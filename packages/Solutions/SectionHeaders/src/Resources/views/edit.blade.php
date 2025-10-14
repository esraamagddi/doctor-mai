@extends('core::layouts.backend')

@push('title') {{ __('sectionheaders::messages.edit_section_header') }} @endpush

@section('content')
<ul class="breadcrumb breadcrumb-top">
    <li><a href="/cp"><i class="fa fa-home"></i></a></li>
    <li><a href="{{ route('sectionheaders.index') }}">{{ __('sectionheaders::messages.section_headers') }}</a></li>
    <li>{{ __('sectionheaders::messages.edit') }}</li>
</ul>

<div class="block full">
    <div class="block-title d-flex align-items-center justify-content-between">
        <h2 class="m-0"><strong>{{ __('sectionheaders::messages.edit') }} :</strong> {{ $header->slug }}</h2>
        <div class="block-options pull-right">
            <a href="{{ route('sectionheaders.index') }}" class="btn btn-sm btn-primary">
                <i class="fa fa-arrow-left me-1"></i> {{ __('sectionheaders::messages.back') }}
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

    <form action="{{ route('sectionheaders.update', $header) }}" method="post" class="form-bordered" enctype="multipart/form-data">
        @csrf @method('PUT')

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
                    {{-- Eyebrow --}}
                    <div class="form-group">
                        <label>{{ __('sectionheaders::messages.eyebrow_' . $lang->code) }}</label>
                        <input type="text" name="eyebrow[{{ $lang->code }}]" class="form-control"
                               value="{{ old('eyebrow.'.$lang->code, $header->eyebrow[$lang->code] ?? '') }}"
                               placeholder="{{ __('sectionheaders::messages.enter_eyebrow_' . $lang->code) }}">
                        <span class="help-block">{{ __('sectionheaders::messages.eyebrow_help_' . $lang->code) }}</span>
                    </div>

                    {{-- Title --}}
                    <div class="form-group">
                        <label>{{ __('sectionheaders::messages.title_' . $lang->code) }}</label>
                        <input type="text" name="title[{{ $lang->code }}]" class="form-control"
                               value="{{ old('title.'.$lang->code, $header->title[$lang->code] ?? '') }}"
                               placeholder="{{ __('sectionheaders::messages.enter_title_' . $lang->code) }}">
                        <span class="help-block">{{ __('sectionheaders::messages.title_help_' . $lang->code) }}</span>
                    </div>

                    {{-- Description --}}
                    <div class="form-group">
                        <label>{{ __('sectionheaders::messages.description_' . $lang->code) }}</label>
                        <textarea name="description[{{ $lang->code }}]" class="form-control" rows="3"
                                  placeholder="{{ __('sectionheaders::messages.enter_description_' . $lang->code) }}">{{ old('description.'.$lang->code, $header->description[$lang->code] ?? '') }}</textarea>
                        <span class="help-block">{{ __('sectionheaders::messages.description_help_' . $lang->code) }}</span>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="row">
            {{-- Icon --}}
            <div class="col-md-12">
                <div class="form-group">
                    <label>{{ __('sectionheaders::messages.icon') }}</label>
                    <input type="file" name="icon" class="file-input" accept="image/*">
                    <span class="help-block">{{ __('sectionheaders::messages.icon_help') }}</span>
                    @if(!empty($header->icon))
                        <div class="mt-2">
                            <img src="{{ asset('storage/'.$header->icon) }}" style="max-width:150px;height:auto;">
                        </div>
                    @endif
                </div>
            </div>

            {{-- Slug --}}
            <div class="col-md-6">
                <div class="form-group">
                    <label>{{ __('sectionheaders::messages.slug') }}</label>
                    <input type="text" name="slug" class="form-control"
                           value="{{ old('slug', $header->slug) }}"
                           placeholder="{{ __('sectionheaders::messages.enter_slug') }}">
                    <span class="help-block">{{ __('sectionheaders::messages.slug_help') }}</span>
                </div>
            </div>

            {{-- Order --}}
            <div class="col-md-6">
                <div class="form-group">
                    <label>{{ __('sectionheaders::messages.order') }}</label>
                    <input type="number" name="order" class="form-control" min="0"
                           value="{{ old('order', $header->order) }}"
                           placeholder="{{ __('sectionheaders::messages.enter_order') }}">
                    <span class="help-block">{{ __('sectionheaders::messages.order_help') }}</span>
                </div>
            </div>

            {{-- Status --}}
            <div class="col-md-6">
                <div class="form-group">
                    <label>{{ __('sectionheaders::messages.status') }}</label>
                    <div>
                        <input type="hidden" name="status" value="0">
                        <label class="switch switch-danger" style="vertical-align: middle;">
                            <input type="checkbox" name="status" value="1" {{ old('status', $header->status) ? 'checked' : '' }}>
                            <span></span>
                        </label>
                        <span class="ms-2 align-middle">{{ __('sectionheaders::messages.active') }}</span>
                    </div>
                    <span class="help-block">{{ __('sectionheaders::messages.toggle_hint') }}</span>
                </div>
            </div>
 
            {{-- Type --}}
            <div class="col-md-6">
                <div class="form-group">
                    <label>{{ __('sectionheaders::messages.type') }}</label>
                    <select name="type" class="form-control" id="menuType">
                        <option value="main" {{ old('type', $header->type ?? 'main') == 'main' ? 'selected' : '' }}>
                            {{ __('sectionheaders::messages.main_menu') }}
                        </option>
                        <option value="sub" {{ old('type', $header->type ?? '') == 'sub' ? 'selected' : '' }}>
                            {{ __('sectionheaders::messages.sub_menu') }}
                        </option>
                    </select>
                    <span class="help-block">{{ __('sectionheaders::messages.type_help') }}</span>
                </div>
            </div>

     
        </div>

        <div class="form-group form-actions">
            <button class="btn btn-sm btn-primary"><i class="fa fa-save"></i> {{ __('sectionheaders::messages.update') }}</button>
            <a href="{{ route('sectionheaders.index') }}" class="btn btn-sm btn-warning"><i class="fa fa-repeat"></i> {{ __('sectionheaders::messages.cancel') }}</a>
        </div>
    </form>
</div>

@push('scripts')
<script>
    document.getElementById('menuType').addEventListener('change', function() {
        let parentDiv = document.getElementById('parentMenuDiv');
        if (this.value === 'sub') {
            parentDiv.style.display = 'block';
        } else {
            parentDiv.style.display = 'none';
        }
    });
</script>
@endpush
@endsection
