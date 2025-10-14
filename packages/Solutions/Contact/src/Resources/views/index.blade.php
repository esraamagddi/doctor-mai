@extends('core::layouts.backend')

@push('title') {{ __('contact::messages.contact_messages') }} @endpush

@push('styles')
<style>
.unread-row { font-weight: bold; background-color: #fffdf2; }
.inline-form { display: inline-block; margin: 0; }
</style>
@endpush

@section('content')
<ul class="breadcrumb breadcrumb-top">
    <li><a href="/cp"><i class="fa fa-home"></i></a></li>
    <li>{{ __('contact::messages.contact_messages') }}</li>
</ul>

<div class="block full">
    <div class="block-title">
        <h2 class="m-0"><strong>{{ __('contact::messages.contact_messages') }}</strong></h2>
    </div>

    <form id="filterForm" action="{{ route('contact.index') }}" method="get" class="push" autocomplete="off">
        <div class="row">
            <div class="col-xs-12 col-sm-5 col-md-4">
                <input type="text" name="q" value="{{ request('q') }}" class="form-control" placeholder="{{ __('contact::messages.search_placeholder') }}">
            </div>
            <div class="col-xs-12 col-sm-4 col-md-3">
                <select name="is_read" class="form-control">
                    <option value="">{{ __('contact::messages.all') }}</option>
                    <option value="0" @selected(request('is_read')==='0')>{{ __('contact::messages.unread') }}</option>
                    <option value="1" @selected(request('is_read')==='1')>{{ __('contact::messages.read') }}</option>
                </select>
            </div>
            <div class="col-xs-12 col-sm-3 col-md-2">
                <button type="submit" class="btn btn-primary btn-block">
                    <i class="fa fa-search"></i>
                </button>
            </div>
        </div>
    </form>

    <div class="table-responsive">
        <table class="table table-vcenter">
            <thead>
                <tr>
                    <th style="width:32px"><input type="checkbox" id="chkAll"></th>
                    <th>#</th>
                    <th>{{ __('contact::messages.from') }}</th>
                    <th>{{ __('contact::messages.email') }}</th>
                    <th>{{ __('contact::messages.subject') }}</th>
                    <th>{{ __('contact::messages.date') }}</th>
                    <th class="text-center">{{ __('contact::messages.status') }}</th>
                    <th class="text-right">{{ __('contact::messages.actions') }}</th>
                </tr>
            </thead>
            <tbody>
                @forelse($items as $row)
                    <tr class="{{ $row->is_read ? '' : 'unread-row' }}">
                        <td><input type="checkbox" name="ids[]" value="{{ $row->id }}" form="bulkForm"></td>
                        <td>{{ $row->id }}</td>
                        <td>{{ $row->name }}</td>
                        <td>{{ $row->email }}</td>
                        <td><a href="{{ route('contact.show', $row) }}">{{ $row->subject ?: __('contact::messages.no_subject') }}</a></td>
                        <td>{{ $row->created_at->format('Y-m-d H:i') }}</td>
                        <td class="text-center">
                            @if($row->is_read)
                                <span class="label label-default">{{ __('contact::messages.read') }}</span>
                            @else
                                <span class="label label-success">{{ __('contact::messages.unread') }}</span>
                            @endif
                        </td>
                        <td class="text-right">
                            <a href="{{ route('contact.show', $row) }}" class="btn btn-xs btn-info"><i class="fa fa-eye"></i></a>
                            <form action="{{ route('contact.destroy', $row) }}" method="post" class="inline-form" onsubmit="return confirm('{{ __('contact::messages.confirm_delete') }}')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="8" class="text-center text-muted">{{ __('contact::messages.no_results') }}</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <form id="bulkForm" action="{{ route('contact.bulk') }}" method="post" class="row form-group">
        @csrf
        <div class="col-sm-6">
            <div class="form-inline">
                <div class="form-group">
                    <select name="action" class="form-control input-sm">
                        <option value="read">{{ __('contact::messages.mark_as_read') }}</option>
                        <option value="unread">{{ __('contact::messages.mark_as_unread') }}</option>
                        <option value="delete">{{ __('contact::messages.delete_selected') }}</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-sm btn-primary">{{ __('contact::messages.apply') }}</button>
            </div>
        </div>
        <div class="col-sm-6 text-right">
            {{ $items->withQueryString()->links() }}
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
(function () {
  var chkAll = document.getElementById('chkAll');
  if (chkAll) {
    chkAll.addEventListener('change', function(){
      [].slice.call(document.querySelectorAll('input[name="ids[]"]'))
        .forEach(function(cb){ cb.checked = chkAll.checked; });
    });
  }
  var bulkForm = document.getElementById('bulkForm');
  if (bulkForm) {
    bulkForm.addEventListener('submit', function(e){
      var selected = [].slice.call(document.querySelectorAll('input[name="ids[]"]:checked'));
      if (!selected.length) {
        e.preventDefault();
        alert('{{ __('contact::messages.select_at_least_one') }}');
      }
    });
  }
})();
</script>
@endpush
