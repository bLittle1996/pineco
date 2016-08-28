<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable;
use Laravel\Cashier\Billable;
class User extends Model implements \Illuminate\Contracts\Auth\Authenticatable
{
  use Authenticatable;//tells laravel "Hey, you can use me for authenticating things"
  use Billable; //lets Laravel Cashier know that we can charge these suckers

  protected $table = 'users'; //this is the table in the database this class is linked to
  protected $hidden = ['email', 'password', 'remember_token']; //makes it so that this isn't returned in our array's or json

  public function reviews() {
    return $this->hasMany('App\ProductReview');
  }

  public function cart() {
    return $this->hasOne('App\Cart');
  }

  public function userShippingInfo() {
    return $this->hasMany('App\UserShippingInfo');
  }
}
