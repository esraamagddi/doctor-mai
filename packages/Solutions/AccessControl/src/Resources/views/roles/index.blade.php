@extends('core::layouts.backend')
@push('title') {{ __('acl::messages.roles') }} @endpush
@section('content')
<ul class="breadcrumb breadcrumb-top">
    <li><a href="/cp"><i class="fa fa-home"></i></a></li>
    <li>{{ __('acl::messages.roles') }}</li>
</ul>

<div class="block full">
    <div class="block-title d-flex align-items-center justify-content-between">
        <h2 class="m-0"><strong>{{ __('acl::messages.roles') }}</strong></h2>
        <div class="block-options pull-right">
            <a href="{{ route('roles.create') }}" class="btn btn-sm btn-success">
                <i class="fa fa-plus me-1"></i> {{ __('acl::messages.add_role') }}
            </a>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>{{ __('acl::messages.name') }}</th>
                    <th>{{ __('acl::messages.permissions') }}</th>
                    <th class="text-end">{{ __('acl::messages.actions') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($items as $i => $item)
                <tr>
                    <td>{{ $items->firstItem() + $i }}</td>
                    <td>{{ $item->name }}</td>
                    <td>
                        @foreach($item->permissions as $p)
                            <span class="label label-primary" style="margin:2px;display:inline-block">{{ $p->key }}</span>
                        @endforeach
                    </td>
                    <td class="text-end">
                        <div class="btn-group" role="group">
                            <a href="{{ route('roles.edit', $item) }}" class="btn btn-sm btn-warning" data-bs-toggle="tooltip" title="Edit">
                                <i class="fa fa-pencil"></i>
                            </a>
                            <form action="{{ route('roles.destroy', $item) }}" method="post" onsubmit="return confirm('{{ __('acl::messages.confirm_delete') }}')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-danger" data-bs-toggle="tooltip" title="Delete">
                                    <i class="fa fa-times"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{ $items->links() }}
</div>
@endsection
