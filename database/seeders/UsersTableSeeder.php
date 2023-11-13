<?php

namespace Database\Seeders;
use App\Models\User;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       // Mengisi tabel users dengan data dummy

    //    User Admin
       User::create([
        'user_name' => 'admin',
        'name' => 'Admin DTS',
        'role' => 'admin',
        'last_active' => Carbon::now(),
        'password' => bcrypt('Ind0lica'),
    ]);


    //    User JKN
       User::create([
        'user_name' => 'Hali',
        'name' => 'Hali Munandar',
        'role' => 'JKN',
        'last_active' => Carbon::now(),
        'password' => bcrypt('12345'),
    ]);


    //    User kepala ruangan
       User::create([
        'user_name' => 'Dani',
        'name' => 'Dani Munandar',
        'role' => 'kepala ruangan',
        'last_active' => Carbon::now(),
        'password' => bcrypt('12345'),
    ]);


    }
}
