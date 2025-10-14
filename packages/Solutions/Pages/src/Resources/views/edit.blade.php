@extends('core::layouts.backend')

@push('title') {{ __('pages::messages.edit_page') }} @endpush

@section('content')
<ul class="breadcrumb breadcrumb-top">
    <li><a href="/cp"><i class="fa fa-home"></i></a></li>
    <li><a href="{{ route('pages.index') }}">{{ __('pages::messages.pages') }}</a></li>
    <li>{{ __('pages::messages.edit') }}</li>
</ul>

<div class="block full">
    <div class="block-title d-flex align-items-center justify-content-between">
        <h2 class="m-0"><strong>{{ __('pages::messages.edit') }}</strong> : {{ $page->slug }}</h2>
        <div class="block-options pull-right">
            <a href="{{ route('pages.index') }}" class="btn btn-sm btn-primary">
                <i class="fa fa-arrow-left me-1"></i> {{ __('pages::messages.back') }}
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

    <form action="{{ route('pages.update', $page) }}" method="post" enctype="multipart/form-data">
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
                    <label>{{ __('pages::messages.title_' . $lang->code) }}</label>
                    <input type="text"
                        name="title[{{ $lang->code }}]"
                        class="form-control"
                        value="{{ old('title.' . $lang->code, data_get($page->title, $lang->code)) }}"
                        placeholder="{{ __('pages::messages.enter_title_' . $lang->code) }}">
                </div>

                <div class="form-group">
                    <label>{{ __('pages::messages.description_' . $lang->code) }}</label>
                    <textarea id="editor-description-{{ $lang->code }}" name="description[{{ $lang->code }}]" class="form-control" rows="4"
                        placeholder="{{ __('pages::messages.enter_description_' . $lang->code) }}">{{ old('description.' . $lang->code, data_get($page->description, $lang->code)) }}</textarea>
                </div>
            </div>
            @endforeach
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>{{ __('pages::messages.image') }}</label>
                    <input type="file" name="icon" class="file-input" accept="image/*">
                    <span class="help-block">{{ __('pages::messages.image_help') }}</span>
                    @if(!empty($page->image))
                        <div class="mt-2">
                            <img src="{{ asset('storage/'.$page->image) }}" style="max-width:150px;height:auto;">
                        </div>
                    @endif
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>{{ __('pages::messages.slug') }}</label>
                    <input type="text" name="slug" class="form-control" value="{{ old('slug', $page->slug) }}"
                        placeholder="{{ __('pages::messages.enter_slug') }}">
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label>{{ __('pages::messages.order') }}</label>
                    <input type="number" name="order" class="form-control" value="{{ old('order', $page->order) }}" min="0">
                </div>
            </div>
            <div class="col-md-8">
                <div class="form-group">
                    <label>{{ __('sectionheaders::messages.status') }}</label>
                    <div>
                        <input type="hidden" name="status" value="0">
                        <label class="switch switch-danger" style="vertical-align: middle;">
                            <input type="checkbox" name="status" value="1" {{ old('status', $page->status) ? 'checked' : '' }}>
                            <span></span>
                        </label>
                        <span class="ms-2 align-middle">{{ __('pages::messages.active') }}</span>
                        <span class="help-block">{{ __('pages::messages.toggle_hint') }}</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-group form-actions">
            <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-save"></i> {{ __('pages::messages.update') }}</button>
            <a href="{{ route('pages.index') }}" class="btn btn-sm btn-warning"><i class="fa fa-repeat"></i> {{ __('pages::messages.cancel') }}</a>
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