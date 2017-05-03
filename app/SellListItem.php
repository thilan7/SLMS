<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SellListItem extends Model
{
    //
    public function books(){
        return $this->hasMany('app\Book');
    }
}
