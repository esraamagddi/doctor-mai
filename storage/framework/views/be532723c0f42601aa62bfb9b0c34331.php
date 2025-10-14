<?php $__env->startPush('title'); ?> <?php echo e(__('media::messages.videos')); ?> <?php $__env->stopPush(); ?>

<?php $__env->startPush('styles'); ?>
<style>
#dataTable tbody tr[draggable="true"] { cursor: move; }
#dataTable tbody tr.dragging { opacity: .5; }
.table-responsive { overflow-x: auto; }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<ul class="breadcrumb breadcrumb-top">
    <li><a href="/cp"><i class="fa fa-home"></i></a></li>
    <li><a href="<?php echo e(route('media.videos.index')); ?>"><?php echo e(__('media::messages.videos')); ?></a></li>
</ul>

<div class="block full">
    <div class="block-title d-flex align-items-center justify-content-between">
        <h2 class="m-0"><strong><?php echo e(__('media::messages.videos')); ?></strong></h2>
        <div class="block-options pull-right">
            <a href="<?php echo e(route('media.videos.create')); ?>" class="btn btn-sm btn-primary">
                <i class="fa fa-plus me-1"></i> <?php echo e(__('media::messages.add')); ?>

            </a>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-vcenter" id="dataTable">
            <thead class="table-light">
                <tr>
                    <th style="width:42px" class="text-center">#</th>
                    <th><?php echo e(__('media::messages.title')); ?></th>
                    <th><?php echo e(__('media::messages.category')); ?></th>
                    <th class="text-center"><?php echo e(__('media::messages.status')); ?></th>
                    <th class="text-center"><?php echo e(__('media::messages.order')); ?></th>
                    <th class="text-end"><?php echo e(__('media::messages.actions')); ?></th>
                </tr>
            </thead>
            <tbody id="sortableBody">
                <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr draggable="true" data-id="<?php echo e($row->id); ?>">
                        <td class="text-center fw-semibold"><?php echo e($row->id); ?></td>
                        <td><?php echo e(data_get($row->title, app()->getLocale(), data_get($row->title, 'en'))); ?></td>
                        <td><?php echo e(data_get($row->category, 'name.' . app()->getLocale(), data_get($row->category, 'name.en', '-'))); ?></td>
                        <td class="text-center">
                            <form action="<?php echo e(route('media.videos.toggle', $row)); ?>" method="post" class="d-inline toggle-form">
                                <?php echo csrf_field(); ?>
                                <?php if($row->status): ?>
                                    <span class="badge bg-success"><?php echo e(__('media::messages.active')); ?></span>
                                <?php else: ?>
                                    <span class="badge bg-secondary"><?php echo e(__('media::messages.inactive')); ?></span>
                                <?php endif; ?>
                                <button type="submit" class="btn btn-sm btn-outline-secondary ms-2" data-bs-toggle="tooltip"
                                    data-bs-title="<?php echo e(__('media::messages.toggle_status')); ?>" aria-label="<?php echo e(__('media::messages.toggle_status')); ?>">
                                    <i class="fa fa-exchange"></i>
                                </button>
                            </form>
                        </td>
                        <td class="text-center">
                            <input type="number" class="form-control form-control-sm order-input mx-auto"
                                value="<?php echo e($row->order); ?>" min="1" data-id="<?php echo e($row->id); ?>" style="max-width:90px"
                                aria-label="<?php echo e(__('media::messages.item_order', ['id' => $row->id])); ?>">
                        </td>
                        <td class="text-end">
                            <div class="btn-group" role="group">
                                <a href="<?php echo e(route('media.videos.edit', $row)); ?>" class="btn btn-sm btn-warning"
                                    data-bs-toggle="tooltip" data-bs-title="<?php echo e(__('media::messages.edit')); ?>"
                                    aria-label="<?php echo e(__('media::messages.edit')); ?>">
                                    <i class="fa fa-pencil"></i>
                                </a>
                            </div>
                            <div class="btn-group" role="group">
                                <form action="<?php echo e(route('media.videos.destroy', $row)); ?>" method="post"
                                    onsubmit="return confirm('<?php echo e(__('media::messages.confirm_delete')); ?>')">
                                    <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="btn btn-sm btn-danger" data-bs-toggle="tooltip"
                                        data-bs-title="<?php echo e(__('media::messages.delete')); ?>" aria-label="<?php echo e(__('media::messages.delete')); ?>">
                                        <i class="fa fa-times"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>

    <div class="d-flex flex-column flex-md-row align-items-center justify-content-between small text-muted mt-2">
        <div class="mb-2 mb-md-0">
            <strong><?php echo e($items->firstItem()); ?></strong>-<strong><?php echo e($items->lastItem()); ?></strong>
            <?php echo e(__('media::messages.of')); ?> <strong><?php echo e($items->total()); ?></strong>
        </div>
        <div>
            <?php echo e($items->withQueryString()->links()); ?>

        </div>
    </div>

    <div class="d-flex gap-2 mt-3">
        <button id="saveOrderBtn" class="btn btn-primary btn-sm" disabled>
            <i class="fa fa-save me-1"></i> <?php echo e(__('media::messages.save_order')); ?>

        </button>
        <small class="text-muted">
            <?php echo e(__('media::messages.drag_drop_hint')); ?>

        </small>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
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
    [...tbody.querySelectorAll('tr')].forEach((tr, i) => {
      const inp = tr.querySelector('.order-input');
      if (inp) inp.value = (i + 1);
    });
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

  document.getElementById('saveOrderBtn')?.addEventListener('click', async () => {
    const rows = [...tbody.querySelectorAll('tr')]
      .map(tr => ({ id: parseInt(tr.dataset.id, 10), order: Number(tr.querySelector('.order-input')?.value || 0) }))
      .filter(r => !Number.isNaN(r.id));
    saveBtn.disabled = true;
    try {
      const res = await fetch(<?php echo json_encode(route('media.videos.order', [], false)) ?>, {
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
<?php $__env->stopPush(); ?>

<?php echo $__env->make('core::layouts.backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Dr-Mai-El-Hakim\packages\Solutions\Media\src\Providers/../Resources/views/videos/index.blade.php ENDPATH**/ ?>