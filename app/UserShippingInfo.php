<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserShippingInfo extends Model
{
  protected $table = 'user_shipping_info';

  public function user() {
    return $this->belongsTo('App\User');
  }
}
