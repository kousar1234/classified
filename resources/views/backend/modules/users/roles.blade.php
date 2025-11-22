@php
    $links = [
        [
            'title' => 'Users',
            'route' => 'admin.users.list',
            'active' => false,
        ],
        [
            'title' => 'Roles',
            'route' => '',
            'active' => true,
        ],
    ];
@endphp
@extends('backend.layouts.dashboard_layout')
@section('page-title')
    {{ translation('Roles') }}
@endsection
@section('page-style')
    <link rel="stylesheet"
        href="{{ asset('public/web-assets/backend/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('public/web-assets/backend/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
@endsection
@section('page-content')
    <x-admin-page-header title="Roles" :links="$links" />
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">{{ translation('Roles') }}</h3>
                            <button class="btn btn-success btn-sm float-right text-white" data-toggle="modal"
                                data-target="#role-create-modal">{{translation('Add New Role')}}</button>
                        </div>
                        <div class="card-body">
                            <table id="rolesTable" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>{{ translation('ID') }}</th>
                                        <th>{{ translation('Name') }}</th>
                                        <th>{{ translation('Guard') }}</th>
                                        <th class="text-right">{{ translation('Action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($roles as $role)
                                        <tr>
                                            <td>{{ $role->id }}</td>
                                            <td class="text-capitalize">{{ $role->name }}</td>
                                            <td>{{ $role->guard_name }}</td>
                                            <td class="text-right">
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-default">{{ translation('Action') }}
                                                    </button>
                                                    <button type="button"
                                                        class="btn btn-default dropdown-toggle dropdown-hover dropdown-icon"
                                                        data-toggle="dropdown" aria-expanded="false">
                                                    </button>
                                                    <div class="dropdown-menu" role="menu">
                                                        <button class="dropdown-item edit-role"
                                                            data-id="{{ $role->id }}">
                                                            {{ translation('Edit') }}
                                                        </button>
                                                        <div class="dropdown-divider"></div>
                                                        <button class="dropdown-item delete-role"
                                                            data-id="{{ $role->id }}">
                                                            {{ translation('Delete') }}
                                                        </button>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--New Role Modal-->
        <div class="modal fade" id="role-create-modal">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ translation('New Role') }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="new-role-form">
                            @csrf
                            <div class="form-group">
                                <label>{{ translation('Role Name') }}</label>
                                <input type="text" class="form-control" name="name"
                                    placeholder="{{ translation('Enter Role Name') }}">
                            </div>
                            <div class="form-group">
                                <label>{{ translation('Permissions') }}</label>
                                <table class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>{{ translation('Feature') }}</th>
                                            <th>{{ translation('Capabilities') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($permissions as $permission_module => $permission_list)
                                            <tr>
                                                <td>{{ $permission_module }}</td>
                                                <td>
                                                    @foreach ($permission_list as $permission)
                                                        <div class="form-check">
                                                            <input class="form-check-input" id="{{ $permission->id }}"
                                                                name="permission[]" type="checkbox"
                                                                value="{{ $permission->name }}">
                                                            <label class="form-check-label text-capitalize"
                                                                for="{{ $permission->id }}">{{ $permission->name }}</label>
                                                        </div>
                                                    @endforeach
                                                </td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </form>
                        <div class="d-flex justify-content-between">
                            <button type="button"
                                class="btn btn-primary create-new-role-btn">{{ translation('Create Role') }}</button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!--End New Role Modal-->
        <!--Role Edit Modal-->
        <div class="modal fade" id="role-edit-modal">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ translation('Role Information') }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body role-edit-content">

                    </div>
                </div>
            </div>
        </div>
        <!--End Role Edit Modal-->
        <!--Role Delete Modal-->
        <div class="modal fade" id="role-delete-modal">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title h6">{{ translation('Delete Confirmation') }}</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body text-center">
                        <h4 class="mt-1 h6 my-2">{{ translation('Are you sure to delete role ?') }}</h4>
                        <form method="POST" action="{{ route('admin.users.role.delete') }}">
                            @csrf
                            <input type="hidden" id="delete-role-id" name="id">
                            <button type="button" class="btn mt-2 btn-danger"
                                data-dismiss="modal">{{ translation('cancel') }}</button>
                            <button type="submit" class="btn btn-success mt-2">{{ translation('Delete') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--End Role Delete Modal-->
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
            $('#rolesTable').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });

            //Create new role 
            $('.create-new-role-btn').on('click', function(e) {
                e.preventDefault();
                $(document).find(".invalid-input").remove();
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    },
                    type: "POST",
                    data: $('#new-role-form').serialize(),
                    url: '{{ route('admin.users.role.store') }}',
                    success: function(response) {
                        if (response.success) {
                            toastr.success('Role created successfully', 'Success');
                            $('#role-create-modal').modal('hide');
                            location.reload();
                        } else {
                            toastr.error(response.message, 'Error')
                        }
                    },
                    error: function(response) {
                        if (response.status === 422) {
                            $.each(response.responseJSON.errors, function(field_name, error) {
                                $(document).find('[name=' + field_name + ']').after(
                                    '<div class="error text-danger mb-0 invalid-input">' +
                                    error + '</div>');
                            })
                        } else {
                            toastr.error('Role create failed', 'Error');
                        }
                    }
                });
            });

            //Visible role delete modal
            $('.delete-role').on('click', function(e) {
                e.preventDefault();
                let role_id = $(this).data('id');
                $('#delete-role-id').val(role_id);
                $('#role-delete-modal').modal('show');
            });
            //Edit role form
            $('.edit-role').on('click', function(e) {
                e.preventDefault();
                let role_id = $(this).data('id');
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    },
                    type: "POST",
                    data: {
                        id: role_id
                    },
                    url: '{{ route('admin.users.role.edit') }}',
                    success: function(response) {
                        if (response.success) {
                            $('.role-edit-content').html(response.data);
                            $("#role-edit-modal").modal('show');
                        } else {
                            toastr.error('Role not found', 'Error');
                        }
                    },
                    error: function(response) {
                        toastr.error('Role not found', 'Error');
                    }
                });
            })
        })(jQuery);
    </script>
@endsection
