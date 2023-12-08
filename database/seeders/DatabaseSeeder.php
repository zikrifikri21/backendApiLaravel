<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\Super\UserRole;
use Illuminate\Database\Seeder;
use Database\Seeders\base\MenuSeeder;
use Database\Seeders\base\UserSeeder;
use Database\Seeders\base\AccessSeeder;
use Database\Seeders\base\UserRoleSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $role  = UserRole::count();
        $super = User::count();

        if ($role <= 0) {
            $this->call(UserRoleSeeder::class);
        }

        if ($super <= 0) {
            $this->call(UserSeeder::class);
        }

        $this->call(MenuSeeder::class);
        $this->call(AccessSeeder::class);
    }
}
