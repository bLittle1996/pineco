<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Cart;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->username = 'lexington';
        $user->email = 'lexington@test.com';
        $user->password = bcrypt("notsecure");
        $user->confirmed = true;
        $cart = new Cart();
        $user->save();
        $user->cart()->save($cart);

        $user = new User();
        $user->username = "enterprise";
        $user->email = "enterprise@starfleet.ca";
        $user->confirmed = true;
        $user->password = bcrypt("yoshi");
        $cart = new Cart();
        $user->save();
        $user->cart()->save($cart);

    }
}
