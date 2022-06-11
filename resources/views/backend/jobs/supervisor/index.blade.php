@extends('backend.layouts.app')

@section('title', __('component'))

@section('breadcrumb-links')
    @include('backend.component.includes.breadcrumb-links')
@endsection

@section('content')
    <div>
        <x-backend.card>
            <x-slot name="header">
                Job Requests - Supervisor View
            </x-slot>

            <x-slot name="body">
                @if (session('Success'))
                    <div class="alert alert-success">
                        {{ session('Success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                <div class="container table-responsive pt-3">
                    <table class="table table-striped">
                        <tr>
                            <th>ID</th>
                            <th>Status</th>
                            <th>Machine</th>
                            <th>Material</th>
                            <th>Supervisor</th>
                            <th>&nbsp;</th>
                        </tr>

                        @foreach($jobs as $job)

                            <tr>
                                <td>Job #{{ $job->id }}</td>
                                <th>{{ \App\Models\JobRequests::job_status()[$job->status]  }}</th>
                                <td>
                                    @if($job->machine_info() != null)
                                        <a href="{{ route('admin.machines.show', $job->machine) }}" target="_blank">
                                            {{ $job->machine_info['title'] }}
                                        </a>
                                    @endif
                                </td>
                                <td>
                                    @if($job->material_info() != null)
                                        <a href="{{ route('admin.raw_materials.show', $job->material) }}"
                                           target="_blank">
                                            {{ $job->material_info['title'] }}
                                        </a>
                                    @endif
                                </td>
                                <td>
                                    @if($job->supervisor_info() != null)
                                        {{ $job->supervisor_info['name'] }}
                                    @endif
                                </td>

                                <td class="d-flex justify-content-end">
                                    <div class="btn-group" role="group">
                                        @if ($job->status == 'PENDING')
                                            <a href="{{ route('admin.jobs.student.confirm', $job)}}"
                                               class="btn btn-primary btn-xs"><i class="fa fa-check"
                                                                                 title="Approal"></i>
                                            </a>
                                        @endif
                                        <a href="{{ route('admin.jobs.student.show', $job)}}"
                                           class="btn btn-secondary btn-xs"><i class="fa fa-eye" title="Show"></i>
                                        </a>
                                        <a href="{{ route('admin.jobs.student.delete', $job)}}"
                                           class="btn btn-danger btn-xs"><i class="fa fa-trash-o" title="Delete"></i>
                                        </a>
                                    </div>
                                </td>

                            </tr>
                        @endforeach
                    </table>

                </div>
            </x-slot>
        </x-backend.card>
    </div>
@endsection
