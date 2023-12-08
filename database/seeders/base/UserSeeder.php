<?php

namespace Database\Seeders\base;

use App\Models\User;
use Illuminate\Support\Str;
use App\Models\Super\UserRole;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sa = UserRole::all();

        User::insert([
            [
                'id'           => Str::uuid()->toString(),
                'username' => 'superadmin',
                'password'     =>  Hash::make('admin123', ['rounds' => 12]),
                'active'       => 1,
                'user_role_id' =>  $sa[0]->id,
                'email'        => 'zik@gmail.com',
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
            [
                'id'           => Str::uuid()->toString(),
                'username' => 'admin',
                'password'     =>  Hash::make('admin123', ['rounds' => 12]),
                'active'       => 1,
                'user_role_id' =>  $sa[1]->id,
                'email'        => 'admin@gmail.com',
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
        ]);
    }
}
