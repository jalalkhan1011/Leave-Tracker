<?php

namespace Database\Seeders;

use App\Models\PermissionLabel;
use App\Models\PermissionLabelCheck;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissionLabel = PermissionLabel::create([
            'permission_label' => 'User'
        ]);
        PermissionLabelCheck::create([
            'permission_label' => $permissionLabel->permission_label,
            'role_name' => 'Admin',
            'role_id' => 1,
            'check_status' => '1',
        ]);
        Permission::create([
            'name' => 'user-list',
            'permission_label' => $permissionLabel->permission_label,
        ]);
        Permission::create([
            'name' => 'user-create',
            'permission_label' => $permissionLabel->permission_label,
        ]);
        Permission::create([
            'name' => 'user-edit',
            'permission_label' => $permissionLabel->permission_label,
        ]);
        Permission::create([
            'name' => 'user-delete',
            'permission_label' => $permissionLabel->permission_label,
        ]);
        Permission::create([
            'name' => 'user-approve',
            'permission_label' => $permissionLabel->permission_label,
        ]);
        Permission::create([
            'name' => 'user-block',
            'permission_label' => $permissionLabel->permission_label,
        ]);
        $adminUser = Role::findByName('Admin');
        $adminUser->givePermissionTo(['user-list', 'user-create', 'user-edit', 'user-delete', 'user-approve', 'user-block']);
    }
}
