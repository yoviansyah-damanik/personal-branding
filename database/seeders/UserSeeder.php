<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create(
            [
                'username' => 'yoviansyah25',
                'name' => 'Yoviansyah Rizki Pratama',
                'email' => 'yoviansyahrizkypratama@gmail.com',
                'password' => bcrypt(123456)
            ]
        );

        User::create(
            [
                'username' => 'subarjaroy',
                'name' => 'Roy Efendi Subarja',
                'email' => 'subardjaroy@gmail.com',
                'password' => bcrypt(123456)
            ]
        );
    }
}
