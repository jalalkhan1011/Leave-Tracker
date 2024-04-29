<?php

namespace Database\Seeders;

use App\Models\PermissionLabel;
use App\Models\PermissionLabelCheck;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissionLabel = PermissionLabel::create([
            'permission_label' => 'Role'
        ]);
        PermissionLabelCheck::create([
            'permission_label' => $permissionLabel->permission_label,
            'role_name' => 'Admin',
            'role_id' => 1,
            'check_status' => '1',
        ]);
        $permissions = [
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',
        ]; 
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
