<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    function __construct()
    {
        $this->middleware(['auth']);
        $this->middleware('permission:user-list|user-create|user-edit|user-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:user-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:user-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:user-delete', ['only' => ['destroy']]);
        $this->middleware('permission:user-approve', ['only' => ['approve']]);
        $this->middleware('permission:user-block', ['only' => ['block']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::pluck('name', 'name')->all();
        return view('admin.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|same:password_confirmation',
            'roles' => 'required'
        ]);
        DB::beginTransaction();
        try {
            $data = $request->all();
            $data['password'] = Hash::make($request->password);
            $user = User::create($data);
            $user->assignRole($request->roles);
            DB::commit();
            toastr()->success('User Create successfully', '!Success');
            return redirect(route('users.index'));
        } catch (\Throwable $th) {
            DB::rollBack();
            toastr()->error('Something want wrong', '!Opps');
            return redirect(route('users.index'));
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $roles = Role::pluck('name', 'name')->all();
        $userRole = $user->roles->pluck('name', 'name')->all();
        return view('admin.users.edit', compact('user', 'roles', 'userRole'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'same:password_confirmation',
            'roles' => 'required'
        ]);
        DB::beginTransaction();
        try {
            $data = $request->all();
            if (!empty($request->password)) {
                $data['password'] = Hash::make($request->password);
            } else {
                $data = Arr::except($data, array('password'));
            }
            $user->update($data);
            DB::table('model_has_roles')->where('model_id', $user->id)->delete();
            $user->assignRole($request->roles);
            DB::commit();
            toastr()->success('User Update successfully', '!Success');
            return redirect(route('users.index'));
        } catch (\Throwable $th) {
            DB::rollBack();
            toastr()->error('Something want wrong', '!Opps');
            return redirect(route('users.index'));
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        DB::beginTransaction();
        try {
            $user->delete();
            DB::commit();
            toastr()->error('User delete successfully', 'Delete');
            return back();
        } catch (\Throwable $th) {
            DB::rollBack();
            toastr()->error('Something want wrong', '!Opps');
            return back();
        }
    }

    public function approve($id)
    {
        DB::beginTransaction();
        try {
            $userApprove = User::where('id', $id)->first();
            $userApprove->update([
                'status' => 'approve'
            ]);
            DB::commit();
            toastr()->success('User approve successfully', 'Success');
            return back();
        } catch (\Throwable $th) {
            DB::rollBack();
            toastr()->error('Something want wrong', '!Opps');
            return back();
        }
    }

    public function block($id)
    {
        DB::beginTransaction();
        try {
            $userBlock = User::where('id', $id)->first();
            $userBlock->update([
                'status' => 'block'
            ]);
            DB::commit();
            toastr()->success('User block successfully', 'Success');
            return back();
        } catch (\Throwable $th) {
            DB::rollBack();
            toastr()->error('Something want wrong', '!Opps');
            return back();
        }
    }
}
