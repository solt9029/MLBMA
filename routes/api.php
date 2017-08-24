<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::post("/books/register",[
//   "as"=>"books.register",
//   "uses"=>"BooksController@register"
// ]);

// Route::group(['middleware' => 'api'], function () {
//     Route::post("/books/register",[
//         "as"=>"books.register",
//         "uses"=>"BooksController@register"
//     ]);

//     Route::post("/books/test", [
//         "as" => "books.test",
//         "uses" => "BooksController@test"
//     ]);

//     Route::post("books/show",[
//         "as"=>"books.show",
//         "uses"=>"BooksController@show"
//     ]);

//     Route::post("books/delete",[
//         "as"=>"books.delete",
//         "uses"=>"BooksController@delete"
//     ]);

//     Route::post("books/state",[
//         "as"=>"books.state",
//         "uses"=>"BooksController@state"
//     ]);

//     Route::get("users/user_id",[
//         "as"=>"users.id",
//         "uses"=>"UsersController@user_id"
//     ]);
// });