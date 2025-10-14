@extends('core::layouts.backend')

@push('title')
  {{ __('appointments::messages.title') }} - {{ __('appointments::messages.edit') }}
@endpush

@section('content')
  <ul class="breadcrumb breadcrumb-top">
    <li><a href="/cp"><i class="fa fa-home"></i></a></li>
    <li><a href="{{ route('appointments.index') }}">{{ __('appointments::messages.title') }}</a></li>
    <li>{{ __('appointments::messages.edit') }}</li>
  </ul>

  <div class="block full">
    <div class="block-title">
      <h2 class="m-0">{{ __('appointments::messages.edit') }}</h2>
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

    <form method="POST" action="{{ route('appointments.update', $appointment->id) }}">
      @csrf
      @method('PUT')

      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label class="control-label">{{ __('appointments::messages.patient') }}</label>
            <select name="patient_id" class="form-control">
              @foreach($patients as $p)
                <option value="{{ $p->id }}" {{ old('patient_id', $appointment->patient_id) == $p->id ? 'selected' : '' }}>
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
                <option value="{{ $s->id }}" {{ old('service_id', $appointment->service_id) == $s->id ? 'selected' : '' }}>
                  {{ $s->name['ar'] ?? $s->name['en'] }}
                </option>
              @endforeach
            </select>
          </div>
        </div>

        <div class="col-md-4">
          <div class="form-group">
            <label class="control-label">{{ __('appointments::messages.date') }}</label>
            <input type="date" name="preferred_date"
              value="{{ old('preferred_date', optional($appointment->preferred_date)->format('Y-m-d')) }}"
              class="form-control">
          </div>
        </div>

        <div class="col-md-4">
          <div class="form-group">
            <label class="control-label">{{ __('appointments::messages.time') }}</label>
            <input type="time" name="preferred_time"
              value="{{ old('preferred_time', $appointment->preferred_time) }}"
              class="form-control">
          </div>
        </div>

        <div class="col-md-4">
          <div class="form-group">
            <label class="control-label">{{ __('appointments::messages.status') }}</label>
            <select name="status" class="form-control">
              @foreach (['pending', 'confirmed', 'completed', 'canceled', 'no_show'] as $st)
                <option value="{{ $st }}" {{ old('status', $appointment->status) == $st ? 'selected' : '' }}>
                  {{ __('appointments::messages.statuses.' . $st) }}
                </option>
              @endforeach
            </select>
          </div>
        </div>

        <div class="col-md-12">
          <div class="form-group">
            <label class="control-label">
              {{ __('appointments::messages.notes') }}
              <small class="text-muted">({{ __('appointments::messages.optional') }})</small>
            </label>
            <textarea name="notes" class="form-control" rows="4">{{ old('notes', $appointment->notes) }}</textarea>
          </div>
        </div>
      </div>

      <button class="btn btn-success mt-3">
        <i class="fa fa-save"></i> {{ __('appointments::messages.update') }}
      </button>
    </form>
  </div>
@endsection
