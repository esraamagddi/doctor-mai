@extends('core::layouts.backend')

@push('title') {{ __('language::messages.languages') }} @endpush

@section('content')

<ul class="breadcrumb breadcrumb-top">
    <li><a href="/cp"><i class="fa fa-home"></i></a></li>
    <li><a href="{{ route('language.index') }}">{{ __('language::messages.languages') }}</a></li>
    <li>{{ __('language::messages.edit') }}</li>
</ul>

<div class="block full">
    <div class="block-title d-flex align-items-center justify-content-between">
        <h2 class="m-0"><strong>{{ __('language::messages.languages') }}</strong></h2>
        <div class="block-options pull-right">
            <a href="{{ route('language.index') }}" class="btn btn-sm btn-primary">
                <i class="fa fa-arrow-left me-1"></i> {{ __('language::messages.back') }}
            </a>
        </div>
    </div>

    <form action="{{ route('language.update', $language) }}" method="post" class="form-bordered">
        @csrf
        @method('PUT')

        <div class="row">
            {{-- Name --}}
            <div class="col-md-6">
                <div class="form-group">
                    <label>{{ __('language::messages.name') }}</label>
                    <input type="text" name="name" class="form-control"
                           value="{{ old('name', $language->name) }}" required>
                </div>
            </div>

            {{-- Code --}}
            <div class="col-md-6">
                <div class="form-group">
                    <label>{{ __('language::messages.code') }}</label>
                    <input type="text" name="code" class="form-control"
                           value="{{ old('code', $language->code) }}" required>
                </div>
            </div>

            {{-- Direction --}}
            <div class="col-md-6">
                <div class="form-group">
                    <label>{{ __('language::messages.dir') }}</label>
                    <select name="dir" class="form-control">
                        <option value="ltr" {{ old('dir', $language->dir)=='ltr'?'selected':'' }}>LTR</option>
                        <option value="rtl" {{ old('dir', $language->dir)=='rtl'?'selected':'' }}>RTL</option>
                    </select>
                </div>
            </div>

            {{-- Locale --}}
            <div class="col-md-6">
                <div class="form-group">
                    <label>{{ __('language::messages.locale') }}</label>
                    <input type="text" name="locale" class="form-control"
                           value="{{ old('locale', $language->locale) }}" placeholder="en_US, ar_EG">
                </div>
            </div>

            {{-- Order --}}
            <div class="col-md-6">
                <div class="form-group">
                    <label>{{ __('language::messages.order') }}</label>
                    <input type="number" name="order" class="form-control"
                           value="{{ old('order', $language->order) }}" min="0">
                    <span class="help-block">{{ __('language::messages.display_order') }}</span>
                </div>
            </div>

            {{-- Status (switch) --}}
            <div class="col-md-6">
                <div class="form-group">
                    <label>{{ __('language::messages.status') }}</label>
                    <div>
                        <input type="hidden" name="status" value="0">
                        <label class="switch switch-danger" style="vertical-align: middle;">
                            <input type="checkbox" name="status" value="1" {{ old('status', $language->status) ? 'checked' : '' }}>
                            <span></span>
                        </label>
                        <span class="ms-2 align-middle">{{ __('language::messages.active') }}</span>
                    </div>
                </div>
            </div>

            {{-- Default (switch) --}}
            <div class="col-md-6">
                <div class="form-group">
                    <label>{{ __('language::messages.default') }}</label>
                    <div>
                        <input type="hidden" name="is_default" value="0">
                        <label class="switch switch-primary" style="vertical-align: middle;">
                            <input type="checkbox" name="is_default" value="1" {{ old('is_default', $language->is_default) ? 'checked' : '' }}>
                            <span></span>
                        </label>
                        <span class="ms-2 align-middle">{{ __('language::messages.make_default') ?? 'Make Default' }}</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Actions --}}
        <div class="form-group form-actions">
            <button type="submit" class="btn btn-sm btn-primary">
                <i class="fa fa-save"></i> {{ __('language::messages.save') }}
            </button>
            <a href="{{ route('language.index') }}" class="btn btn-sm btn-warning">
                <i class="fa fa-repeat"></i> {{ __('language::messages.cancel') }}
            </a>
        </div>
    </form>
</div>
@endsection
