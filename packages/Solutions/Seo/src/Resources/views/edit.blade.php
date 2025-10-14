@extends('core::layouts.backend')

@push('title') {{ __('seo::messages.edit_seo') }} @endpush

@section('content')
<ul class="breadcrumb breadcrumb-top">
    <li><a href="/cp"><i class="fa fa-home"></i></a></li>
    <li><a href="{{ route('seo.index') }}">{{ __('seo::messages.seo') }}</a></li>
    <li>{{ __('seo::messages.edit') }}</li>
</ul>

<div class="block full">
    <div class="block-title d-flex align-items-center justify-content-between">
        <h2 class="m-0"><strong>{{ __('seo::messages.edit') }} :</strong> {{ $page->slug }}</h2>
        <div class="block-options pull-right">
            <a href="{{ route('seo.index') }}" class="btn btn-sm btn-primary">
                <i class="fa fa-arrow-left me-1"></i> {{ __('seo::messages.back') }}
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

    <form action="{{ route('seo.update', $page) }}" method="post" class="form-bordered" enctype="multipart/form-data">
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
                    <label>{{ __('seo::messages.meta_title_'.$lang->code) }}</label>
                    <input type="text" name="meta_title[{{ $lang->code }}]" class="form-control"
                           value="{{ old('meta_title.'.$lang->code, $page->meta_title[$lang->code] ?? '') }}"
                           placeholder="{{ __('seo::messages.enter_meta_title_'.$lang->code) }}">
                    <span class="help-block">{{ __('seo::messages.meta_title_help_'.$lang->code) }}</span>
                </div>
                <div class="form-group">
                    <label>{{ __('seo::messages.meta_description_'.$lang->code) }}</label>
                    <textarea name="meta_description[{{ $lang->code }}]" class="form-control" rows="3"
                              placeholder="{{ __('seo::messages.enter_meta_description_'.$lang->code) }}">{{ old('meta_description.'.$lang->code, $page->meta_description[$lang->code] ?? '') }}</textarea>
                    <span class="help-block">{{ __('seo::messages.meta_description_help_'.$lang->code) }}</span>
                </div>
                <div class="form-group">
                    <label>{{ __('seo::messages.og_title_'.$lang->code) }}</label>
                    <input type="text" name="og_title[{{ $lang->code }}]" class="form-control"
                           value="{{ old('og_title.'.$lang->code, $page->og_title[$lang->code] ?? '') }}"
                           placeholder="{{ __('seo::messages.enter_og_title_'.$lang->code) }}">
                    <span class="help-block">{{ __('seo::messages.og_title_help_'.$lang->code) }}</span>
                </div>
                <div class="form-group">
                    <label>{{ __('seo::messages.og_description_'.$lang->code) }}</label>
                    <textarea name="og_description[{{ $lang->code }}]" class="form-control" rows="3"
                              placeholder="{{ __('seo::messages.enter_og_description_'.$lang->code) }}">{{ old('og_description.'.$lang->code, $page->og_description[$lang->code] ?? '') }}</textarea>
                    <span class="help-block">{{ __('seo::messages.og_description_help_'.$lang->code) }}</span>
                </div>
            </div>
            @endforeach
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>{{ __('seo::messages.canonical') }}</label>
                    <input type="url" name="canonical" class="form-control"
                           value="{{ old('canonical', $page->canonical) }}"
                           placeholder="{{ __('seo::messages.enter_canonical') }}">
                    <span class="help-block">{{ __('seo::messages.canonical_help') }}</span>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label>{{ __('seo::messages.og_image') }}</label>
                    <input type="file" name="og_image" class="file-input" accept="image/*">
                    <span class="help-block">{{ __('seo::messages.og_image_help') }}</span>
                    @if(!empty($page->og_image))
                        <div class="mt-2">
                            <img src="{{ asset('storage/'.$page->og_image) }}" style="max-width:150px;height:auto;">
                        </div>
                    @endif
                </div>
            </div>

            <div class="col-md-12">
                <div class="form-group">
                    <label>{{ __('seo::messages.slug') }}</label>
                    <input type="text" name="slug" class="form-control"
                        value="{{ old('slug', $page->slug) }}"
                        placeholder="{{ __('seo::messages.enter_slug') }}">
                    <span class="help-block">{{ __('seo::messages.slug_help') }}</span>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label>{{ __('seo::messages.twitter_card') }}</label>
                    <select name="twitter_card" class="form-control">
                        @foreach(['summary_large_image','summary','app','player'] as $t)
                            <option value="{{ $t }}" {{ old('twitter_card', $page->twitter_card)===$t?'selected':'' }}>{{ $t }}</option>
                        @endforeach
                    </select>
                    <span class="help-block">{{ __('seo::messages.twitter_card_help') }}</span>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label>{{ __('seo::messages.schema_type') }}</label>
                    <select name="schema_type" class="form-control">
                        @foreach(['webpage','article','event','video','custom'] as $s)
                            <option value="{{ $s }}" {{ old('schema_type', $page->schema_type)===$s?'selected':'' }}>{{ $s }}</option>
                        @endforeach
                    </select>
                    <span class="help-block">{{ __('seo::messages.schema_type_help') }}</span>
                </div>
            </div>

            <div class="col-md-12">
                <div class="form-group">
                    <label>{{ __('seo::messages.schema_json') }}</label>
                    <textarea name="schema_json" class="form-control" rows="4" placeholder='{{ __("seo::messages.enter_schema_json") }}'>{{ old('schema_json', json_encode($page->schema_json ?? [], JSON_PRETTY_PRINT|JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE)) }}</textarea>
                    <span class="help-block">{{ __('seo::messages.schema_json_help') }}</span>
                </div>
            </div>

            <div class="col-md-12">
                <div class="form-group">
                    <label>{{ __('seo::messages.hreflang') }}</label>
                    <textarea name="hreflang" class="form-control" rows="3" placeholder='{{ __("seo::messages.enter_hreflang") }}'>{{ old('hreflang', json_encode($page->hreflang ?? [], JSON_PRETTY_PRINT|JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE)) }}</textarea>
                    <span class="help-block">{{ __('seo::messages.hreflang_help') }}</span>
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label>{{ __('seo::messages.robots') }}</label>
                    <div class="d-flex align-items-center gap-3">
                        <label class="checkbox-inline"><input type="checkbox" name="robots_index" value="1" {{ old('robots_index', $page->robots_index)?'checked':'' }}> index</label>
                        <label class="checkbox-inline"><input type="checkbox" name="robots_follow" value="1" {{ old('robots_follow', $page->robots_follow)?'checked':'' }}> follow</label>
                    </div>
                    <span class="help-block">{{ __('seo::messages.robots_help') }}</span>
                </div>
            </div>

            <div class="col-md-8">
                <div class="form-group">
                    <label>{{ __('seo::messages.robots_extra') }}</label>
                    <input type="text" name="robots_extra[]" class="form-control" placeholder="noarchive, nosnippet ... (optional)">
                    <span class="help-block">{{ __('seo::messages.robots_extra_help') }}</span>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label>{{ __('seo::messages.changefreq') }}</label>
                    <select name="changefreq" class="form-control">
                        <option value="">{{ __('seo::messages.select_optional') }}</option>
                        @foreach(['always','hourly','daily','weekly','monthly','yearly','never'] as $f)
                            <option value="{{ $f }}" {{ old('changefreq', $page->changefreq)===$f?'selected':'' }}>{{ $f }}</option>
                        @endforeach
                    </select>
                    <span class="help-block">{{ __('seo::messages.changefreq_help') }}</span>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label>{{ __('seo::messages.priority') }}</label>
                    <input type="number" step="0.1" min="0" max="1" name="priority" class="form-control"
                           value="{{ old('priority', $page->priority) }}" placeholder="0.5">
                    <span class="help-block">{{ __('seo::messages.priority_help') }}</span>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label>{{ __('seo::messages.order') }}</label>
                    <input type="number" name="order" class="form-control" min="0"
                           value="{{ old('order', $page->order) }}"
                           placeholder="{{ __('seo::messages.enter_order') }}">
                    <span class="help-block">{{ __('seo::messages.order_help') }}</span>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label>{{ __('seo::messages.status') }}</label>
                    <div>
                        <input type="hidden" name="status" value="0">
                        <label class="switch switch-danger" style="vertical-align: middle;">
                            <input type="checkbox" name="status" value="1" {{ old('status', $page->status) ? 'checked' : '' }}>
                            <span></span>
                        </label>
                        <span class="ms-2 align-middle">{{ __('seo::messages.active') }}</span>
                    </div>
                    <span class="help-block">{{ __('seo::messages.toggle_hint') }}</span>
                </div>
            </div>
        </div>

        <div class="form-group form-actions">
            <button class="btn btn-sm btn-primary"><i class="fa fa-save"></i> {{ __('seo::messages.update') }}</button>
            <a href="{{ route('seo.index') }}" class="btn btn-sm btn-warning"><i class="fa fa-repeat"></i> {{ __('seo::messages.cancel') }}</a>
        </div>
    </form>
</div>
@endsection
