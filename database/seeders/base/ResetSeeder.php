<?php

namespace Database\Seeders\base;

use App\Models\User;
use App\Models\Super\Menu;
use App\Models\Super\Access;
use App\Models\Super\UserRole;
use Illuminate\Database\Seeder;
use App\Models\Super\MenuController;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ResetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Menu::truncate();
        User::truncate();
        Access::truncate();
        UserRole::truncate();
        MenuController::truncate();
    }
}
