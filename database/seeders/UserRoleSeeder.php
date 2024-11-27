<?php

namespace PreOrder\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use PreOrder\PreOrderBackend\Models\Role;
use PreOrder\PreOrderBackend\Models\User;

class UserRoleSeeder extends Seeder
{
    public function run(): void
    {
        $descriptionData = [
            'admin' => 'Admin can perform all actions',
            'manager' => 'Managers can view records',
        ];

        $users = [
            [
                'name' => 'Admin User',
                'email' => 'admin@example.com',
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'Manager User',
                'email' => 'manager@example.com',
                'password' => Hash::make('password'),
            ],
        ];

        foreach ($users as $userData) {
            $user = User::query()->updateOrCreate(
                ['email' => $userData['email']],
                $userData
            );

            $roleName = str_starts_with($user->email, 'admin@') ? 'admin' : 'manager';

            $role = Role::query()->firstOrCreate(['name' => $roleName],['description' => $descriptionData[$roleName]]);

            $user->roles()->sync([$role->id]);
        }
    }
}