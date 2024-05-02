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
                                    <th scope="col">{{ __('Status') }}</th>
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
                                        <td>{{ $leave->leave_status ?? '' }}</td> 
                                        <td>
                                            <ul class="list-inline">
                                                <li class="list-inline-item"> 
                                                    <a href="{{ route('leaves.show', $leave->id) }}"
                                                        class="btn btn-info btn-sm text-white" title="View"><i
                                                            class="bi bi-eye text-white"></i> {{ __('view') }}</a>
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
