<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = "categories";

    public function products() {
      return $this->hasMany('App\Product'); //it automatically looks for a foreign key called 'category_id'
    }
}
