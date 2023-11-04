<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('roles')->insert([
            ["id" => 1, "name" => "Super Admin", "guard_name" => "web"]
        ]);

        DB::table('model_has_roles')->insert([
            ["role_id" => 1, "model_type" => "App\Models\User", "model_id" => "1"],
        ]);

        DB::table('role_has_permissions')->insert([
            ["permission_id" => 1, "role_id" => 1],
            ["permission_id" => 2, "role_id" => 1],
            ["permission_id" => 3, "role_id" => 1],
        ]);
    }
}
