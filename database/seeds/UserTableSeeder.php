<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use CodeCommerce\Category;

class UserTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->truncate();

        \CodeCommerce\User::create([
            'name' => "Rogerio Munhoz",
            'email' => "rogerio_munhoz@hotmail.com.br",
            'password' => \Illuminate\Support\Facades\Hash::make(123456),
            'is_admin' => 1,
        ]);

        factory('CodeCommerce\User', 9)->create();
    }
}
