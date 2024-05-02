<?php

namespace App\Http\Controllers;

use App\Models\Leave;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $role = $user->getRoleNames()->first();
        if ($user->status == 'pending') {
            Auth::logout();
            $request->session()->flush();
            $request->session()->regenerate();
            return redirect(route('login'))->with('success', 'Your registrtion successfuly. After approve by admin you will be login your account!');
        } elseif ($user->status == 'block') {
            Auth::logout();
            $request->session()->flush();
            $request->session()->regenerate();
            return redirect(route('login'))->with('success', 'Your are blocked by admin. You are not able to login your account!');
        } elseif ($user->status == 'approve' && $role == 'Employee') {
            return redirect(route('employeeDashboard'));
        }
        $totalLeave = Leave::count();
        $pendingRequest = Leave::where('leave_status', 'Pending')->count();
        $approveRequest = Leave::where('leave_status', 'Approve')->count();
        $rejectRequest = Leave::where('leave_status', 'Reject')->count();

        return view('home', compact('totalLeave', 'pendingRequest', 'approveRequest', 'rejectRequest'));
    }

    public function employeeDashboard()
    {
        $userId = auth()->user()->id;
        $totalLeave = Leave::where('user_id', $userId)->count();
        $pendingRequest = Leave::where('user_id', $userId)->where('leave_status', 'Pending')->count();
        $approveRequest = Leave::where('user_id', $userId)->where('leave_status', 'Approve')->count();
        $rejectRequest = Leave::where('user_id', $userId)->where('leave_status', 'Reject')->count();
        return view('admin.dashboard.employeeDashboard', compact('totalLeave', 'pendingRequest', 'approveRequest', 'rejectRequest'));
    }
}
