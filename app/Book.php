<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable=["user_id","isbn","name"];

    public static function validateISBN($isbn)
    {
        //ISBNの値のバリデーション
        if (!is_numeric($isbn) || mb_strlen($isbn) !== 13) {
            return false;
        }
    }

    public static function getName($isbn)
    {
        //ISBNの値のバリデーション
        if(!is_numeric($isbn) || mb_strlen($isbn) !== 13){
            return false;
        }

        $url = "http://iss.ndl.go.jp/api/sru?operation=searchRetrieve&query=isbn=" . $isbn;
        $xml = simplexml_load_file($url);
        $xml_part = (string)$xml->records->record->recordData;
        $name = substr($xml_part, strpos($xml_part, "<dc:title>") + 10, strpos($xml_part, "</dc:title>") - (strpos($xml_part, "<dc:title>") + 10));
        return $name;
    }

    public static function getState($isbn, $campus)
    {
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
        if(strpos($html,"所蔵はありません")===false && strpos($html,"指定された条件に該当する資料がありませんでした")===false){
            //</strong>があるので10文字分戻しています
            $start_pos=mb_strpos($html,"件の所蔵があります")-10;
            $book_num=mb_substr($html,$start_pos,1);//本の数が手に入る
            preg_match_all("/貸出中/",$html,$match);
            if($book_num==count($match[0])){
                return "貸出中";
            }else if($book_num>count($match[0])){
                return "OK";
            }
        }else{
            return "所蔵無し";//所蔵が無い場合
        }
    }
};