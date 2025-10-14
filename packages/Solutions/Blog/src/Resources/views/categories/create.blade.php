@extends('core::layouts.backend')
@push('title') {{ __('blog::messages.add_category') }} @endpush

@section('content')
<ul class="breadcrumb breadcrumb-top">
    <li><a href="/cp"><i class="fa fa-home"></i></a></li>
    <li><a href="{{ route('blog.categories.index') }}">{{ __('blog::messages.blog') }}</a></li>
    <li>{{ __('blog::messages.add_category') }}</li>
</ul>

<div class="block full">
    <div class="block-title d-flex align-items-center justify-content-between">
        <h2 class="m-0"><strong>{{ __('blog::messages.add_category') }}</strong></h2>
        <div class="block-options pull-right">
            <a href="{{ route('blog.categories.index') }}" class="btn btn-sm btn-primary">
                <i class="fa fa-arrow-left"></i> {{ __('blog::messages.back') }}
            </a>
        </div>
    </div>

    <form action="{{ route('blog.categories.store') }}" method="post" class="form-bordered">
        @csrf

        {{-- Tabs for Languages --}}
        <ul class="nav nav-tabs push" data-toggle="tabs">
            @foreach($langs as $i => $lang)
                <li class="{{ $lang->code === $activeLocale ? 'active' : '' }}">
                    <a href="#tab-{{ $lang->code }}">{{ $lang->name }} ({{ strtoupper($lang->code) }})</a>
                </li>
            @endforeach
        </ul>

        <div class="tab-content mb-3">
            @foreach($langs as $lang)
                <div class="tab-pane {{ $lang->code === $activeLocale ? 'active' : '' }}" id="tab-{{ $lang->code }}">
                    {{-- Name --}}
                    <div class="form-group">
                        <label>{{ __('blog::messages.name') }} ({{ strtoupper($lang->code) }})</label>
                        <input type="text" name="name[{{ $lang->code }}]" class="form-control"
                               value="{{ old('name.'.$lang->code) }}"
                               placeholder="{{ __('blog::messages.enter_name', ['lang' => $lang->name]) }}">
                    </div>

                    {{-- Description --}}
                    <div class="form-group">
                        <label>{{ __('blog::messages.description') }} ({{ strtoupper($lang->code) }})</label>
                        <textarea name="description[{{ $lang->code }}]" class="form-control" rows="4"
                                  placeholder="{{ __('blog::messages.enter_description', ['lang' => $lang->name]) }}">{{ old('description.'.$lang->code) }}</textarea>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="row">
            {{-- Parent --}}
            <div class="col-md-4">
                <div class="form-group">
                    <label>{{ __('blog::messages.parent') }}</label>
                    <select name="parent_id" class="form-control">
                        <option value="">{{ __('blog::messages.none') }}</option>
                        @foreach($parents as $cat)
                            <option value="{{ $cat->id }}" {{ old('parent_id') == $cat->id ? 'selected' : '' }}>
                                {{ data_get($cat->name,'en') }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            {{-- Order --}}
            <div class="col-md-4">
                <div class="form-group">
                    <label>{{ __('blog::messages.order') }}</label>
                    <input type="number" class="form-control" name="order" value="{{ old('order',0) }}" min="0">
                </div>
            </div>

            {{-- Status --}}
            <div class="col-md-4">
                <div class="form-group">
                    <label>{{ __('blog::messages.status') }}</label>
                    <div>
                        <input type="hidden" name="status" value="0">
                        <label class="switch switch-danger" style="vertical-align: middle;">
                            <input type="checkbox" name="status" value="1" {{ old('status',1) ? 'checked' : '' }}>
                            <span></span>
                        </label>
                        <span class="ms-2 align-middle">{{ __('blog::messages.active') }}</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Actions --}}
        <div class="form-group form-actions">
            <button class="btn btn-success"><i class="fa fa-check"></i> {{ __('blog::messages.save') }}</button>
            <a href="{{ route('blog.categories.index') }}" class="btn btn-warning"><i class="fa fa-repeat"></i> {{ __('blog::messages.cancel') }}</a>
        </div>
    </form>
</div>
@endsection
