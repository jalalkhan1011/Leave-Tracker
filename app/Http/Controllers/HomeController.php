<?php

namespace App\Http\Controllers;

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
            dd('you are logdin');
        }

        return view('home');
    }
}
