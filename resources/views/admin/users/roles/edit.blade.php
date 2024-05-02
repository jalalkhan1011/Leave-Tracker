@extends('admin.layouts.master')

@section('title','Role')
@section('content')
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ __('Edit Role') }}</h5>
                        <form action="{{ route('roles.update', $role->id) }}" class="row g-3 rolode" method="POST">
                            @csrf
                            @method('put')
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="name" class="form-label">{{ __('Role Name') }}</label>
                                    <input type="text" class="form-control" name="name" value="{{ $role->name }}"
                                        id="name">
                                    <div class="clearfix"></div>
                                    @if ($errors->has('name'))
                                        <span class="form-text">
                                            <strong
                                                class="text-danger form-control-sm">{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-12">
                                        <strong>Permission</strong>
                                        <hr>
                                    </div>
                                    @foreach ($permissionLabels as $permissionLabel)
                                        <div class="col-md-12">
                                            <input type="hidden" class="form-controler" name="permission_label[]"
                                                    value="{{ $permissionLabel->permission_label }}">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox"
                                                    id="{{ $permissionLabel->permission_label }}"
                                                    name="check_status[{{ $permissionLabel->permission_label }}]"
                                                    value="1"
                                                    {{ $permissionLabel->check_status == '1' ? 'checked' : '' }}
                                                    onchange="handleChange(this)">
                                                <label class="form-check-label"
                                                    for="{{ $permissionLabel->permission_label }}">{{ $permissionLabel->permission_label }}</label>
                                            </div>
                                            <hr>
                                        </div>
                                        @foreach ($permissions as $permission)
                                            @if ($permissionLabel->permission_label == $permission->permission_label)
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <div class="form-check">
                                                            <input
                                                                class="form-check-input check{{ $permissionLabel->permission_label }}"
                                                                name="permission_id[]" type="checkbox"
                                                                value="{{ $permission->id }}"
                                                                onchange="handleParent('check{{ $permissionLabel->permission_label }}','{{ $permissionLabel->permission_label }}')"
                                                                {{ in_array($permission->id, $rolePermissions) ? 'checked' : '' }}
                                                                id="role{{ $permission->id }}">
                                                            <label class="form-check-label"
                                                                for="role{{ $permission->id }}">
                                                                {{ $permission->name }}
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                        <div class="col-md-12">
                                            <hr>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="text-end">
                                <button type="submit" class="btn btn-sm btn-primary">{{ __('Update') }}</button>
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
@push('js')
    <script>
        function handleChange(element) {
            if (element.checked) {
                $('.check' + element.id).each(function() {
                    $(this).prop("checked", true);
                })
            } else {
                $('.check' + element.id).each(function() {
                    $(this).prop("checked", false);
                })
            }
        }

        function handleParent(cl, id) {
            var allchecked = true;
            $('.' + cl).each(function() {
                if ($(this).prop("checked") == false) {
                    allchecked = false;
                }
            })

            if (allchecked) {
                $('#' + id).prop("checked", true);
            } else {
                $('#' + id).prop("checked", false);
            }
        }
    </script>
@endpush
