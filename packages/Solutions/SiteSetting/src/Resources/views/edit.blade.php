@extends('core::layouts.backend')

@push('title') {{ __('sitesetting::messages.site_settings') }} @endpush

@section('content')
<ul class="breadcrumb breadcrumb-top">
    <li><a href="/cp"><i class="fa fa-home"></i></a></li>
    <li>{{ __('sitesetting::messages.site_settings') }}</li>
</ul>

<div class="block full">
    <div class="block-title d-flex align-items-center justify-content-between">
        <h2 class="m-0"><strong>{{ __('sitesetting::messages.site_settings') }}</strong></h2>
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

    <form action="{{ route('sitesetting.update') }}" method="post" class="form-bordered" enctype="multipart/form-data">
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
                    <label>{{ __('sitesetting::messages.name_' . $lang->code) }}</label>
                    <input type="text" name="site_name[{{ $lang->code }}]" class="form-control"
                        value="{{ old('site_name.' . $lang->code, $setting->site_name[$lang->code] ?? '') }}"
                        placeholder="{{ __('sitesetting::messages.enter_name_' . $lang->code) }}">
                    <span class="help-block">{{ __('sitesetting::messages.name_help_' . $lang->code) }}</span>
                </div>

                <div class="form-group">
                    <label>{{ __('sitesetting::messages.tagline_' . $lang->code) }}</label>
                    <input type="text" name="site_tagline[{{ $lang->code }}]" class="form-control"
                        value="{{ old('site_tagline.' . $lang->code, $setting->site_tagline[$lang->code] ?? '') }}"
                        placeholder="{{ __('sitesetting::messages.enter_tagline_' . $lang->code) }}">
                    <span class="help-block">{{ __('sitesetting::messages.tagline_help_' . $lang->code) }}</span>
                </div>

                <div class="form-group">
                    <label>{{ __('sitesetting::messages.desc_' . $lang->code) }}</label>
                    <textarea id="editor-desc-{{ $lang->code }}" name="site_description[{{ $lang->code }}]" class="form-control" rows="3"
                        placeholder="{{ __('sitesetting::messages.enter_desc_' . $lang->code) }}">{{ old('site_description.' . $lang->code, $setting->site_description[$lang->code] ?? '') }}</textarea>
                    <span class="help-block">{{ __('sitesetting::messages.desc_help_' . $lang->code) }}</span>
                </div>
                <div class="form-group">
                    <label>{{ __('sitesetting::messages.address_' . $lang->code) }}</label>
                    <input type="text" name="address[{{ $lang->code }}]" class="form-control"
                        value="{{ old('address.' . $lang->code, $setting->address[$lang->code] ?? '') }}"
                        placeholder="{{ __('sitesetting::messages.enter_address_' . $lang->code) }}">
                    <span class="help-block">{{ __('sitesetting::messages.address_help_' . $lang->code) }}</span>
                </div>

                <div class="form-group">
                    <label>{{ __('sitesetting::messages.working_hours') }}</label>
                    <input type="text" name="working_hours[{{ $lang->code }}]" class="form-control"
                        value="{{ old('working_hours.' . $lang->code, $setting->working_hours[$lang->code] ?? '') }}"
                        placeholder="{{ __('sitesetting::messages.enter_working_hours_' . $lang->code) }}">
                    <span class="help-block">{{ __('sitesetting::messages.working_hours_help') }}</span>
                </div>
                <div class="form-group">
                    <label>{{ __('sitesetting::messages.working_days') }}</label>
                    <input type="text" name="working_days[{{ $lang->code }}]" class="form-control"
                        value="{{ old('working_days.' . $lang->code, $setting->working_days[$lang->code] ?? '') }}"
                        placeholder="{{ __('sitesetting::messages.enter_working_days') }}">
                    <span class="help-block">{{ __('sitesetting::messages.working_days_help') }}</span>
                </div>

            </div>
            @endforeach
        </div>

        <div class="row">
            {{-- Logos / Favicon --}}
            <div class="col-md-4">
                <div class="form-group">
                    <label>{{ __('sitesetting::messages.logo_light') }}</label>
                    <input type="file" name="logo_light" class="file-input" accept="image/*">
                    <span class="help-block">{{ __('sitesetting::messages.logo_light_help') }}</span>
                    @if(!empty($setting->logo_light))
                    <div class="mt-2"><img src="{{ asset('storage/' . $setting->logo_light) }}"
                            style="max-width:150px;height:auto;"></div>
                    @endif
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>{{ __('sitesetting::messages.logo_dark') }}</label>
                    <input type="file" name="logo_dark" class="file-input" accept="image/*">
                    <span class="help-block">{{ __('sitesetting::messages.logo_dark_help') }}</span>
                    @if(!empty($setting->logo_dark))
                    <div class="mt-2"><img src="{{ asset('storage/' . $setting->logo_dark) }}"
                            style="max-width:150px;height:auto;"></div>
                    @endif
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>{{ __('sitesetting::messages.favicon') }}</label>
                    <input type="file" name="favicon" class="file-input" accept="image/*">
                    <span class="help-block">{{ __('sitesetting::messages.favicon_help') }}</span>
                    @if(!empty($setting->favicon))
                    <div class="mt-2"><img src="{{ asset('storage/' . $setting->favicon) }}"
                            style="max-width:64px;height:auto;"></div>
                    @endif
                </div>
            </div>

            {{-- Emails / Phones --}}
            <div class="col-md-6">
                <div class="form-group">
                    <label>{{ __('sitesetting::messages.emails') }}</label>
                    <input type="text" name="contact_emails" class="form-control"
                        value="{{ old('contact_emails', $setting->contact_emails ?? '') }}"
                        placeholder="{{ __('sitesetting::messages.emails_placeholder') }}">
                    <span class="help-block">{{ __('sitesetting::messages.emails_help') }}</span>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label>{{ __('sitesetting::messages.phones') }}</label>
                    <input
                        type="text"
                        name="contact_phones"
                        class="form-control"
                        value="{{ old('contact_phones', $setting->contact_phones ?? '') }}"
                        placeholder="{{ __('sitesetting::messages.phones_placeholder') }}">
                    <span class="help-block">{{ __('sitesetting::messages.phones_help') }}</span>
                </div>
            </div>

            <div class="col-md-12">
                <hr>
            </div>

            {{-- Social --}}
            @php $social = is_array($setting->social ?? null) ? $setting->social : []; @endphp

            <div class="col-md-4">
                <div class="form-group">
                    <label>{{ __('sitesetting::messages.facebook') }}</label>
                    <input type="url" name="social[facebook]" class="form-control"
                        value="{{ old('social.facebook', $social['facebook'] ?? '') }}"
                        placeholder="{{ __('sitesetting::messages.enter_facebook_url') }}">
                    <span class="help-block">{{ __('sitesetting::messages.social_optional') }}</span>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>{{ __('sitesetting::messages.twitter') }}</label>
                    <input type="url" name="social[twitter]" class="form-control"
                        value="{{ old('social.twitter', $social['twitter'] ?? '') }}"
                        placeholder="{{ __('sitesetting::messages.enter_twitter_url') }}">
                    <span class="help-block">{{ __('sitesetting::messages.social_optional') }}</span>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>{{ __('sitesetting::messages.linkedin') }}</label>
                    <input type="url" name="social[linkedin]" class="form-control"
                        value="{{ old('social.linkedin', $social['linkedin'] ?? '') }}"
                        placeholder="{{ __('sitesetting::messages.enter_linkedin_url') }}">
                    <span class="help-block">{{ __('sitesetting::messages.social_optional') }}</span>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>{{ __('sitesetting::messages.instagram') }}</label>
                    <input type="url" name="social[instagram]" class="form-control"
                        value="{{ old('social.instagram', $social['instagram'] ?? '') }}"
                        placeholder="{{ __('sitesetting::messages.enter_instagram_url') }}">
                    <span class="help-block">{{ __('sitesetting::messages.social_optional') }}</span>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>{{ __('sitesetting::messages.youtube') }}</label>
                    <input type="url" name="social[youtube]" class="form-control"
                        value="{{ old('social.youtube', $social['youtube'] ?? '') }}"
                        placeholder="{{ __('sitesetting::messages.enter_youtube_url') }}">
                    <span class="help-block">{{ __('sitesetting::messages.social_optional') }}</span>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>{{ __('sitesetting::messages.tiktok') }}</label>
                    <input type="url" name="social[tiktok]" class="form-control"
                        value="{{ old('social.tiktok', $social['tiktok'] ?? '') }}"
                        placeholder="{{ __('sitesetting::messages.enter_tiktok_url') }}">
                    <span class="help-block">{{ __('sitesetting::messages.social_optional') }}</span>
                </div>
            </div>

            <div class="col-md-12">
                <hr>
            </div>

            {{-- Analytics / Pixels --}}
            <div class="col-md-4">
                <div class="form-group">
                    <label>{{ __('sitesetting::messages.ga4_measurement_id') }}</label>
                    <input type="text" name="ga4_measurement_id" class="form-control"
                        value="{{ old('ga4_measurement_id', $setting->ga4_measurement_id) }}"
                        placeholder="{{ __('sitesetting::messages.enter_ga4_measurement_id') }}">
                    <span class="help-block">{{ __('sitesetting::messages.ga4_measurement_id_help') }}</span>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>{{ __('sitesetting::messages.gtm_container_id') }}</label>
                    <input type="text" name="gtm_container_id" class="form-control"
                        value="{{ old('gtm_container_id', $setting->gtm_container_id) }}"
                        placeholder="{{ __('sitesetting::messages.enter_gtm_container_id') }}">
                    <span class="help-block">{{ __('sitesetting::messages.gtm_container_id_help') }}</span>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>{{ __('sitesetting::messages.fb_pixel_id') }}</label>
                    <input type="text" name="fb_pixel_id" class="form-control"
                        value="{{ old('fb_pixel_id', $setting->fb_pixel_id) }}"
                        placeholder="{{ __('sitesetting::messages.enter_fb_pixel_id') }}">
                    <span class="help-block">{{ __('sitesetting::messages.fb_pixel_id_help') }}</span>
                </div>
            </div>

            {{-- Custom code --}}
            <div class="col-md-12">
                <div class="form-group">
                    <label>{{ __('sitesetting::messages.custom_head_code') }}</label>
                    <textarea name="custom_head_code" class="form-control" rows="3"
                        placeholder="{{ __('sitesetting::messages.enter_custom_head_code') }}">{{ old('custom_head_code', $setting->custom_head_code) }}</textarea>
                    <span class="help-block">{{ __('sitesetting::messages.custom_head_code_help') }}</span>
                </div>
            </div>

            <div class="col-md-12">
                <div class="form-group">
                    <label>{{ __('sitesetting::messages.custom_body_code') }}</label>
                    <textarea name="custom_body_code" class="form-control" rows="3"
                        placeholder="{{ __('sitesetting::messages.enter_custom_body_code') }}">{{ old('custom_body_code', $setting->custom_body_code) }}</textarea>
                    <span class="help-block">{{ __('sitesetting::messages.custom_body_code_help') }}</span>
                </div>
            </div>

            {{-- Google Map Embed --}}
            <div class="col-md-12">
                <div class="form-group">
                    <label>{{ __('sitesetting::messages.google_map_embed') }}</label>
                    <textarea name="google_map_embed" class="form-control" rows="3"
                        placeholder="{{ __('sitesetting::messages.google_map_embed_placeholder') }}">{{ old('google_map_embed', $setting->google_map_embed ?? '') }}</textarea>
                    <span class="help-block">{{ __('sitesetting::messages.google_map_embed_help') }}</span>
                </div>
            </div>
        </div>
        <div class="form-group form-actions">
            <button class="btn btn-sm btn-primary"><i class="fa fa-save"></i>
                {{ __('sitesetting::messages.update') }}</button>
        </div>
    </form>
</div>
@endsection
@push('scripts')
<script>
document.addEventListener("DOMContentLoaded", function() {
    @foreach($langs as $lang)
        initCkEditor('editor-desc-{{ $lang->code }}');
    @endforeach
});
</script>
@endpush
