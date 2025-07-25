<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Str;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (! User::where('email', 'admin@yopmail.com')->exists()) {
            User::create([
                'name' => 'Admin',
                'email' => 'admin@yopmail.com',
                'password' => 'password',
                'email_verified_at' => now(),
                'role_id' => 1, // Assuming 'super admin' has ID 1
                'remember_token' => \Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        $faker = Faker::create('en_IN');

        $mobileStart = 6000000000;

        $users = [];
        $chunkSize = 100;

        for ($i = 0; $i < 100; $i++) {
            $firstName = $faker->firstName;
            $lastName = $faker->lastName;
            $name = $firstName.' '.$lastName;
            $email = strtolower($firstName).'.'.strtolower($lastName).'@yopmail.com';
            if (in_array($email, array_column($users, 'email'))) {
                $email = strtolower($firstName).'.'.strtolower($lastName).$i.'@yopmail.com';
            }

            $users[] = [
                'name' => $name,
                'email' => $email,
                'email_verified_at' => now(),
                'password' => 'password',
                'role_id' => rand(1, 9), // Random role ID between 1 and 9
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ];

            // Insert in chunks of 1000
            if (($i + 1) % $chunkSize === 0) {
                User::insert($users);
                $users = [];
            }
        }

        // Insert remaining records
        if (! empty($users)) {
            User::insert($users);
        }
    }
}
