@extends('core::layouts.backend')

@push('title') {{ __('blog::messages.add_post') }} @endpush

@section('content')
<ul class="breadcrumb breadcrumb-top">
    <li><a href="/cp"><i class="fa fa-home"></i></a></li>
    <li><a href="{{ route('blog.posts.index') }}">{{ __('blog::messages.blog') }}</a></li>
    <li>{{ __('blog::messages.add_post') }}</li>
</ul>

<div class="block full">
    <div class="block-title d-flex align-items-center justify-content-between">
        <h2 class="m-0"><strong>{{ __('blog::messages.add_post') }}</strong></h2>
        <div class="block-options pull-right">
            <a href="{{ route('blog.posts.index') }}" class="btn btn-sm btn-primary">
                <i class="fa fa-arrow-left"></i> {{ __('blog::messages.back') }}
            </a>
        </div>
    </div>

    <form action="{{ route('blog.posts.store') }}" method="post" class="form-bordered" enctype="multipart/form-data">
        @csrf

        {{-- Tabs for Languages --}}
        <ul class="nav nav-tabs push" data-toggle="tabs">
            @foreach($langs as $i => $lang)
            <li class="{{ $lang->code === $activeLocale ? 'active' : '' }}">
                <a href="#tab-{{ $lang->code }}">{{ $lang->name }} ({{ strtoupper($lang->code) }})</a>
            </li>
            @endforeach
        </ul>

        <div class="tab-content">
            @foreach($langs as $lang)
            <div class="tab-pane {{ $lang->code === $activeLocale ? 'active' : '' }}" id="tab-{{ $lang->code }}">
                {{-- Title --}}
                <div class="form-group">
                    <label>{{ __('blog::messages.title') }} ({{ strtoupper($lang->code) }})</label>
                    <input type="text" name="title[{{ $lang->code }}]" class="form-control"
                        value="{{ old('title.' . $lang->code) }}"
                        placeholder="{{ __('blog::messages.enter_title', ['lang' => $lang->name]) }}">
                </div>
                <div class="form-group">
                    <label>{{ __('blog::messages.author') }} ({{ strtoupper($lang->code) }})</label>
                    <input type="text" name="author[{{ $lang->code }}]" class="form-control"
                        value="{{ old('author.' . $lang->code) }}"
                        placeholder="{{ __('blog::messages.enter_author', ['lang' => $lang->name]) }}">
                </div>
                <div class="form-group">
                    <label>{{ __('blog::messages.description') }} ({{ strtoupper($lang->code) }})</label>
                    <textarea name="description[{{ $lang->code }}]" class="form-control" rows="5"
                        placeholder="{{ __('blog::messages.enter_description', ['lang' => $lang->name]) }}">{{ old('description.' . $lang->code) }}</textarea>
                </div>

                {{-- Content --}}
                <div class="form-group">
                    <label>{{ __('blog::messages.content') }} ({{ strtoupper($lang->code) }})</label>
                    <textarea id="editor-content-{{ $lang->code }}" name="content[{{ $lang->code }}]"
                        class="form-control" rows="5"
                        placeholder="{{ __('blog::messages.enter_content', ['lang' => $lang->name]) }}">{{ old('content.' . $lang->code) }}</textarea>
                </div>
            </div>
            @endforeach
        </div>


        <div class="row">
            {{-- Image --}}
            <div class="col-md-12">
                <div class="form-group">
                    <label>{{ __('blog::messages.image') }}</label>
                    <input type="file" name="image" class="file-input" accept="image/*">
                </div>
            </div>

            {{-- Category --}}
            <div class="col-md-6">
                <div class="form-group">
                    <label>{{ __('blog::messages.category') }}</label>
                    <select name="category_id" class="form-control">
                        <option value="">{{ __('blog::messages.none') }}</option>
                        @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ old('category_id')==$cat->id ? 'selected' : '' }}>
                            {{ data_get($cat->name,'en') }}
                        </option>
                        @endforeach
                    </select>
                </div>
            </div>

            {{-- Order --}}
            <div class="col-md-6">
                <div class="form-group">
                    <label>{{ __('blog::messages.order') }}</label>
                    <input type="number" class="form-control" name="order" value="{{ old('order',0) }}" min="0">
                </div>
            </div>



            {{-- Published at --}}
            <div class="col-md-6">
                <div class="form-group">
                    <label>{{ __('blog::messages.published_at') }}</label>
                    <input type="datetime-local" class="form-control" name="published_at"
                        value="{{ old('published_at') }}">
                </div>
            </div>
            {{-- Status --}}
            <div class="col-md-6">
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
            <a href="{{ route('blog.posts.index') }}" class="btn btn-warning"><i class="fa fa-repeat"></i> {{
                __('blog::messages.cancel') }}</a>
        </div>
    </form>
</div>
@endsection
@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function () {
        @foreach($langs as $lang)
        initCkEditor('editor-content-{{ $lang->code }}');

        @endforeach
    });
</script>
@endpush