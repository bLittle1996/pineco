<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = "products";

    function category(){
      return $this->belongsTo('App\Category');
    }

    function reviews() {
      return $this->hasMany('App\ProductReview');
    }

    function carts() {
      return $this->belongsToMany('App\Cart')->withPivot('quantity')->withTimestamps();
    }
}
