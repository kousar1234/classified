@php
    $links = [
        [
            'title' => 'Colors Setup',
            'route' => '',
            'active' => true,
        ],
    ];
@endphp
@extends('backend.layouts.dashboard_layout')
@section('page-title')
    {{ translation('Colors Setup') }}
@endsection
@section('page-style')
    <link rel="stylesheet"
        href="{{ asset('public/web-assets/backend/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css') }}">
@endsection
@section('page-content')
    <x-admin-page-header title="" :links="$links" />
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">{{ translation('Colors Setup') }}</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-5 col-sm-3">
                                    @include('backend.modules.Appearances.site-setting.setting_tabs')
                                </div>
                                <div class="col-7 col-sm-9">
                                    <div class="tab-content">
                                        <div
                                            class="tab-pane text-left fade {{ Request::routeIs(['admin.appearance.site.setting.colors']) ? 'show active' : '' }}">
                                            <h4>{{ translation('Colors Setup') }}</h4>
                                            <hr>
                                            <form method="POST"
                                                action="{{ route('admin.appearance.site.setting.colors.update') }}">
                                                @csrf
                                                <div class="form-group">
                                                    <label>{{ translation('Primary Color') }}</label>
                                                    <div class="input-group colorpicker-input">
                                                        <input type="text" class="form-control" name="site_primary_color"
                                                            value="{{ get_setting('site_primary_color') }}">
                                                        <div class="input-group-append">
                                                            <span class="input-group-text"
                                                                style="color:{{ get_setting('site_primary_color') != null ? get_setting('site_primary_color') : '#FFFF' }}"><i
                                                                    class="fas fa-square"></i></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>{{ translation('Base Color') }}</label>
                                                    <div class="input-group colorpicker-input">
                                                        <input type="text" class="form-control" name="site_base_color"
                                                            value="{{ get_setting('site_base_color') }}">
                                                        <div class="input-group-append">
                                                            <span class="input-group-text"
                                                                style="color:{{ get_setting('site_base_color') != null ? get_setting('site_base_color') : '#FFFF' }}"><i
                                                                    class="fas fa-square"></i></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>{{ translation('Heading Color') }}</label>
                                                    <div class="input-group colorpicker-input">
                                                        <input type="text" class="form-control" name="site_heading_color"
                                                            value="{{ get_setting('site_heading_color') }}">
                                                        <div class="input-group-append">
                                                            <span class="input-group-text"
                                                                style="color:{{ get_setting('site_heading_color') != null ? get_setting('site_heading_color') : '#FFFF' }}"><i
                                                                    class="fas fa-square"></i></span>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="d-flex justify-content-end">
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
    <script src="{{ asset('public/web-assets/backend/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js') }}">
    </script>
    <script>
        (function($) {
            "use strict";
            $(document).ready(function() {
                $('.colorpicker-input').colorpicker();
            });

            $('.colorpicker-input').on('colorpickerChange', function(event) {
                $(this).find('.fa-square').css('color', event.color.toString());
            });

        })(jQuery);
    </script>
@endsection
