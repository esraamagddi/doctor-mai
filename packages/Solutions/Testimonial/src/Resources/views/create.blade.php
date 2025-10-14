@extends('core::layouts.backend')

@push('title') {{ __('testimonial::messages.testimonial') }} @endpush

@section('content')

<ul class="breadcrumb breadcrumb-top">
    <li><a href="/cp"><i class="fa fa-home"></i></a></li>
    <li><a href="{{ route('testimonial.index') }}">{{ __('testimonial::messages.testimonial') }}</a></li>
    <li>{{ __('testimonial::messages.add') }}</li>
</ul>

<div class="block full">
    <div class="block-title d-flex align-items-center justify-content-between">
        <h2 class="m-0"><strong>{{ __('testimonial::messages.add') }}</strong></h2>
        <div class="block-options pull-right">
            <a href="{{ route('testimonial.index') }}" class="btn btn-sm btn-primary">
                <i class="fa fa-arrow-left me-1"></i> {{ __('testimonial::messages.back') }}
            </a>
        </div>
    </div>

    <form action="{{ route('testimonial.store') }}" method="post" class="form-bordered" enctype="multipart/form-data">
        @csrf

        {{-- Tabs --}}
        <ul class="nav nav-tabs push" data-toggle="tabs">
            <li><a href="#tab-en">{{ __('testimonial::messages.english') }}</a></li>
            <li class="active"><a href="#tab-ar">{{ __('testimonial::messages.arabic') }}</a></li>
        </ul>


        <div class="tab-content mt-3">
            @foreach($langs as $lang)
            <div class="tab-pane {{ $loop->first ? 'active' : '' }}" id="tab-{{ $lang->code }}">
                <div class="form-group">
                    <label>{{ __('testimonial::messages.name_' . $lang->code) }}</label>
                    <input type="text" name="name[{{ $lang->code }}]" class="form-control"
                        value="{{ old('name.' . $lang->code) }}"
                        placeholder="{{ __('testimonial::messages.enter_name_' . $lang->code) }}">
                    <span class="help-block">{{ __('testimonial::messages.member_name_' . $lang->code) }}</span>
                </div>

                <div class="form-group">
                    <label>{{ __('testimonial::messages.job_title_' . $lang->code) }}</label>
                    <input type="text" name="job_title[{{ $lang->code }}]" class="form-control"
                        value="{{ old('job_title.' . $lang->code) }}"
                        placeholder="{{ __('testimonial::messages.enter_job_title_' . $lang->code) }}">
                    <span class="help-block">{{ __('testimonial::messages.job_title_in_' . $lang->code) }}</span>
                </div>

                <div class="form-group">
                    <label>{{ __('testimonial::messages.description_' . $lang->code) }}</label>
                    <textarea name="description[{{ $lang->code }}]" class="form-control" rows="3"
                        placeholder="{{ __('testimonial::messages.enter_description_' . $lang->code) }}">{{ old('description.' . $lang->code) }}</textarea>
                    <span class="help-block">{{ __('testimonial::messages.short_bio_' . $lang->code) }}</span>
                </div>
                <div class="form-group">
                    <label>{{ __('testimonial::messages.service') }}</label>
                    <input type="text" name="service[{{ $lang->code }}]" class="form-control" value="{{ old('service.' . $lang->code) }}"
                        placeholder="{{ __('testimonial::messages.enter_service_' . $lang->code) }}">
                </div>
            </div>
            @endforeach
        </div>

        <div class="row mt-3">

            {{-- Image --}}
            <div class="col-md-12">
                <div class="form-group">
                    <label>{{ __('testimonial::messages.image') }}</label>
                    <input type="file" name="image" class="file-input">
                    <span class="help-block">{{ __('testimonial::messages.image_help') }}</span>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>{{ __('testimonial::messages.rating') }}</label>
                    <input type="txt" name="rating" class="form-control" value="{{ old('rating') }}" placeholder="{{ __('testimonial::messages.enter_rating') }}">
                    <span class="help-block">{{ __('testimonial::messages.rating_help') }}</span>
                </div>
            </div>
            {{-- Email --}}
            <div class="col-md-6">
                <div class="form-group">
                    <label>{{ __('testimonial::messages.email') }}</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email') }}"
                        placeholder="{{ __('testimonial::messages.enter_email') }}">
                    <span class="help-block">{{ __('testimonial::messages.email_help') }}</span>
                </div>
            </div>

            {{-- Phone --}}
            <div class="col-md-6">
                <div class="form-group">
                    <label>{{ __('testimonial::messages.phone') }}</label>
                    <input type="text" name="phone" class="form-control" value="{{ old('phone') }}"
                        placeholder="{{ __('testimonial::messages.enter_phone') }}">
                    <span class="help-block">{{ __('testimonial::messages.phone_help') }}</span>
                </div>
            </div>

            {{-- Social Links --}}
            @foreach(['facebook', 'twitter', 'linkedin', 'instagram', 'youtube'] as $social)
            <div class="col-md-6">
                <div class="form-group">
                    <label>{{ __('testimonial::messages.' . $social) }}</label>
                    <input type="url" name="{{ $social }}" class="form-control" value="{{ old($social) }}"
                        placeholder="{{ __('testimonial::messages.enter_' . $social) }}">
                    <span class="help-block">{{ __('testimonial::messages.optional') }}</span>
                </div>
            </div>
            @endforeach

            {{-- Order --}}
            <div class="col-md-6">
                <div class="form-group">
                    <label>{{ __('testimonial::messages.order') }}</label>
                    <input type="number" name="order" class="form-control" value="{{ old('order', 0) }}" min="0">
                    <span class="help-block">{{ __('testimonial::messages.display_order') }}</span>
                </div>
            </div>

            {{-- Status --}}
            <div class="col-md-6">
                <div class="form-group">
                    <label>{{ __('testimonial::messages.status') }}</label>
                    <div>
                        <input type="hidden" name="status" value="0">
                        <label class="switch switch-danger" style="vertical-align: middle;">
                            <input type="checkbox" name="status" value="1" {{ old('status', 1) ? 'checked' : '' }}>
                            <span></span>
                        </label>
                        <span class="ms-2 align-middle">{{ __('testimonial::messages.active') }}</span>
                    </div>
                    <span class="help-block">{{ __('testimonial::messages.toggle_hint') }}</span>
                </div>
            </div>
        </div>

        {{-- Actions --}}
        <div class="form-group form-actions mt-3">
            <button type="submit" class="btn btn-sm btn-primary">
                <i class="fa fa-save"></i> {{ __('testimonial::messages.save') }}
            </button>
            <a href="{{ route('testimonial.index') }}" class="btn btn-sm btn-warning">
                <i class="fa fa-repeat"></i> {{ __('testimonial::messages.cancel') }}
            </a>
        </div>
    </form>
</div>

@endsection

@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function () {
        @foreach($langs as $lang)
        initCkEditor('editor-description-{{ $lang->code }}');
        @endforeach
    });
</script>
@endpush