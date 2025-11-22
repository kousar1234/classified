@php
    $links = [
        [
            'title' => 'Users',
            'route' => 'admin.users.list',
            'active' => false,
        ],
        [
            'title' => 'Permissions',
            'route' => '',
            'active' => true,
        ],
    ];
@endphp
@extends('backend.layouts.dashboard_layout')
@section('page-title')
    {{ translation('Permissions') }}
@endsection
@section('page-style')
    <link rel="stylesheet"
        href="{{ asset('public/web-assets/backend/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('public/web-assets/backend/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
@endsection
@section('page-content')
    <x-admin-page-header title="Permissions" :links="$links" />
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">{{ translation('Permissions') }}</h3>
                        </div>
                        <div class="card-body">
                            <table id="permissionsTable" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>{{ translation('ID') }}</th>
                                        <th>{{ translation('Name') }}</th>
                                        <th>{{ translation('Module') }}</th>
                                        <th>{{ translation('Guard') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($permissions as $permission)
                                        <tr>
                                            <td>{{ $permission->id }}</td>
                                            <td class="text-capitalize">{{ $permission->name }}</td>
                                            <td> {{ $permission->module }}</td>
                                            <td>{{ $permission->guard_name }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('page-script')
    <script src="{{ asset('public/web-assets/backend/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('public/web-assets/backend/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('public/web-assets/backend/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}">
    </script>
    <script>
        (function($) {
            "use strict";
            //data table
            $('#permissionsTable').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });

        })(jQuery);
    </script>
@endsection
