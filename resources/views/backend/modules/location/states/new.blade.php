@extends('backend.layouts.dashboard_layout')
@section('title')
    {{ translation('New State') }}
@endsection
@section('page-style')
    <link rel="stylesheet" href="{{ asset('/public/web-assets/backend/plugins/select2/select2.min.css') }}">
@endsection
@section('page-content')
    <div class="row">
        <div class="col-lg-6 mx-auto">
            <div class="card mb-30">
                <div class="card-header bg-white py-3">
                    <h4 class="font-20">{{ translation('New State') }}</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('plugin.location.state.store') }}" method="POST">
                        @csrf
                        <div class="form-row mb-20">
                            <div class="col-sm-4">
                                <label class="font-14 bold black">{{ translation('Name') }} </label>
                            </div>
                            <div class="col-sm-8">
                                <input type="text" name="name" class="form-control" value="{{ old('name') }}"
                                    placeholder="{{ translation('Type Name') }}">
                                @if ($errors->has('name'))
                                    <div class="invalid-input">{{ $errors->first('name') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="form-row mb-20">
                            <div class="col-sm-4">
                                <label class="font-14 bold black">{{ translation('Code') }}</label>
                            </div>
                            <div class="col-sm-8">
                                <input type="text" name="code" class="form-control" value="{{ old('code') }}"
                                    placeholder="{{ translation('Type  Here') }}">
                                @if ($errors->has('code'))
                                    <div class="invalid-input">{{ $errors->first('code') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="form-row mb-20">
                            <div class="col-sm-4">
                                <label class="font-14 bold black">{{ translation('Country') }}</label>
                            </div>
                            <div class="col-sm-8">
                                <select class="countrySelect form-control" name="country"
                                    placeholder="{{ translation('Select a option') }}">
                                    @foreach ($countries as $country)
                                        <option value="{{ $country->id }}">
                                            {{ $country->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @if ($errors->has('country'))
                                    <div class="invalid-input">{{ $errors->first('country') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-12 text-right">
                                <button type="submit" class="btn long">{{ translation('Save') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('page-script')
    <script src="{{ asset('/public/web-assets/backend/plugins/select2/select2.min.js') }}"></script>
    <script>
        (function($) {
            "use strict";
            $(document).ready(function() {
                $('.countrySelect').select2({
                    theme: "classic",
                });
            });
        })(jQuery);
    </script>
@endsection
