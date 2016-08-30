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
        $table->string('confirmation_token')->nullable();
        $table->boolean('confirmed')->default(false);
        $table->string('password_token')->nullable();
        /* The following is required for Laravel Cashier w/ Stripe to work */
        $table->string('stripe_id')->nullable();
        $table->string('card_brand')->nullable();
        $table->string('card_last_four')->nullable();
        $table->timestamp('trial_ends_at')->nullable();
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
