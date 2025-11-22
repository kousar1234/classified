@php
    $page_title = 'New Faq';
    $links = [
        [
            'title' => 'Faq',
            'route' => 'admin.appearance.faq.list',
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
                            <form id="new-slider-item-form" method="POST" action="{{ route('admin.appearance.faq.store') }}">
                                @csrf
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>{{ translation('Question') }}</label>
                                            <input type="text" class="form-control" name="question"
                                                placeholder="{{ translation('Enter Question') }}">
                                            @if ($errors->has('question'))
                                                <div class="error text-danger mb-0 invalid-input">
                                                    {{ $errors->first('question') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>{{ translation('Answer') }}</label>
                                            <textarea class="form-control" name="answer" placeholder="{{ translation('Enter Answer') }}" rows="5"></textarea>
                                            @if ($errors->has('answer'))
                                                <div class="error text-danger mb-0 invalid-input">
                                                    {{ $errors->first('answer') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <button type="submit"
                                        class="btn btn-primary create-new-slider-item-btn">{{ translation('Save') }}</button>
                                </div>
                        </div>
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
