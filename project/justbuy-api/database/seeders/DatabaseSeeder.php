<?php

namespace Database\Seeders;

use App\Models\Cart;
use App\Models\Product;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::factory()
            ->count(3)
            ->state(new Sequence(
                ['name' => 'guest'],
                ['name' => 'client'],
                ['name' => 'admin']
            ))
            ->create();

        User::factory(30)
            ->has(
                Cart::factory()->count(1)
            )
            ->create();

        Product::factory(30)
            ->create();
    }
}
