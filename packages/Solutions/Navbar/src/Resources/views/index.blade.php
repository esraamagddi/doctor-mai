@extends('core::layouts.backend')

@push('title') {{ __('navbar::messages.navbar') }} @endpush

@push('styles')
  <style>
    #dataTable tbody tr[draggable="true"] {
      cursor: move;
    }

    #dataTable tbody tr.dragging {
      opacity: .5;
    }

    .table-responsive {
      overflow-x: auto;
    }
  </style>
@endpush

@section('content')
  <ul class="breadcrumb breadcrumb-top">
    <li><a href="/cp"><i class="fa fa-home"></i></a></li>
    <li><a href="{{ route('navbar.index') }}">{{ __('navbar::messages.navbar') }}</a></li>
  </ul>

  <div class="block full">
    <div class="block-title d-flex align-items-center justify-content-between">
      <h2 class="m-0"><strong>{{ __('navbar::messages.navbar') }}</strong></h2>
      <div class="block-options pull-right">
        <a href="{{ route('navbar.create') }}" class="btn btn-sm btn-primary">
          <i class="fa fa-plus me-1"></i> {{ __('navbar::messages.add') }}
        </a>
      </div>
    </div>

    <div class="table-responsive">
      <table class="table table-vcenter" id="dataTable">
        <thead class="table-light">
          <tr>
            <th style="width:42px" class="text-center">#</th>
            <th>{{ __('navbar::messages.slug') }}</th>
            <th>{{ __('navbar::messages.title') }}</th>
            <th class="text-center">{{ __('navbar::messages.status') }}</th>
            <th class="text-center">{{ __('navbar::messages.order') }}</th>
            <th class="text-end">{{ __('navbar::messages.actions') }}</th>
          </tr>
        </thead>
        <tbody id="sortableBody">
          @foreach($items as $row)
            <tr draggable="true" data-id="{{ $row->id }}">
              <td class="text-center fw-semibold">{{ $row->id }}</td>
              <td class="text-muted">{{ $row->slug }}</td>
              <td>{{ data_get($row->title, app()->getLocale(), data_get($row->title, 'en')) }}</td>
              <td class="text-center">
                <form action="{{ route('navbar.toggle', $row) }}" method="post" class="d-inline toggle-form">
                  @csrf
                  @if($row->status)
                    <span class="badge bg-success">{{ __('navbar::messages.active') }}</span>
                  @else
                    <span class="badge bg-secondary">{{ __('navbar::messages.inactive') }}</span>
                  @endif
                  <button type="submit" class="btn btn-sm btn-outline-secondary ms-2" data-bs-toggle="tooltip"
                    data-bs-title="{{ __('navbar::messages.toggle_status') }}">
                    <i class="fa fa-exchange"></i>
                  </button>
                </form>
              </td>
              <td class="text-center">
                <input type="number" class="form-control form-control-sm order-input mx-auto" value="{{ $row->order }}"
                  min="1" style="max-width:90px">
              </td>
              <td class="text-end">
                <div class="btn-group" role="group">
                  <a href="{{ route('navbar.edit', $row) }}" class="btn btn-sm btn-warning" data-bs-toggle="tooltip"
                    data-bs-title="{{ __('navbar::messages.edit') }}">
                    <i class="fa fa-pencil"></i>
                  </a>
                </div>
                <div class="btn-group" role="group">
                  <form action="{{ route('navbar.destroy', $row) }}" method="post"
                    onsubmit="return confirm('{{ __('navbar::messages.confirm_delete') }}')">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger" data-bs-toggle="tooltip"
                      data-bs-title="{{ __('navbar::messages.delete') }}">
                      <i class="fa fa-times"></i>
                    </button>
                  </form>
                </div>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>

    <div class="d-flex flex-column flex-md-row align-items-center justify-content-between small text-muted mt-2">
      <div class="mb-2 mb-md-0">
        <strong>{{ $items->firstItem() }}</strong>-<strong>{{ $items->lastItem() }}</strong>
        {{ __('navbar::messages.of') }} <strong>{{ $items->total() }}</strong>
      </div>
      <div>
        {{ $items->withQueryString()->links() }}
      </div>
    </div>

    <div class="d-flex gap-2 mt-3">
      <button id="saveOrderBtn" class="btn btn-primary btn-sm" disabled>
        <i class="fa fa-save me-1"></i> {{ __('navbar::messages.save_order') }}
      </button>
      <small class="text-muted">
        {{ __('navbar::messages.drag_drop_hint') }}
      </small>
    </div>
  </div>
@endsection

@push('scripts')
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      if (window.bootstrap) {
        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        tooltipTriggerList.map(el => new bootstrap.Tooltip(el));
      }

      const saveBtn = document.getElementById('saveOrderBtn');
      const tbody = document.getElementById('sortableBody');
      if (!saveBtn || !tbody) return;

      document.querySelectorAll('.order-input').forEach(inp => {
        inp.addEventListener('input', () => saveBtn.disabled = false);
      });

      let dragEl = null;
      tbody.addEventListener('dragstart', e => {
        const tr = e.target.closest('tr[draggable="true"]');
        if (!tr) return;
        dragEl = tr;
        tr.classList.add('dragging');
        tr.style.opacity = .5;
        if (e.dataTransfer) e.dataTransfer.setData('text/plain', '');
      });
      tbody.addEventListener('dragend', () => {
        if (dragEl) {
          dragEl.style.opacity = '';
          tr.classList.remove('dragging');
        }
        dragEl = null;
      });
      tbody.addEventListener('dragover', e => {
        e.preventDefault();
        const rows = [...tbody.querySelectorAll('tr:not(.dragging)')];
        const after = rows.reduce((c, child) => {
          const box = child.getBoundingClientRect();
          const offset = e.clientY - box.top - box.height / 2;
          return (offset < 0 && offset > c.offset) ? { offset, el: child } : c;
        }, { offset: Number.NEGATIVE_INFINITY, el: null }).el;
        if (!dragEl) return;
        if (!after) tbody.appendChild(dragEl);
        else if (after !== dragEl) tbody.insertBefore(dragEl, after);
      });
      tbody.addEventListener('drop', () => {
        saveBtn.disabled = false;
        [...tbody.querySelectorAll('tr')].forEach((tr, i) => {
          const inp = tr.querySelector('.order-input');
          if (inp) inp.value = (i + 1);
        });
      });

      document.getElementById('saveOrderBtn')?.addEventListener('click', async () => {
        const rows = [...tbody.querySelectorAll('tr')]
          .map(tr => ({ id: parseInt(tr.dataset.id, 10), order: Number(tr.querySelector('.order-input')?.value || 0) }))
          .filter(r => !Number.isNaN(r.id));
        saveBtn.disabled = true;
        try {
          const res = await fetch(@json(route('navbar.order', [], false)), {
            method: 'POST',
            credentials: 'same-origin',
            headers: {
              'Content-Type': 'application/json',
              'X-Requested-With': 'XMLHttpRequest',
              'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({ rows })
          });
          if (!res.ok) throw new Error(await res.text());
          const old = saveBtn.innerHTML;
          saveBtn.innerHTML = '<i class="fa fa-check me-1"></i> Saved';
          setTimeout(() => saveBtn.innerHTML = old, 1500);
        } catch (e) {
          alert('Saving failed. Check console/logs.');
          saveBtn.disabled = false;
        }
      });
    });
  </script>
@endpush