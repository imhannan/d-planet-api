<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->count(1)->create(['role_id' => 1, 'name' => 'Admin', 'email' => 'hannanhridoy@gmail.com','password' => bcrypt('adgjmp420')]);
        User::factory()->count(10)->create();
    }
}
