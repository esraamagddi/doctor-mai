@extends('core::layouts.backend')

@push('title')
    {{ __('main_slider::messages.edit_main_slider') }}
@endpush

@section('content')

<ul class="breadcrumb breadcrumb-top">
    <li><a href="/cp"><i class="fa fa-home"></i></a></li>
    <li><a href="{{ route('mainslider.index') }}">{{ __('main_slider::messages.main_slider') }}</a></li>
    <li>{{ __('main_slider::messages.edit') }}</li>
</ul>

<div class="block full">
    <div class="block-title d-flex align-items-center justify-content-between">
        <h2 class="m-0">
            <strong>{{ __('main_slider::messages.edit') }} :</strong>
            {{ data_get($mainSlider->title, app()->getLocale(), data_get($mainSlider->title, 'en')) }}
        </h2>
        <div class="block-options pull-right">
            <a href="{{ route('mainslider.index') }}" class="btn btn-sm btn-primary">
                <i class="fa fa-arrow-left me-1"></i> {{ __('main_slider::messages.back') }}
            </a>
        </div>
    </div>

    <form action="{{ route('mainslider.update', $mainSlider->id) }}"
          method="post" class="form-bordered" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- Tabs for Languages --}}
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
                        <label>{{ __('main_slider::messages.title_'.$lang->code) }}</label>
                        <input type="text"
                               name="title[{{ $lang->code }}]"
                               class="form-control"
                               value="{{ old('title.'.$lang->code, $mainSlider->title[$lang->code] ?? '') }}">
                    </div>

                    {{-- Subtitle --}}
                    <div class="form-group">
                        <label>{{ __('main_slider::messages.subtitle_'.$lang->code) }}</label>
                        <input type="text"
                               name="subtitle[{{ $lang->code }}]"
                               class="form-control"
                               value="{{ old('subtitle.'.$lang->code, $mainSlider->subtitle[$lang->code] ?? '') }}">
                    </div>

                    {{-- Description --}}
                    <div class="form-group">
                        <label>{{ __('main_slider::messages.description_'.$lang->code) }}</label>
                        <textarea name="description[{{ $lang->code }}]"
                                  id="editor-description-{{ $lang->code }}"
                                  class="form-control" rows="3">{{ old('description.'.$lang->code, $mainSlider->description[$lang->code] ?? '') }}</textarea>
                    </div>

                    {{-- Buttons --}}
                    <div class="row">
                        {{-- Button 1 --}}
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{ __('main_slider::messages.button1_text_'.$lang->code) }}</label>
                                <input type="text"
                                       name="button1_text[{{ $lang->code }}]"
                                       class="form-control"
                                       value="{{ old('button1_text.'.$lang->code, $mainSlider->button1_text[$lang->code] ?? '') }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{ __('main_slider::messages.button1_link') }}</label>
                                <input type="text"
                                       name="button1_link"
                                       class="form-control"
                                       value="{{ old('button1_link', $mainSlider->button1_link ?? '') }}">
                            </div>
                        </div>

                        {{-- Button 2 --}}
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{ __('main_slider::messages.button2_text_'.$lang->code) }}</label>
                                <input type="text"
                                       name="button2_text[{{ $lang->code }}]"
                                       class="form-control"
                                       value="{{ old('button2_text.'.$lang->code, $mainSlider->button2_text[$lang->code] ?? '') }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{ __('main_slider::messages.button2_link') }}</label>
                                <input type="text"
                                       name="button2_link"
                                       class="form-control"
                                       value="{{ old('button2_link', $mainSlider->button2_link ?? '') }}">
                            </div>
                        </div>

                        {{-- Background --}}
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>{{ __('main_slider::messages.background_image_'.$lang->code) }}</label>
                                <input type="file" name="background_{{ $lang->code }}" class="file-input" accept="image/*">
                                @if($mainSlider->background_image)
                                    <div class="mt-2">
                                        <img src="{{ asset('storage/'.$mainSlider->{'background_'.$lang->code}) }}"
                                            alt="" style="max-width: 150px;">
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                </div>
            @endforeach
        </div>



        {{-- Media --}}
        <div class="row">
            {{-- Image --}}
            <div class="col-md-12">
                <div class="form-group">
                    <label>{{ __('main_slider::messages.image') }}</label>
                    <input type="file" name="image" class="file-input" accept="image/*">
                    @if($mainSlider->image)
                        <div class="mt-2">
                            <img src="{{ asset('storage/'.$mainSlider->image) }}"
                                 alt="" style="max-width: 150px;">
                        </div>
                    @endif
                </div>
            </div>


            {{-- Video URL --}}
            <div class="col-md-12">
                <div class="form-group">
                    <label>{{ __('main_slider::messages.video_url') }}</label>
                    <input type="text"
                           name="video_url"
                           class="form-control"
                           value="{{ old('video_url', $mainSlider->video_url ?? '') }}">
                </div>
            </div>
        </div>

        {{-- Overlay, order, status --}}
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label>{{ __('main_slider::messages.overlay_color') }}</label>
                    <input type="color"
                           name="overlay_color"
                           class="form-control"
                           value="{{ old('overlay_color', $mainSlider->overlay_color) }}">
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label>{{ __('main_slider::messages.order') }}</label>
                    <input type="number"
                           name="order"
                           class="form-control"
                           value="{{ old('order', $mainSlider->order) }}">
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label>{{ __('main_slider::messages.status') }}</label>
                    <div>
                        <input type="hidden" name="status" value="0">
                        <label class="switch switch-danger">
                            <input type="checkbox"
                                   name="status" value="1"
                                   {{ old('status', $mainSlider->status) ? 'checked' : '' }}>
                            <span></span>
                        </label>
                    </div>
                </div>
            </div>
        </div>

        {{-- Actions --}}
        <div class="form-group form-actions">
            <button type="submit" class="btn btn-sm btn-primary">
                <i class="fa fa-save"></i> {{ __('main_slider::messages.update') }}
            </button>
            <a href="{{ route('mainslider.index') }}" class="btn btn-sm btn-warning">
                <i class="fa fa-repeat"></i> {{ __('main_slider::messages.cancel') }}
            </a>
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
