@extends('core::layouts.backend')

@push('title') {{ __('team::messages.team') }} @endpush

@push('styles')
    <style>
        /* Minor UI touches */
        #teamTable tbody tr[draggable="true"] {
            cursor: move;
        }

        #teamTable tbody tr.dragging {
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
        <li><a href="{{ route('team.index') }}">{{ __('team::messages.team') }}</a></li>
    </ul>

    <div class="block full">
        <div class="block-title d-flex align-items-center justify-content-between">
            <h2 class="m-0"><strong>{{ __('team::messages.team') }}</strong></h2>
            <div class="block-options pull-right">
                <a href="{{ route('team.create') }}" class="btn btn-sm btn-primary">
                    <i class="fa fa-plus me-1"></i> {{ __('team::messages.add') }}
                </a>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-vcenter" id="teamTable">
                <thead class="table-light">
                    <tr>
                        <th style="width:42px" class="text-center">#</th>
                        <th>{{ __('team::messages.name') }}</th>
                        <th>{{ __('team::messages.job_title') }}</th>
                        <th class="text-center">{{ __('team::messages.status') }}</th>
                        <th class="text-center">{{ __('team::messages.order') }}</th>
                        <th class="text-end">{{ __('team::messages.actions') }}</th>
                    </tr>
                </thead>
                <tbody id="sortableBody">
                    @foreach($items as $row)
                        <tr draggable="true" data-id="{{ $row->id }}">
                            <td class="text-center fw-semibold">{{ $row->id }}</td>

                            <td>{{ data_get($row->name, app()->getLocale(), data_get($row->name, 'en')) }}</td>

                            <td class="text-muted">
                                {{ data_get($row->job_title, app()->getLocale(), data_get($row->job_title, 'en')) }}
                            </td>

                            <td class="text-center">
                                <form action="{{ route('team.toggle', $row) }}" method="post" class="d-inline toggle-form">
                                    @csrf
                                    @if($row->status)
                                        <span class="badge bg-success">{{ __('team::messages.active') }}</span>
                                    @else
                                        <span class="badge bg-secondary">{{ __('team::messages.inactive') }}</span>
                                    @endif
                                    <button type="submit" class="btn btn-sm btn-outline-secondary ms-2" data-bs-toggle="tooltip"
                                        data-bs-title="{{ __('team::messages.toggle_status') }}"
                                        aria-label="{{ __('team::messages.toggle_status') }}">
                                        <i class="fa fa-exchange"></i>
                                    </button>
                                </form>
                            </td>

                            <td class="text-center">
                                <input type="number" class="form-control form-control-sm order-input mx-auto"
                                    value="{{ $row->order }}" min="1" data-id="{{ $row->id }}" style="max-width:90px"
                                    aria-label="{{ __('team::messages.item_order', ['id' => $row->id]) }}">
                            </td>

                            <td class="text-end">
                                <div class="btn-group" role="group" aria-label="{{ __('team::messages.actions') }}">
                                    <a href="{{ route('team.edit', $row) }}" class="btn btn-sm btn-warning"
                                        data-bs-toggle="tooltip" data-bs-title="{{ __('team::messages.edit') }}"
                                        aria-label="{{ __('team::messages.edit') }}">
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                </div>
                                <div class="btn-group" role="group">
                                    <form action="{{ route('team.destroy', $row) }}" method="post"
                                        onsubmit="return confirm('{{ __('team::messages.confirm_delete') }}')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" data-bs-toggle="tooltip"
                                            data-bs-title="{{ __('team::messages.delete') }}"
                                            aria-label="{{ __('team::messages.delete') }}">
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
                {{ __('team::messages.of') }} <strong>{{ $items->total() }}</strong>
            </div>
            <div>
                {{ $items->withQueryString()->links() }}
            </div>
        </div>

        <div class="d-flex gap-2 mt-3">
            <button id="saveOrderBtn" class="btn btn-primary btn-sm" disabled>
                <i class="fa fa-save me-1"></i> {{ __('team::messages.save_order') }}
            </button>
            <small class="text-muted">
                {{ __('team::messages.drag_drop_hint') }}
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
  const tbody  = document.getElementById('sortableBody');
  if (!saveBtn || !tbody) return;

  // فعل الزر عند أي تغيير
  document.querySelectorAll('.order-input').forEach(inp => {
    inp.addEventListener('input', () => saveBtn.disabled = false);
  });

  // Drag & Drop
  let dragEl = null;

  tbody.addEventListener('dragstart', e => {
    const tr = e.target.closest('tr[draggable="true"]');
    if (!tr) return;
    dragEl = tr;
    tr.classList.add('dragging');
    tr.style.opacity = .5;
    // تمنع بعض المتصفحات من تجاهل السحب
    if (e.dataTransfer) e.dataTransfer.setData('text/plain', '');
  });

  tbody.addEventListener('dragend', () => {
    if (dragEl) {
      dragEl.style.opacity = '';
      dragEl.classList.remove('dragging');
    }
    dragEl = null;
  });

  tbody.addEventListener('dragover', e => {
    e.preventDefault();
    const afterEl = getRowAfter(tbody, e.clientY);
    if (!dragEl) return;
    if (!afterEl) tbody.appendChild(dragEl);
    else if (afterEl !== dragEl) tbody.insertBefore(dragEl, afterEl);
  });

  tbody.addEventListener('drop', () => {
    saveBtn.disabled = false;
    reindexInputs();
  });

  function getRowAfter(container, y) {
    const rows = [...container.querySelectorAll('tr:not(.dragging)')];
    const res = rows.reduce((closest, child) => {
      const box = child.getBoundingClientRect();
      const offset = y - box.top - (box.height / 2);
      if (offset < 0 && offset > closest.offset) return { offset, element: child };
      return closest;
    }, { offset: Number.NEGATIVE_INFINITY, element: null });
    return res.element;
  }

  function reindexInputs() {
    [...tbody.querySelectorAll('tr')].forEach((tr, i) => {
      const inp = tr.querySelector('.order-input');
      if (inp) inp.value = (i + 1);
    });
  }

  // حفظ الترتيب
  saveBtn.addEventListener('click', async () => {
    const rows = [...tbody.querySelectorAll('tr')]
      .map(tr => ({
        id: tr.dataset.id ? parseInt(tr.dataset.id, 10) : null,
        order: Number(tr.querySelector('.order-input')?.value || 0)
      }))
      .filter(r => r.id !== null);

    saveBtn.disabled = true;

    try {
      const res = await fetch(@json(route('team.order', [], false)), { // URL نسبي لتفادي http
        method: 'POST',
        credentials: 'same-origin', // مهم للجلسة/الكوكيز
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
      console.error(e);
      saveBtn.disabled = false;
    }
  });
});
</script>

@endpush