<?php

namespace Database\Seeders\base;

use App\Models\Super\Menu;
use App\Models\Super\Access;
use App\Models\Super\UserRole;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AccessSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $supM = Menu::take(5)->get();
        $sup  = UserRole::where('nama', 'superadmin')->first();

        $adminM = Menu::take(1)->get();
        $user   = Menu::take(1)->get();

        $ur = UserRole::get();

        $supA = [];
        foreach ($supM as $id) {
            $supA[] = [
                'menu_id'      => $id->id,
                'user_role_id' => $sup->id,
                'created_at'   => now(),
                'updated_at'   => now(),
            ];
        }

        $adm = [];
        foreach ($adminM as $menu) {
            $adm[] = [
                'menu_id'      => $menu->id,
                'user_role_id' => $ur[1]->id,
                'created_at'   => now(),
                'updated_at'   => now(),
            ];
        }

        $usr = [];
        foreach ($user as $menu) {
            $usr[] = [
                'menu_id' => $menu->id,
                'user_role_id' => $ur[2]->id,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        $marge = array_merge($supA, $adm, $usr);
        Access::insert($marge);
    }
}
