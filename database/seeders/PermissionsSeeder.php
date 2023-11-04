<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionsSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('permissions')->insert([
            ["id" => 1, "name" => "Manage Posts", "guard_name" => "web"],
            ["id" => 2, "name" => "Manage Users", "guard_name" => "web"],
            ["id" => 3, "name" => "Manage Roles", "guard_name" => "web"],
        ]);
    }
}
