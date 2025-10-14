@extends('core::layouts.backend')

@push('title') {{ __('language::messages.languages') }} @endpush

@push('styles')
<style>
#languagesTable tbody tr[draggable="true"] { cursor: move; }
#languagesTable tbody tr.dragging { opacity: .5; }
.table-responsive { overflow-x: auto; }
.inline-block { display: inline-block; }
</style>
@endpush

@section('content')

<ul class="breadcrumb breadcrumb-top">
    <li><a href="/cp"><i class="fa fa-home"></i></a></li>
    <li>{{ __('language::messages.languages') }}</li>
</ul>

<div class="block full">
    <div class="block-title d-flex align-items-center justify-content-between">
        <h2 class="m-0"><strong>{{ __('language::messages.languages') }}</strong></h2>
        <div class="block-options pull-right">
            <a href="{{ route('language.create') }}" class="btn btn-sm btn-primary"><i class="fa fa-plus me-1"></i> {{ __('language::messages.add') }}</a>
        </div>
    </div>
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
@if(session('ok'))
    <div class="alert alert-success">
        {{ session('ok') }}
    </div>
@endif
@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif
    <div class="table-responsive">
        <table id="languagesTable" class="table table-striped table-vcenter">
            <thead>
            <tr>
                <th style="width:60px">#</th>
                <th>{{ __('language::messages.name') }}</th>
                <th>{{ __('language::messages.code') }}</th>
                <th>{{ __('language::messages.dir') }}</th>
                <th>{{ __('language::messages.locale') }}</th>
                <th>{{ __('language::messages.status') }}</th>
                <th>{{ __('language::messages.default') }}</th>
                <th>{{ __('language::messages.order') }}</th>
                <th class="text-center" style="width:220px">{{ __('language::messages.actions') }}</th>
            </tr>
            </thead>
            <tbody>
            @forelse($items as $item)
                <tr draggable="true" data-id="{{ $item->id }}">
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->name }}</td>
                    <td><span class="label label-info">{{ $item->code }}</span></td>
                    <td>
                        @if($item->dir=='rtl')
                            <span class="label label-warning">{{ __('language::messages.rtl') }}</span>
                        @else
                            <span class="label label-default">{{ __('language::messages.ltr') }}</span>
                        @endif
                    </td>
                    <td>{{ $item->locale ?? '-' }}</td>
                    <td>
                        @if($item->status)
                            <span class="label label-success">{{ __('language::messages.active') }}</span>
                        @else
                            <span class="label label-danger">{{ __('language::messages.inactive') }}</span>
                        @endif
                    </td>
                    <td>
                        @if($item->is_default)
                            <span class="label label-primary">{{ __('language::messages.default') }}</span>
                        @else
                            <span class="label label-default">—</span>
                        @endif
                    </td>
                    <td><input type="number" class="form-control input-sm row-order" value="{{ (int)$item->order }}" min="0" style="width: 80px;"></td>
                    <td class="text-center">
                        <form action="{{ route('language.toggle',$item) }}" method="post" class="inline-block">
                            @csrf
                            <button class="btn btn-sm  btn-default" title="Toggle Active"><i class="fa fa-power-off"></i></button>
                        </form>

                        <form action="{{ route('language.default',$item) }}" method="post" class="inline-block">
                            @csrf
                            <button class="btn btn-sm  btn-info" title="Set Default" {{ $item->is_default ? 'disabled' : '' }}><i class="fa fa-star"></i></button>
                        </form>

                        <a href="{{ route('language.edit',$item) }}" class="btn btn-sm  btn-warning"><i class="fa fa-pencil"></i></a>

                        <form action="{{ route('language.destroy',$item) }}" method="post" class="inline-block" onsubmit="return confirm('Delete this language?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm  btn-danger"><i class="fa fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="9" class="text-center text-muted">No data</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>

    <div class="row">
        <div class="col-md-12 text-right">
            <button id="saveOrderBtn" class="btn btn-success"><i class="fa fa-save"></i> {{ __('language::messages.save') }}</button>
        </div>
    </div>

    <div class="text-center">
        {{ $items->links() }}
    </div>
</div>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
  const table = document.getElementById('languagesTable');
  const saveBtn = document.getElementById('saveOrderBtn');
  const flashAreaId = 'flashArea';

  // ===== Helpers =====
  function ensureFlashArea() {
    let box = document.getElementById(flashAreaId);
    if (!box) {
      box = document.createElement('div');
      box.id = flashAreaId;
      // حط الرسائل قبل البلوك مباشرة
      const block = document.querySelector('.block.full');
      (block?.parentNode || document.body).insertBefore(box, block);
    }
    return box;
  }

  function showFlash(type, message) {
    const box = ensureFlashArea();
    box.innerHTML = `
      <div class="alert alert-${type} alert-dismissible fade in" role="alert" style="margin-bottom:15px">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">&times;</button>
        ${message}
      </div>`;
  }

  function getCsrf() {
    const m = document.querySelector('meta[name="csrf-token"]');
    return (m && m.getAttribute('content')) || '{{ csrf_token() }}';
  }

  // ===== Drag & drop row reordering =====
  let draggingEl = null;
  if (table) {
    table.querySelectorAll('tbody tr').forEach(tr => {
      tr.setAttribute('draggable', 'true');
      tr.addEventListener('dragstart', () => { draggingEl = tr; tr.classList.add('dragging'); });
      tr.addEventListener('dragend',   () => { draggingEl = null; tr.classList.remove('dragging'); });
    });

    const body = table.querySelector('tbody');
    body.addEventListener('dragover', function(e){
      e.preventDefault();
      const after = [...this.querySelectorAll('tr')].find(row => {
        const box = row.getBoundingClientRect();
        return e.clientY <= box.top + box.height/2;
      });
      if (!after) this.appendChild(draggingEl);
      else this.insertBefore(draggingEl, after);
    });
  }

  // ===== Save order via fetch =====
  if (saveBtn) {
    saveBtn.addEventListener('click', async function () {
      if (!table) return;

      saveBtn.disabled = true;

      // جمع البيانات
      const rows = [];
      table.querySelectorAll('tbody tr').forEach((tr, idx) => {
        const id  = tr.getAttribute('data-id');
        const inp = tr.querySelector('.row-order');
        const ord = (inp && inp.value !== '') ? parseInt(inp.value, 10) : idx;
        if (id) rows.push({ id, order: isNaN(ord) ? idx : ord });
      });

      const url = '{{ route('language.order', [], true) }}'; // HTTPS دايمًا
      const payload = JSON.stringify({ orders: rows });

      try {
        const res = await fetch(url, {
          method: 'POST',
          credentials: 'same-origin',
          headers: {
            'X-CSRF-TOKEN': getCsrf(),
            'Accept': 'application/json',
            'Content-Type': 'application/json'
          },
          body: payload
        });

        // Blocked by redirect (مثلاً للّوجين)
        if (res.redirected) {
          throw new Error('Redirected to ' + res.url);
        }

        const ct = res.headers.get('content-type') || '';
        if (!ct.includes('application/json')) {
          const text = await res.text();
          throw new Error('Unexpected response (not JSON): ' + text.slice(0, 200));
        }

        const data = await res.json();

        if (!res.ok || !data.ok) {
          throw new Error(data?.message || 'Saving failed');
        }

        // Success UI
        const old = saveBtn.innerHTML;
        saveBtn.innerHTML = '<i class="fa fa-check me-1"></i> {{ __('language::messages.save') }}';
        showFlash('success', data.message || '{{ __('language::messages.order_saved') }}');
        setTimeout(() => { saveBtn.innerHTML = old; saveBtn.disabled = false; }, 1000);

      } catch (err) {
        console.error(err);
        showFlash('danger', err?.message || 'Saving failed');
        saveBtn.disabled = false;
      }
    });
  }
});
</script>

@endpush
