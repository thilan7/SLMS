<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    //
    public function bookTransactions(){
        return $this->hasMany('app\Transaction');
    }
    public static function SearchByKeyword($query, $keyword)
    {
        if ($keyword!='') {
            $query->where(function ($query) use ($keyword) {
                $query->where("book_id", "LIKE","%$keyword%")
                    ->orWhere("title", "LIKE", "%$keyword%")
                    ->orWhere("author", "LIKE", "%$keyword%")
                    ->orWhere("description", "LIKE", "%$keyword%")
                    ->orWhere("isbn_number", "LIKE", "%$keyword%");
            });
        }
        return $query;
    }
}
//$book->book_id = $bookID;
//$book->title=$title;
//$book->author=$author;
//$book->isbn_number = $isbn;
//$book->description=$description;
//$book->reference=$reference;
//$book->availability=true;