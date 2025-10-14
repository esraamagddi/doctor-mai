@extends('core::layouts.backend')

@push('title') {{ __('founder::messages.founder') }} @endpush

@section('content')

<ul class="breadcrumb breadcrumb-top">
    <li><a href="/cp"><i class="fa fa-home"></i></a></li>
    <li><a href="{{ route('founder.index') }}">{{ __('founder::messages.founder') }}</a></li>
    <li>{{ __('founder::messages.add') }}</li>
</ul>

<div class="block full">
    <div class="block-title d-flex align-items-center justify-content-between">
        <h2 class="m-0"><strong>{{ __('founder::messages.founder') }}</strong></h2>
    </div>

    <form action="{{ route('founder.store') }}" method="post" class="form-bordered" enctype="multipart/form-data">
        @csrf

        {{-- Tabs للغات --}}
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
                    {{-- Name --}}
                    <div class="form-group">
                        <label>{{ __('founder::messages.name_'.$lang->code) }}</label>
                        <input type="text" name="name[{{ $lang->code }}]" class="form-control"
                               value="{{ old('name.'.$lang->code, $founder->name[$lang->code] ?? '') }}"
                               placeholder="{{ __('founder::messages.enter_name_'.$lang->code) }}">
                    </div>

                    {{-- Position --}}
                    <div class="form-group">
                        <label>{{ __('founder::messages.position_'.$lang->code) }}</label>
                        <input type="text" name="position[{{ $lang->code }}]" class="form-control"
                               value="{{ old('position.'.$lang->code, $founder->position[$lang->code] ?? '') }}"
                               placeholder="{{ __('founder::messages.enter_position_'.$lang->code) }}">
                    </div>

                    {{-- Short Description --}}
                    <div class="form-group">
                        <label>{{ __('founder::messages.short_desc_'.$lang->code) }}</label>
                        <input type="text" name="short_desc[{{ $lang->code }}]" class="form-control"
                               value="{{ old('short_desc.'.$lang->code, $founder->short_desc[$lang->code] ?? '') }}"
                               placeholder="{{ __('founder::messages.enter_short_desc_'.$lang->code) }}">
                    </div>

                    {{-- Speech --}}
                    <div class="form-group">
                        <label>{{ __('founder::messages.speech_'.$lang->code) }}</label>
                        <textarea id="editor-speech-{{ $lang->code }}" name="speech[{{ $lang->code }}]" class="form-control" rows="4"
                                  placeholder="{{ __('founder::messages.enter_speech_'.$lang->code) }}">{{ old('speech.'.$lang->code, $founder->speech[$lang->code] ?? '') }}</textarea>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Image --}}
        <div class="row mt-3">
            <div class="col-md-6">
                <div class="form-group">
                    <label>{{ __('founder::messages.image') }}</label>
                    <input type="file" name="image" class="file-input" accept="image/*">
                </div>
            </div>

            {{-- Contact & Socials --}}
            <div class="col-md-6">
                <div class="form-group">
                    <label>{{ __('founder::messages.email') }}</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email', $founder->email ?? '') }}" placeholder="{{ __('founder::messages.enter_email') }}">
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label>{{ __('founder::messages.phone') }}</label>
                    <input type="text" name="phone" class="form-control" value="{{ old('phone', $founder->phone ?? '') }}" placeholder="{{ __('founder::messages.enter_phone') }}">
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label>{{ __('founder::messages.facebook') }}</label>
                    <input type="url" name="facebook" class="form-control" value="{{ old('facebook', $founder->facebook ?? '') }}" placeholder="{{ __('founder::messages.enter_facebook') }}">
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label>{{ __('founder::messages.twitter') }}</label>
                    <input type="url" name="twitter" class="form-control" value="{{ old('twitter', $founder->twitter ?? '') }}" placeholder="{{ __('founder::messages.enter_twitter') }}">
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label>{{ __('founder::messages.linkedin') }}</label>
                    <input type="url" name="linkedin" class="form-control" value="{{ old('linkedin', $founder->linkedin ?? '') }}" placeholder="{{ __('founder::messages.enter_linkedin') }}">
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label>{{ __('founder::messages.instagram') }}</label>
                    <input type="url" name="instagram" class="form-control" value="{{ old('instagram', $founder->instagram ?? '') }}" placeholder="{{ __('founder::messages.enter_instagram') }}">
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label>{{ __('founder::messages.youtube') }}</label>
                    <input type="url" name="youtube" class="form-control" value="{{ old('youtube', $founder->youtube ?? '') }}" placeholder="{{ __('founder::messages.enter_youtube') }}">
                </div>
            </div>
        </div>

        <div class="form-group form-actions mt-3">
            <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-save"></i> {{ __('founder::messages.save') }}</button>
        </div>
    </form>
</div>

@endsection

@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        @foreach($langs as $lang)
            initCkEditor('editor-speech-{{ $lang->code }}');
        @endforeach
    });
</script>
@endpush
   