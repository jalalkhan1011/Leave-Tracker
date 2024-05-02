@extends('admin.layouts.master')

@section('title', 'Leaves')
@section('content')
    <section class="section">
        <div class="row">
            <div class="col-lg-3"></div>
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ __('Leave Details') }}</h5>
                        <form action="{{ route('leaveApproveReject', $leave->id) }}" class="row g-3 rolode" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="leave_type" class="form-label">{{ __('Leave Type') }}
                                            <p>{{ $leave->leave_type ?? '' }}</p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="start_date" class="form-label">{{ __('Start Date') }} </label>
                                        <p>{{ date('d-M-Y', strtotime($leave->start_date ?? '')) }}</p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="end_date" class="form-label">{{ __('End Date') }} </label>
                                        <p>{{ date('d-M-Y', strtotime($leave->end_date ?? '')) }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="leave_rason" class="form-label">{{ __('Leave Rason') }} </label>
                                    <p>{{ $leave->leave_rason ?? '' }}</p>
                                </div>
                            </div>
                            @if (Auth::user()->hasRole('Admin'))
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="note" class="form-label">{{ __('Note') }} <span
                                                class="text-danger"> </span></label>
                                        <textarea class="form-control" name="note" id="note" rows="10" placeholder="Write here....">{{ old('note', $leave->note) }}</textarea>
                                        <div class="clearfix"></div>
                                        @if ($errors->has('note'))
                                            <span class="form-text">
                                                <strong
                                                    class="text-danger form-control-sm">{{ $errors->first('note') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            @elseif(Auth::user()->hasRole('Employee'))
                                @if (!empty($leave->note))
                                    <div class="form-group">
                                        <label for="note" class="form-label">{{ __('Note') }} </label>
                                        <p>{{ $leave->note ?? '' }}</p>
                                    </div>
                                @endif
                            @endif
                            <div class="text-end">
                                @can('leave-approve-reject')
                                    @if ($leave->leave_status == 'Approve')
                                        <button type="submit" name="reject" value="reject"
                                            class="btn btn-sm btn-danger">{{ __('Reject') }}</button>
                                    @elseif($leave->leave_status == 'Reject')
                                        <button type="submit" name="approve" value="approve"
                                            class="btn btn-sm btn-primary">{{ __('Approve') }}</button>
                                    @else
                                        <button type="submit" name="approve" value="approve"
                                            class="btn btn-sm btn-primary">{{ __('Approve') }}</button>
                                        <button type="submit" name="reject" value="reject"
                                            class="btn btn-sm btn-danger">{{ __('Reject') }}</button>
                                    @endif
                                    <button type="reset" class="btn btn-sm btn-secondary"
                                        id="reset">{{ __('Reset') }}</button>
                                @endcan
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
