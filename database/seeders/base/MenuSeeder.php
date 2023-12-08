<?php

namespace Database\Seeders\base;

use App\Models\Super\Menu;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Menu::insert([
            [
                'title' => strtolower('Dashboard'),
                'url' => strtolower('dashboard'),
                'icon' => strtolower('bx bxs-dashboard'),
                'is_main_menu' => 0,
                'is_aktif' => 'y',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => strtolower('Manage User'),
                'url' => strtolower('user-manage.index'),
                'icon' => strtolower('bx bxs-user-circle'),
                'is_main_menu' => 0,
                'is_aktif' => 'y',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => strtolower('Manage Role'),
                'url' => strtolower('user-role-manage.index'),
                'icon' => strtolower('bx bxs-user-account'),
                'is_main_menu' => 0,
                'is_aktif' => 'y',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => strtolower('Manage Menu'),
                'url' => strtolower('menu-manage.index'),
                'icon' => strtolower('bx bx-menu'),
                'is_main_menu' => 0,
                'is_aktif' => 'y',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => strtolower('Manage Access'),
                'url' => strtolower('access-rights-of-each-user.index'),
                'icon' => strtolower('bx bx-crown'),
                'is_main_menu' => 0,
                'is_aktif' => 'y',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
