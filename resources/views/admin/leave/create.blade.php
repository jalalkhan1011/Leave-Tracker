@extends('admin.layouts.master')

@section('title', 'Leaves')
@section('content')
    <section class="section">
        <div class="row">
            <div class="col-lg-3"></div>
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ __('Create Leave') }}</h5>
                        <form action="{{ route('leaves.store') }}" class="row g-3 rolode" method="POST">
                            @csrf
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="leave_type" class="form-label">{{ __('Leave Type') }}
                                        <span class="text-danger">*</span></label>
                                    <select class="form-select" name="leave_type" id="leave_type" required>
                                        <option value="" selected disabled>{{ __('Select Leave Type') }}</option>
                                        <option value="Casual Leave">{{ __('Casual Leave') }}</option>
                                        <option value="Sick Leave">{{ __('Sick Leave') }}</option>
                                        <option value="Emergency Leave">{{ __('Emergency Leave') }}</option>
                                    </select>
                                    <div class="clearfix"></div>
                                    @if ($errors->has('leave_type'))
                                        <span class="form-text">
                                            <strong
                                                class="text-danger form-control-sm">{{ $errors->first('leave_type') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="start_date" class="form-label">{{ __('Start Date') }} <span
                                            class="text-danger">*</span></label>
                                    <input type="date" class="form-control" name="start_date" value="{{ date('Y-m-d') }}"
                                        id="start_date" required>
                                    <div class="clearfix"></div>
                                    @if ($errors->has('start_date'))
                                        <span class="form-text">
                                            <strong
                                                class="text-danger form-control-sm">{{ $errors->first('start_date') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="end_date" class="form-label">{{ __('End Date') }} <span
                                            class="text-danger">*</span></label>
                                    <input type="date" class="form-control" name="end_date" value="{{ date('Y-m-d') }}"
                                        id="end_date" required>
                                    <div class="clearfix"></div>
                                    @if ($errors->has('end_date'))
                                        <span class="form-text">
                                            <strong
                                                class="text-danger form-control-sm">{{ $errors->first('end_date') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="leave_rason" class="form-label">{{ __('Leave Rason') }} <span
                                            class="text-danger">*</span></label>
                                    <textarea class="form-control" name="leave_rason" id="leave_rason" rows="10" required placeholder="Write here....">{{ old('leave_rason') }}</textarea>
                                    <div class="clearfix"></div>
                                    @if ($errors->has('leave_rason'))
                                        <span class="form-text">
                                            <strong
                                                class="text-danger form-control-sm">{{ $errors->first('leave_rason') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="text-end">
                                <button type="submit" class="btn btn-sm btn-primary">{{ __('Submit') }}</button>
                                <button type="reset" class="btn btn-sm btn-secondary"
                                    id="reset">{{ __('Reset') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
