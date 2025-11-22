@extends('backend.layouts.dashboard_layout')
@section('page-content')
    <!--Page Header-->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ translation('Dashboard') }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">{{ translation('Dashboard') }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!--End page header-->

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon bg-info elevation-1"><i class="fas fa-blog"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">{{ translation('Products') }}</span>
                            <span class="info-box-number">
                                {{ $total_product }}
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-comment-alt"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">{{ translation('Messages') }}</span>
                            <span class="info-box-number">{{ $total_message }}</span>
                        </div>
                    </div>
                </div>
                <div class="clearfix hidden-md-up"></div>

                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-success elevation-1"><i class="fas fas fa-users"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">{{ translation('Blogs') }}</span>
                            <span class="info-box-number">{{ $total_blogs }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-warning elevation-1"><i class="fas fas fa-credit-card"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">{{ translation('Pages') }}</span>
                            <span class="info-box-number">{{ $total_page }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main row -->
            <div class="row">

                <div class="col-md-6">
                    <!-- Latest Members -->
                    <div class="card">
                        <div class="card-header border-transparent">
                            <h3 class="card-title">{{ translation('Latest Products') }}</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <table class="table table-hover text-nowrap table-bordered">
                                <thead>
                                    <tr>
                                        <th>{{ translation('#') }}</th>
                                        <th>{{ translation('Image') }}</th>
                                        <th>{{ translation('Title') }}</th>
                                        <th>{{ translation('Category') }}</th>
                                        <th>{{ translation('Status') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($latest_products->count() > 0)
                                        @foreach ($latest_products as $key => $product)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>

                                                <td>
                                                    <img src="{{ asset(getFilePath($product->thumbnail)) }}" alt="Image"
                                                        class="img-md">
                                                </td>
                                                <td>{{ $product->translation('title') }}</td>
                                                <td>{{ $product->category?->title }}</td>
                                                <td>
                                                    @if ($product->status == config('settings.general_status.active'))
                                                        <span
                                                            class="badge badge-success">{{ translation('Active') }}</span>
                                                    @else
                                                        <span
                                                            class="badge badge-danger">{{ translation('Inactive') }}</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="7">
                                                <p class="alert text-center">
                                                    {{ translation('No item found') }}
                                                </p>
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer clearfix">
                            <a href="{{ route('admin.product.list') }}"
                                class="btn btn-sm btn-success">{{ translation('View All Product') }}</a>
                        </div>
                    </div>
                    <!--End  Latest members -->
                </div>
                <div class="col-md-6">
                    <!-- Latest Members -->
                    <div class="card">
                        <div class="card-header border-transparent">
                            <h3 class="card-title">{{ translation('Latest Messages') }}</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <table class="table table-hover text-nowrap table-bordered">
                                <thead>
                                    <tr>
                                        <th>{{ translation('#') }}</th>
                                        <th>{{ translation('Sender') }}</th>
                                        <th>{{ translation('Email') }}</th>
                                        <th>{{ translation('Phone Number') }}</th>
                                        <th>{{ translation('Country') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($latest_messages->count() > 0)
                                        @foreach ($latest_messages as $key => $message)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>

                                                <td>{{ $message->name }}</td>
                                                <td>{{ $message->email }}</td>
                                                <td>{{ $message->phone_number }}</td>
                                                <td>{{ $message->country }}</td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="7">
                                                <p class="alert text-center">
                                                    {{ translation('No item found') }}
                                                </p>
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer clearfix">
                            <a href="{{ route('admin.contact.us.message.list') }}"
                                class="btn btn-sm btn-success">{{ translation('View All Messages') }}</a>
                        </div>
                    </div>
                    <!--End  Latest members -->
                </div>

            </div>
        </div>
    </section>
@endsection
@section('page-script')
@endsection
