@extends('core::layouts.backend')

@push('title') {{ __('testimonial::messages.edit_testimonial') }} @endpush

@section('content')
<ul class="breadcrumb breadcrumb-top">
    <li><a href="/cp"><i class="fa fa-home"></i></a></li>
    <li><a href="{{ route('testimonial.index') }}">{{ __('testimonial::messages.testimonial') }}</a></li>
    <li>{{ __('testimonial::messages.edit') }}</li>
</ul>

<div class="block full">
    <div class="block-title d-flex align-items-center justify-content-between">
        <h2 class="m-0">
            <strong>{{ __('testimonial::messages.edit') }}:</strong>
            {{ data_get($testimonial->name, app()->getLocale(), data_get($testimonial->name, 'en')) }}
        </h2>
        <div class="block-options pull-right">
            <a href="{{ route('testimonial.index') }}" class="btn btn-sm btn-primary">
                <i class="fa fa-arrow-left me-1"></i> {{ __('testimonial::messages.back') }}
            </a>
        </div>
    </div>

    <form action="{{ route('testimonial.update', $testimonial) }}" method="post" class="form-bordered"
        enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- Tabs --}}
        <ul class="nav nav-tabs push" data-toggle="tabs">
            <li><a href="#tab-en">{{ __('testimonial::messages.english') }}</a></li>
            <li class="active"><a href="#tab-ar">{{ __('testimonial::messages.arabic') }}</a></li>
        </ul>

        <div class="tab-content">
            @foreach($langs as $lang)
            <div class="tab-pane {{ $loop->first ? 'active' : '' }}" id="tab-{{ $lang->code }}">
                <div class="form-group">
                    <label>{{ __('testimonial::messages.name_' . $lang->code) }}</label>
                    <input type="text" name="name[{{ $lang->code }}]" class="form-control"
                        value="{{ old('name.'.$lang->code, data_get($testimonial->name, $lang->code)) }}"
                        placeholder="{{ __('testimonial::messages.enter_name_' . $lang->code) }}">
                </div>

                <div class="form-group">
                    <label>{{ __('testimonial::messages.job_title_' . $lang->code) }}</label>
                    <input type="text" name="job_title[{{ $lang->code }}]" class="form-control"
                        value="{{ old('job_title.' . $lang->code, data_get($testimonial->job_title, $lang->code)) }}"
                        placeholder="{{ __('testimonial::messages.enter_job_title_' . $lang->code) }}">
                    <span class="help-block">{{ __('testimonial::messages.job_title_in_' . $lang->code) }}</span>
                </div>

                <div class="form-group">
                    <label>{{ __('testimonial::messages.description_' . $lang->code) }}</label>
                    <textarea name="description[{{ $lang->code }}]" class="form-control" rows="3"
                        placeholder="{{ __('testimonial::messages.enter_description_' . $lang->code) }}">{{ old('description.' . $lang->code, data_get($testimonial->description, $lang->code)) }}</textarea>
                    <span class="help-block">{{ __('testimonial::messages.short_bio_' . $lang->code) }}</span>
                </div>
                <div class="form-group">
                    <label>{{ __('testimonial::messages.service') }}</label>
                    <input type="text" name="service[{{ $lang->code }}]" class="form-control"
                        value="{{ old('service.' . $lang->code, data_get($testimonial->service, $lang->code)) }}"
                        placeholder="{{ __('testimonial::messages.enter_service_' . $lang->code) }}">
                </div>
            </div>
            @endforeach

        </div>

        {{-- Half-width fields --}}
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label>{{ __('testimonial::messages.image') }}</label>
                    <input type="file" name="image" class="file-input">
                    @if(!empty($testimonial->image))
                    <div class="mt-2">
                        <img src="{{ asset('storage/'.$testimonial->image) }}" alt="Current Image"
                            style="max-height: 100px;">
                    </div>
                    @endif
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>{{ __('testimonial::messages.rating') }}</label>
                    <input type="txt" name="rating" class="form-control"
                        value="{{ old('email', $testimonial->rating) }}"
                        placeholder="{{ __('testimonial::messages.enter_rating') }}">
                    <span class="help-block">{{ __('testimonial::messages.rating_help') }}</span>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>{{ __('testimonial::messages.email') }}</label>
                    <input type="email" name="email" class="form-control"
                        value="{{ old('email', $testimonial->email) }}"
                        placeholder="{{ __('testimonial::messages.enter_email') }}">
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label>{{ __('testimonial::messages.phone') }}</label>
                    <input type="text" name="phone" class="form-control" value="{{ old('phone', $testimonial->phone) }}"
                        placeholder="{{ __('testimonial::messages.enter_phone') }}">
                </div>
            </div>

            {{-- Social Links --}}
            <div class="col-md-6">
                <div class="form-group">
                    <label>{{ __('testimonial::messages.facebook') }}</label>
                    <input type="url" name="facebook" class="form-control"
                        value="{{ old('facebook', $testimonial->facebook) }}"
                        placeholder="{{ __('testimonial::messages.enter_facebook') }}">
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label>{{ __('testimonial::messages.twitter') }}</label>
                    <input type="url" name="twitter" class="form-control"
                        value="{{ old('twitter', $testimonial->twitter) }}"
                        placeholder="{{ __('testimonial::messages.enter_twitter') }}">
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label>{{ __('testimonial::messages.linkedin') }}</label>
                    <input type="url" name="linkedin" class="form-control"
                        value="{{ old('linkedin', $testimonial->linkedin) }}"
                        placeholder="{{ __('testimonial::messages.enter_linkedin') }}">
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label>{{ __('testimonial::messages.instagram') }}</label>
                    <input type="url" name="instagram" class="form-control"
                        value="{{ old('instagram', $testimonial->instagram) }}"
                        placeholder="{{ __('testimonial::messages.enter_instagram') }}">
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label>{{ __('testimonial::messages.youtube') }}</label>
                    <input type="url" name="youtube" class="form-control"
                        value="{{ old('youtube', $testimonial->youtube) }}"
                        placeholder="{{ __('testimonial::messages.enter_youtube') }}">
                </div>
            </div>

            {{-- Order --}}
            <div class="col-md-6">
                <div class="form-group">
                    <label>{{ __('testimonial::messages.order') }}</label>
                    <input type="number" name="order" class="form-control" min="0"
                        value="{{ old('order', $testimonial->order) }}">
                </div>
            </div>

            {{-- Status --}}
            <div class="col-md-6">
                <div class="form-group">
                    <label>{{ __('testimonial::messages.status') }}</label>
                    <div>
                        <input type="hidden" name="status" value="0">
                        <label class="switch switch-danger">
                            <input type="checkbox" name="status" value="1" {{ old('status', $testimonial->status) ?
                            'checked' : '' }}>
                            <span></span>
                        </label>
                        <span class="ms-2">{{ __('testimonial::messages.active') }}</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Actions --}}
        <div class="form-group form-actions">
            <button class="btn btn-sm btn-primary"><i class="fa fa-save"></i> {{ __('testimonial::messages.update')
                }}</button>
            <a href="{{ route('testimonial.index') }}" class="btn btn-sm btn-warning"><i class="fa fa-repeat"></i> {{
                __('testimonial::messages.cancel') }}</a>
        </div>
    </form>
</div>
@endsection