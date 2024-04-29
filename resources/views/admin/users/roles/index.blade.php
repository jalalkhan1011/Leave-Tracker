@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <h5 class="card-title">Roles</h5>
                                <p>All role list</p>
                            </div>
                            <div class="col-lg-6 text-end mt-3">
                                @can('role-create')
                                    <a href="{{ route('roles.create') }}" class="btn btn-sm btn-primary"><i
                                            class="bi bi-plus"></i>{{ __('Add Role') }}</a>
                                @endcan
                            </div>
                            <hr>
                        </div>
                        <!-- Table with stripped rows -->
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th scope="col">#Sl</th>
                                    <th scope="col">Role Name</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i = 0; @endphp
                                @foreach ($roles as $role)
                                    <tr>
                                        <th scope="row">{{ ++$i }}</th>
                                        <td>{{ $role->name ?? '' }}</td>
                                        <td>
                                            <ul class="list-inline">
                                                <li class="list-inline-item">
                                                    @can('role-edit')
                                                        <a href="{{ route('roles.edit', $role->id) }}"
                                                            class="btn btn-warning btn-sm text-white" title="Edit"><i
                                                                class="bi bi-pen text-white"></i>{{ __('Edit') }}</a>
                                                    @endcan
                                                </li>
                                                <li class="list-inline-item">
                                                    @can('role-delete')
                                                        <form action="{{ route('roles.destroy', $role->id) }}" method="POST"
                                                            id="deleteButton{{ $role->id }}">
                                                            @csrf
                                                            @method('delete')
                                                            <button type="submit" class="btn btn-danger btn-sm" title="Delete"
                                                                onclick="sweetAlertDelete({{ $role->id }})"><i
                                                                    class="bi bi-trash"></i>{{ __('Delete') }}</button>
                                                        </form>
                                                    @endcan
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <!-- End Table with stripped rows -->
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
