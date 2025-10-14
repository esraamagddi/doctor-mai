<?php $__env->startPush('title'); ?> <?php echo e(__('appointments::messages.title')); ?> <?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
  <ul class="breadcrumb breadcrumb-top">
    <li><a href="/cp"><i class="fa fa-home"></i></a></li>
    <li><?php echo e(__('appointments::messages.title')); ?></li>
  </ul>

  <div class="block full">
    <div class="block-title d-flex align-items-center justify-content-between">
      <h2 class="m-0"><strong><?php echo e(__('appointments::messages.title')); ?></strong></h2>
      <div class="block-options pull-right">
        <a href="<?php echo e(route('appointments.create')); ?>" class="btn btn-sm btn-success">
          <i class="fa fa-plus me-1"></i> <?php echo e(__('appointments::messages.add')); ?>

        </a>
      </div>
    </div>

    <form method="GET" class="row mb-3">
      <div class="col-md-3">
        <input type="date" name="date" value="<?php echo e(request('date')); ?>" class="form-control"
          placeholder="<?php echo e(__('appointments::messages.date')); ?>">
      </div>

      <div class="col-md-3">
        <select name="service_id" class="form-control">
          <option value=""><?php echo e(__('appointments::messages.all_services')); ?></option>
          <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($s->id); ?>" <?php echo e(request('service_id') == $s->id ? 'selected' : ''); ?>>
              <?php echo e($s->name['ar'] ?? $s->name['en']); ?>

            </option>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
      </div>

      <div class="col-md-3">
        <select name="status" class="form-control">
          <option value=""><?php echo e(__('appointments::messages.all_statuses')); ?></option>
          <?php $__currentLoopData = ['pending', 'confirmed', 'completed', 'canceled', 'no_show']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $st): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($st); ?>" <?php echo e(request('status') === $st ? 'selected' : ''); ?>>
              <?php echo e(__('appointments::messages.statuses.' . $st)); ?>

            </option>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
      </div>

      <div class="col-md-2">
        <button class="btn btn-default"><?php echo e(__('appointments::messages.filter')); ?></button>
      </div>
    </form>

    <div class="table-responsive">
      <table class="table table-bordered table-striped">
        <thead>
          <tr>
            <th><?php echo e(__('appointments::messages.id')); ?></th>
            <th><?php echo e(__('appointments::messages.patient')); ?></th>
            <th><?php echo e(__('appointments::messages.service')); ?></th>
            <th><?php echo e(__('appointments::messages.date')); ?></th>
            <th><?php echo e(__('appointments::messages.time')); ?></th>
            <th><?php echo e(__('appointments::messages.status')); ?></th>
            <th class="text-end"><?php echo e(__('appointments::messages.actions')); ?></th>
          </tr>
        </thead>
        <tbody>
          <?php $__empty_1 = true; $__currentLoopData = $appointments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $a): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr>
              <td><?php echo e($a->id); ?></td>
              <td><?php echo e($a->patient->name['ar'] ?? $a->patient->name['en'] ?? '-'); ?></td>
              <td><?php echo e($a->service->name['ar'] ?? $a->service->name['en'] ?? '-'); ?></td>
              <td><?php echo e(optional($a->preferred_date)->format('Y-m-d') ?? '-'); ?></td>
              <td><?php echo e($a->preferred_time ?? '-'); ?></td>
              <td><?php echo e(__('appointments::messages.statuses.' . ($a->status ?? 'pending'))); ?></td>
              <td class="text-end">
                <div class="btn-group" role="group">
                  <form method="POST" action="<?php echo e(route('appointments.confirm', $a->id)); ?>" class="d-inline">
                    <?php echo csrf_field(); ?>
                    <button class="btn btn-sm btn-info"><?php echo e(__('appointments::messages.confirm')); ?></button>
                  </form>
                </div>
                <div class="btn-group" role="group">
                  <form method="POST" action="<?php echo e(route('appointments.cancel', $a->id)); ?>" class="d-inline">
                    <?php echo csrf_field(); ?>
                    <button class="btn btn-sm btn-warning"><?php echo e(__('appointments::messages.cancel')); ?></button>
                  </form>
                </div>
                <div class="btn-group" role="group">
                  <form method="POST" action="<?php echo e(route('appointments.complete', $a->id)); ?>" class="d-inline">
                    <?php echo csrf_field(); ?>
                    <button class="btn btn-sm btn-success"><?php echo e(__('appointments::messages.complete')); ?></button>
                  </form>
                </div>
                <div class="btn-group" role="group">
                  <a href="<?php echo e(route('appointments.edit', $a->id)); ?>" class="btn btn-sm btn-info">
                    <?php echo e(__('appointments::messages.edit_btn')); ?>

                  </a>
                </div>
                <div class="btn-group" role="group">
                  <form method="POST" action="<?php echo e(route('appointments.destroy', $a->id)); ?>" class="d-inline">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('DELETE'); ?>
                    <button class="btn btn-sm btn-danger"
                      onclick="return confirm('<?php echo e(__('appointments::messages.are_you_sure_delete')); ?>')">
                      <?php echo e(__('appointments::messages.delete')); ?>

                    </button>
                  </form>
                </div>
              </td>
            </tr>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <tr>
              <td colspan="7" class="text-center text-muted"><?php echo e(__('appointments::messages.no_records')); ?></td>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>

    <?php echo e($appointments->links()); ?>

  </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('core::layouts.backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Dr-Mai-El-Hakim\packages\Solutions\Appointments\src\Providers/../Resources/views/index.blade.php ENDPATH**/ ?>