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

            </div>
        </div>
    </section>
@endsection
@section('page-script')
@endsection
