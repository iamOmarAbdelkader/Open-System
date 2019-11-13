<?php

use Illuminate\Database\Seeder;

use App\Models\User;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        User::create([
            'name'=>'admin',
            'user_name'=>'admin',
            'password'=>'123456',
        ]);
    }
}
