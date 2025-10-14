@extends('core::layouts.backend')

@push('title')
  {{ __('appointments::messages.title') }} - {{ __('appointments::messages.add') }}
@endpush

@section('content')
  <ul class="breadcrumb breadcrumb-top">
    <li><a href="/cp"><i class="fa fa-home"></i></a></li>
    <li><a href="{{ route('appointments.index') }}">{{ __('appointments::messages.title') }}</a></li>
    <li>{{ __('appointments::messages.add') }}</li>
  </ul>

  <div class="block full">
    <div class="block-title">
      <h2 class="m-0">{{ __('appointments::messages.add') }}</h2>
                  <div class="block-options pull-right">

      <a href="{{ route('appointments.index') }}" class="btn btn-sm btn-default">
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

    <form method="POST" action="{{ route('appointments.store') }}">
      @csrf
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label class="control-label">{{ __('appointments::messages.patient') }}</label>
            <select name="patient_id" class="form-control">
              <option value="">{{ __('appointments::messages.choose_patient') }}</option>
              @foreach($patients as $p)
                <option value="{{ $p->id }}" {{ old('patient_id') == $p->id ? 'selected' : '' }}>
                  {{ $p->name['ar'] ?? $p->name['en'] }} - {{ $p->phone }}
                </option>
              @endforeach
            </select>
          </div>
        </div>

        <div class="col-md-6">
          <div class="form-group">
            <label class="control-label">{{ __('appointments::messages.service') }}</label>
            <select name="service_id" class="form-control">
              <option value="">{{ __('appointments::messages.none') }}</option>
              @foreach($services as $s)
                <option value="{{ $s->id }}" {{ old('service_id') == $s->id ? 'selected' : '' }}>
                  {{ $s->name['ar'] ?? $s->name['en'] }}
                </option>
              @endforeach
            </select>
          </div>
        </div>

        <div class="col-md-6">
          <div class="form-group">
            <label class="control-label">{{ __('appointments::messages.date') }}</label>
            <input type="date" name="preferred_date" value="{{ old('preferred_date') }}" class="form-control">
          </div>
        </div>

        <div class="col-md-6">
          <div class="form-group">
            <label class="control-label">{{ __('appointments::messages.time') }}</label>
            <input type="time" name="preferred_time" value="{{ old('preferred_time') }}" class="form-control">
          </div>
        </div>

        <div class="col-md-12">
          <div class="form-group">
            <label class="control-label">
              {{ __('appointments::messages.notes') }}
              <small class="text-muted">({{ __('appointments::messages.optional') }})</small>
            </label>
            <textarea name="notes" class="form-control" rows="4">{{ old('notes') }}</textarea>
          </div>
        </div>
      </div>

      <button class="btn btn-success mt-3">
        <i class="fa fa-check"></i> {{ __('appointments::messages.save') }}
      </button>
    </form>
  </div>
@endsection