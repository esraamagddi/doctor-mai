@extends('core::layouts.backend')
@push('title') {{ __('users::messages.add') }} @endpush
@section('content')
<ul class="breadcrumb breadcrumb-top">
    <li><a href="/cp"><i class="fa fa-home"></i></a></li>
    <li><a href="{{ route('users.index') }}">{{ __('users::messages.title') }}</a></li>
    <li>{{ __('users::messages.add') }}</li>
</ul>
<div class="block full">
    <div class="block-title">
        <h2 class="m-0"><strong>{{ __('users::messages.add') }}</strong></h2>
    </div>
    <form action="{{ route('users.store') }}" method="post" class="form-bordered" enctype="multipart/form-data">
        @csrf
        
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label>{{ __('users::messages.name') }}</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $user->name ?? '') }}" required>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label>{{ __('users::messages.email') }}</label>
            <input type="email" name="email" class="form-control" value="{{ old('email', $user->email ?? '') }}" required>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label>{{ __('users::messages.phone') }}</label>
            <input type="text" name="phone" class="form-control" value="{{ old('phone', $user->phone ?? '') }}">
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label>{{ __('users::messages.image') }}</label>
            <input type="file" name="avatar" class="file-input">
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label>{{ __('users::messages.password') }}</label>
            <input type="password" name="password" class="form-control" {{ isset($user) ? '' : 'required' }}>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label>{{ __('users::messages.password_confirmation') }}</label>
            <input type="password" name="password_confirmation" class="form-control" {{ isset($user) ? '' : 'required' }}>
        </div>
    </div>
    @if(class_exists('Solutions\\AccessControl\\Models\\Role'))
    <div class="col-md-6">
        <div class="form-group">
            <label>{{ __('users::messages.role') }}</label>
            <select name="role_id" class="form-control">
                <option value="">{{ __('users::messages.no_role') }}</option>
                @foreach(\Solutions\AccessControl\Models\Role::orderBy('name')->get() as $role)
                    <option value="{{ $role->id }}" {{ (old('role_id', isset($user) ? optional($user->roles->first())->id : null) == $role->id) ? 'selected' : '' }}>
                        {{ $role->name }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
    @endif
</div>

<div class="mt-3" style="display: flex; justify-content: flex-start; padding-left: 20px;">
    <button class="btn btn-primary">
        <i class="fa fa-save me-1"></i> {{ __('users::messages.save') }}
    </button>
</div>
    </form>
</div>
@endsection
