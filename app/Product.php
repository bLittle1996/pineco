<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = "products";

    function category(){
      return $this->belongsTo('App\Category');
    }
}
