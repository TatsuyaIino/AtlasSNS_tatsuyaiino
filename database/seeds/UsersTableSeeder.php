<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
           ['username' => 'Tatsuya', 'mail' => 't.i.0607.g@gmail.com', 'password' => Hash::make('tatsuya0607')],
            ['username' => 'user1', 'mail' => 'user1@example.com', 'password' => Hash::make('password1')],
            ['username' => 'user2', 'mail' => 'user2@example.com', 'password' => Hash::make('password2')],
            ['username' => 'user3', 'mail' => 'user3@example.com', 'password' => Hash::make('password3')],
            ['username' => 'user4', 'mail' => 'user4@example.com', 'password' => Hash::make('password4')],
            ['username' => 'user5', 'mail' => 'user5@example.com', 'password' => Hash::make('password5')],
            ['username' => 'user6', 'mail' => 'user6@example.com', 'password' => Hash::make('password6')],
            ['username' => 'user7', 'mail' => 'user7@example.com', 'password' => Hash::make('password7')],
            ['username' => 'user8', 'mail' => 'user8@example.com', 'password' => Hash::make('password8')],
            ['username' => 'user9', 'mail' => 'user9@example.com', 'password' => Hash::make('password9')],
            ['username' => 'user10', 'mail' => 'user10@example.com', 'password' => Hash::make('password10')]
        ]);
    }
}
