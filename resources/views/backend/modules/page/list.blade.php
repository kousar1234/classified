@php
    $links = [
        [
            'title' => 'Blogs',
            'route' => 'admin.page.list',
            'active' => true,
        ],
    ];
@endphp
@extends('backend.layouts.dashboard_layout')
@section('page-title')
    {{ translation('Pages') }}
@endsection
@section('page-style')
@endsection
@section('page-content')
    <x-admin-page-header title="Pages" :links="$links" />
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">{{ translation('Pages') }}</h3>
                            <a class="btn btn-success btn-sm float-right text-white"
                                href="{{ route('admin.page.create') }}">{{ translation('Create New Page') }}</a>
                        </div>
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap table-bordered">
                                <thead>
                                    <tr>
                                        <th>{{ translation('#') }}</th>
                                        <th>{{ translation('Title') }}</th>
                                        <th>{{ translation('Author') }}</th>
                                        <th>{{ translation('Created') }}</th>
                                        <th>{{ translation('Status') }}</th>
                                        <th class="text-right">{{ translation('Action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($pages->count() > 0)
                                        @foreach ($pages as $key => $page)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td class="text-capitalize page-title">
                                                    <a href="{{ route('frontend.page.single.preview', ['permalink' => $page->permalink]) }}"
                                                        target="_blank">
                                                        {{ $page->title }}
                                                    </a>
                                                    @if (get_setting('home_page_id') == $page->id)
                                                        <span class="text-black">- {{ translation('Home Page') }}</span>
                                                    @endif
                                                    @if (get_setting('contact_page_id') == $page->id)
                                                        <span class="text-black">- {{ translation('Contact Page') }}</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($page->authorInfo != null)
                                                        {{ $page->authorInfo->name }}
                                                    @else
                                                        -
                                                    @endif
                                                </td>
                                                <td>
                                                    {{ $page->created_at->format('M d Y h:i:sA') }}
                                                </td>
                                                <td>
                                                    @if ($page->status == config('settings.page_status.active'))
                                                        <p class="badge badge-success">{{ translation('Active') }}</p>
                                                    @else
                                                        <p class="badge badge-danger">{{ translation('Inactive') }}</p>
                                                    @endif
                                                </td>
                                                <td class="text-right">
                                                    <div class="btn-group">
                                                        <button type="button"
                                                            class="btn btn-default">{{ translation('Action') }}</button>
                                                        <button type="button"
                                                            class="btn btn-default dropdown-toggle dropdown-hover dropdown-icon"
                                                            data-toggle="dropdown" aria-expanded="false">
                                                        </button>
                                                        <div class="dropdown-menu" role="menu">
                                                            <a class="dropdown-item"
                                                                href="{{ route('admin.page.edit', ['page' => $page->id, 'lang' => defaultLangCode()]) }}">
                                                                {{ translation('Edit Page') }}
                                                            </a>
                                                            @can('Delete Page')
                                                                <div class="dropdown-divider"></div>
                                                                <a class="dropdown-item delete-item" href="#"
                                                                    data-id="{{ $page->id }}">
                                                                    {{ translation('Delete Page') }}
                                                                </a>
                                                            @endcan
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="6">
                                                <p class="alert alert-default-danger text-center">
                                                    {{ translation('No item found') }}
                                                </p>
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                            <div class="py-3">
                                {{ $pages->withQueryString()->onEachSide(1)->links('pagination::bootstrap-5') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--Delete Modal-->
        <div class="modal fade" id="delete-modal">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title h6">{{ translation('Delete Confirmation') }}</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body text-center">
                        <h4 class="mt-1 h6 my-2">{{ translation('Are you sure to delete?') }}</h4>
                        <form method="POST" action="{{ route('admin.page.delete') }}">
                            @csrf
                            <input type="hidden" id="delete-item-id" name="id">
                            <button type="button" class="btn mt-2 btn-danger"
                                data-dismiss="modal">{{ translation('Cancel') }}</button>
                            <button type="submit" class="btn btn-success mt-2">{{ translation('Delete') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--End Delete Modal-->
    </section>
@endsection
@section('page-script')
    <script>
        (function($) {
            "use strict";
            //Visible delete modal
            $('.delete-item').on('click', function(e) {
                e.preventDefault();
                let id = $(this).data('id');
                $('#delete-item-id').val(id);
                $('#delete-modal').modal('show');
            });

        })(jQuery);
    </script>
@endsection
