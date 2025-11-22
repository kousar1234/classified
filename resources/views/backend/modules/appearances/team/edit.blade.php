@php
    $page_title = 'Team Members';
    $links = [
        [
            'title' => $page_title,
            'route' => 'admin.appearance.team.list',
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
                            <h3 class="card-title">{{ translation('Edit team') }}</h3>
                        </div>
                        <div class="card-body">
                            <form id="new-item-item-form" method="POST" action="{{ route('admin.appearance.team.update') }}">
                                @csrf
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>{{ translation('Name') }}</label>
                                            <input type="hidden" name="id" value="{{ $item->id }}">
                                            <input type="text" class="form-control" name="name"
                                                value="{{ $item->name }}" placeholder="{{ translation('Enter Name') }}">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>{{ translation('Email') }}</label>
                                            <input type="email" class="form-control" name="email"
                                                value="{{ $item->email }}" placeholder="{{ translation('Enter Email') }}">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>{{ translation('Phone') }}</label>
                                            <input type="text" class="form-control" name="phone"
                                                value="{{ $item->phone }}"
                                                placeholder="{{ translation('Enter Phone') }}">
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
