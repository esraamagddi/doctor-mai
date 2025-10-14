@extends('core::layouts.backend')

@push('title') {{ __('clients::messages.title') }} @endpush

@section('content')
<ul class="breadcrumb breadcrumb-top">
    <li><a href="/cp"><i class="fa fa-home"></i></a></li>
    <li>{{ __('clients::messages.title') }}</li>
</ul>

<div class="block full">
    <div class="block-title d-flex align-items-center justify-content-between">
        <h2 class="m-0"><strong>{{ __('clients::messages.title') }}</strong></h2>
        <div class="block-options pull-right">
            <a href="{{ route('clients.create') }}" class="btn btn-sm btn-success">
                <i class="fa fa-plus me-1"></i> {{ __('clients::messages.add') }}
            </a>
        </div>
    </div>

    <form method="get" class="mb-3">
        <div class="row g-2">
            <div class="col-md-4">
                <input name="s" class="form-control" placeholder="Search..." value="{{ request('s') }}">
            </div>
            <div class="col-md-2">
                <button class="btn btn-primary"><i class="fa fa-search"></i></button>
            </div>
        </div>
    </form>

    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>{{ __('clients::messages.name_en') }}</th>
                    <th>Slug</th>
                    <th>{{ __('clients::messages.website') }}</th>
                    <th>{{ __('clients::messages.status') }}</th>
                    <th class="text-end">{{ __('clients::messages.actions') }}</th>
                </tr>
            </thead>
            <tbody>
                @forelse($items as $it)
                <tr>
                    <td>{{ $it->id }}</td>
                    <td>{{ $it->name['en'] ?? '' }}</td>
                    <td>{{ $it->slug }}</td>
                    <td>
                        @if($it->website)
                        <a href="{{ $it->website }}" target="_blank">{{ $it->website }}</a>
                        @endif
                    </td>
                    <td>
                        <span class="badge {{ $it->status ? 'bg-success':'bg-secondary' }}">
                            {{ $it->status ? 'ON' : 'OFF' }}
                        </span>
                    </td>
                    <td class="text-end">
                        <div class="btn-group" role="group">
                            <a href="{{ route('clients.edit',$it) }}" class="btn btn-sm btn-warning" data-bs-toggle="tooltip" title="Edit">
                                <i class="fa fa-pencil"></i>
                            </a>
                            <form action="{{ route('clients.destroy',$it) }}" method="post" onsubmit="return confirm('Delete?');">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-danger" data-bs-toggle="tooltip" title="Delete">
                                    <i class="fa fa-times"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center text-muted">No data</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{ $items->withQueryString()->links() }}
</div>
@endsection
