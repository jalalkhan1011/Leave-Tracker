@extends('admin.layouts.master')

@section('title','Leave List')
@section('content')
    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <h5 class="card-title">{{ __('Leave') }}</h5>
                                <p>{{ __('All leave list') }}</p>
                            </div>
                            <div class="col-lg-6 text-end mt-3">
                                @can('leave-create')
                                    <a href="{{ route('leaves.create') }}" class="btn btn-primary"><i
                                            class="bi bi-plus"></i>{{ __('Add Leave') }}</a>
                                @endcan
                            </div>
                            <hr>
                        </div>
                        <!-- Table with stripped rows -->
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th scope="col">{{ __('#Sl') }}</th>
                                    <th scope="col">{{ __('Employee Name') }}</th>
                                    <th scope="col">{{ __('Start Date') }}</th>
                                    <th scope="col">{{ __('End Date') }}</th>
                                    <th scope="col">{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i = 0; @endphp
                                @foreach ($leaves as $leave)
                                    <tr>
                                        <th scope="row">{{ ++$i }}</th>
                                        <td>{{ $leave->user->name ?? '' }}</td>
                                        <td>{{ date('d-M-Y',strtotime($leave->start_date ?? '')) }}</td> 
                                        <td>{{ date('d-M-Y',strtotime($leave->end_date ?? '')) }}</td> 
                                        {{-- <td>
                                            <ul class="list-inline">
                                                <li class="list-inline-item">
                                                    @can('user-approve')
                                                        @if ($role == 'Employee')
                                                            @if ($user->status == 'pending' || $user->status == 'block')
                                                                <form action="{{ route('approve', $user->id) }}" method="post"
                                                                    id="successApprove{{ $user->id }}">
                                                                    @csrf
                                                                    <button type="submit"
                                                                        class="btn btn-info btn-sm text-white" title="Approve"
                                                                        onclick="sweetAlertApprove({{ $user->id }})"><i
                                                                            class="bi bi-check text-white"></i>{{ __('Approve') }}</button>
                                                                </form>
                                                            @endif
                                                        @endif
                                                    @endcan
                                                </li>

                                                <li class="list-inline-item">
                                                    @can('user-block')
                                                        @if ($role == 'Employee')
                                                            @if ($user->status == 'approve')
                                                                <form action="{{ route('block', $user->id) }}" method="post"
                                                                    id="successBlock{{ $user->id }}">
                                                                    @csrf
                                                                    <button type="submit"
                                                                        class="btn btn-primary btn-sm text-white" title="Block"
                                                                        onclick="sweetAlertBlock({{ $user->id }})"><i
                                                                            class="bi bi-lock text-white"></i>{{ __('Block') }}</button>
                                                                </form>
                                                            @endif
                                                        @endif
                                                    @endcan
                                                </li>


                                                <li class="list-inline-item">
                                                    @can('user-edit')
                                                        <a href="{{ route('users.edit', $user->id) }}"
                                                            class="btn btn-warning btn-sm text-white" title="Edit"><i
                                                                class="bi bi-pen text-white"></i>{{ __('Edit') }}</a>
                                                    @endcan
                                                </li>
                                                <li class="list-inline-item">
                                                    @can('user-delete')
                                                        <form action="{{ route('users.destroy', $user->id) }}" method="POST"
                                                            id="deleteButton{{ $user->id }}">
                                                            @csrf
                                                            @method('delete')
                                                            <button type="submit" class="btn btn-danger btn-sm" title="Delete"
                                                                onclick="sweetAlertDelete({{ $user->id }})"><i
                                                                    class="bi bi-trash"></i>{{ __('Delete') }}</button>
                                                        </form>
                                                    @endcan
                                                </li>
                                            </ul>
                                        </td> --}}
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
