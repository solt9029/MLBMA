<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable=["user_id","isbn","name"];

    public static function getName ($isbn)
    {
        //ISBNの値のバリデーション
        if(!is_numeric($isbn) || mb_strlen($isbn)!==13){
            return false;
        }

        $url = "http://iss.ndl.go.jp/api/sru?operation=searchRetrieve&query=isbn=" . $isbn;
        $xml = simplexml_load_file($url);
        $xml_part = (string)$xml->records->record->recordData;
        $name = substr($xml_part, strpos($xml_part, "<dc:title>") + 10, strpos($xml_part, "</dc:title>") - (strpos($xml_part, "<dc:title>") + 10));
        return $name;
    }
};