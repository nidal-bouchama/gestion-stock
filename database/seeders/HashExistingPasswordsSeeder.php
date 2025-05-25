<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class HashExistingPasswordsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all users from the utilisateurs table
        $users = DB::table('utilisateurs')->get();
        
        foreach ($users as $user) {
            // Hash each password using Laravel's bcrypt
            DB::table('utilisateurs')
                ->where('Email', $user->Email)
                ->update([
                    'Password' => Hash::make($user->Password),
                    'updated_at' => now()
                ]);
        }
    }
}
