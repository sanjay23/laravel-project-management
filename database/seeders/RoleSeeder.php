<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::insert([
            ['name' => 'super admin'],
            ['name' => 'admin'],
            ['name' => 'project manager'],
            ['name' => 'developer'],
            ['name' => 'designer'],
            ['name' => 'qa'],
            ['name' => 'client'],
            ['name' => 'hr'],
            ['name' => 'accountant'],
        ]);
    }
}
