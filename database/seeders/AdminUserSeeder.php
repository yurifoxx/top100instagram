<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AdminUser;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        AdminUser::updateOrCreate(
            ['email' => 'admin@top100.com.br'],
            [
                'name'     => 'Administrador',
                'password' => Hash::make('password'),
            ]
        );
    }
}
