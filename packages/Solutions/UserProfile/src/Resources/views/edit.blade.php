@extends('core::layouts.backend')

@push('title') {{ __('userprofile::messages.profile') }} @endpush

@push('styles')
    <style>
        .form-group label {
            font-weight: 600;
        }
    </style>
@endpush

@section('content')
    <ul class="breadcrumb breadcrumb-top">
        <li><a href="/cp"><i class="fa fa-home"></i></a></li>
        <li>{{ __('userprofile::messages.profile') }}</li>
    </ul>

    <div class="block full">
        @if (session('success'))
            <div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <ul class="m-0 ps-3">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="block-title d-flex align-items-center justify-content-between">
            <div class="block-options pull-right">
                <a href="/cp" class="btn btn-sm btn-primary">
                    <i class="fa fa-arrow-left me-1"></i> {{ __('userprofile::messages.back_dashboard') }}
                </a>
            </div>
            <h2 class="m-0"><strong>{{ __('userprofile::messages.edit_profile') }}</strong></h2>
        </div>

        <form action="{{ route('profile.update') }}" method="post" class="form-bordered" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ __('userprofile::messages.phone') }}</label>
                        <input type="text" name="phone" class="form-control" value="{{ old('phone', $user->phone) }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ __('userprofile::messages.avatar') }}</label>
                        <input type="file" name="avatar" class="form-control">
                        @if($user->avatar ?? false)
                            <div class="mt-2">
                                <img src="{{ asset('storage/' . $user->avatar) }}" alt="avatar"
                                    style="height:70px;border-radius:8px">
                            </div>
                        @endif
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ __('userprofile::messages.password') }}</label>
                        <input type="password" name="password" class="form-control" value="" autocomplete="new-password">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ __('userprofile::messages.password_confirmation') }}</label>
                        <input type="password" name="password_confirmation" class="form-control" value=""
                            autocomplete="new-password">
                    </div>
                </div>
                <div class="col-md-12">

                    <div class="form-group form-actions">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-save me-1"></i>
                            {{ __('userprofile::messages.save') }}</button>
                    </div>
                </div>
            </div>

        </form>
    </div>
@endsection