<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Add new fields to users table
        Schema::table('users', function (Blueprint $table) {
            // First check if the role column exists and modify it
            if (Schema::hasColumn('users', 'role')) {
                // Drop the existing enum constraint
                DB::statement("ALTER TABLE users DROP CONSTRAINT IF EXISTS users_role_check");
                
                // Recreate the column with the new enum values
                DB::statement("ALTER TABLE users ALTER COLUMN role TYPE VARCHAR(20)");
                DB::statement("ALTER TABLE users ADD CONSTRAINT users_role_check CHECK (role IN ('user', 'admin', 'super_admin'))");
                
                // Set default value for new registrations
                DB::statement("ALTER TABLE users ALTER COLUMN role SET DEFAULT 'user'");
            } else {
                $table->string('role', 20)->default('user');
            }
            
            // Add new profile fields if they don't exist
            if (!Schema::hasColumn('users', 'address')) {
                $table->text('address')->nullable();
            }
            
            if (!Schema::hasColumn('users', 'phone')) {
                $table->string('phone', 50)->nullable();
            }
            
            if (!Schema::hasColumn('users', 'profile_image')) {
                $table->string('profile_image')->nullable();
            }
        });
        
        // Update Joe Doe's role to 'user'
        DB::table('users')
            ->where('name', 'Joe Doe')
            ->update(['role' => 'user']);
            
        // Update Nidal's role to 'admin' if exists
        DB::table('users')
            ->where('name', 'Nidal')
            ->update(['role' => 'admin']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // We don't want to remove columns in the down migration
        // as it could lead to data loss
    }
};
