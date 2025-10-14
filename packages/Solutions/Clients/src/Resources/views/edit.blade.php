@extends('core::layouts.backend')

@push('title') {{ __('clients::messages.title') }} - {{ __('clients::messages.edit') }} @endpush

@push('styles')
<style>
    .logo-preview-container {
        margin-top: 10px;
    }
    .logo-preview {
        max-width: 200px;
        max-height: 200px;
        border: 2px dashed #ddd;
        padding: 10px;
        border-radius: 5px;
    }
    .logo-preview img {
        width: 100%;
        height: auto;
    }
    .remove-logo-btn {
        margin-top: 5px;
    }
</style>
@endpush

@section('content')

<ul class="breadcrumb breadcrumb-top">
    <li><a href="/cp"><i class="fa fa-home"></i></a></li>
    <li><a href="{{ route('clients.index') }}">{{ __('clients::messages.title') }}</a></li>
    <li>{{ __('clients::messages.edit') }}</li>
</ul>

<div class="block full">
    <div class="block-title d-flex align-items-center justify-content-between">
        <h2 class="m-0"><strong>{{ __('clients::messages.edit') }}</strong></h2>
        <div class="block-options pull-right">
            <a href="{{ route('clients.index') }}" class="btn btn-sm btn-primary">
                <i class="fa fa-arrow-left me-1"></i> {{ __('clients::messages.back') }}
            </a>
        </div>
    </div>

    <form action="{{ route('clients.update', $client) }}" method="post" class="form-bordered" enctype="multipart/form-data">
        @method('PUT')
        @csrf

        {{-- Tabs for Languages --}}
        <ul class="nav nav-tabs push" role="tablist">
            @foreach($langs as $lang)
                <li role="presentation" class="{{ $lang->code === $activeLocale ? 'active' : '' }}">
                    <a href="#tab-{{ $lang->code }}" aria-controls="tab-{{ $lang->code }}" role="tab" data-toggle="tab">
                        {{ $lang->name }} ({{ strtoupper($lang->code) }})
                    </a>
                </li>
            @endforeach
        </ul>

        <div class="tab-content">
            @foreach($langs as $lang)
                <div role="tabpanel" class="tab-pane {{ $lang->code === $activeLocale ? 'active' : '' }}" id="tab-{{ $lang->code }}">
                    <div class="form-group">
                        <label>{{ __('clients::messages.name_'.$lang->code) }}</label>
                        <input type="text" name="name[{{ $lang->code }}]" class="form-control"
                               value="{{ old('name.'.$lang->code, $client->name[$lang->code] ?? '') }}"
                               placeholder="{{ __('clients::messages.enter_name_'.$lang->code) }}">
                    </div>
                </div>
            @endforeach
        </div>

        <div class="row mt-3">
            <div class="col-md-6">
                <div class="form-group">
                    <label>{{ __('clients::messages.slug') }}</label>
                    <input type="text" name="slug" class="form-control"
                           value="{{ old('slug', $client->slug ?? '') }}"
                           placeholder="{{ __('clients::messages.enter_slug') }}">
                </div>

                <div class="form-group">
                    <label>{{ __('clients::messages.logo') }}</label>
                    <input type="file" name="logo" class="form-control" id="logoInput" accept="image/*">
                    
                    <div class="logo-preview-container">
                        <div class="logo-preview" id="logoPreview" style="{{ $client->logo ? 'display: block;' : 'display: none;' }}">
                            <img src="{{ $client->logo ? asset('storage/' . $client->logo) : '' }}" alt="Logo Preview" id="logoPreviewImg">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label>{{ __('clients::messages.website') }}</label>
                    <input type="url" name="website" class="form-control"
                           value="{{ old('website', $client->website ?? '') }}"
                           placeholder="{{ __('clients::messages.enter_website') }}">
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label>{{ __('clients::messages.email') }}</label>
                    <input type="email" name="email" class="form-control"
                           value="{{ old('email', $client->email ?? '') }}"
                           placeholder="{{ __('clients::messages.enter_email') }}">
                </div>

                <div class="form-group">
                    <label>{{ __('clients::messages.phone') }}</label>
                    <input type="text" name="phone" class="form-control"
                           value="{{ old('phone', $client->phone ?? '') }}"
                           placeholder="{{ __('clients::messages.enter_phone') }}">
                </div>

                <div class="form-group">
                    <label>{{ __('clients::messages.order') }}</label>
                    <input type="number" name="order" class="form-control" min="0"
                           value="{{ old('order', $client->order ?? 0) }}">
                </div>

                <div class="form-group">
                    <label>{{ __('clients::messages.status') }}</label>
                    <div>
                        <input type="hidden" name="status" value="0">
                        <label class="switch switch-danger" style="vertical-align: middle;">
                            <input type="checkbox" name="status" value="1" {{ old('status', $client->status ?? 1) ? 'checked' : '' }}>
                            <span></span>
                        </label>
                        <span class="ms-2 align-middle">{{ __('clients::messages.active') }}</span>
                    </div>
                    <span class="help-block">{{ __('clients::messages.status_hint') }}</span>
                </div>
            </div>
        </div>

        <div class="form-group form-actions mt-3">
            <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-save"></i> {{ __('clients::messages.update') }}</button>
            <a href="{{ route('clients.index') }}" class="btn btn-sm btn-warning"><i class="fa fa-repeat"></i> {{ __('clients::messages.cancel') }}</a>
        </div>
    </form>
</div>

@endsection

@push('scripts')
<script>
document.getElementById('logoInput').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('logoPreviewImg').src = e.target.result;
            document.getElementById('logoPreview').style.display = 'block';
        }
        reader.readAsDataURL(file);
    }
});
</script>
@endpush