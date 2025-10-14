@extends('core::layouts.backend')
@push('title') {{ __('appointments::messages.timeslots') }} @endpush

@section('content')
  <ul class="breadcrumb breadcrumb-top">
    <li><a href="/cp"><i class="fa fa-home"></i></a></li>
    <li>{{ __('appointments::messages.timeslots') }}</li>
  </ul>

  <div class="block full">
    <div class="block-title d-flex align-items-center justify-content-between">
      <h2 class="m-0"><strong>{{ __('appointments::messages.timeslots') }}</strong></h2>
      <div class="block-options pull-right">
        <a href="{{ route('timeslots.create') }}" class="btn btn-sm btn-success">
          <i class="fa fa-plus me-1"></i> {{ __('appointments::messages.add_timeslot') }}
        </a>
      </div>
    </div>

    {{-- فلاتر اختيارية --}}
    <form method="GET" class="row mb-3">
      <div class="col-md-4">
        <select name="weekday" class="form-control">
          <option value="">{{ __('appointments::messages.all_days') }}</option>
          @for($i=0; $i<=6; $i++)
            <option value="{{ $i }}" {{ (string)request('weekday') === (string)$i ? 'selected' : '' }}>
              {{ __('appointments::messages.weekdays.'.$i) }}
            </option>
          @endfor
        </select>
      </div>
      <div class="col-md-3">
        <select name="is_active" class="form-control">
          <option value="">{{ __('appointments::messages.all_statuses') }}</option>
          <option value="1" {{ request('is_active')==='1' ? 'selected' : '' }}>
            {{ __('appointments::messages.active') }}
          </option>
          <option value="0" {{ request('is_active')==='0' ? 'selected' : '' }}>
            {{ __('appointments::messages.inactive') }}
          </option>
        </select>
      </div>
      <div class="col-md-2">
        <button class="btn btn-default">{{ __('appointments::messages.filter') }}</button>
      </div>
    </form>

    <div class="table-responsive">
      <table class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>{{ __('appointments::messages.weekday') }}</th>
            <th>{{ __('appointments::messages.from') }}</th>
            <th>{{ __('appointments::messages.to') }}</th>
            <th>{{ __('appointments::messages.capacity') }}</th>
            <th>{{ __('appointments::messages.status') }}</th>
            <th class="text-end">{{ __('appointments::messages.actions') }}</th>
          </tr>
        </thead>
        <tbody>
          @forelse($slots as $row)
            <tr>
              <td>{{ __('appointments::messages.weekdays.' . $row->weekday) }}</td>
              <td>{{\Carbon\Carbon::parse($row->start_time)->format('h:i A') }}</td>
              <td>{{\Carbon\Carbon::parse($row->end_time)->format('h:i A') }}</td>
              <td>{{ $row->capacity }}</td>
              <td>{{ $row->is_active ? __('appointments::messages.yes') : __('appointments::messages.no') }}</td>
              <td class="text-end">
                <div class="btn-group" role="group">
                  <a class="btn btn-sm btn-info" href="{{ route('timeslots.edit',$row->id) }}">
                    {{ __('appointments::messages.edit_btn') }}
                  </a>
                </div>
                <div class="btn-group" role="group">
                  <form method="POST" action="{{ route('timeslots.destroy',$row->id) }}" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-danger"
                      onclick="return confirm('{{ __('appointments::messages.are_you_sure_delete') }}')">
                      {{ __('appointments::messages.delete') }}
                    </button>
                  </form>
                </div>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="6" class="text-center text-muted">{{ __('appointments::messages.no_records') }}</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    {{-- لو $slots paginator --}}
    @if(method_exists($slots, 'links'))
      {{ $slots->appends(request()->query())->links() }}
    @endif
  </div>
@endsection
