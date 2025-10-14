@extends('core::layouts.backend')

@push('title') {{ __('media::messages.video_categories') }} @endpush

@push('styles')
<style>
#dataTable tbody tr[draggable="true"] { cursor: move; }
#dataTable tbody tr.dragging { opacity: .5; }
.table-responsive { overflow-x: auto; }
</style>
@endpush

@section('content')
<ul class="breadcrumb breadcrumb-top">
    <li><a href="/cp"><i class="fa fa-home"></i></a></li>
    <li><a href="{{ route('media.video_categories.index') }}">{{ __('media::messages.video_categories') }}</a></li>
</ul>

<div class="block full">
    <div class="block-title d-flex align-items-center justify-content-between">
        <h2 class="m-0"><strong>{{ __('media::messages.video_categories') }}</strong></h2>
        <div class="block-options pull-right">
            <a href="{{ route('media.video_categories.create') }}" class="btn btn-sm btn-primary">
                <i class="fa fa-plus me-1"></i> {{ __('media::messages.add') }}
            </a>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-vcenter" id="dataTable">
            <thead class="table-light">
                <tr>
                    <th style="width:42px" class="text-center">#</th>
                    <th>{{ __('media::messages.name') }}</th>
                    <th class="text-center">{{ __('media::messages.status') }}</th>
                    <th class="text-center">{{ __('media::messages.order') }}</th>
                    <th class="text-end">{{ __('media::messages.actions') }}</th>
                </tr>
            </thead>
            <tbody id="sortableBody">
                @foreach($items as $row)
                    <tr draggable="true" data-id="{{ $row->id }}">
                        <td class="text-center fw-semibold">{{ $row->id }}</td>
                        <td>{{ data_get($row->name, app()->getLocale(), data_get($row->name, 'en')) }}</td>
                        <td class="text-center">
                            <form action="{{ route('media.video_categories.toggle', $row) }}" method="post" class="d-inline toggle-form">
                                @csrf
                                @if($row->status)
                                    <span class="badge bg-success">{{ __('media::messages.active') }}</span>
                                @else
                                    <span class="badge bg-secondary">{{ __('media::messages.inactive') }}</span>
                                @endif
                                <button type="submit" class="btn btn-sm btn-outline-secondary ms-2" data-bs-toggle="tooltip"
                                    data-bs-title="{{ __('media::messages.toggle_status') }}" aria-label="{{ __('media::messages.toggle_status') }}">
                                    <i class="fa fa-exchange"></i>
                                </button>
                            </form>
                        </td>
                        <td class="text-center">
                            <input type="number" class="form-control form-control-sm order-input"
                                value="{{ $row->order }}" min="1" data-id="{{ $row->id }}" style="max-width:90px; margin:1px auto;"
                                aria-label="{{ __('media::messages.item_order', ['id' => $row->id]) }}">
                        </td>
                        <td class="text-end">
                            <div class="btn-group" role="group">
                                <a href="{{ route('media.video_categories.edit', $row) }}" class="btn btn-sm btn-warning"
                                    data-bs-toggle="tooltip" data-bs-title="{{ __('media::messages.edit') }}">
                                    <i class="fa fa-pencil"></i>
                                </a>
                            </div>
                            <div class="btn-group" role="group">
                                <form action="{{ route('media.video_categories.destroy', $row) }}" method="post" class="d-inline"
                                    onsubmit="return confirm('{{ __('media::messages.confirm_delete') }}')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" data-bs-toggle="tooltip"
                                        data-bs-title="{{ __('media::messages.delete') }}" aria-label="{{ __('media::messages.delete') }}">
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
            {{ __('media::messages.of') }} <strong>{{ $items->total() }}</strong>
        </div>
        <div>
            {{ $items->withQueryString()->links() }}
        </div>
    </div>

    <div class="d-flex gap-2 mt-3">
        <button id="saveOrderBtn" class="btn btn-primary btn-sm" disabled>
            <i class="fa fa-save me-1"></i> {{ __('media::messages.save_order') }}
        </button>
        <small class="text-muted">
            {{ __('media::messages.drag_drop_hint') }}
        </small>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
  const tbody = document.getElementById('sortableBody');
  const saveBtn = document.getElementById('saveOrderBtn');

  tbody.addEventListener('dragstart', e => {
    if (e.target.matches('tr[draggable="true"]')) e.target.classList.add('dragging');
  });
  tbody.addEventListener('dragend', e => {
    if (e.target.matches('tr[draggable="true"]')) e.target.classList.remove('dragging');
  });
  tbody.addEventListener('dragover', e => {
    e.preventDefault();
    const dragging = tbody.querySelector('.dragging');
    const afterElement = getDragAfterElement(tbody, e.clientY);
    if (afterElement == null) {
      tbody.appendChild(dragging);
    } else {
      tbody.insertBefore(dragging, afterElement);
    }
  });

  function getDragAfterElement(container, y) {
    const elements = [...container.querySelectorAll('tr[draggable="true"]:not(.dragging)')];
    return elements.reduce((closest, child) => {
      const box = child.getBoundingClientRect();
      const offset = y - box.top - box.height / 2;
      if (offset < 0 && offset > closest.offset) {
        return { offset: offset, element: child };
      } else {
        return closest;
      }
    }, { offset: Number.NEGATIVE_INFINITY }).element;
  }

  saveBtn.addEventListener('click', async () => {
    const rows = {};
    tbody.querySelectorAll('tr[draggable="true"]').forEach((tr, idx) => {
      const id = tr.getAttribute('data-id');
      const input = tr.querySelector('.order-input');
      if (id && input) rows[id] = parseInt(input.value || (idx + 1), 10);
    });
    try {
      saveBtn.disabled = true;
      const res = await fetch('{{ route('media.video_categories.order') }}', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': '{{ csrf_token() }}'
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
