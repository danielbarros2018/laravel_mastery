<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Daniel Barros',
            'email' => 'danielbarros.android@gmail.com',
        ]);

        User::factory(15)
            ->hasProfile()
            ->create();
    }
}