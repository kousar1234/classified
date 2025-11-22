@php
    $links = [
        [
            'title' => 'Sliders',
            'route' => '',
            'active' => true,
        ],
    ];
@endphp
@extends('backend.layouts.dashboard_layout')
@section('page-title')
    Sliders
@endsection
@section('page-style')
@endsection
@section('page-content')
    <x-admin-page-header title="Sliders" :links="$links" />
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">{{ translation('Sliders') }}</h3>
                            <a class="btn btn-success btn-sm float-right text-white"
                                href="{{ route('admin.appearance.slider.add.slider.item') }}">{{ translation('Add New Slider') }}</a>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>{{ translation('Image') }}</th>
                                        <th>{{ translation('Title') }}</th>
                                        <th>{{ translation('Link') }}</th>
                                        <th>{{ translation('Action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($sliders as $slider)
                                        <tr>
                                            <td><img src="{{ asset(getFilePath($slider->image)) }}" width="100"></td>
                                            <td>{{ $slider->translation('title') }}</td>
                                            <td>
                                                <a href="{{ $slider->button_link }}">{{ $slider->btn_link }}</a>
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.appearance.slider.edit.slider.item', ['slider' => $slider->id, 'lang' => 'en']) }}"
                                                    class="btn btn-info btn-sm">{{ translation('Edit') }}</a>
                                                <a href="{{ route('admin.appearance.slider.delete.slider.item', ['slider' => $slider->id]) }}"
                                                    class="btn btn-danger btn-sm">{{ translation('Delete') }}</a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4">
                                                <p class="alert alert-default-danger text-center">
                                                    {{ translation('No item found') }}
                                                </p>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            {{ $sliders->links() }}
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
