 <form id="editForm">
     @csrf
     <input type="hidden" name="id" value="{{ $field->id }}">
     <div class="form-row">
         <div class="form-group col-lg-12">
             <label class="black font-14">{{ translation('Type') }}</label>
             <select name="type" class="form-control text-capitalize">
                 @foreach (config('settings.input_types') as $key => $value)
                     <option value="{{ $value }}" @selected($field->type == $value)>
                         {{ ucwords(str_replace('_', ' ', $key)) }}
                     </option>
                 @endforeach
             </select>
         </div>
     </div>
     <div class="form-row">
         <div class="form-group col-lg-12">
             <label class="black font-14">{{ translation('Title') }}</label>
             <input type="text" name="title" class="form-control slugable_input"
                 placeholder="{{ translation('Enter title') }}" value="{{ $field->title }}">
         </div>
     </div>

     <div class="form-row">
         <div class="form-group col-lg-12">
             <label class="black font-14">{{ translation('Default Value') }}</label>
             <input type="text" name="default_value" class="form-control slugable_input"
                 placeholder="{{ translation('Enter Default Value') }}" value="{{ $field->default_value }}">
         </div>
     </div>

     <div class="form-row">
         <div class="form-group col-lg-12 ">
             <label class="switch glow primary medium mr-2">
                 <input type="checkbox" name="is_required" @checked($field->is_required == config('settings.general_status.active'))>
                 <span class="control"></span>
             </label>
             <label class="black font-14">{{ translation('Is Required ?') }}</label>
         </div>
     </div>

     <div class="form-row">
         <div class="form-group col-lg-12">
             <label class="switch glow primary medium mr-2">
                 <input type="checkbox" name="is_filterable" @checked($field->is_filterable == config('settings.general_status.active'))>
                 <span class="control"></span>
             </label>
             <label class="black font-14">{{ translation('Is Filterable ?') }}</label>
         </div>
     </div>

     <div class="form-row">
         <div class="form-group col-lg-12">
             <label class="black font-14">{{ translation('Status') }}</label>
             <select name="status" class="form-control">
                 <option value="{{ config('settings.general_status.active') }}" @selected($field->status == config('settings.general_status.active'))>
                     {{ translation('Active') }}
                 </option>
                 <option value="{{ config('settings.general_status.in_active') }}" @selected($field->status == config('settings.general_status.in_active'))>
                     {{ translation('Inactive') }}
                 </option>
             </select>
         </div>
     </div>
     <div class="btn-area d-flex justify-content-between">
         <button class="btn btn-primary mt-2 store-category">{{ translation('Save') }}</button>
     </div>

 </form>
