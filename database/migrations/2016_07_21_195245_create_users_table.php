<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('users', function (Blueprint $table) {

        $table->increments('id');
        $table->string('username')->unique();
        $table->string('email')->unique();
        $table->string('password');//the users actual password
        $table->rememberToken();//used for remember me functionality, which I probably will forget to do!
        $table->timestamps();//created at, updated at

      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
}
