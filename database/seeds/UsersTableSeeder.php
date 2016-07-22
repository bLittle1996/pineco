<?php

use Illuminate\Database\Seeder;
use App\User;
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
        $user->save();

        $user = new User();
        $user->username = "enterprise";
        $user->email = "enterprise@starfleet.ca";
        $user->password = bcrypt("yoshi");
        $user->save();
    }
}
