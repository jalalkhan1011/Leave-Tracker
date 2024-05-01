<?php

namespace Database\Seeders;

use App\Models\PermissionLabel;
use App\Models\PermissionLabelCheck;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class LeavePermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissionLabel = PermissionLabel::create([
            'permission_label' => 'Leave'
        ]);
        PermissionLabelCheck::create([
            'permission_label' => $permissionLabel->permission_label,
            'role_name' => 'Admin',
            'role_id' => 1,
            'check_status' => '1',
        ]);
        Permission::create([
            'name'=>'leave-list',
            'permission_label' => $permissionLabel->permission_label,
        ]);
        Permission::create([
            'name'=>'leave-create',
            'permission_label' => $permissionLabel->permission_label,
        ]);
        Permission::create([
            'name'=>'leave-edit',
            'permission_label' => $permissionLabel->permission_label,
        ]);
        Permission::create([
            'name'=>'leave-delete',
            'permission_label' => $permissionLabel->permission_label,
        ]);
        Permission::create([
            'name'=>'leave-approve',
            'permission_label' => $permissionLabel->permission_label,
        ]);
        Permission::create([
            'name'=>'leave-reject',
            'permission_label' => $permissionLabel->permission_label,
        ]);
        $adminUser = Role::findByName('Admin');
        $employeeUser = Role::findByName('Employee');
        $adminUser->givePermissionTo(['leave-list','leave-create','leave-edit','leave-delete']);
        $employeeUser->givePermissionTo(['leave-list','leave-create']);
    }
}
