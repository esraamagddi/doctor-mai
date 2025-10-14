@extends('core::layouts.backend')

@push('title')
  {{ __('appointments::messages.patients') }} - {{ __('appointments::messages.add_patient') }}
@endpush

@section('content')
  <ul class="breadcrumb breadcrumb-top">
    <li><a href="/cp"><i class="fa fa-home"></i></a></li>
    <li><a href="{{ route('patients.index') }}">{{ __('appointments::messages.patients') }}</a></li>
    <li>{{ __('appointments::messages.add_patient') }}</li>
  </ul>

  <div class="block full">
    <div class="block-title">
      <h2 class="m-0">{{ __('appointments::messages.add_patient') }}</h2>
      <div class="block-options pull-right">
        <a href="{{ route('patients.index') }}" class="btn btn-sm btn-default">
          <i class="fa fa-arrow-right"></i> {{ __('appointments::messages.back') }}
        </a>
      </div>
    </div>

    {{-- عرض الأخطاء --}}
    @if ($errors->any())
      <div class="alert alert-danger">
        <ul class="m-0 ps-3">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form method="POST" action="{{ route('patients.store') }}">
      @csrf
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label class="control-label">{{ __('appointments::messages.name_ar') }}</label>
            <input class="form-control" name="name[ar]" value="{{ old('name.ar') }}">
          </div>
        </div>

        <div class="col-md-6">
          <div class="form-group">
            <label class="control-label">{{ __('appointments::messages.name_en') }}</label>
            <input class="form-control" name="name[en]" value="{{ old('name.en') }}">
          </div>
        </div>

        <div class="col-md-6">
          <div class="form-group">
            <label class="control-label">{{ __('appointments::messages.phone') }}</label>
            <input class="form-control" name="phone" value="{{ old('phone') }}">
          </div>
        </div>

        <div class="col-md-6">
          <div class="form-group">
            <label class="control-label">{{ __('appointments::messages.email') }}</label>
            <input class="form-control" type="email" name="email" value="{{ old('email') }}">
          </div>
        </div>

        <div class="col-md-6">
          <div class="form-group">
            <label class="control-label">{{ __('appointments::messages.gender') }}</label>
            <select name="gender" class="form-control">
              <option value="">{{ __('appointments::messages.undefined') }}</option>
              <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>{{ __('appointments::messages.male') }}</option>
              <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>{{ __('appointments::messages.female') }}</option>
              <option value="other" {{ old('gender') == 'other' ? 'selected' : '' }}>{{ __('appointments::messages.other') }}</option>
            </select>
          </div>
        </div>

        <div class="col-md-6">
          <div class="form-group">
            <label class="control-label">{{ __('appointments::messages.birthdate') }}</label>
            <input class="form-control" type="date" name="birthdate" value="{{ old('birthdate') }}">
          </div>
        </div>

        <div class="col-md-6">
          <div class="form-group">
            <label class="control-label">{{ __('appointments::messages.file_number') }}</label>
            <input class="form-control" name="file_number" value="{{ old('file_number') }}">
          </div>
        </div>

        <div class="col-md-12">
          <div class="form-group">
            <label class="control-label">
              {{ __('appointments::messages.notes') }}
              <small class="text-muted">({{ __('appointments::messages.optional') }})</small>
            </label>
            <textarea class="form-control" name="notes" rows="4">{{ old('notes') }}</textarea>
          </div>
        </div>

        <div class="col-md-12">
          <label>
            <input type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}>
            {{ __('appointments::messages.active') }}
          </label>
        </div>
      </div>

      <button class="btn btn-success mt-3">
        <i class="fa fa-check"></i> {{ __('appointments::messages.save') }}
      </button>
    </form>
  </div>
@endsection
