<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable;
class User extends Model implements \Illuminate\Contracts\Auth\Authenticatable
{
  use Authenticatable;//tells laravel "Hey, you can use me for authenticating things"
  protected $table = 'users'; //this is the table in the database this class is linked to
}
