@extends('core::layouts.backend')
@push('title') {{ __('acl::messages.add_role') }} @endpush
@section('content')
    <ul class="breadcrumb breadcrumb-top">
        <li><a href="/cp"><i class="fa fa-home"></i></a></li>
        <li><a href="{{ route('roles.index') }}">{{ __('acl::messages.roles') }}</a></li>
        <li>{{ __('acl::messages.add_role') }}</li>
    </ul>
    <div class="block full">
        <div class="block-title">
            <h2 class="m-0"><strong>{{ __('acl::messages.add_role') }}</strong></h2>
            <div class="block-options pull-right">
                <a href="{{ route('permissions.sync') }}" class="btn btn-sm btn-default"><i class="fa fa-sync me-1"></i>
                    {{ __('acl::messages.sync') }}</a>
            </div>
        </div>
        <form action="{{ route('roles.store') }}" method="post" class="form-horizontal form-bordered">
            @csrf
            <div class="form-group">
                <label>{{ __('acl::messages.name') }}</label>
                <input type="text" name="name" class="form-control" value="{{ old('name', $role->name ?? '') }}" required>
            </div>
            <div class="row">
                @foreach($perms as $module => $list)
                    <div class="col-md-4">
                        <div class="block">
                            <div class="block-title">
                                <div class="block-options pull-right">
                                    <a href="{{ route('permissions.delete', $module) }}"
                                        onsubmit="return confirm('{{ __('acl::messages.confirm_delete') }}')"
                                        class="btn btn-sm btn-danger" data-toggle="tooltip"
                                        title="{{ __('acl::messages.delete') }}" data-original-title="Settings"><i
                                            class="fa fa-times"></i>
                                    </a>
                                </div>
                                <h2>{{ $module }}</h2>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-body" style="height:260px;overflow:auto">
                                    @foreach($list as $perm)
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="permissions[]" value="{{ $perm->id }}" {{ in_array($perm->id, $selected ?? []) ? 'checked' : '' }}>
                                                {{ $perm->label ?? $perm->key }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="form-group"><button class="btn btn-primary">{{ __('acl::messages.save') }}</button></div>
        </form>
    </div>
@endsection