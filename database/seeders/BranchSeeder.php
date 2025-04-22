<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BranchSeeder extends Seeder
{
    public function run()
    {
        DB::table('branches')->insert([
            'branch_id' => 'B-001',
            'branch_name' => 'default',
            'address' => 'default',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
