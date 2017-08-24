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
        $this->validate($request, [
            'isbn' => 'required|size:13'
        ]);

        $isbn = $request->input('isbn');
        $name = Book::getName($isbn);//名前を取得する

        //名前が取得できなかったらfalse
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
        $this->validate($request, [
            'id' => 'required'
        ]);

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

    public function state(Request $request)
    {
        $this->validate($request, [
            'isbn' => 'required|size:13'
        ]);

        return Book::getState($request->input("isbn"), $request->input("campus"));
    }
}
