<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

return new class extends Migration
{
    public function up()
    {
        // First insert the branch if it doesn't exist
        DB::table('branches')->updateOrInsert(
            ['branch_id' => 'B-001'],
            ['branch_name' => 'Main Branch', 'created_at' => now(), 'updated_at' => now(), 'address' => 'default']
        );

        // Then insert the user
        DB::table('users')->insert([
            'name' => 'System Admin User',
            'username' => 'system-admin',
            'password' => Hash::make('password'), // Use a secure password
            'role' => 'system-admin',
            'branch_id' => 'B-001',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function down()
    {
        DB::table('users')->where('username', 'system-admin')->delete();
        DB::table('branches')->where('branch_id', 'B-001')->delete();
    }
};

