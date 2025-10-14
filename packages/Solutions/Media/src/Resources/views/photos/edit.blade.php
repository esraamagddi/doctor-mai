@extends('core::layouts.backend')

@push('title') {{ __('media::messages.edit_photo') }} @endpush

@section('content')
<ul class="breadcrumb breadcrumb-top">
    <li><a href="/cp"><i class="fa fa-home"></i></a></li>
    <li><a href="{{ route('media.photos.index') }}">{{ __('media::messages.photos') }}</a></li>
    <li>{{ __('media::messages.edit') }}</li>
</ul>

<div class="block full">
    <div class="block-title d-flex align-items-center justify-content-between">
        <h2 class="m-0"><strong>{{ __('media::messages.edit') }} :</strong>
            {{ data_get($photo->title, app()->getLocale(), data_get($photo->title, 'en')) }}</h2>
        <div class="block-options pull-right">
            <a href="{{ route('media.photos.index') }}" class="btn btn-sm btn-primary">
                <i class="fa fa-arrow-left me-1"></i> {{ __('media::messages.back') }}
            </a>
        </div>
    </div>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul class="m-0">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('media.photos.update', $photo) }}" method="post" class="form-bordered" enctype="multipart/form-data">
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
                        <label>{{ __('media::messages.title_' . $lang->code) }}</label>
                        <input type="text" name="title[{{ $lang->code }}]" class="form-control"
                               value="{{ old('title.'.$lang->code, $photo->title[$lang->code] ?? '') }}"
                               placeholder="{{ __('media::messages.enter_title_' . $lang->code) }}">
                    </div>
                    <div class="form-group">
                        <label>{{ __('media::messages.description_' . $lang->code) }}</label>
                        <textarea name="description[{{ $lang->code }}]" class="form-control" rows="3"
                                  placeholder="{{ __('media::messages.enter_description_' . $lang->code) }}">{{ old('description.'.$lang->code, $photo->description[$lang->code] ?? '') }}</textarea>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="row">


            <div class="col-md-6">
                <div class="form-group">
                    <label>{{ __('media::messages.image') }}</label>
                    <input type="file" name="image" class="file-input" accept="image/*">
                    @if(!empty($photo->image))
                        <div class="mt-2">
                            <img src="{{ asset('storage/'.$photo->image) }}" style="max-width:150px;height:auto;">
                        </div>
                    @endif
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label>{{ __('media::messages.order') }}</label>
                    <input type="number" name="order" class="form-control" min="0"
                           value="{{ old('order', $photo->order) }}">
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label>{{ __('media::messages.status') }}</label>
                    <div>
                        <input type="hidden" name="status" value="0">
                        <label class="switch switch-danger" style="vertical-align: middle;">
                            <input type="checkbox" name="status" value="1" {{ old('status', $photo->status) ? 'checked' : '' }}>
                            <span></span>
                        </label>
                        <span class="ms-2 align-middle">{{ __('media::messages.active') }}</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-group form-actions">
            <button class="btn btn-sm btn-primary"><i class="fa fa-save"></i> {{ __('media::messages.update') }}</button>
            <a href="{{ route('media.photos.index') }}" class="btn btn-sm btn-warning"><i class="fa fa-repeat"></i> {{ __('media::messages.cancel') }}</a>
        </div>
    </form>
</div>
@endsection
