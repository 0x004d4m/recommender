<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'name' => 'admin',
            'email' => 'admin@app.com',
            'password' => Hash::make('admin1234'),
            'is_admin' => true,
        ]);

        DB::table('permissions')->insert([
            ["id"=>1,"name"=> "Manage Posts","guard_name"=>"web"],
            ["id"=>2,"name"=> "Manage Users","guard_name"=>"web"],
            ["id"=>3,"name"=> "Manage Roles","guard_name"=>"web"],
        ]);

        DB::table('roles')->insert([
            ["id"=>1,"name"=>"Super Admin","guard_name"=>"web"]
        ]);

        DB::table('model_has_roles')->insert([
            ["role_id"=>1,"model_type"=>"App\Models\User","model_id"=>"1"],
        ]);

        DB::table('role_has_permissions')->insert([
            ["permission_id"=>1,"role_id"=>1],
            ["permission_id"=>2,"role_id"=>1],
            ["permission_id"=>3,"role_id"=>1],
        ]);

        \App\Models\Post::factory(1000)->create();
    }
}
