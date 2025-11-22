@php
    $links = [
        [
            'title' => 'Blogs',
            'route' => 'admin.blogs.list',
            'active' => true,
        ],
    ];
@endphp
@extends('backend.layouts.dashboard_layout')
@section('page-title')
    {{ translation('Blogs') }}
@endsection
@section('page-style')
@endsection
@section('page-content')
    <x-admin-page-header title="Blogs" :links="$links" />
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">{{ translation('Blogs') }}</h3>
                            @can('Create New Blog')
                                <a class="btn btn-success btn-sm float-right text-white" href="{{ route('admin.blogs.create') }}">
                                    {{ translation('Create New Blog') }}
                                </a>
                            @endcan
                        </div>
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap table-bordered">
                                <thead>
                                    <tr>
                                        <th>{{ translation('#') }}</th>
                                        <th>{{ translation('Title') }}</th>
                                        <th>{{ translation('Author') }}</th>
                                        <th>{{ translation('Published At') }}</th>
                                        <th>{{ translation('Featured') }}</th>
                                        <th>{{ translation('Status') }}</th>
                                        <th class="text-right">{{ translation('Action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($blogs->count() > 0)
                                        @foreach ($blogs as $key => $blog)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td class="text-capitalize">
                                                    <a href="{{ route('frontend.new.details', ['permalink' => $blog->permalink]) }}"
                                                        target="_blank">
                                                        {{ $blog->translation('title', getLocale()) }}
                                                    </a>
                                                </td>
                                                <td>
                                                    @if ($blog->authorInfo != null)
                                                        {{ $blog->authorInfo->name }}
                                                    @else
                                                        -
                                                    @endif
                                                </td>
                                                <td>
                                                    {{ $blog->created_at->format('d M Y') }}
                                                </td>
                                                <td>
                                                    @if ($blog->is_featured == config('settings.general_status.active'))
                                                        <p class="badge badge-success">{{ translation('Active') }}</p>
                                                    @else
                                                        <p class="badge badge-danger">{{ translation('Inactive') }}</p>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($blog->status == config('settings.blog_status.publish'))
                                                        <p class="badge badge-success">{{ translation('Published') }}</p>
                                                    @endif
                                                    @if ($blog->status == config('settings.blog_status.unpublish'))
                                                        <p class="badge badge-danger">{{ translation('Unpublish') }}</p>
                                                    @endif
                                                    @if ($blog->status == config('settings.blog_status.draft'))
                                                        <p class="badge badge-secondary">{{ translation('Draft') }}</p>
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
                                                                href="{{ route('admin.blogs.edit', ['blog' => $blog->id, 'lang' => defaultLangCode()]) }}">
                                                                {{ translation('Edit') }}
                                                            </a>
                                                            @can('Delete Blog')
                                                                <div class="dropdown-divider"></div>
                                                                <a class="dropdown-item delete-blog" href="#"
                                                                    data-id="{{ $blog->id }}">
                                                                    {{ translation('Delete') }}
                                                                </a>
                                                            @endcan
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="7">
                                                <p class="alert alert-default-danger text-center">
                                                    {{ translation('No Item Found') }}
                                                </p>
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                            <div class="py-3">
                                {{ $blogs->withQueryString()->onEachSide(1)->links('pagination::bootstrap-5') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--Delete Modal-->
        <div class="modal fade" id="blog-delete-modal">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title h6">{{ translation('Delete Confirmation') }}</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body text-center">
                        <h4 class="mt-1 h6 my-2">{{ translation('Are you sure to delete blog ?') }}</h4>
                        <form method="POST" action="{{ route('admin.blogs.delete') }}">
                            @csrf
                            <input type="hidden" id="delete-blog-id" name="id">
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
            //Visible blog delete modal
            $('.delete-blog').on('click', function(e) {
                e.preventDefault();
                let blog_id = $(this).data('id');
                $('#delete-blog-id').val(blog_id);
                $('#blog-delete-modal').modal('show');
            });
        })(jQuery);
    </script>
@endsection
