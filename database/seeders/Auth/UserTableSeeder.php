<?php

namespace Database\Seeders\Auth;

use App\Events\Backend\UserCreated;
use App\Models\PasswordHash;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

/**
 * Class UserTableSeeder.
 */
class UserTableSeeder extends Seeder
{
    /**
     * Run the database seed.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();

        $faker = \Faker\Factory::create();

        // Add the master administrator, user id of 1
        $users = [
            [
                'nim' => '10001',
                'nama' => 'Laboran',
                'username' => 'admin',
                'password' => Hash::make('admin'),
                'password_string' => 'admin',
                'telepon' => $faker->phoneNumber,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'status' => 'laboran',
            ],
            [
                'nim' => '10002',
                'nama' => 'Mahasiswa',
                'username' => 'user',
                'password' => Hash::make('user'),
                'password_string' => 'user',
                'telepon' => $faker->phoneNumber,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'status' => 'mahasiswa'
            ],
        ];

        foreach ($users as $user_data) {
            User::create($user_data);
        }

        Schema::enableForeignKeyConstraints();
    }
}
