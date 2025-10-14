@extends('core::layouts.backend')

@push('title') {{ __('blog::messages.blog_posts') }} @endpush

@push('styles')
    <style>
        .table-responsive { overflow-x: auto; }
        #postsTable tbody tr[draggable="true"] { cursor: move; }
        #postsTable tbody tr.dragging { opacity: .5; }
    </style>
@endpush

@section('content')
<ul class="breadcrumb breadcrumb-top">
    <li><a href="/cp"><i class="fa fa-home"></i></a></li>
    <li>{{ __('blog::messages.blog') }}</li>
    <li>{{ __('blog::messages.posts') }}</li>
</ul>

<div class="block full">
    <div class="block-title d-flex align-items-center justify-content-between">
        <h2 class="m-0"><strong>{{ __('blog::messages.posts') }}</strong></h2>
        <div class="block-options pull-right">
            <a href="{{ route('blog.posts.create') }}" class="btn btn-sm btn-success">
                <i class="fa fa-plus me-1"></i> {{ __('blog::messages.add') }}
            </a>
        </div>
    </div>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <div class="table-responsive">
        <table class="table table-bordered table-striped" id="postsTable">
            <thead class="table-light">
                <tr>
                    <th style="width:42px" class="text-center">#</th>
                    <th>{{ __('blog::messages.title') }} (EN)</th>
                    <th>{{ __('blog::messages.category') }}</th>
                    <th class="text-center">{{ __('blog::messages.status') }}</th>
                    <th class="text-center">{{ __('blog::messages.order') }}</th>
                    <th class="text-end">{{ __('blog::messages.actions') }}</th>
                </tr>
            </thead>
            <tbody id="sortableBody">
                @foreach($items as $item)
                    <tr draggable="true" data-id="{{ $item->id }}">
                        <td class="text-center fw-semibold">{{ $item->id }}</td>
                        <td>{{ data_get($item->title,'en') ?? '-' }}</td>
                        <td>{{ optional($item->category)->name['en'] ?? '-' }}</td>
                        <td class="text-center">
                            <form action="{{ route('blog.posts.toggle', $item) }}" method="post" class="d-inline toggle-form">
                                @csrf
                                @if($item->status)
                                    <span class="badge bg-success">{{ __('blog::messages.active') }}</span>
                                @else
                                    <span class="badge bg-secondary">{{ __('blog::messages.inactive') }}</span>
                                @endif
                                <button type="submit" class="btn btn-sm btn-outline-secondary ms-2" data-bs-toggle="tooltip"
                                    data-bs-title="{{ __('blog::messages.toggle_status') }}">
                                    <i class="fa fa-exchange"></i>
                                </button>
                            </form>
                        </td>
                        <td class="text-center">
                            <input type="number" class="form-control form-control-sm order-input mx-auto"
                                value="{{ $item->order }}" min="1" data-id="{{ $item->id }}" style="max-width:90px">
                        </td>
                        <td class="text-end">
                            <div class="btn-group" role="group">
                                <a href="{{ route('blog.posts.edit', $item) }}" class="btn btn-sm btn-warning"
                                   data-bs-toggle="tooltip" title="{{ __('blog::messages.edit') }}">
                                    <i class="fa fa-pencil"></i>
                                </a>
                              </div>
                              <div class="btn-group" role="group">
                                <form action="{{ route('blog.posts.destroy', $item) }}" method="post"
                                      onsubmit="return confirm('{{ __('blog::messages.delete_confirm') }}')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" data-bs-toggle="tooltip"
                                            title="{{ __('blog::messages.delete') }}">
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
            of <strong>{{ $items->total() }}</strong>
        </div>
        <div>
            {{ $items->withQueryString()->links() }}
        </div>
    </div>

    <div class="d-flex gap-2 mt-3">
        <button id="saveOrderBtn" class="btn btn-primary btn-sm" disabled>
            <i class="fa fa-save me-1"></i> {{ __('blog::messages.save_order') }}
        </button>
        <small class="text-muted">
            {{ __('blog::messages.drag_drop_rows') }}
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
    return rows.reduce((closest, child) => {
      const box = child.getBoundingClientRect();
      const offset = y - box.top - (box.height / 2);
      if (offset < 0 && offset > closest.offset) return { offset, element: child };
      return closest;
    }, { offset: Number.NEGATIVE_INFINITY, element: null }).element;
  }

  function reindexInputs() {
    [...tbody.querySelectorAll('tr')].forEach((tr, i) => {
      const inp = tr.querySelector('.order-input');
      if (inp) inp.value = (i + 1);
    });
  }

  saveBtn.addEventListener('click', async () => {
    const rows = [...tbody.querySelectorAll('tr')].map(tr => ({
        id: tr.dataset.id ? parseInt(tr.dataset.id, 10) : null,
        order: Number(tr.querySelector('.order-input')?.value || 0)
      }))
      .filter(r => r.id !== null);

    saveBtn.disabled = true;

    try {
      const res = await fetch(@json(route('blog.posts.order', [], false)), {
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
      console.error(e);
      saveBtn.disabled = false;
    }
  });
});
</script>
@endpush
