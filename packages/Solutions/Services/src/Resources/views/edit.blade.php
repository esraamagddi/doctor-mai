@extends('core::layouts.backend')

@push('title') {{ __('services::messages.edit_service') }} @endpush

@section('content')

<ul class="breadcrumb breadcrumb-top">
    <li><a href="/cp"><i class="fa fa-home"></i></a></li>
    <li><a href="{{ route('services.index') }}">{{ __('services::messages.services') }}</a></li>
    <li>{{ __('services::messages.edit') }}</li>
</ul>

<div class="block full">
    <div class="block-title d-flex align-items-center justify-content-between">
        <h2 class="m-0"><strong>{{ __('services::messages.edit') }} :</strong> {{ data_get($service->name, app()->getLocale(), data_get($service->name, 'en')) }}</h2>
        <div class="block-options pull-right">
            <a href="{{ route('services.index') }}" class="btn btn-sm btn-primary">
                <i class="fa fa-arrow-left me-1"></i> {{ __('services::messages.back') }}
            </a>
        </div>
    </div>

    <form action="{{ route('services.update', $service) }}" method="post" class="form-bordered" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- Tabs --}}
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
                        <label>{{ __('services::messages.name_'.$lang->code) }}</label>
                        <input type="text" name="name[{{ $lang->code }}]" class="form-control"
                               value="{{ old('name.'.$lang->code, $service->name[$lang->code] ?? '') }}"
                               placeholder="{{ __('services::messages.enter_name_'.$lang->code) }}">
                        <small class="form-text text-muted">{{ __('services::messages.enter_name_'.$lang->code) }}</small>
                    </div>

                    <div class="form-group">
                        <label>{{ __('services::messages.description_'.$lang->code) }}</label>
                        <textarea name="description[{{ $lang->code }}]" class="form-control" rows="3" id="editor-description-{{ $lang->code }}"
                                  placeholder="{{ __('services::messages.enter_description_'.$lang->code) }}">{{ old('description.'.$lang->code, $service->description[$lang->code] ?? '') }}</textarea>
                        <small class="form-text text-muted">{{ __('services::messages.enter_description_'.$lang->code) }}</small>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Half-width rows --}}
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>{{ __('services::messages.image') }}</label>
                    <input type="file" name="image" class="file-input">
                    <small class="form-text text-muted">{{ __('services::messages.image_helper') }}</small>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label>{{ __('services::messages.icon') }}</label>
                    <input type="file" name="icon" class="file-input">
                    <small class="form-text text-muted">{{ __('services::messages.icon_helper') }}</small>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label>{{ __('services::messages.link') }}</label>
                    <input type="url" name="link" class="form-control" value="{{ old('link', $service->link) }}" placeholder="{{ __('services::messages.enter_link') }}">
                    <small class="form-text text-muted">{{ __('services::messages.enter_link') }}</small>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label>{{ __('services::messages.pdf') }}</label>
                    <input type="file" name="pdf" class="file-input">
                    <small class="form-text text-muted">{{ __('services::messages.pdf_helper') }}</small>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label>{{ __('services::messages.order') }}</label>
                    <input type="number" name="order" class="form-control" min="0" value="{{ old('order', $service->order) }}">
                    <small class="form-text text-muted">{{ __('services::messages.order_helper') }}</small>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label>{{ __('services::messages.status') }}</label>
                    <div>
                        <input type="hidden" name="status" value="0">
                        <label class="switch switch-danger" style="vertical-align: middle;">
                            <input type="checkbox" name="status" value="1" {{ old('status', $service->status) ? 'checked' : '' }}>
                            <span></span>
                        </label>
                        <span class="ms-2 align-middle">{{ __('services::messages.active') }}</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Actions --}}
        <div class="form-group form-actions mt-3">
            <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-save"></i> {{ __('services::messages.update') }}</button>
            <a href="{{ route('services.index') }}" class="btn btn-sm btn-warning"><i class="fa fa-repeat"></i> {{ __('services::messages.cancel') }}</a>
        </div>
    </form>
</div>

@endsection

@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        @foreach($langs as $lang)
            initCkEditor('editor-description-{{ $lang->code }}');
        @endforeach
    });
</script>
@endpush
