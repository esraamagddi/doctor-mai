@extends('core::layouts.backend')

@push('title') {{ __('media::messages.photos') }} @endpush

@section('content')
    <ul class="breadcrumb breadcrumb-top">
        <li><a href="/cp"><i class="fa fa-home"></i></a></li>
        <li><a href="{{ route('media.videos.index') }}">{{ __('media::messages.photos') }}</a></li>
        <li>{{ __('media::messages.add') }}</li>
    </ul>

    <div class="block full">
        <div class="block-title d-flex align-items-center justify-content-between">
            <h2 class="m-0"><strong>{{ __('media::messages.photos') }}</strong></h2>
            <div class="block-options pull-right">
                <a href="{{ route('media.videos.index') }}" class="btn btn-sm btn-primary">
                    <i class="fa fa-arrow-left me-1"></i> {{ __('media::messages.back') }}
                </a>
            </div>
        </div>

        <form action="{{ route('media.videos.store') }}" method="post" class="form-bordered" enctype="multipart/form-data">
            @csrf

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
                                value="{{ old('title.' . $lang->code) }}"
                                placeholder="{{ __('media::messages.enter_title_' . $lang->code) }}">
                        </div>
                        <div class="form-group">
                            <label>{{ __('media::messages.description_' . $lang->code) }}</label>
                            <textarea name="description[{{ $lang->code }}]" class="form-control" rows="3"
                                placeholder="{{ __('media::messages.enter_description_' . $lang->code) }}">{{ old('description.' . $lang->code) }}</textarea>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{ __('media::messages.category') }}</label>
                            <select name="category_id" class="form-control">
                                <option value="">{{ __('media::messages.select_category') }}</option>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}"
                                        {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                                        {{ data_get($cat->name, app()->getLocale(), data_get($cat->name, 'en')) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{ __('Cover Image') }}</label>
                            <input type="file" name="image" class="file-input" accept="image/*">
                            @if(!empty($video->image))
                                <div class="mt-2">
                                    <img src="{{ asset('storage/' . $video->image) }}" alt="Cover Image" class="img-fluid rounded"
                                        style="max-width: 250px;">
                                </div>
                            @endif
                        </div>
                    </div>
                </div>



                <div class="col-md-12">
                    <div class="form-group">
                        <label>{{ __('media::messages.embed_code') }}</label>
                        <textarea name="embed_code" class="form-control" rows="3"
                            placeholder="{{ __('media::messages.enter_embed_code') }}">{{ old('embed_code') }}</textarea>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>{{ __('media::messages.order') }}</label>
                        <input type="number" name="order" class="form-control" value="{{ old('order', 0) }}" min="0">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>{{ __('media::messages.status') }}</label>
                        <div>
                            <input type="hidden" name="status" value="0">
                            <label class="switch switch-danger" style="vertical-align: middle;">
                                <input type="checkbox" name="status" value="1" {{ old('status', 1) ? 'checked' : '' }}>
                                <span></span>
                            </label>
                            <span class="ms-2 align-middle">{{ __('media::messages.active') }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group form-actions">
                <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-save"></i> {{
        __('media::messages.save') }}</button>
                <a href="{{ route('media.videos.index') }}" class="btn btn-sm btn-warning"><i class="fa fa-repeat"></i> {{
        __('media::messages.cancel') }}</a>
            </div>
        </form>
    </div>

@endsection
