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

        $info = Book::getInfo($isbn);
        $author = '';

        foreach ($info['authors'] as $a) {
            $author .= $a;
            $author .= '/';
        }

        //そのインデックスが存在してから代入した方がよさそうだけど、とりあえずこれで
        logger(Book::create([
            "user_id"=>Auth::user()->id,
            "isbn"=>$request->input("isbn"),
            "name"=>$name,
            'author' => $author,
            'published' => $info['publishedDate'],
            'description' => $info['description'],
            'page' => intval($info['pageCount']),
            'thumbnail' => $info['imageLinks']['thumbnail']
        ]));

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
        $page_num = 10;//ページネーションの数

        $books = Book::paginate($page_num);

        if ($request->input('yours')) {
            $user_id = Auth::user()->id;
            $books = Book::where('user_id', $user_id)->paginate($page_num);
        }

        return $books;
    }

    public function state(Request $request)
    {
        $this->validate($request, [
            'isbn' => 'required|size:13'
        ]);

        return Book::getState($request->input("isbn"), $request->input("campus"));
    }

    public function test()
    {
        return Book::getInfo('9784822296537');
    }
}
