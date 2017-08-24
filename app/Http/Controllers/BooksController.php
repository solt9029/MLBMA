<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;
use Auth;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class BooksController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    //isbnのクエリを取得、13または10文字だったら登録する→validation？
    public function register(Request $request)
    {
        $isbn = $request->input('isbn');
        $name = Book::getName($isbn);//名前を取得する

        if(!$name){
            return false;
        }

        Book::create([
            "user_id"=>Auth::user()->id,
            "isbn"=>$request->input("isbn"),
            "name"=>$name
        ]);

        return;
    }

    public function delete(Request $request)
    {
        $id=intval($request->input("id"));
        $book=Book::find($id);
        $book->delete();
        return;
    }

    //ページネーションしながら出してほしい
    public function show(Request $request)
    {
        /*if($request->input("mine")){
            $user_id=Auth::user()->id;
            $books=Book::where("user_id",$user_id)->get();
        }else{
            $books=Book::all();
        }*/
        // $books=Book::all();
        $books = Book::where("user_id",Auth::user()->id)->paginate(5);
        return $books;
    }

    public function state(Request $request){
        $isbn=$request->input("isbn");
        $campus=$request->input("campus");
        if(empty($isbn) || strlen($isbn)!==13){
            return false;
        }
        $url="http://opac.lib.meiji.ac.jp/webopac/ctlsrh.do";
        switch($campus){
            case "nakano":$campus="MN";break;
            case "ikuta":$campus="MS";break;
            case "surugadai":$campus="MH";break;
            case "izumi":$campus="MW";break;
            case "all":$campus="all";break;
            default: $campus="MN";break;
        }
        $postdata=array("holar"=>$campus,"isbn_issn"=>$isbn);
        $ch=curl_init($url);
        curl_setopt($ch,CURLOPT_POST,true);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        curl_setopt($ch,CURLOPT_POSTFIELDS,$postdata);
        $html=curl_exec($ch);
        curl_close($ch);

        //所蔵がある場合
        if(strpos($html,"所蔵はありません")===false && strpos($html,"指定された条件に該当する資料がありませんでした")===false){
            $start_pos=mb_strpos($html,"件の所蔵があります")-10;//</strong>があるので10文字分戻しています
            $book_num=mb_substr($html,$start_pos,1);//本の数が手に入る
            preg_match_all("/貸出中/",$html,$match);
            if($book_num==count($match[0])){
                return "貸出中";
            }else if($book_num>count($match[0])){
                return "OK";
            }
        }else{//所蔵が無い場合
            return "所蔵無し";
        }
    }
}
