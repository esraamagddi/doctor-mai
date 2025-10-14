@extends('core::layouts.backend')

@push('title')
  {{ __('appointments::messages.timeslots') }} - {{ __('appointments::messages.edit_timeslot') }}
@endpush

@section('content')
  <ul class="breadcrumb breadcrumb-top">
    <li><a href="/cp"><i class="fa fa-home"></i></a></li>
    <li><a href="{{ route('timeslots.index') }}">{{ __('appointments::messages.timeslots') }}</a></li>
    <li>{{ __('appointments::messages.edit_timeslot') }}</li>
  </ul>

  <div class="block full">
    <div class="block-title">
      <h2 class="m-0">{{ __('appointments::messages.edit_timeslot') }}</h2>
      <div class="block-options pull-right">
        <a href="{{ route('timeslots.index') }}" class="btn btn-sm btn-default">
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

    <form method="POST" action="{{ route('timeslots.update', $slot->id) }}">
      @csrf
      @method('PUT')

      <div class="row">
        <div class="col-md-3">
          <div class="form-group">
            <label class="control-label">{{ __('appointments::messages.weekday') }}</label>
            <select class="form-control" name="weekday">
              @for($i=1; $i<=7; $i++)
                <option value="{{ $i }}" {{ old('weekday', $slot->weekday) == $i ? 'selected' : '' }}>
                  {{ __('appointments::messages.weekdays.'.$i) }}
                </option>
              @endfor
            </select>
          </div>
        </div>

        <div class="col-md-3">
          <div class="form-group">
            <label class="control-label">{{ __('appointments::messages.from') }}</label>
            <input class="form-control" type="time" name="start_time" value="{{ old('start_time', \Carbon\Carbon::parse($slot->start_time)->format('H:i')) }}">
          </div>
        </div>

        <div class="col-md-3">
          <div class="form-group">
            <label class="control-label">{{ __('appointments::messages.to') }}</label>
            <input class="form-control" type="time" name="end_time" value="{{ old('end_time', \Carbon\Carbon::parse($slot->end_time)->format('H:i')) }}">
          </div>
          
        </div>

        <div class="col-md-3">
          <div class="form-group">
            <label class="control-label">{{ __('appointments::messages.capacity') }}</label>
            <input class="form-control" type="number" min="1" name="capacity"
                   value="{{ old('capacity', $slot->capacity) }}">
          </div>
        </div>

        <div class="col-md-12 mt-2">
          <label>
            <input type="checkbox" name="is_active" value="1"
                   {{ old('is_active', $slot->is_active) ? 'checked' : '' }}>
            {{ __('appointments::messages.active') }}
          </label>
        </div>
      </div>

      <button class="btn btn-success mt-3">
        <i class="fa fa-save"></i> {{ __('appointments::messages.update') }}
      </button>
    </form>
  </div>
@endsection
