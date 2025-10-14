@extends('core::layouts.backend')

@push('title') {{ __('transformation::messages.sidebar_title') }} @endpush

@section('content')
<ul class="breadcrumb breadcrumb-top">
    <li><a href="/cp"><i class="fa fa-home"></i></a></li>
    <li><a href="{{ route('transformations.index') }}">{{ __('transformation::messages.sidebar_title') }}</a></li>
    <li>{{ isset($transformation) ? __('Edit') : __('Add') }}</li>
</ul>

<div class="block full">
    <form action="{{ isset($transformation) ? route('transformations.update', $transformation) : route('transformations.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        @if (isset($transformation)) @method('PUT') @endif

        <ul class="nav nav-tabs push" data-toggle="tabs">
            @foreach($langs as $L)
                <li class="{{ $L->code === $activeLocale ? 'active' : '' }}">
                    <a href="#tab-{{ $L->code }}">{{ $L->name }} ({{ $L->code }})</a>
                </li>
            @endforeach
        </ul>

        <div class="tab-content">
            @foreach($langs as $lang)
                <div class="tab-pane {{ $lang->code === $activeLocale ? 'active' : '' }}" id="tab-{{ $lang->code }}">
                    <div class="form-group">
                        <label>@lang('Title') ({{ $lang->code }})</label>
                        <input type="text" name="title[{{ $lang->code }}]" class="form-control"
                               value="{{ old('title.'.$lang->code, $transformation->title[$lang->code] ?? '') }}">
                    </div>
                    <div class="form-group">
                        <label>@lang('Description') ({{ $lang->code }})</label>
                        <textarea name="description[{{ $lang->code }}]" class="form-control" rows="2">{{ old('description.'.$lang->code, $transformation->description[$lang->code] ?? '') }}</textarea>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="row">
            @foreach(['before_image' => 'Before Image', 'after_image' => 'After Image'] as $field => $label)
            <div class="col-md-6">
                <div class="form-group">
                    <label>{{ $label }}</label>
                    <input type="file" name="{{ $field }}" class="form-control" accept="image/*">
                    @if(isset($transformation) && !empty($transformation->{$field}))
                        <img src="{{ asset('storage/'.$transformation->{$field}) }}" style="width:100px; height:auto;" class="mt-2">
                    @endif
                </div>
            </div>
            @endforeach
        </div>
        <div class="form-group form-actions mt-3">
            <button type="submit" class="btn btn-sm btn-primary">
                <i class="fa fa-save"></i> {{ isset($transformation) ? __('Update') : __('Add') }}
            </button>
        </div>
    </form>
</div>
@endsection
