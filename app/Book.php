<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    //
    public function bookTransactions(){
        return $this->hasMany('app\Transaction');
    }
}
