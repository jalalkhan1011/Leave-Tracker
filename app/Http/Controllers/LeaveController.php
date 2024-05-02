<?php

namespace App\Http\Controllers;

use App\Models\Leave;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Monolog\Level;

class LeaveController extends Controller
{
    function __construct()
    {
        $this->middleware(['auth']);
        $this->middleware('permission:leave-list|leave-create|leave-edit|leave-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:leave-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:leave-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:leave-delete', ['only' => ['destroy']]);
        $this->middleware('permission:leave-approve-reject', ['only' => ['leaveApproveReject']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->hasRole('Admin')) {
            $leaves = Leave::orderBy('id', 'DESC')->get();
        } else {
            $leaves = Leave::where('user_id', auth()->user()->id)->orderBy('id', 'DESC')->get();
        }

        return view('admin.leave.index', compact('leaves'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.leave.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'start_date' => 'required',
            'end_date' => 'required',
            'leave_type' => 'required',
            'leave_rason' => 'required',
        ]);

        DB::beginTransaction();
        try {
            $data = $request->all();
            $data['user_id'] = auth()->user()->id;
            $data['start_date'] = date('Y-m-d', strtotime($request->start_date));
            $data['end_date'] = date('Y-m-d', strtotime($request->end_date));
            $data['leave_status'] = 'Pending';
            $leave = Leave::create($data);
            DB::commit();
            toastr()->success('Leave request create successfully', '!Success');
            return redirect(route('leaves.index'));
        } catch (\Throwable $th) {
            DB::rollBack();
            toastr()->error('Something want wrong', '!Opps');
            return back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Leave $leave, $id)
    {
        $leave = Leave::where('id', $id)->first();
        return view('admin.leave.show', compact('leave'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Leave $leave)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Leave $leave)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Leave $leave)
    {
        //
    }

    public function leaveApproveReject(Request $request, $id)
    {
        $leave = Leave::where('id', $id)->first();
        if ($request->approve == 'approve') {
            $leave->update([
                'note' => $request->note,
                'leave_status' => 'Approve',
            ]);
            toastr()->success('Leave Approve successfully', '!Success');
            return redirect(route('leaves.index'));
        } else {
            $leave->update([
                'note' => $request->note,
                'leave_status' => 'Reject',
            ]);
            toastr()->error('Leave Rejected', '!Rejected');
            return redirect(route('leaves.index'));
        }
    }
}
