<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::factory()->count(1)->create(['name' => 'admin', 'slug' => 'admin']);
        Role::factory()->count(1)->create(['name' => 'user', 'slug' => 'user']);
    }
}
