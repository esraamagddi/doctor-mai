@extends('core::layouts.backend')

@push('title') {{ __('navbar::messages.navbar') }} @endpush

@section('content')
<ul class="breadcrumb breadcrumb-top">
    <li><a href="/cp"><i class="fa fa-home"></i></a></li>
    <li><a href="{{ route('navbar.index') }}">{{ __('navbar::messages.navbar') }}</a></li>
    <li>{{ __('navbar::messages.add') }}</li>
</ul>

<div class="block full">
    <div class="block-title d-flex align-items-center justify-content-between">
        <h2 class="m-0"><strong>{{ __('navbar::messages.navbar') }}</strong></h2>
        <div class="block-options pull-right">
            <a href="{{ route('navbar.index') }}" class="btn btn-sm btn-primary">
                <i class="fa fa-arrow-left me-1"></i> {{ __('navbar::messages.back') }}
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

    <form action="{{ route('navbar.store') }}" method="post" class="form-bordered" enctype="multipart/form-data">
        @csrf

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

                    {{-- Title --}}
                    <div class="form-group">
                        <label>{{ __('navbar::messages.title_' . $lang->code) }}</label>
                        <input type="text" name="title[{{ $lang->code }}]" class="form-control"
                               value="{{ old('title.'.$lang->code) }}"
                               placeholder="{{ __('navbar::messages.enter_title_' . $lang->code) }}">
                        <span class="help-block">{{ __('navbar::messages.title_help_' . $lang->code) }}</span>
                    </div>

      
                </div>
            @endforeach
        </div>

        <div class="row">
            {{-- Icon --}}
            <div class="col-md-12">
                <div class="form-group">
                    <label>{{ __('navbar::messages.icon') }}</label>
                    <input type="file" name="icon" class="file-input" accept="image/*">
                    <span class="help-block">{{ __('navbar::messages.icon_help') }}</span>
                </div>
            </div>

            {{-- Slug --}}
            <div class="col-md-6">
                <div class="form-group">
                    <label>{{ __('navbar::messages.slug') }}</label>
                    <input type="text" name="slug" class="form-control"
                           value="{{ old('slug') }}"
                           placeholder="{{ __('navbar::messages.enter_slug') }}">
                    <span class="help-block">{{ __('navbar::messages.slug_help') }}</span>
                </div>
            </div>

    
            {{-- Order --}}
            <div class="col-md-6">
                <div class="form-group">
                    <label>{{ __('navbar::messages.order') }}</label>
                    <input type="number" name="order" class="form-control" value="{{ old('order', 0) }}" min="0"
                           placeholder="{{ __('navbar::messages.enter_order') }}">
                    <span class="help-block">{{ __('navbar::messages.order_help') }}</span>
                </div>
            </div>

            {{-- Status --}}
            <div class="col-md-6">
                <div class="form-group">
                    <label>{{ __('navbar::messages.status') }}</label>
                    <div>
                        <input type="hidden" name="status" value="0">
                        <label class="switch switch-danger" style="vertical-align: middle;">
                            <input type="checkbox" name="status" value="1" {{ old('status', 1) ? 'checked' : '' }}>
                            <span></span>
                        </label>
                        <span class="ms-2 align-middle">{{ __('navbar::messages.active') }}</span>
                    </div>
                    <span class="help-block">{{ __('navbar::messages.toggle_hint') }}</span>
                </div>
            </div>
        </div>

        <div class="form-group form-actions">
            <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-save"></i> {{ __('navbar::messages.save') }}</button>
            <a href="{{ route('navbar.index') }}" class="btn btn-sm btn-warning"><i class="fa fa-repeat"></i> {{ __('navbar::messages.cancel') }}</a>
        </div>
    </form>
</div>
@endsection
