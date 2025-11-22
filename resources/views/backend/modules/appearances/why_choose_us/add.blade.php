@php
    $page_title = 'New Why Choose Us';
    $links = [
        [
            'title' => 'Why Choose Us',
            'route' => 'admin.appearance.why.us.list',
            'active' => false,
        ],
        [
            'title' => $page_title,
            'route' => '',
            'active' => true,
        ],
    ];
@endphp
@extends('backend.layouts.dashboard_layout')
@section('page-title')
    {{ $page_title }}
@endsection
@section('page-style')
@endsection
@section('page-content')
    <x-admin-page-header :title="$page_title" :links="$links" />
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">{{ translation($page_title) }}</h3>
                        </div>
                        <div class="card-body">
                            <form id="new-slider-item-form" method="POST"
                                action="{{ route('admin.appearance.why.us.store') }}">
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
                                            <label>{{ translation('Description') }}</label>
                                            <input type="text" class="form-control" name="description"
                                                placeholder="{{ translation('Enter Description') }}">
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
                                        class="btn btn-primary create-new-slider-item-btn">{{ translation('Save') }}</button>
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
