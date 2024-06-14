<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            [
                'role_name' => 'admin',
                'role_description' => 'Administrator role',
                'permission_type' => 'full_access',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'role_name' => 'organizer',
                'role_description' => 'Event organizer role',
                'permission_type' => 'limited_access',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'role_name' => 'participant',
                'role_description' => 'Event participant role',
                'permission_type' => 'read_only',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
