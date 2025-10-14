@extends('core::layouts.backend')

@push('title') {{ __('team::messages.edit_team') }} @endpush

@section('content')
    <ul class="breadcrumb breadcrumb-top">
        <li><a href="/cp"><i class="fa fa-home"></i></a></li>
        <li><a href="{{ route('team.index') }}">{{ __('team::messages.team') }}</a></li>
        <li>{{ __('team::messages.edit') }}</li>
    </ul>

    <div class="block full">
        <div class="block-title d-flex align-items-center justify-content-between">
            <h2 class="m-0"><strong>{{ __('team::messages.edit') }} :</strong>
                {{ data_get($team->name, app()->getLocale(), data_get($team->name, 'en')) }}</h2>
            <div class="block-options pull-right">
                <a href="{{ route('team.index') }}" class="btn btn-sm btn-primary">
                    <i class="fa fa-arrow-left me-1"></i> {{ __('team::messages.back') }}
                </a>
            </div>
        </div>

        <form action="{{ route('team.update', $team) }}" method="post" class="form-bordered">
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

                        {{-- Name --}}
                        <div class="form-group">
                            <label>{{ __('team::messages.name_' . $lang->code) }}</label>
                            <input type="text" name="name[{{ $lang->code }}]" class="form-control"
                                value="{{ old('name.' . $lang->code, $team->name[$lang->code] ?? '') }}"
                                placeholder="{{ __('team::messages.enter_name_' . $lang->code) }}">
                            <span class="help-block">{{ __('team::messages.member_name_' . $lang->code) }}</span>
                        </div>

                        {{-- Job Title --}}
                        <div class="form-group">
                            <label>{{ __('team::messages.job_title_' . $lang->code) }}</label>
                            <input type="text" name="job_title[{{ $lang->code }}]" class="form-control"
                                value="{{ old('job_title.' . $lang->code, $team->job_title[$lang->code] ?? '') }}"
                                placeholder="{{ __('team::messages.enter_job_title_' . $lang->code) }}">
                            <span class="help-block">{{ __('team::messages.job_title_in_' . $lang->code) }}</span>
                        </div>

                        {{-- Description --}}
                        <div class="form-group">
                            <label>{{ __('team::messages.description_' . $lang->code) }}</label>
                            <textarea name="description[{{ $lang->code }}]" class="form-control" rows="3" id="editor-description-{{ $lang->code }}"
                                placeholder="{{ __('team::messages.enter_description_' . $lang->code) }}">{{ old('description.' . $lang->code, $team->description[$lang->code] ?? '') }}</textarea>
                            <span class="help-block">{{ __('team::messages.short_bio_' . $lang->code) }}</span>
                        </div>

                    </div>
                @endforeach
            </div>


            {{-- Half-width fields --}}
            <div class="row">

                <div class="col-md-6">
             <div class="form-group">
                  <label>{{ __('team::messages.image') }}</label>
        
                @if(!empty($team->image))
                <div style="margin-bottom: 10px;">
                    <img src="{{ asset('storage/' . $team->image) }}" 
                        alt="Current Image" 
                        style="max-width: 150px; height: auto; border: 1px solid #ddd; padding: 3px; border-radius: 4px;">
                </div>
            @endif
                <input type="file" name="image" class="file-input" accept="image/*">
            </div>
            </div>


                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ __('team::messages.email') }}</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email', $team->email) }}"
                            placeholder="{{ __('team::messages.enter_email') }}">
                        <span class="help-block">{{ __('team::messages.email_help') }}</span>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ __('team::messages.phone') }}</label>
                        <input type="text" name="phone" class="form-control" value="{{ old('phone', $team->phone) }}"
                            placeholder="{{ __('team::messages.enter_phone') }}">
                        <span class="help-block">{{ __('team::messages.phone_help') }}</span>
                    </div>
                </div>
                  
                {{-- Socials --}}
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ __('team::messages.facebook') }}</label>
                        <input type="url" name="facebook" class="form-control"
                            value="{{ old('facebook', $team->facebook) }}"
                            placeholder="{{ __('team::messages.enter_facebook') }}">
                        <span class="help-block">{{ __('team::messages.optional') }}</span>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ __('team::messages.twitter') }}</label>
                        <input type="url" name="twitter" class="form-control" value="{{ old('twitter', $team->twitter) }}"
                            placeholder="{{ __('team::messages.enter_twitter') }}">
                        <span class="help-block">{{ __('team::messages.optional') }}</span>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ __('team::messages.linkedin') }}</label>
                        <input type="url" name="linkedin" class="form-control"
                            value="{{ old('linkedin', $team->linkedin) }}"
                            placeholder="{{ __('team::messages.enter_linkedin') }}">
                        <span class="help-block">{{ __('team::messages.optional') }}</span>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ __('team::messages.instagram') }}</label>
                        <input type="url" name="instagram" class="form-control"
                            value="{{ old('instagram', $team->instagram) }}"
                            placeholder="{{ __('team::messages.enter_instagram') }}">
                        <span class="help-block">{{ __('team::messages.optional') }}</span>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ __('team::messages.youtube') }}</label>
                        <input type="url" name="youtube" class="form-control" value="{{ old('youtube', $team->youtube) }}"
                            placeholder="{{ __('team::messages.enter_youtube') }}">
                        <span class="help-block">{{ __('team::messages.optional') }}</span>
                    </div>
                </div>

                {{-- Order --}}
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ __('team::messages.order') }}</label>
                        <input type="number" name="order" class="form-control" min="0"
                            value="{{ old('order', $team->order) }}">
                        <span class="help-block">{{ __('team::messages.display_order') }}</span>
                    </div>
                </div>

                {{-- Status switch --}}
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ __('team::messages.status') }}</label>
                        <div>
                            <input type="hidden" name="status" value="0">
                            <label class="switch switch-danger" style="vertical-align: middle;">
                                <input type="checkbox" name="status" value="1" {{ old('status', $team->status) ? 'checked' : '' }}>
                                <span></span>
                            </label>
                            <span class="ms-2 align-middle">{{ __('team::messages.active') }}</span>
                        </div>
                        <span class="help-block">{{ __('team::messages.toggle_hint') }}</span>
                    </div>
                </div>
            </div>

            {{-- Actions --}}
            <div class="form-group form-actions">
                <button class="btn btn-sm btn-primary"><i class="fa fa-save"></i> {{ __('team::messages.update') }}</button>
                <a href="{{ route('team.index') }}" class="btn btn-sm btn-warning"><i class="fa fa-repeat"></i>
                    {{ __('team::messages.cancel') }}</a>
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