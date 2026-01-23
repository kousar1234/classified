<form id="editForm">
    @csrf
    <div class="form-row">
        <div class="form-group col-lg-12">
            <label class="black font-14">{{ translation('Value') }}</label>
            <input type="text" name="value" class="form-control" placeholder="{{ translation('Enter value') }}"
                value="{{ $option->value }}">
            <input type="hidden" name="id" value="{{ $option->id }}">
        </div>
    </div>

    <div class="form-row">
        <div class="form-group col-lg-12">
            <label class="black font-14">{{ translation('Status') }}</label>
            <select name="status" class="form-control">
                <option value="{{ config('settings.general_status.active') }}" @selected($option->status == config('settings.general_status.active'))>
                    {{ translation('Active') }}
                </option>
                <option value="{{ config('settings.general_status.in_active') }}" @selected($option->status == config('settings.general_status.in_active'))>
                    {{ translation('Inactive') }}
                </option>
            </select>
        </div>
    </div>
    <div class="btn-area d-flex justify-content-between">
        <button class="btn btn-primary mt-2">{{ translation('Save Changes') }}</button>
    </div>
</form>
