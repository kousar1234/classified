@php
    $page_title = 'Product Applications';
    $links = [
        [
            'title' => $page_title,
            'route' => 'admin.appearance.product.application.list',
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
                            <h3 class="card-title">{{ translation('Edit Product Application') }}</h3>
                        </div>
                        <div class="card-body">
                            <ul class="nav nav-tabs nav-fill border-light border-0">
                                @foreach (activeLanguages() as $key => $language)
                                    <li class="nav-item">
                                        <a class="nav-link @if ($language->code == $lang) active border-0 @else bg-light @endif py-3"
                                            href="{{ route('admin.appearance.product.application.edit', ['id' => $item->id, 'lang' => $language->code]) }}">
                                            <span>{{ $language->title }}</span>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                            <form id="new-item-item-form" method="POST"
                                action="{{ route('admin.appearance.product.application.update') }}">
                                @csrf
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>{{ translation('Title') }}</label>
                                            <input type="hidden" name="id" value="{{ $item->id }}">
                                            <input type="hidden" name="lang" value="{{ $lang }}">
                                            <input type="text" class="form-control" name="title"
                                                value="{{ $item->translation('title', $lang) }}"
                                                placeholder="{{ translation('Enter Title') }}">
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
