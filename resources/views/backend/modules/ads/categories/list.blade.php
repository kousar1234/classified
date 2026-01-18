@extends('core::base.layouts.master')
@section('title')
    {{ translate('Categories') }}
@endsection
@section('custom_css')
    <!--Select2-->
    <link rel="stylesheet" href="{{ asset('/public/web-assets/backend/plugins/select2/select2.min.css') }}">

    <style>
        .select2-container--classic {
            width: 100% !important;
        }
    </style>
@endsection
@section('main_content')
    <div class="row">
        <div class="col-12">
            <div class="card mb-30">
                <div class="align-items-center bg-white card-header d-sm-flex justify-content-between py-2">
                    <h4 class="font-20">{{ translate('Categories') }}</h4>
                    @if (auth()->user()->can('Create Categories'))
                        <button class="btn long" data-toggle="modal"
                            data-target="#new-category-modal">{{ translate('Add New Category') }}
                        </button>
                    @endif
                </div>
                <div class="card-body">

                    <div class="px-2 filter-area d-flex align-items-center">
                        <form method="get" action="{{ route('classified.ads.categories.list') }}">
                            <select class="theme-input-style mb-10" name="per_page">
                                <option value="">{{ translate('Per page') }}</option>
                                <option value="20" @selected(request()->has('per_page') && request()->get('per_page') == '20')>20</option>
                                <option value="50" @selected(request()->has('per_page') && request()->get('per_page') == '50')>50</option>
                                <option value="all" @selected(request()->has('per_page') && request()->get('per_page') == 'all')>All</option>
                            </select>
                            <select class="theme-input-style mb-10" name="status">
                                <option value="">{{ translate('Status') }}</option>
                                <option value="{{ config('settings.general_status.active') }}" @selected(request()->has('status') && request()->get('status') == config('settings.general_status.active'))>
                                    {{ translate('Active') }}</option>
                                <option value="{{ config('settings.general_status.in_active') }}"
                                    @selected(request()->has('status') && request()->get('status') == config('settings.general_status.in_active'))>
                                    {{ translate('Inactive') }}</option>
                            </select>
                            <input type="text" name="search" class="theme-input-style mb-10"
                                value="{{ request()->has('search') ? request()->get('search') : '' }}"
                                placeholder="Enter title">
                            <button type="submit" class="btn long mb-1">{{ translate('Filter') }}</button>
                        </form>
                        <a class="btn btn-danger long mb-2"
                            href="{{ route('classified.ads.categories.list') }}">{{ translate('Clear Filter') }}</a>
                    </div>
                    <div class="table-responsive">
                        <table class="hoverable text-nowrap border-top2">
                            <thead>
                                <tr>
                                    <th>
                                        #
                                    </th>
                                    <th>{{ translate('Title') }}</th>
                                    <th>{{ translate('Parent') }}</th>
                                    <th>{{ translate('Icon') }}</th>
                                    <th>{{ translate('Image') }}</th>
                                    <th>{{ translate('Status') }}</th>
                                    <th class="text-center">{{ translate('Actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($categories->count() > 0)
                                    @foreach ($categories as $key => $category)
                                        <tr>
                                            <td>
                                                {{ $key + 1 }}
                                            </td>
                                            <td>
                                                {{ $category->translation('title') }}
                                            </td>
                                            <td>
                                                @if ($category->parentCategory != null)
                                                    {{ $category->parentCategory->translation('title') }}
                                                @else
                                                    --
                                                @endif
                                            </td>
                                            <td>
                                                <img src="{{ asset(getFilePath($category->icon, true)) }}" class="img-45"
                                                    alt="{{ $category->title }}">
                                            </td>
                                            <td>
                                                <img src="{{ asset(getFilePath($category->image, true)) }}" class="img-45"
                                                    alt="{{ $category->title }}">
                                            </td>

                                            <td>
                                                @if ($category->status == config('settings.general_status.active'))
                                                    <p class="badge badge-success">{{ translate('Active') }}</p>
                                                @else
                                                    <p class="badge badge-danger">{{ translate('Inactive') }}</p>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="d-flex dropdown-button justify-content-center show">
                                                    <a href="#" class="d-flex align-items-center justify-content-end"
                                                        data-toggle="dropdown">
                                                        <div class="menu-icon mr-0">
                                                            <span></span>
                                                            <span></span>
                                                            <span></span>
                                                        </div>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        @if (auth()->user()->can('Edit Categories'))
                                                            <a
                                                                href="{{ route('classified.ads.categories.edit', ['id' => $category->id, 'lang' => getDefaultLang()]) }}">
                                                                {{ translate('Edit') }}
                                                            </a>
                                                        @endif
                                                        @if (auth()->user()->can('Delete Categories'))
                                                            <a href="#" class="delete-category"
                                                                data-category="{{ $category->id }}">{{ translate('Delete') }}
                                                            </a>
                                                        @endif
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="9">
                                            <p class="alert alert-danger text-center">{{ translate('Nothing Found') }}</p>
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                        <div class="pgination px-3">
                            {!! $categories->withQueryString()->onEachSide(1)->links('pagination::bootstrap-5-custom') !!}
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!--Category adding Modal-->
    <div id="new-category-modal" class="new-category-modal modal fade show" aria-modal="true">
        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title bold h6">{{ translate('Category information') }}</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="new-category-form">
                            <div class="form-row mb-20">
                                <div class="form-group col-lg-6">
                                    <label class="black font-14">{{ translate('Icon') }}</label>
                                    @include('core::base.includes.media.media_input', [
                                        'input' => 'icon',
                                        'data' => '',
                                    ])
                                </div>
                                <div class="form-group col-lg-6">
                                    <label class="black font-14">{{ translate('Featured Image') }}</label>
                                    @include('core::base.includes.media.media_input', [
                                        'input' => 'image',
                                        'data' => '',
                                    ])
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-lg-12">
                                    <label class="black font-14">{{ translate('Title') }}</label>
                                    <input type="text" name="title" class="theme-input-style slugable_input"
                                        placeholder="{{ translate('Enter title') }}">
                                </div>
                            </div>

                            @include('plugin/classilookscore::includes.permalink', [
                                'root_url' => 'ads/category',
                                'value' => '',
                                'lang' => getDefaultLang(),
                            ])

                            <div class="form-row">
                                <div class="form-group col-lg-12">
                                    <label class="font-14 bold black w-100">{{ translate('Parent') }} </label>
                                    <select class="parent-options theme-input-style w-100" name="parent">
                                    </select>
                                    @if ($errors->has('parent'))
                                        <div class="invalid-input">{{ $errors->first('parent') }}</div>
                                    @endif
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-lg-12">
                                    <label class="black font-14">{{ translate('Status') }}</label>
                                    <select name="status" class="theme-input-style">
                                        <option value="{{ config('settings.general_status.active') }}">
                                            {{ translate('Active') }}
                                        </option>
                                        <option value="{{ config('settings.general_status.in_active') }}">
                                            {{ translate('Inactive') }}
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="btn-area d-flex justify-content-between">
                                <button class="btn long mt-2 store-category">{{ translate('Save') }}</button>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--End Category adding modal-->
    <!--Delete Modal-->
    <div id="delete-modal" class="delete-modal modal fade show" aria-modal="true">
        <div class="modal-dialog modal-sm modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title h6">{{ translate('Delete Confirmation') }}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <p class="mt-1">{{ translate('Are you sure to delete this category') }}?</p>
                    <form method="POST" action="{{ route('classified.ads.categories.delete') }}">
                        @csrf
                        <input type="hidden" id="delete-category-id" name="id">
                        <div class="form-row d-flex justify-content-between">
                            <button type="button" class="btn long mt-2 btn-danger"
                                data-dismiss="modal">{{ translate('cancel') }}</button>
                            <button type="submit" class="btn long mt-2">{{ translate('Delete') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--Delete Modal-->
    @include('core::base.media.partial.media_modal')
@endsection
@section('custom_scripts')
    <!--Select2-->
    <script src="{{ asset('/public/web-assets/backend/plugins/select2/select2.min.js') }}"></script>
    <script>
        (function($) {
            "use strict";
            initDropzone();
            /**
             *  Parent Select
             * 
             */
            $('.parent-options').select2({
                theme: "classic",
                placeholder: '{{ translate('Select parent category') }}',
                closeOnSelect: true,
                ajax: {
                    url: '{{ route('classified.ads.categories.options') }}',
                    dataType: 'json',
                    method: "GET",
                    delay: 250,
                    data: function(params) {
                        return {
                            term: params.term || '',
                            page: params.page || 1
                        }
                    },
                    cache: true
                }
            });
            /**
             * Store New Category
             *
             **/
            $(document).on('click', '.store-category', function(e) {
                $(document).find('.invalid-input').remove();
                e.preventDefault();
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    },
                    type: "POST",
                    data: $("#new-category-form").serialize(),
                    url: '{{ route('classified.ads.categories.store') }}',
                    success: function(response) {
                        if (response.success) {
                            toastr.success('{{ translate('Category created successfully') }}');
                            location.reload();
                        } else {
                            toastr.error('{{ translate('Category create failed') }}');
                        }
                    },
                    error: function(response) {
                        if (response.status === 422) {
                            $.each(response.responseJSON.errors, function(field_name, error) {
                                $(document).find('[name=' + field_name + ']').closest(
                                    '.theme-input-style').after(
                                    '<div class="invalid-input d-flex">' + error +
                                    '</div>')
                            })
                        } else {
                            toastr.error('{{ translate('Category create failed') }}');
                        }
                    }
                });
            });
            /**
             *
             * Visible category delete modal
             *
             * */
            $('.delete-category').on('click', function(e) {
                e.preventDefault();
                var id = $(this).data('category');
                $('#delete-category-id').val(id);
                $("#delete-modal").modal("show");
            });

        })(jQuery);
    </script>

    @include('plugin/classilookscore::includes.permalink_script')
@endsection
