<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable;
class User extends Model implements \Illuminate\Contracts\Auth\Authenticatable
{
  use Authenticatable;//tells laravel "Hey, you can use me for authenticating things"
  protected $table = 'users'; //this is the table in the database this class is linked to
  protected $hidden = ['password', 'remember_token']; //makes it so that this isn't returned in our array's or json

  public function reviews() {
    return $this->hasMany('App\ProductReview');
  }

  public function cart() {
    return $this->hasOne('App\Cart');
  }
}
