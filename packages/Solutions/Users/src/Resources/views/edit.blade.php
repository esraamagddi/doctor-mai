@extends('core::layouts.backend')

@section('title', __('users::messages.edit'))

@section('content')
<ul class="breadcrumb breadcrumb-top">
    <li><a href="/cp"><i class="fa fa-home"></i></a></li>
    <li><a href="{{ route('users.index') }}">{{ __('users::messages.title') }}</a></li>
    <li>{{ __('users::messages.edit') }}</li>
</ul>

<div class="block full">
    <div class="block-title">
        <h2 class="m-0"><strong>{{ __('users::messages.edit') }}</strong></h2>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="m-0 ps-3">
                @foreach ($errors->all() as $error)
                    <li class="mb-1">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('users.update', $user) }}" method="post" class="form-bordered" enctype="multipart/form-data">
        @csrf
        @method('PUT')

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
                    <div class="mb-2">
                        <img
                            src="{{ $user->avatar ? asset('storage/' . $user->avatar) : asset('img/placeholders/avatars/avatar1.jpg') }}"
                            alt="{{ $user->name }}"
                            class="img-thumbnail"
                            style="max-height: 120px"
                            onerror="this.onerror=null;this.src='{{ asset('img/placeholders/avatars/avatar1.jpg') }}';">
                    </div>
                    <input type="file" name="avatar" class="file-input">
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label>{{ __('users::messages.password') }}</label>
                    <input type="password" name="password" class="form-control" autocomplete="new-password">
                    <small class="text-muted">{{ __('users::messages.leave_password_blank') }}</small>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label>{{ __('users::messages.password_confirmation') }}</label>
                    <input type="password" name="password_confirmation" class="form-control" autocomplete="new-password">
                </div>
            </div>

            @if (class_exists('Solutions\\AccessControl\\Models\\Role'))
                @php
                    $selectedRoleId = old('role_id', $user->role_id ?? null);
                    $roles = \Solutions\AccessControl\Models\Role::orderBy('name')->get();
                @endphp
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ __('users::messages.role') }}</label>
                        <select name="role_id" class="form-control">
                            <option value="">{{ __('users::messages.no_role') }}</option>
                            @foreach ($roles as $role)
                                <option value="{{ $role->id }}" {{ (string)$selectedRoleId === (string)$role->id ? 'selected' : '' }}>
                                    {{ $role->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            @endif
        </div>

        <div class="text-end mt-3">
            <button class="btn btn-primary">
                <i class="fa fa-save me-1"></i> {{ __('users::messages.update') }}
            </button>
        </div>
    </form>
</div>
@endsection
