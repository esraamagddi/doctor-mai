@extends('core::layouts.backend')

@push('title') {{ __('services::messages.services') }} @endpush

@push('styles')
<style>
    #servicesTable tbody tr[draggable="true"] { cursor: move; }
    #servicesTable tbody tr.dragging { opacity: .5; }
    .table-responsive { overflow-x: auto; }
</style>
@endpush

@section('content')
<ul class="breadcrumb breadcrumb-top">
    <li><a href="/cp"><i class="fa fa-home"></i></a></li>
    <li><a href="{{ route('services.index') }}">{{ __('services::messages.services') }}</a></li>
</ul>

<div class="block full">
    <div class="block-title d-flex align-items-center justify-content-between">
        <h2 class="m-0"><strong>{{ __('services::messages.services') }}</strong></h2>
        <div class="block-options pull-right">
            <a href="{{ route('services.create') }}" class="btn btn-sm btn-primary">
                <i class="fa fa-plus me-1"></i> {{ __('services::messages.add') }}
            </a>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-vcenter" id="servicesTable">
            <thead class="table-light">
                <tr>
                    <th style="width:42px" class="text-center">#</th>
                    <th>{{ __('services::messages.name') }}</th>
                    <th>{{ __('services::messages.status') }}</th>
                    <th class="text-center">{{ __('services::messages.order') }}</th>
                    <th class="text-end">{{ __('services::messages.actions') }}</th>
                </tr>
            </thead>
            <tbody id="sortableBody">
                @foreach($items as $row)
                    <tr draggable="true" data-id="{{ $row->id }}">
                        <td class="text-center fw-semibold">{{ $row->id }}</td>

                        <td>
                            {{ data_get($row->name, app()->getLocale(), data_get($row->name, 'en')) }}
                            @if($row->link)
                                <br><small><a href="{{ $row->link }}" target="_blank">{{ __('services::messages.link') }}</a></small>
                            @endif
                            @if($row->features)
                                <br><small>{{ implode(', ', $row->features) }}</small>
                            @endif
                        </td>

                        <td class="text-center">
                            <form action="{{ route('services.toggle', $row) }}" method="post" class="d-inline toggle-form">
                                @csrf
                                @if($row->status)
                                    <span class="badge bg-success">{{ __('services::messages.active') }}</span>
                                @else
                                    <span class="badge bg-secondary">{{ __('services::messages.inactive') }}</span>
                                @endif
                                <button type="submit" class="btn btn-sm btn-outline-secondary ms-2" data-bs-toggle="tooltip"
                                    data-bs-title="{{ __('services::messages.toggle_status') }}">
                                    <i class="fa fa-exchange"></i>
                                </button>
                            </form>
                        </td>

                        <td class="text-center">
                            <input type="number" class="form-control form-control-sm order-input mx-auto"
                                value="{{ $row->order }}" min="1" data-id="{{ $row->id }}" style="max-width:90px">
                        </td>

                        <td class="text-end">
                            <a href="{{ route('services.edit', $row) }}" class="btn btn-sm btn-warning">
                                <i class="fa fa-pencil"></i>
                            </a>
                            <form action="{{ route('services.destroy', $row) }}" method="post" class="d-inline"
                                onsubmit="return confirm('{{ __('services::messages.confirm_delete') }}')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">
                                    <i class="fa fa-times"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-between small text-muted mt-2">
        <div>
            <strong>{{ $items->firstItem() }}</strong>-<strong>{{ $items->lastItem() }}</strong>
            {{ __('services::messages.of') }} <strong>{{ $items->total() }}</strong>
        </div>
        <div>{{ $items->withQueryString()->links() }}</div>
    </div>

    <div class="d-flex gap-2 mt-3">
        <button id="saveOrderBtn" class="btn btn-primary btn-sm" disabled>
            <i class="fa fa-save me-1"></i> {{ __('services::messages.save_order') }}
        </button>
        <small class="text-muted">{{ __('services::messages.drag_drop_hint') }}</small>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
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
        e.dataTransfer.setData('text/plain', '');
    });

    tbody.addEventListener('dragend', () => {
        if (dragEl) dragEl.classList.remove('dragging');
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
            if (offset < 0 && offset > closest.offset) {
                return { offset, element: child };
            }
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
            id: parseInt(tr.dataset.id, 10),
            order: Number(tr.querySelector('.order-input')?.value || 0)
        }));

        saveBtn.disabled = true;

        try {
            const res = await fetch("{{ route('services.order') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({ rows })
            });
            if (!res.ok) throw new Error(await res.text());
            saveBtn.innerHTML = '<i class="fa fa-check me-1"></i> Saved';
            setTimeout(() => saveBtn.innerHTML = '<i class="fa fa-save me-1"></i> {{ __("services::messages.save_order") }}', 1500);
        } catch (err) {
            alert('Saving failed. Check console.');
            saveBtn.disabled = false;
            console.error(err);
        }
    });
});
</script>
@endpush
