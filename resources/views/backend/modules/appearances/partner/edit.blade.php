@php
    $page_title = 'Partner';
    $links = [
        [
            'title' => $page_title,
            'route' => 'admin.appearance.partner.list',
            'active' => false,
        ],
        [
            'title' => 'Edit ' . $page_title,
            'route' => '',
            'active' => true,
        ],
    ];
@endphp
@extends('backend.layouts.dashboard_layout')
@section('page-title')
    Edit {{ $page_title }}
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
                            <h3 class="card-title">{{ translation('Edit Partner') }}</h3>
                        </div>
                        <div class="card-body">
                            <form id="new-item-item-form" method="POST"
                                action="{{ route('admin.appearance.partner.update') }}">
                                @csrf
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>{{ translation('Title') }}</label>
                                            <input type="hidden" name="id" value="{{ $item->id }}">
                                            <input type="text" class="form-control" name="title"
                                                value="{{ $item->title }}" placeholder="{{ translation('Enter Title') }}">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>{{ translation('Link') }}</label>
                                            <input type="text" class="form-control" name="link"
                                                value="{{ $item->link }}" placeholder="{{ translation('Enter Link') }}">
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>{{ translation('Image') }}</label>
                                            <x-media name="image" value="{{ $item->image }}"></x-media>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <button type="submit"
                                        class="btn btn-primary create-new-item-item-btn">{{ translation('Save Changes') }}</button>
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
