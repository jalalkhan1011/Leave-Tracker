<?php

namespace App\Http\Controllers;

use App\Models\PermissionLabel;
use App\Models\PermissionLabelCheck;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    function __construct()
    {
        $this->middleware(['auth']);
        $this->middleware('permission:role-list|role-create|role-edit|role-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:role-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:role-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:role-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::all();
        return view('admin.users.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permissionLabels = PermissionLabel::get();
        $permissions = Permission::get();
        return view('admin.users.roles.create', compact('permissions', 'permissionLabels'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:roles,name',
            'permission_id' => 'required',
        ]);
        DB::beginTransaction();
        try {
            $role = Role::create(['name' => $request->name]);
            foreach ($request->permission_label as $key => $permission) {
                PermissionLabelCheck::create([
                    'permission_label' => $request->permission_label[$key],
                    'role_name' => $request->name,
                    'role_id' => $role->id,
                    'check_status' => isset($request->check_status[$permission]) ? '1' : '0',
                ]);
            }
            $role->syncPermissions($request->permission_id);
            DB::commit();
            toastr()->success('Role create successfully!', 'Success');
            return redirect()->route('roles.index');
        } catch (\Throwable $th) {
            DB::rollBack();
            toastr()->error('Something want wrong!', 'Opps');
            return redirect()->route('roles.index');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        $permissionLabels = PermissionLabelCheck::where('role_name', $role->name)->get();
        $permissions = Permission::get();
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id", $role->id)
            ->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')
            ->all();
        return view('admin.users.roles.edit', compact('role', 'permissions', 'permissionLabels', 'rolePermissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        $this->validate($request, [
            'name' => 'required',
            'permission_id' => 'required',
        ]);
        DB::beginTransaction();
        try {
            $role = Role::find($role->id);
            $role->name = $request->name;
            $role->save();
            // $checkLabelDelete = PermissionLabelCheck::where('role_id', $role->id)->delete();
            foreach ($request->permission_label as $key => $permission) {
                // PermissionLabelCheck::create([
                //     'permission_label' => $request->permission_label[$key],
                //     'role_name' => $request->name,
                //     'role_id' => $role->id,
                //     'check_status' => isset($request->check_status[$permission]) ? '1' : '0',
                // ]);
                PermissionLabelCheck::where([['permission_label', $permission]])->update([
                    'check_status' => isset($request->check_status[$permission]) ? '1' : '0',
                ]);
            }
            $role->syncPermissions($request->permission_id);
            DB::commit();
            toastr()->success('Role update successfully!', 'Success');
            return redirect()->route('roles.index');
        } catch (\Throwable $th) {
            DB::rollBack();
            toastr()->error('Something want wrong!', 'Opps');
            return redirect()->route('roles.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        DB::beginTransaction();
        try {
            DB::table('role_has_permissions')->where('role_id', $role->id)->delete();
            $role->delete();
            DB::commit();
            toastr()->error('Role delete successfully!', 'Delete');
            return redirect()->route('roles.index');
        } catch (\Throwable $th) {
            DB::rollBack();
            toastr()->error('Something want wrong!', 'Opps');
            return redirect()->route('roles.index');
        }
    }
}
