<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable=["user_id", "isbn", "name", 'author', 'published', 'description', 'page', 'thumbnail'];

    public static function getName($isbn)
    {
        $url = "http://iss.ndl.go.jp/api/sru?operation=searchRetrieve&query=isbn=" . $isbn;
        $xml = simplexml_load_file($url);
        $xml_part = (string)$xml->records->record->recordData;
        $name = substr($xml_part, strpos($xml_part, "<dc:title>") + 10, strpos($xml_part, "</dc:title>") - (strpos($xml_part, "<dc:title>") + 10));
        return $name;
    }

    //著者・出版日・概要・ページ数・画像をとってきてあげたい！
    public static function getInfo($isbn)
    {
        //httpsでないと駄目っぽい
        $url = 'https://www.googleapis.com/books/v1/volumes?q=isbn:' . $isbn;
        $json = file_get_contents($url);
        $info = json_decode($json, true);
        return $info['items'][0]['volumeInfo'];
        // return $info["items"][0]["volumeInfo"]["authors"]; // 著者
        // return $info["items"][0]["volumeInfo"]["publishedDate"]; // 出版日
        // return $info["items"][0]["volumeInfo"]["description"]; // 概要
        // return $info["items"][0]["volumeInfo"]["pageCount"]; // ページ数
        // return $info["items"][0]["volumeInfo"]["imageLinks"]["thumbnail"]; // サムネイル画像
    }

    public static function getState($isbn, $campus)
    {
        //キャッシュがあればそれを返す
        if (\Cache::has($isbn)) {
            return \Cache::get($isbn);
        }

        //図書館のURLです
        $url = "http://opac.lib.meiji.ac.jp/webopac/ctlsrh.do";

        switch ($campus) {
            case "nakano": $campus="MN"; break;
            case "ikuta": $campus="MS"; break;
            case "surugadai": $campus="MH"; break;
            case "izumi": $campus="MW"; break;
            case "all": $campus="all"; break;
            default: $campus="MN"; break;
        }

        $postdata = array("holar" => $campus, "isbn_issn" => $isbn);
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
        $html = curl_exec($ch);
        curl_close($ch);

        //所蔵がある場合
        if(strpos($html,"所蔵はありません") === false && strpos($html,"指定された条件に該当する資料がありませんでした") === false){
            //</strong>があるので10文字分戻しています
            $start_pos=mb_strpos($html,"件の所蔵があります")-10;
            $book_num=mb_substr($html,$start_pos,1);//本の数が手に入る
            preg_match_all("/貸出中/",$html,$match);

            if($book_num==count($match[0])){
                \Cache::put($isbn, "貸出中", 60);
                return "貸出中";
            }else if($book_num>count($match[0])){
                \Cache::put($isbn, "OK", 60);
                return "OK";
            }
            
        }else{
            \Cache::put($isbn, "所蔵無し", 60*24);
            return "所蔵無し";//所蔵が無い場合
        }
    }
};