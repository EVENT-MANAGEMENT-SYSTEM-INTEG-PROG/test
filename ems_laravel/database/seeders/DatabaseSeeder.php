<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
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
                'role_name' => 'participant',
                'role_description' => 'Event participant role',
                'permission_type' => 'limited_access',
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
        ]);

        //Added separate file for users
        // DB::table('users')->insert([
        //     [
        //         'role_id' => 1,
        //         'first_name' => 'admin',
        //         'last_name' => 'admin',
        //         'gender' => 'Male',
        //         'date_of_birth' => '2001-01-01',
        //         'email' => 'admin@gmail.com',
        //         'user_name' => 'admin',
        //         'password' => Hash::make('admin'),
        //         'mobile_number' => '09123456789',
        //         'country' => 'Philippines',
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ],
        //     [
        //         'role_id' => 3,
        //         'first_name' => 'organizer',
        //         'last_name' => 'organizer',
        //         'gender' => 'Male',
        //         'date_of_birth' => '2003-03-03', 
        //         'email' => 'organizer@gmail.com',
        //         'user_name' => 'organizer',
        //         'password' => Hash::make('organizer'),
        //         'mobile_number' => '09123456789',
        //         'country' => 'Philippines',
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ],
        //     [
        //         'role_id' => 2,
        //         'first_name' => 'shoeken',
        //         'last_name' => 'Bunjan',
        //         'gender' => 'Male',
        //         'date_of_birth' => '1920-01-15',
        //         'email' => 'vincentbunjan476@gmail.com',
        //         'user_name' => 'vincentbunjan',
        //         'password' => Hash::make('organizer'),
        //         'mobile_number' => '1234567890',
        //         'street_address' => '123 Main St',
        //         'city' => 'Anytown',
        //         'post_code' => '12345',
        //         'country' => 'USA',
        //     ]
        // ]);
        
        $this->call(UsersTableSeeder::class);
        $this->call(EventsTableSeeder::class);
        $this->call(RegistrationsTableSeeder::class);
    }
}
