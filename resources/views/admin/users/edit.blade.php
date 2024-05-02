@extends('admin.layouts.master')

@section('title','User')
@section('content')
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ __('Edit User') }}</h5>
                        <form action="{{ route('users.update',$user->id) }}" class="row g-3 rolode" method="POST">
                            @csrf
                            @method('put')
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name" class="form-label">{{ __('User Name') }} <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="name" value="{{ $user->name }}" id="name" required>
                                    <div class="clearfix"></div>
                                    @if ($errors->has('name'))
                                        <span class="form-text">
                                            <strong
                                                class="text-danger form-control-sm">{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email" class="form-label">{{ __('Email') }} <span
                                            class="text-danger">*</span></label>
                                    <input type="email" class="form-control" name="email" value="{{ $user->email }}" id="email" required>
                                    <div class="clearfix"></div>
                                    @if ($errors->has('email'))
                                        <span class="form-text">
                                            <strong
                                                class="text-danger form-control-sm">{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="password" class="form-label">{{ __('Password') }} <span
                                            class="text-danger"></span></label>
                                    <input type="password" class="form-control" name="password" id="password">
                                    <div class="clearfix"></div>
                                    @if ($errors->has('password'))
                                        <span class="form-text">
                                            <strong
                                                class="text-danger form-control-sm">{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="password_confirmation" class="form-label">{{ __('Confirm Password') }}
                                        <span class="text-danger"></span></label>
                                    <input type="password" class="form-control" name="password_confirmation"
                                        id="password_confirmation">
                                    <div class="clearfix"></div>
                                    @if ($errors->has('password_confirmation'))
                                        <span class="form-text">
                                            <strong
                                                class="text-danger form-control-sm">{{ $errors->first('password_confirmation') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="role" class="form-label">{{ __('Role') }}
                                        <span class="text-danger">*</span></label>
                                        <select class="form-select" name="roles[]" id="role"  required>
                                            <option disabled>{{ __('Select Role') }}</option>
                                            @foreach ($roles as $key => $role)
                                                <option value="{{ $key }}"{{ in_array($role,$userRole) ? 'selected' : '' }}>{{ $role }}</option>
                                            @endforeach
                                          </select>
                                    <div class="clearfix"></div>
                                    @if ($errors->has('password_confirmation'))
                                        <span class="form-text">
                                            <strong
                                                class="text-danger form-control-sm">{{ $errors->first('password_confirmation') }}</strong>
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
