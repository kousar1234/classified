@php
    $links = [
        [
            'title' => 'Sliders',
            'route' => 'admin.appearance.slider.list',
            'active' => false,
        ],
        [
            'title' => 'New Slider',
            'route' => '',
            'active' => true,
        ],
    ];
@endphp
@extends('backend.layouts.dashboard_layout')
@section('page-title')
    New Slider
@endsection
@section('page-style')
@endsection
@section('page-content')
    <x-admin-page-header title="New Slider" :links="$links" />
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">{{ translation('New Slider') }}</h3>
                        </div>
                        <div class="card-body">
                            <form id="new-slider-item-form" method="POST"
                                action="{{ route('admin.appearance.slider.store.slider.item') }}">
                                @csrf
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>{{ translation('Title') }}</label>
                                            <input type="text" class="form-control" name="title"
                                                placeholder="{{ translation('Enter Title') }}">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>{{ translation('Link') }}</label>
                                            <input type="text" class="form-control" name="button_link"
                                                placeholder="{{ translation('Enter Link') }}">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>{{ translation('Image') }}</label>
                                            <x-media name="image" value=""></x-media>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <button type="submit"
                                        class="btn btn-primary create-new-slider-item-btn">{{ translation('Save Slider Item') }}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('page-script')
    <script>
        (function($) {
            "use strict";
            initMediaManager();

        })(jQuery);
    </script>
@endsection
