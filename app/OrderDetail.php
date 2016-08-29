<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
  public function orders() {
    return $this->belongsTo('App\Model');
  }

  public function products() {
    return $this->belongsTo('App\Model');
  }
}
