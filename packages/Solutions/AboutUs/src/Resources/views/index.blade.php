@extends('core::layouts.backend')

@push('title') {{ __('aboutus::messages.about_us') }} @endpush

@section('content')

<ul class="breadcrumb breadcrumb-top">
    <li><a href="/cp"><i class="fa fa-home"></i></a></li>
    <li><a href="{{ route('aboutus.index') }}">{{ __('aboutus::messages.about_us') }}</a></li>
    <li>{{ __('aboutus::messages.add') }}</li>
</ul>

<div class="block full">
    <div class="block-title d-flex align-items-center justify-content-between">
        <h2 class="m-0"><strong>{{ __('aboutus::messages.about_us') }}</strong></h2>
    </div>

    <form action="{{ route('aboutus.store') }}" method="post" class="form-bordered" enctype="multipart/form-data">
        @csrf

        {{-- Tabs للغات --}}
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
                    
                    {{-- Title --}}
                    <div class="form-group">
                        <label>{{ __('aboutus::messages.title') }} ({{ $lang->code }})</label>
                        <input type="text" name="title[{{ $lang->code }}]" class="form-control"
                               value="{{ old('title.'.$lang->code, $aboutUs->title[$lang->code] ?? '') }}">
                    </div>

                    {{-- Sub Title --}}
                    <div class="form-group">
                        <label>{{ __('aboutus::messages.sub_title') }} ({{ $lang->code }})</label>
                        <input type="text" name="sub_title[{{ $lang->code }}]" class="form-control"
                               value="{{ old('sub_title.'.$lang->code, $aboutUs->sub_title[$lang->code] ?? '') }}">
                    </div>

                    {{-- Mission --}}
                    <div class="form-group">
                        <label>{{ __('aboutus::messages.mission') }} ({{ $lang->code }})</label>
                        <textarea id="editor-mission-{{ $lang->code }}" 
                                  name="mission[{{ $lang->code }}]" rows="3">{{ old('mission.'.$lang->code, $aboutUs->mission[$lang->code] ?? '') }}</textarea>
                    </div>

                    {{-- Vision --}}
                    <div class="form-group">
                        <label>{{ __('aboutus::messages.vision') }} ({{ $lang->code }})</label>
                        <textarea id="editor-vision-{{ $lang->code }}" 
                                  name="vision[{{ $lang->code }}]" rows="3">{{ old('vision.'.$lang->code, $aboutUs->vision[$lang->code] ?? '') }}</textarea>
                    </div>

                    {{-- Values --}}
                    <div class="form-group">
                        <label>{{ __('aboutus::messages.values') }} ({{ $lang->code }})</label>
                        <textarea name="values[{{ $lang->code }}]" class="form-control" rows="2">{{ old('values.'.$lang->code, $aboutUs->values[$lang->code] ?? '') }}</textarea>
                    </div>

                    {{-- Goals --}}
                    <div class="form-group">
                        <label>{{ __('aboutus::messages.goals') }} ({{ $lang->code }})</label>
                        <textarea id="editor-goals-{{ $lang->code }}" 
                                  name="goals[{{ $lang->code }}]" rows="2">{{ old('goals.'.$lang->code, $aboutUs->goals[$lang->code] ?? '') }}</textarea>
                    </div>

                    {{-- History --}}
                    <div class="form-group">
                        <label>{{ __('aboutus::messages.history') }} ({{ $lang->code }})</label>
                        <textarea name="history[{{ $lang->code }}]" class="form-control" rows="3">{{ old('history.'.$lang->code, $aboutUs->history[$lang->code] ?? '') }}</textarea>
                    </div>

                    {{-- Stats Per Language --}}
                    <h4 class="mt-3">Statistics ({{ $lang->name }})</h4>
                    @for ($i = 1; $i <= 2; $i++)
                        <div class="form-group">
                            <label>Stat {{ $i }} Title ({{ $lang->code }})</label>
                            <input type="text" name="stat{{ $i }}_title[{{ $lang->code }}]" class="form-control"
                                   value="{{ old('stat'.$i.'_title.'.$lang->code, $aboutUs->{'stat'.$i.'_title'}[$lang->code] ?? '') }}">
                        </div>
                        <div class="form-group">
                            <label>Stat {{ $i }} Value ({{ $lang->code }})</label>
                            <input type="text" name="stat{{ $i }}_value[{{ $lang->code }}]" class="form-control"
                                   value="{{ old('stat'.$i.'_value.'.$lang->code, $aboutUs->{'stat'.$i.'_value'}[$lang->code] ?? '') }}">
                        </div>
                        <div class="form-group">
                            <label>Stat {{ $i }} Description ({{ $lang->code }})</label>
                            <textarea name="stat{{ $i }}_description[{{ $lang->code }}]" class="form-control" rows="2">{{ old('stat'.$i.'_description.'.$lang->code, $aboutUs->{'stat'.$i.'_description'}[$lang->code] ?? '') }}</textarea>
                        </div>
                    @endfor

                    <hr class="my-4">

                    {{-- NEW: Education & Qualifications Section --}}
                    <h4 class="mt-4 mb-3 text-primary">
                        <i class="fa fa-graduation-cap"></i> Education & Qualifications ({{ $lang->name }})
                    </h4>

                    <div class="form-group">
                        <label>Education Description ({{ $lang->code }})</label>
                        <textarea id="editor-education-desc-{{ $lang->code }}" 
                                  name="education_description[{{ $lang->code }}]" 
                                  class="form-control" 
                                  rows="3">{{ old('education_description.'.$lang->code, $aboutUs->education_description[$lang->code] ?? '') }}</textarea>
                    </div>

                    <div class="form-group">
                        <label>Education Degree ({{ $lang->code }})</label>
                        <input type="text" 
                               name="education_degree[{{ $lang->code }}]" 
                               class="form-control"
                               value="{{ old('education_degree.'.$lang->code, $aboutUs->education_degree[$lang->code] ?? '') }}">
                    </div>

                    <div class="form-group">
                        <label>Education Degree Description ({{ $lang->code }})</label>
                        <textarea name="education_degree_description[{{ $lang->code }}]" 
                                  class="form-control" 
                                  rows="2">{{ old('education_degree_description.'.$lang->code, $aboutUs->education_degree_description[$lang->code] ?? '') }}</textarea>
                    </div>

                    <hr class="my-4">

                    {{-- NEW: Experience & Philosophy Section --}}
                    <h4 class="mt-4 mb-3 text-success">
                        <i class="fa fa-lightbulb-o"></i> Experience & Philosophy ({{ $lang->name }})
                    </h4>

                    <div class="form-group">
                        <label>Treatment Techniques ({{ $lang->code }})</label>
                        <textarea id="editor-treatment-{{ $lang->code }}" 
                                  name="treatment_techniques[{{ $lang->code }}]" 
                                  class="form-control" 
                                  rows="3">{{ old('treatment_techniques.'.$lang->code, $aboutUs->treatment_techniques[$lang->code] ?? '') }}</textarea>
                    </div>

                    <div class="form-group">
                        <label>Philosophy Quote ({{ $lang->code }})</label>
                        <textarea name="philosophy_quote[{{ $lang->code }}]" 
                                  class="form-control" 
                                  rows="2">{{ old('philosophy_quote.'.$lang->code, $aboutUs->philosophy_quote[$lang->code] ?? '') }}</textarea>
                    </div>

                    <div class="form-group">
                        <label>Philosophy Author ({{ $lang->code }})</label>
                        <input type="text" 
                               name="philosophy_author[{{ $lang->code }}]" 
                               class="form-control"
                               value="{{ old('philosophy_author.'.$lang->code, $aboutUs->philosophy_author[$lang->code] ?? '') }}">
                    </div>

                </div>
            @endforeach
        </div>

        {{-- Experience Years (Single Value - Not Multi-language) --}}
        <div class="form-group mt-4">
            <label class="text-info">
                <i class="fa fa-calendar"></i> Experience Years (Number)
            </label>
            <input type="number" 
                   name="experience_years" 
                   class="form-control" 
                   min="0"
                   value="{{ old('experience_years', $aboutUs->experience_years ?? '') }}"
                   placeholder="e.g., 15">
            <small class="form-text text-muted">Enter the number of years of experience (e.g., 15)</small>
        </div>

        <hr class="my-4">

        {{-- Images --}}
        <h4 class="mb-3"><i class="fa fa-image"></i> Images</h4>
        <div class="row">
            @foreach(['image' => 'Main Image', 'vision_image' => 'Vision Image', 'goal_image' => 'Goal Image', 'stats_image' => 'Stats Image'] as $field => $label)
            <div class="col-md-3">
                <div class="form-group">
                    <label>{{ $label }}</label>
                    <input type="file" name="{{ $field }}" class="file-input" accept="image/*">
                    @if(!empty($aboutUs->{$field}))
                        <div class="mt-2">
                            <img src="{{ asset('storage/'.$aboutUs->{$field}) }}" alt="{{ $label }}" style="width:100px; height:auto; border:1px solid #ccc; padding:2px;">
                        </div>
                    @endif
                </div>
            </div>
            @endforeach
        </div>

        <hr class="my-4">

        {{-- Contact Info --}}
        <h4 class="mb-3"><i class="fa fa-phone"></i> Contact Information</h4>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>{{ __('aboutus::messages.video_url') }}</label>
                    <input type="url" name="video_url" class="form-control" value="{{ old('video_url', $aboutUs->video_url ?? '') }}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>{{ __('aboutus::messages.contact_email') }}</label>
                    <input type="email" name="contact_email" class="form-control" value="{{ old('contact_email', $aboutUs->contact_email ?? '') }}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>{{ __('aboutus::messages.contact_phone') }}</label>
                    <input type="text" name="contact_phone" class="form-control" value="{{ old('contact_phone', $aboutUs->contact_phone ?? '') }}">
                </div>
            </div>
        </div>

        <hr class="my-4">

        {{-- Social Links --}}
        <h4 class="mb-3"><i class="fa fa-share-alt"></i> Social Media Links</h4>
        <div class="row">
            @foreach(['facebook','twitter','linkedin','instagram','youtube'] as $social)
                <div class="col-md-4">
                    <div class="form-group">
                        <label>
                            <i class="fa fa-{{ $social }}"></i> {{ ucfirst($social) }}
                        </label>
                        <input type="text" name="{{ $social }}" class="form-control" value="{{ old($social, $aboutUs->$social ?? '') }}" placeholder="https://{{ $social }}.com/...">
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Actions --}}
        <div class="form-group form-actions mt-4">
            <button type="submit" class="btn btn-sm btn-primary">
                <i class="fa fa-save"></i> {{ __('aboutus::messages.save') }}
            </button>
        </div>
    </form>
</div>

@endsection

@push('scripts')
<script>
document.addEventListener("DOMContentLoaded", function() {
    @foreach($langs as $lang)
        // Original editors
        initCkEditor('editor-mission-{{ $lang->code }}');
        initCkEditor('editor-vision-{{ $lang->code }}');
        initCkEditor('editor-goals-{{ $lang->code }}');
        
        // New editors for Education & Philosophy
        initCkEditor('editor-education-desc-{{ $lang->code }}');
        initCkEditor('editor-treatment-{{ $lang->code }}');
    @endforeach
});
</script>
@endpush