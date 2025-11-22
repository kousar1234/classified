@php
    $links = [
        [
            'title' => 'Users',
            'route' => '',
            'active' => true,
        ],
    ];
@endphp
@extends('backend.layouts.dashboard_layout')
@section('page-title')
    Users
@endsection
@section('page-style')
    <link rel="stylesheet"
        href="{{ asset('public/web-assets/backend/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('public/web-assets/backend/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
@endsection
@section('page-content')
    <x-admin-page-header title="Users" :links="$links" />
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">{{ translation('User') }}</h3>
                            <button class="btn btn-success btn-sm float-right text-white" data-toggle="modal"
                                data-target="#user-create-modal">{{ translation('Add New User') }}</button>
                        </div>
                        <div class="card-body">
                            <table id="userTable" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>{{ translation('ID') }}</th>
                                        <th>{{ translation('Image') }}</th>
                                        <th>{{ translation('Name') }}</th>
                                        <th>{{ translation('Email') }}</th>
                                        <th>{{ translation('Role') }}</th>
                                        <th>{{ translation('Status') }}</th>
                                        <th class="text-right">{{ translation('Action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>{{ $user->id }}</td>
                                            <td>
                                                <img src="{{ asset(getFilePath($user->image)) }}"
                                                    alt="{{ $user->name }}" class="img-circle img-md" />
                                            </td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>
                                                @foreach ($user->getRoleNames() as $role)
                                                    {{ $role }}
                                                @endforeach
                                            </td>
                                            <td>
                                                @if ($user->status == config('settings.general_status.active'))
                                                    <p class=" badge badge-success">{{ translation('Active') }}</p>
                                                @else
                                                    <p class=" badge badge-danger">{{ translation('Inactive') }}</p>
                                                @endif
                                            </td>
                                            <td class="text-right">
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-default">{{ translation('Action') }}
                                                    </button>
                                                    <button type="button"
                                                        class="btn btn-default dropdown-toggle dropdown-hover dropdown-icon"
                                                        data-toggle="dropdown" aria-expanded="false">
                                                    </button>
                                                    <div class="dropdown-menu" role="menu">
                                                        <button class="dropdown-item edit-user"
                                                            data-id="{{ $user->id }}">
                                                            {{ translation('Edit') }}
                                                        </button>
                                                        <div class="dropdown-divider"></div>
                                                        <button class="dropdown-item delete-user"
                                                            data-id="{{ $user->id }}">
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
        <!--New User Modal-->
        <div class="modal fade" id="user-create-modal">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ translation('New User') }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="new-user-form">
                            @csrf
                            <div class="form-group">
                                <label>{{ translation('Name') }}</label>
                                <input type="text" class="form-control" name="name"
                                    placeholder="{{ translation('Enter Name') }}">
                            </div>
                            <div class="form-group">
                                <label>{{ translation('Email') }}</label>
                                <input type="email" class="form-control" name="email"
                                    placeholder="{{ translation('Enter Email') }}">
                            </div>
                            <div class="form-group">
                                <label>{{ translation('Password') }}</label>
                                <input type="password" class="form-control" name="password"
                                    placeholder="{{ translation('Enter Password') }}">
                            </div>
                            <div class="form-group">
                                <label>{{ translation('Confirm Password') }}</label>
                                <input type="password" class="form-control" name="password_confirmation"
                                    placeholder="{{ translation('Re Enter Password') }}">
                            </div>
                            <div class="form-group">
                                <label>{{ translation('Image') }}</label>
                                <x-media name="image" value=""></x-media>
                            </div>
                            <div class="form-group">
                                <label>{{ translation('Role') }}</label>
                                <select name="role" class="form-control">
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </form>
                        <div class="d-flex justify-content-between">
                            <button type="button"
                                class="btn btn-primary create-new-user-btn">{{ translation('Save User') }}</button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!--End New User Modal-->
        <!--User Edit Modal-->
        <div class="modal fade" id="user-edit-modal">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ translation('User Information') }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body user-edit-content">

                    </div>
                </div>
            </div>
        </div>
        <!--End User Edit Modal-->
        <!--User Delete Modal-->
        <div class="modal fade" id="user-delete-modal">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title h6">{{ translation('Delete Confirmation') }}</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body text-center">
                        <h4 class="mt-1 h6 my-2">{{ translation('Are you sure to delete user ?') }}</h4>
                        <form method="POST" action="{{ route('admin.users.delete') }}">
                            @csrf
                            <input type="hidden" id="delete-user-id" name="id">
                            <button type="button" class="btn mt-2 btn-danger"
                                data-dismiss="modal">{{ translation('Cancel') }}</button>
                            <button type="submit" class="btn btn-success mt-2">{{ translation('Delete') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--End User Delete Modal-->
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
            initMediaManager();
            //data table
            $('#userTable').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });

            //Create new user 
            $('.create-new-user-btn').on('click', function(e) {
                e.preventDefault();
                $(document).find(".invalid-input").remove();
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    },
                    type: "POST",
                    data: $('#new-user-form').serialize(),
                    url: '{{ route('admin.users.store') }}',
                    success: function(response) {
                        if (response.success) {
                            toastr.success('New user created successfully', 'Success');
                            $('#user-create-modal').modal('hide');
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
                            toastr.error('User create failed', 'Error');
                        }
                    }
                });
            });

            //Visible user delete modal
            $('.delete-user').on('click', function(e) {
                e.preventDefault();
                let user_id = $(this).data('id');
                $('#delete-user-id').val(user_id);
                $('#user-delete-modal').modal('show');
            });
            //Edit user form
            $('.edit-user').on('click', function(e) {
                e.preventDefault();
                let id = $(this).data('id');
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    },
                    type: "POST",
                    data: {
                        id:id
                    },
                    url: '{{ route('admin.users.edit') }}',
                    success: function(response) {
                        if (response.success) {
                            $('.user-edit-content').html(response.data);
                            $("#user-edit-modal").modal('show');
                        } else {
                            toastr.error('User not found', 'Error');
                        }
                    },
                    error: function(response) {
                        toastr.error('User not found', 'Error');
                    }
                });
            })
        })(jQuery);
    </script>
@endsection
