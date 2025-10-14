@extends('core::layouts.backend')

@push('title') {{ __('transformation::messages.sidebar_title') }} @endpush

@section('content')

<ul class="breadcrumb breadcrumb-top">
    <li><a href="/cp"><i class="fa fa-home"></i></a></li>
    <li>{{ __('transformation::messages.sidebar_title') }}</li>
</ul>

<div class="block full">

    <div class="block-title d-flex align-items-center justify-content-between">
        <h2 class="m-0"><strong>{{ __('transformation::messages.sidebar_title') }}</strong></h2>
            <a href="{{ route('transformations.create') }}" class="btn btn-success btn-sm">
                <i class="fa fa-plus"></i> {{ __('Add Transformation') }}
            </a>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>@lang('Title')</th>
                    <th>@lang('Before')</th>
                    <th>@lang('After')</th>
                    <th>@lang('Actions')</th>
                </tr>
            </thead>
            <tbody>
                @foreach($items as $item)
                    <tr>
                        <td>{{ $item->title[app()->getLocale()] ?? '-' }}</td>
                        <td><img src="{{ asset('storage/' . $item->before_image) }}" style="width:60px"></td>
                        <td><img src="{{ asset('storage/' . $item->after_image) }}" style="width:60px"></td>
                        <td>
                                <a href="{{ route('transformations.edit', $item) }}" class="btn btn-sm btn-info"><i class="fa fa-edit"></i></a>
                                <form action="{{ route('transformations.destroy', $item) }}" method="POST" style="display:inline;">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Delete?')">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </form>
                        </td>
                    </tr>
                @endforeach
                @if(!$items->count())
                    <tr>
                        <td colspan="4" class="text-center">@lang('No records found')</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>
@endsection
