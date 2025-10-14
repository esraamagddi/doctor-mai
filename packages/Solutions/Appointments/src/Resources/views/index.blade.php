@extends('core::layouts.backend')
@push('title') {{ __('appointments::messages.title') }} @endpush

@section('content')
  <ul class="breadcrumb breadcrumb-top">
    <li><a href="/cp"><i class="fa fa-home"></i></a></li>
    <li>{{ __('appointments::messages.title') }}</li>
  </ul>

  <div class="block full">
    <div class="block-title d-flex align-items-center justify-content-between">
      <h2 class="m-0"><strong>{{ __('appointments::messages.title') }}</strong></h2>
      <div class="block-options pull-right">
        <a href="{{ route('appointments.create') }}" class="btn btn-sm btn-success">
          <i class="fa fa-plus me-1"></i> {{ __('appointments::messages.add') }}
        </a>
      </div>
    </div>

    <form method="GET" class="row mb-3">
      <div class="col-md-3">
        <input type="date" name="date" value="{{ request('date') }}" class="form-control"
          placeholder="{{ __('appointments::messages.date') }}">
      </div>

      <div class="col-md-3">
        <select name="service_id" class="form-control">
          <option value="">{{ __('appointments::messages.all_services') }}</option>
          @foreach($services as $s)
            <option value="{{ $s->id }}" {{ request('service_id') == $s->id ? 'selected' : '' }}>
              {{ $s->name['ar'] ?? $s->name['en'] }}
            </option>
          @endforeach
        </select>
      </div>

      <div class="col-md-3">
        <select name="status" class="form-control">
          <option value="">{{ __('appointments::messages.all_statuses') }}</option>
          @foreach (['pending', 'confirmed', 'completed', 'canceled', 'no_show'] as $st)
            <option value="{{ $st }}" {{ request('status') === $st ? 'selected' : '' }}>
              {{ __('appointments::messages.statuses.' . $st) }}
            </option>
          @endforeach
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
            <th>{{ __('appointments::messages.id') }}</th>
            <th>{{ __('appointments::messages.patient') }}</th>
            <th>{{ __('appointments::messages.service') }}</th>
            <th>{{ __('appointments::messages.date') }}</th>
            <th>{{ __('appointments::messages.time') }}</th>
            <th>{{ __('appointments::messages.status') }}</th>
            <th class="text-end">{{ __('appointments::messages.actions') }}</th>
          </tr>
        </thead>
        <tbody>
          @forelse($appointments as $a)
            <tr>
              <td>{{ $a->id }}</td>
              <td>{{ $a->patient->name['ar'] ?? $a->patient->name['en'] ?? '-' }}</td>
              <td>{{ $a->service->name['ar'] ?? $a->service->name['en'] ?? '-' }}</td>
              <td>{{ optional($a->preferred_date)->format('Y-m-d') ?? '-' }}</td>
              <td>{{ $a->preferred_time ?? '-' }}</td>
              <td>{{ __('appointments::messages.statuses.' . ($a->status ?? 'pending')) }}</td>
              <td class="text-end">
                <div class="btn-group" role="group">
                  <form method="POST" action="{{ route('appointments.confirm', $a->id) }}" class="d-inline">
                    @csrf
                    <button class="btn btn-sm btn-info">{{ __('appointments::messages.confirm') }}</button>
                  </form>
                </div>
                <div class="btn-group" role="group">
                  <form method="POST" action="{{ route('appointments.cancel', $a->id) }}" class="d-inline">
                    @csrf
                    <button class="btn btn-sm btn-warning">{{ __('appointments::messages.cancel') }}</button>
                  </form>
                </div>
                <div class="btn-group" role="group">
                  <form method="POST" action="{{ route('appointments.complete', $a->id) }}" class="d-inline">
                    @csrf
                    <button class="btn btn-sm btn-success">{{ __('appointments::messages.complete') }}</button>
                  </form>
                </div>
                <div class="btn-group" role="group">
                  <a href="{{ route('appointments.edit', $a->id) }}" class="btn btn-sm btn-info">
                    {{ __('appointments::messages.edit_btn') }}
                  </a>
                </div>
                <div class="btn-group" role="group">
                  <form method="POST" action="{{ route('appointments.destroy', $a->id) }}" class="d-inline">
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
              <td colspan="7" class="text-center text-muted">{{ __('appointments::messages.no_records') }}</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    {{ $appointments->links() }}
  </div>
@endsection