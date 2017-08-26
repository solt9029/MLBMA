<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAuthorPublishedDescriptionPageThumbnailToBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('books', function (Blueprint $table) {
            $table->string('author')->nullable();//もしかしたらtextの方が良いかも？
            $table->string('published')->nullable();
            $table->text('description')->nullable();
            $table->integer('page')->nullable();
            $table->string('thumbnail')->nullable();//もしかしたらtextの方が良いかも？バグが出たら対応ってことで
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('books', function (Blueprint $table) {
            $table->dropColumn('author');
            $table->dropColumn('published');
            $table->dropColumn('description');
            $table->dropColumn('page');
            $table->dropColumn('thumbnail');
        });
    }
}
