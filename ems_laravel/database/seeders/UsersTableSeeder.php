<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
class UsersTableSeeder extends Seeder
{
    public function run()
    {
        // Create users
        $user1 = User::create([
                'role_id' => 2,
                'first_name' => 'participant',
                'last_name' => 'participant',
                'gender' => 'Male',
                'date_of_birth' => '2001-01-01',
                'email' => 'bunjan.mark476@gmail.com', #replace with your gmail to test
                'user_name' => 'admin',
                'password' => Hash::make('admin'),
                'mobile_number' => '09123456789',
                'street_address' => '123 Main St',
                'city' => 'Anytown',
                'post_code' => '12345',
                'country' => 'USA',
                'created_at' => now(),
                'updated_at' => now(),
        ]);
        // Create more users as needed
    }
}

