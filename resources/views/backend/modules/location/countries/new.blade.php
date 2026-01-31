@extends('backend.layouts.dashboard_layout')
@section('title')
    {{ translation('New Country') }}
@endsection
@section('page-content')
    <div class="row">
        <div class="col-lg-6 mx-auto">
            <div class="card mb-30">
                <div class="card-header bg-white py-3">
                    <h4>{{ translation('New Country') }}</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('classified.locations.country.store') }}" method="POST">
                        @csrf
                        <div class="form-row mb-20">
                            <div class="col-sm-4">
                                <label class="font-14 bold black">{{ translation('Name') }} </label>
                            </div>
                            <div class="col-sm-8">
                                <input type="text" name="name" class="form-control" value="{{ old('name') }}"
                                    placeholder="{{ translation('Enter Name') }}">
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
                                    placeholder="{{ translation('Enter Code') }}">
                                @if ($errors->has('code'))
                                    <div class="invalid-input">{{ $errors->first('code') }}</div>
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
