@php
    $links = [
        [
            'title' => 'Header Setting',
            'route' => '',
            'active' => true,
        ],
    ];
@endphp
@extends('backend.layouts.dashboard_layout')
@section('page-title')
    {{ translation('Header Setting') }}
@endsection
@section('page-style')
    <link rel="stylesheet" href="{{ asset('public/web-assets/backend/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('public/web-assets/backend/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endsection
@section('page-content')
    <x-admin-page-header title="" :links="$links" />
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">{{ translation('Header Setting') }}</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-5 col-sm-3">
                                    @include('backend.modules.Appearances.site-setting.setting_tabs')
                                </div>
                                <div class="col-7 col-sm-9">
                                    <div class="tab-content">
                                        <div
                                            class="tab-pane text-left fade {{ Request::routeIs(['admin.appearance.site.setting.header']) ? 'show active' : '' }}">
                                            <h4>{{ translation('Header Setting') }}</h4>
                                            <form method="POST"
                                                action="{{ route('admin.appearance.site.setting.header.update') }}">
                                                @csrf

                                                <div class="form-group">
                                                    <label>{{ translation('Contact Number') }}</label>
                                                    <input type="text" class="form-control" name="header_contact_number"
                                                        value="{{ get_setting('header_contact_number') }}"
                                                        placeholder="{{ translation('Enter Contact Numbers') }}">
                                                </div>

                                                <div class="form-row justify-content-end mt-3">
                                                    <button type="submit"
                                                        class="btn btn-primary">{{ translation('Save Change') }}
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
@endsection
@section('page-script')
    <script src="{{ asset('public/web-assets/backend/plugins/select2/js/select2.full.min.js') }}"></script>
    <script>
        (function($) {
            "use strict";
            initMediaManager();
        })(jQuery);
    </script>
@endsection
