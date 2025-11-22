<form id="update-user-form">
    @csrf
    <div class="form-group">
        <label>{{ translation('Name') }}</label>
        <input type="hidden" name="id" value="{{ $user->id }}">
        <input type="text" class="form-control" name="name" placeholder="{{ translation('Enter Name') }}"
            value="{{ $user->name }}">
    </div>
    <div class="form-group">
        <label>{{ translation('Email') }}</label>
        <input type="email" class="form-control" name="email" placeholder="{{ translation('Enter Email') }}"
            value="{{ $user->email }}">
    </div>
    <div class="form-group">
        <label>{{ translation('Password') }}</label>
        <input type="password" class="form-control" name="password" placeholder="{{ translation('Enter Password') }}">
    </div>
    <div class="form-group">
        <label>{{ translation('Confirm Password') }}</label>
        <input type="password" class="form-control" name="password_confirmation"
            placeholder="{{ translation('Re Enter Password') }}">
    </div>
    <div class="form-group">
        <label>{{ translation('Image') }}</label>
        <div class="input-group">
            <x-media name="edit_image" :value="$user->image"></x-media>
        </div>
    </div>
    <div class="form-group">
        <label>{{ translation('Role') }}</label>
        <select name="role" class="form-control">
            @foreach ($roles as $role)
                <option value="{{ $role->id }}" @selected($user->getRoleNames()->contains($role->name))>{{ $role->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label>{{ translation('Status') }}</label>
        <select name="status" class="form-control">
            <option value="{{ config('settings.general_status.active') }}" @selected($user->status == config('settings.general_status.active'))>
                {{ translation('Active') }}</option>
            <option value="{{ config('settings.general_status.in_active') }}" @selected($user->status == config('settings.general_status.in_active'))>
                {{ translation('Inactive') }}
            </option>
        </select>
    </div>
</form>
<div class="d-flex justify-content-between">
    <button type="button" class="btn btn-primary update-user-btn">{{ translation('Save Changes') }}</button>
</div>

<script>
    (function($) {
        "use strict";
        //Update User
        $('.update-user-btn').on('click', function(e) {
            e.preventDefault();
            e.preventDefault();
            $(document).find(".invalid-input").remove();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                },
                type: "POST",
                data: $('#update-user-form').serialize(),
                url: '{{ route('admin.users.update') }}',
                success: function(response) {
                    if (response.success) {
                        toastr.success('User updated successfully', 'Success');
                        $('#update-user-form').modal('hide');
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
                        toastr.error('User update failed', 'Error');
                    }
                }
            });
        });

    })(jQuery);
</script>
