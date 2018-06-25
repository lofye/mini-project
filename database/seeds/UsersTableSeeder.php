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
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        User::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $now = date('Y-m-d H:i:s', time());

        $user = new User();
        $user->name = 'Derek Martin';
        $user->email = 'dmartin@start.ca';
        $user->password = Hash::make('testing');
        $user->created_at = $now;
        $user->updated_at = $now;
        $user->save();

        $user = new User();
        $user->name = 'Hassan Saghier';
        $user->email = 'hsaghier@start.ca';
        $user->password = Hash::make('testing');
        $user->created_at = $now;
        $user->updated_at = $now;
        $user->save();
    }
}
