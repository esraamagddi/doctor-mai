@extends('core::layouts.backend')

@push('title') {{ __('users::messages.title') }} @endpush

@section('content')
<ul class="breadcrumb breadcrumb-top">
    <li><a href="/cp"><i class="fa fa-home"></i></a></li>
    <li>{{ __('users::messages.title') }}</li>
</ul>

<div class="block full">
    <div class="block-title d-flex align-items-center justify-content-between">
        <h2 class="m-0"><strong>{{ __('users::messages.title') }}</strong></h2>
        <div class="block-options pull-right">
            <a href="{{ route('users.create') }}" class="btn btn-sm btn-success">
                <i class="fa fa-plus me-1"></i> {{ __('users::messages.add') }}
            </a>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-vcenter table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>{{ __('users::messages.image') }}</th>
                    <th>{{ __('users::messages.name') }}</th>
                    <th>{{ __('users::messages.email') }}</th>
                    <th>{{ __('users::messages.phone') }}</th>
                    <th class="text-end">{{ __('users::messages.actions') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($items as $i => $item)
                <tr>
                    <td>{{ $items->firstItem() + $i }}</td>
                    <td>
                        @if($item->avatar)
                            <img src="{{ asset('storage/'.$item->avatar) }}" alt="{{ $item->name }}"
                                 onerror="this.onerror=null;this.src='{{ asset('img/placeholders/avatars/avatar1.jpg') }}';"
                                 style="width:40px;height:40px;border-radius:8px;object-fit:cover">
                        @else
                            <img src="{{ asset('img/placeholders/avatars/avatar1.jpg') }}" alt=""
                                 style="width:40px;height:40px;border-radius:8px;object-fit:cover">
                        @endif
                    </td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->email }}</td>
                    <td>{{ $item->phone }}</td>
                    <td class="text-end">
                        <div class="btn-group" role="group">
                            <a href="{{ route('users.edit', $item) }}" class="btn btn-sm btn-warning" data-bs-toggle="tooltip" title="Edit">
                                <i class="fa fa-pencil"></i>
                            </a>
                            <form action="{{ route('users.destroy', $item) }}" method="post" onsubmit="return confirm('{{ __('users::messages.confirm_delete') }}')">
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
