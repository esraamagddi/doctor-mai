@extends('core::layouts.backend')

@push('title') {{ __('media::messages.video_categories') }} @endpush

@section('content')
<ul class="breadcrumb breadcrumb-top">
    <li><a href="/cp"><i class="fa fa-home"></i></a></li>
    <li><a href="{{ route('media.video_categories.index') }}">{{ __('media::messages.video_categories') }}</a></li>
    <li>{{ __('media::messages.edit') }}</li>
</ul>

<div class="block full">
    <div class="block-title d-flex align-items-center justify-content-between">
        <h2 class="m-0"><strong>{{ __('media::messages.video_categories') }}</strong></h2>
        <div class="block-options pull-right">
            <a href="{{ route('media.video_categories.index') }}" class="btn btn-sm btn-primary">
                <i class="fa fa-arrow-left me-1"></i> {{ __('media::messages.back') }}
            </a>
        </div>
    </div>

    <form action="{{ route('media.video_categories.update', $item) }}" method="post" enctype="multipart/form-data">
        @csrf @method('PUT')

        <ul class="nav nav-tabs push" data-toggle="tabs">
            @foreach($langs as $i => $L)
            <li class="{{ $L->code === $activeLocale ? 'active' : '' }}">
                <a href="#tab-{{ $L->code }}">{{ $L->name }} ({{ $L->code }})</a>
            </li>
            @endforeach
        </ul>

        <div class="tab-content">
            @foreach($langs as $lang)
            <div class="tab-pane {{ $lang->code === $activeLocale ? 'active' : '' }}" id="tab-{{ $lang->code }}">
                <div class="form-group">
                    <label>{{ __('media::messages.name_' . $lang->code) }}</label>
                    <input type="text" name="name[{{ $lang->code }}]" class="form-control"
                        value="{{ old('name.'.$lang->code, data_get($item->name ?? [], $lang->code)) }}"
                        placeholder="{{ __('media::messages.enter_name_' . $lang->code) }}">
                </div>
            </div>
            @endforeach
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>{{ __('media::messages.order') }}</label>
                    <input type="number" name="order" class="form-control" value="{{ old('order', $item->order ?? 0) }}" min="0">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>{{ __('media::messages.status') }}</label>
                    <div>
                        <input type="hidden" name="status" value="0">
                        <label class="switch switch-danger">
                            <input type="checkbox" name="status" value="1" {{ old('status', ($item->status ?? 1)) ? 'checked' : '' }}>
                            <span></span>
                        </label>
                        <span class="ms-2 align-middle">{{ __('media::messages.active') }}</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-group form-actions">
            <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-save"></i> {{ __('media::messages.update') }}</button>
            <a href="{{ route('media.video_categories.index') }}" class="btn btn-sm btn-warning"><i class="fa fa-repeat"></i> {{ __('media::messages.cancel') }}</a>
        </div>
    </form>
</div>
@endsection
