<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //using model
        User::create([
            'name'=>'sahar alsalmy',
            'email'=>'sahar22@gmail.com',
            'password'=>Hash::make('password'),
            'phone_number'=>'0567898765',
        ]);

        //using Query builder
        // DB::insert('insert into users (id, name) values (?, ?)', [1, 'Dayle'])

        // DB::table('users')->insert([
        //     'name'=>'sahar alsalmy',
        //     'email'=>'sahar22@gmail.com',
        //     'password'=>Hash::make('password'),
        // ]);

    }
}
