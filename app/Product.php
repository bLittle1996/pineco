<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = "products";

    public function category(){
      return $this->belongsTo('App\Category');
    }

    public function reviews() {
      return $this->hasMany('App\ProductReview');
    }

    public function carts() {
      return $this->belongsToMany('App\Cart')->withPivot('quantity')->withTimestamps();
    }

    public function orderDetails() {
      return $this->hasMany('App\OrderDetail');
    }
}
