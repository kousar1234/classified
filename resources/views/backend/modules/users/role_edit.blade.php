<form id="update-role-form">
    @csrf
    <div class="form-group">
        <label>{{ translation('Role Name') }}</label>
        <input type="hidden" name="id" value="{{ $role->id }}">
        <input type="text" class="form-control" name="name" placeholder="{{ translation('Enter Role Name') }}"
            value="{{ $role->name }}">
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
                                    <input class="form-check-input" id="{{ $permission->id }}" name="permission[]"
                                        type="checkbox" value="{{ $permission->name }}" @checked($role->permissions->contains($permission))>
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
    <button type="button" class="btn btn-primary update-role-btn">{{ translation('Save Change') }}</button>
</div>
<script>
    (function($) {
        "use strict";
        //Update role
        $('.update-role-btn').on('click', function(e) {
            e.preventDefault();
            $(document).find(".invalid-input").remove();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                },
                type: "POST",
                data: $('#update-role-form').serialize(),
                url: '{{ route('admin.users.role.update') }}',
                success: function(response) {
                    if (response.success) {
                        toastr.success('Role updated successfully', 'Success');
                        $('#role-delete-modal').modal('hide');
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
                        toastr.error('Role update failed', 'Error');
                    }
                }
            });
        });

    })(jQuery);
</script>
