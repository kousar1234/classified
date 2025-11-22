@php
    $page_title = 'Partners';
    $links = [
        [
            'title' => 'Partners',
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
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">{{ translation($page_title) }}</h3>
                            <a class="btn btn-success btn-sm float-right text-white"
                                href="{{ route('admin.appearance.partner.add') }}">{{ translation('Add New Item') }}</a>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>{{ translation('#') }}</th>
                                        <th>{{ translation('Image') }}</th>
                                        <th>{{ translation('Title') }}</th>
                                        <th>{{ translation('Link') }}</th>
                                        <th>{{ translation('Action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($items as $key=>$item)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td><img src="{{ asset(getFilePath($item->image)) }}" width="100"></td>
                                            <td>{{ $item->title }}</td>
                                            <td>{{ $item->link }}</td>
                                            <td>
                                                <a href="{{ route('admin.appearance.partner.edit', ['id' => $item->id, 'lang' => 'en']) }}"
                                                    class="btn btn-info btn-sm">{{ translation('Edit') }}
                                                </a>
                                                <a href="{{ route('admin.appearance.partner.delete', ['id' => $item->id]) }}"
                                                    class="btn btn-danger btn-sm">{{ translation('Delete') }}
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5">
                                                <p class="alert alert-default-danger text-center">
                                                    {{ translation('No item found') }}
                                                </p>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            {{ $items->links() }}
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
