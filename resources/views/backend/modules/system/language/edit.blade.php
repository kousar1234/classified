<form id="language-update-form">
    @csrf
    <div class="form-group">
        <label>{{ translation('Name') }}</label>
        <input type="hidden" name="id" value="{{ $lang->id }}">
        <input type="text" class="form-control" value="{{ $lang->title }}" name="name"
            placeholder="{{ translation('Enter Name') }}">
    </div>
    <div class="form-group">
        <label>{{ translation('Native Name') }}</label>
        <input type="text" class="form-control" value="{{ $lang->native_title }}" name="native_name"
            placeholder="{{ translation('Enter Native Name') }}">
    </div>
    <div class="form-group">
        <label>{{ translation('Code') }}</label>
        <input type="code" class="form-control" name="code" value="{{ $lang->code }}"
            placeholder="{{ translation('Enter code') }}">
    </div>
    <div class="form-group">
        <label>{{ translation('Status') }}</label>
        <select name="status" class="form-control">
            <option value="{{ config('settings.general_status.active') }}" @selected($lang->status == config('settings.general_status.active'))>
                {{ translation('Active') }}</option>
            <option value="{{ config('settings.general_status.in_active') }}" @selected($lang->status == config('settings.general_status.in_active'))>
                {{ translation('Inactive') }}
            </option>
        </select>
    </div>
    <div class="form-group">
        <label>{{ translation('Icon') }}</label>
        <x-media name="icon" value=""></x-media>
    </div>
</form>
<div class="d-flex justify-content-between">
    <button type="button" class="btn btn-primary language-update-btn">{{ translation('Save Changes') }}</button>
</div>
