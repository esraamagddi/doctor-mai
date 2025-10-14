<?php $__env->startPush('title'); ?> <?php echo e(__('blog::messages.blog_posts')); ?> <?php $__env->stopPush(); ?>

<?php $__env->startPush('styles'); ?>
    <style>
        .table-responsive { overflow-x: auto; }
        #postsTable tbody tr[draggable="true"] { cursor: move; }
        #postsTable tbody tr.dragging { opacity: .5; }
    </style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<ul class="breadcrumb breadcrumb-top">
    <li><a href="/cp"><i class="fa fa-home"></i></a></li>
    <li><?php echo e(__('blog::messages.blog')); ?></li>
    <li><?php echo e(__('blog::messages.posts')); ?></li>
</ul>

<div class="block full">
    <div class="block-title d-flex align-items-center justify-content-between">
        <h2 class="m-0"><strong><?php echo e(__('blog::messages.posts')); ?></strong></h2>
        <div class="block-options pull-right">
            <a href="<?php echo e(route('blog.posts.create')); ?>" class="btn btn-sm btn-success">
                <i class="fa fa-plus me-1"></i> <?php echo e(__('blog::messages.add')); ?>

            </a>
        </div>
    </div>

    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <div class="table-responsive">
        <table class="table table-bordered table-striped" id="postsTable">
            <thead class="table-light">
                <tr>
                    <th style="width:42px" class="text-center">#</th>
                    <th><?php echo e(__('blog::messages.title')); ?> (EN)</th>
                    <th><?php echo e(__('blog::messages.category')); ?></th>
                    <th class="text-center"><?php echo e(__('blog::messages.status')); ?></th>
                    <th class="text-center"><?php echo e(__('blog::messages.order')); ?></th>
                    <th class="text-end"><?php echo e(__('blog::messages.actions')); ?></th>
                </tr>
            </thead>
            <tbody id="sortableBody">
                <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr draggable="true" data-id="<?php echo e($item->id); ?>">
                        <td class="text-center fw-semibold"><?php echo e($item->id); ?></td>
                        <td><?php echo e(data_get($item->title,'en') ?? '-'); ?></td>
                        <td><?php echo e(optional($item->category)->name['en'] ?? '-'); ?></td>
                        <td class="text-center">
                            <form action="<?php echo e(route('blog.posts.toggle', $item)); ?>" method="post" class="d-inline toggle-form">
                                <?php echo csrf_field(); ?>
                                <?php if($item->status): ?>
                                    <span class="badge bg-success"><?php echo e(__('blog::messages.active')); ?></span>
                                <?php else: ?>
                                    <span class="badge bg-secondary"><?php echo e(__('blog::messages.inactive')); ?></span>
                                <?php endif; ?>
                                <button type="submit" class="btn btn-sm btn-outline-secondary ms-2" data-bs-toggle="tooltip"
                                    data-bs-title="<?php echo e(__('blog::messages.toggle_status')); ?>">
                                    <i class="fa fa-exchange"></i>
                                </button>
                            </form>
                        </td>
                        <td class="text-center">
                            <input type="number" class="form-control form-control-sm order-input mx-auto"
                                value="<?php echo e($item->order); ?>" min="1" data-id="<?php echo e($item->id); ?>" style="max-width:90px">
                        </td>
                        <td class="text-end">
                            <div class="btn-group" role="group">
                                <a href="<?php echo e(route('blog.posts.edit', $item)); ?>" class="btn btn-sm btn-warning"
                                   data-bs-toggle="tooltip" title="<?php echo e(__('blog::messages.edit')); ?>">
                                    <i class="fa fa-pencil"></i>
                                </a>
                              </div>
                              <div class="btn-group" role="group">
                                <form action="<?php echo e(route('blog.posts.destroy', $item)); ?>" method="post"
                                      onsubmit="return confirm('<?php echo e(__('blog::messages.delete_confirm')); ?>')">
                                    <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="btn btn-sm btn-danger" data-bs-toggle="tooltip"
                                            title="<?php echo e(__('blog::messages.delete')); ?>">
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
            of <strong><?php echo e($items->total()); ?></strong>
        </div>
        <div>
            <?php echo e($items->withQueryString()->links()); ?>

        </div>
    </div>

    <div class="d-flex gap-2 mt-3">
        <button id="saveOrderBtn" class="btn btn-primary btn-sm" disabled>
            <i class="fa fa-save me-1"></i> <?php echo e(__('blog::messages.save_order')); ?>

        </button>
        <small class="text-muted">
            <?php echo e(__('blog::messages.drag_drop_rows')); ?>

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
      const res = await fetch(<?php echo json_encode(route('blog.posts.order', [], false)) ?>, {
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
<?php $__env->stopPush(); ?>

<?php echo $__env->make('core::layouts.backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Dr-Mai-El-Hakim\packages\Solutions\Blog\src\Providers/../Resources/views/posts/index.blade.php ENDPATH**/ ?>