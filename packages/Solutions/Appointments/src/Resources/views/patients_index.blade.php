@extends('core::layouts.backend')
@push('title') {{ __('appointments::messages.patients') }} @endpush

@section('content')
  <ul class="breadcrumb breadcrumb-top">
    <li><a href="/cp"><i class="fa fa-home"></i></a></li>
    <li>{{ __('appointments::messages.patients') }}</li>
  </ul>

  <div class="block full">
    <div class="block-title d-flex align-items-center justify-content-between">
      <h2 class="m-0"><strong>{{ __('appointments::messages.patients') }}</strong></h2>
      <div class="block-options pull-right">
        <a href="{{ route('patients.create') }}" class="btn btn-sm btn-success">
          <i class="fa fa-plus me-1"></i> {{ __('appointments::messages.add_patient') }}
        </a>
      </div>
    </div>

    {{-- فلاتر البحث --}}
    <form method="GET" class="row mb-3">
      <div class="col-md-4">
        <input type="text" name="phone" value="{{ request('phone') }}" class="form-control"
               placeholder="{{ __('appointments::messages.search_phone') }}">
      </div>
      <div class="col-md-3">
        <label class="checkbox-inline" style="margin-top:8px">
          <input type="checkbox" name="only_trashed" value="1" {{ request('only_trashed') ? 'checked' : '' }}>
          {{ __('appointments::messages.only_trashed') }}
        </label>
      </div>
      <div class="col-md-2">
        <button class="btn btn-default">{{ __('appointments::messages.filter') }}</button>
      </div>
    </form>

    {{-- تنبيهات الأخطاء --}}
    @if ($errors->any())
      <div class="alert alert-danger">
        <ul class="m-0 ps-3">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <div class="table-responsive">
      <table class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>{{ __('appointments::messages.id') }}</th>
            <th>{{ __('appointments::messages.name') }}</th>
            <th>{{ __('appointments::messages.phone') }}</th>
            <th>{{ __('appointments::messages.status') }}</th>
            <th class="text-end">{{ __('appointments::messages.actions') }}</th>
          </tr>
        </thead>
        <tbody>
          @forelse($patients as $row)
            <tr>
              <td>{{ $row->id }}</td>
              <td>{{ $row->name['ar'] ?? $row->name['en'] ?? '-' }}</td>
              <td>{{ $row->phone ?? '-' }}</td>
              <td>
                {{ $row->deleted_at ? __('appointments::messages.archived') : __('appointments::messages.active') }}
              </td>
              <td class="text-end">
                <div class="btn-group" role="group">
                  <a href="{{ route('patients.edit',$row->id) }}" class="btn btn-sm btn-info">
                    {{ __('appointments::messages.edit_btn') }}
                  </a>
                </div>

                @if($row->deleted_at)
                  <div class="btn-group" role="group">
                    <form method="POST" action="{{ route('patients.restore',$row->id) }}" class="d-inline">
                      @csrf
                      <button class="btn btn-sm btn-warning">
                        {{ __('appointments::messages.restore') }}
                      </button>
                    </form>
                  </div>
                @else
                  <div class="btn-group" role="group">
                    <form method="POST" action="{{ route('patients.destroy',$row->id) }}" class="d-inline">
                      @csrf
                      @method('DELETE')
                      <button class="btn btn-sm btn-danger"
                              onclick="return confirm('{{ __('appointments::messages.are_you_sure_archive') }}')">
                        {{ __('appointments::messages.archive') }}
                      </button>
                    </form>
                  </div>
                @endif
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="5" class="text-center text-muted">{{ __('appointments::messages.no_records') }}</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    {{ $patients->appends(request()->query())->links() }}
  </div>
@endsection
