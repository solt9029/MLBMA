<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

use Faker\Factory as Faker;
use Carbon\Carbon;
use App\Book;

class BooksTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('books')->delete();
        $faker = Faker::create('en_US');

        // この部分はあとで書籍情報を取得するように書き直す
        for ($i = 0; $i < 100; $i++) {
            Book::create([
                'user_id' => 1,
                'isbn' => '9784802610445',
                'name' => 'test'
            ]);
        }
    }  
}
