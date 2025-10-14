<?php $__env->startPush('title'); ?> <?php echo e(__('services::messages.services')); ?> <?php $__env->stopPush(); ?>

<?php $__env->startPush('styles'); ?>
<style>
    #servicesTable tbody tr[draggable="true"] { cursor: move; }
    #servicesTable tbody tr.dragging { opacity: .5; }
    .table-responsive { overflow-x: auto; }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<ul class="breadcrumb breadcrumb-top">
    <li><a href="/cp"><i class="fa fa-home"></i></a></li>
    <li><a href="<?php echo e(route('services.index')); ?>"><?php echo e(__('services::messages.services')); ?></a></li>
</ul>

<div class="block full">
    <div class="block-title d-flex align-items-center justify-content-between">
        <h2 class="m-0"><strong><?php echo e(__('services::messages.services')); ?></strong></h2>
        <div class="block-options pull-right">
            <a href="<?php echo e(route('services.create')); ?>" class="btn btn-sm btn-primary">
                <i class="fa fa-plus me-1"></i> <?php echo e(__('services::messages.add')); ?>

            </a>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-vcenter" id="servicesTable">
            <thead class="table-light">
                <tr>
                    <th style="width:42px" class="text-center">#</th>
                    <th><?php echo e(__('services::messages.name')); ?></th>
                    <th><?php echo e(__('services::messages.status')); ?></th>
                    <th class="text-center"><?php echo e(__('services::messages.order')); ?></th>
                    <th class="text-end"><?php echo e(__('services::messages.actions')); ?></th>
                </tr>
            </thead>
            <tbody id="sortableBody">
                <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr draggable="true" data-id="<?php echo e($row->id); ?>">
                        <td class="text-center fw-semibold"><?php echo e($row->id); ?></td>

                        <td>
                            <?php echo e(data_get($row->name, app()->getLocale(), data_get($row->name, 'en'))); ?>

                            <?php if($row->link): ?>
                                <br><small><a href="<?php echo e($row->link); ?>" target="_blank"><?php echo e(__('services::messages.link')); ?></a></small>
                            <?php endif; ?>
                            <?php if($row->features): ?>
                                <br><small><?php echo e(implode(', ', $row->features)); ?></small>
                            <?php endif; ?>
                        </td>

                        <td class="text-center">
                            <form action="<?php echo e(route('services.toggle', $row)); ?>" method="post" class="d-inline toggle-form">
                                <?php echo csrf_field(); ?>
                                <?php if($row->status): ?>
                                    <span class="badge bg-success"><?php echo e(__('services::messages.active')); ?></span>
                                <?php else: ?>
                                    <span class="badge bg-secondary"><?php echo e(__('services::messages.inactive')); ?></span>
                                <?php endif; ?>
                                <button type="submit" class="btn btn-sm btn-outline-secondary ms-2" data-bs-toggle="tooltip"
                                    data-bs-title="<?php echo e(__('services::messages.toggle_status')); ?>">
                                    <i class="fa fa-exchange"></i>
                                </button>
                            </form>
                        </td>

                        <td class="text-center">
                            <input type="number" class="form-control form-control-sm order-input mx-auto"
                                value="<?php echo e($row->order); ?>" min="1" data-id="<?php echo e($row->id); ?>" style="max-width:90px">
                        </td>

                        <td class="text-end">
                            <a href="<?php echo e(route('services.edit', $row)); ?>" class="btn btn-sm btn-warning">
                                <i class="fa fa-pencil"></i>
                            </a>
                            <form action="<?php echo e(route('services.destroy', $row)); ?>" method="post" class="d-inline"
                                onsubmit="return confirm('<?php echo e(__('services::messages.confirm_delete')); ?>')">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="btn btn-sm btn-danger">
                                    <i class="fa fa-times"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-between small text-muted mt-2">
        <div>
            <strong><?php echo e($items->firstItem()); ?></strong>-<strong><?php echo e($items->lastItem()); ?></strong>
            <?php echo e(__('services::messages.of')); ?> <strong><?php echo e($items->total()); ?></strong>
        </div>
        <div><?php echo e($items->withQueryString()->links()); ?></div>
    </div>

    <div class="d-flex gap-2 mt-3">
        <button id="saveOrderBtn" class="btn btn-primary btn-sm" disabled>
            <i class="fa fa-save me-1"></i> <?php echo e(__('services::messages.save_order')); ?>

        </button>
        <small class="text-muted"><?php echo e(__('services::messages.drag_drop_hint')); ?></small>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
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
            const res = await fetch("<?php echo e(route('services.order')); ?>", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({ rows })
            });
            if (!res.ok) throw new Error(await res.text());
            saveBtn.innerHTML = '<i class="fa fa-check me-1"></i> Saved';
            setTimeout(() => saveBtn.innerHTML = '<i class="fa fa-save me-1"></i> <?php echo e(__("services::messages.save_order")); ?>', 1500);
        } catch (err) {
            alert('Saving failed. Check console.');
            saveBtn.disabled = false;
            console.error(err);
        }
    });
});
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('core::layouts.backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Dr-Mai-El-Hakim\packages\Solutions\Services\src\Providers/../Resources/views/index.blade.php ENDPATH**/ ?>