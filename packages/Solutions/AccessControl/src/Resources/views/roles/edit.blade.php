@extends('core::layouts.backend')
@push('title') {{ __('acl::messages.edit_role') }} @endpush
@section('content')
<ul class="breadcrumb breadcrumb-top">
    <li><a href="/cp"><i class="fa fa-home"></i></a></li>
    <li><a href="{{ route('roles.index') }}">{{ __('acl::messages.roles') }}</a></li>
    <li>{{ __('acl::messages.edit_role') }}</li>
</ul>
<div class="block full">
    <div class="block-title">
        <h2 class="m-0"><strong>{{ __('acl::messages.edit_role') }}</strong></h2>
    </div>
    <form action="{{ route('roles.update', $role) }}" method="post" class="form-bordered">
        @csrf @method('PUT')

        <div class="form-group">
            <label>{{ __('acl::messages.name') }}</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $role->name ?? '') }}" required>
        </div>
        <div class="block">
            <div class="row">
                @foreach($perms as $module => $list)
                <div class="col-md-4">
                    <div class="panel panel-default">
                        <div class="panel-heading"><strong>{{ $module }}</strong></div>
                        <div class="panel-body" style="height:260px;overflow:auto">
                            @foreach($list as $perm)
                            <input type="hidden" name="" value="{{$perm->key}}">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="permissions[]" value="{{ $perm->id }}" {{
                                        in_array($perm->id, $selected ?? []) ? 'checked' : '' }}>
                                    {{ $perm->label ?? $perm->key }}
                                </label>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <div class="form-group"><button class="btn btn-primary">{{ __('acl::messages.update') }}</button></div>
    </form>
</div>
@endsection