<?php $__env->startPush('title'); ?> <?php echo e(__('appointments::messages.patients')); ?> <?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
  <ul class="breadcrumb breadcrumb-top">
    <li><a href="/cp"><i class="fa fa-home"></i></a></li>
    <li><?php echo e(__('appointments::messages.patients')); ?></li>
  </ul>

  <div class="block full">
    <div class="block-title d-flex align-items-center justify-content-between">
      <h2 class="m-0"><strong><?php echo e(__('appointments::messages.patients')); ?></strong></h2>
      <div class="block-options pull-right">
        <a href="<?php echo e(route('patients.create')); ?>" class="btn btn-sm btn-success">
          <i class="fa fa-plus me-1"></i> <?php echo e(__('appointments::messages.add_patient')); ?>

        </a>
      </div>
    </div>

    
    <form method="GET" class="row mb-3">
      <div class="col-md-4">
        <input type="text" name="phone" value="<?php echo e(request('phone')); ?>" class="form-control"
               placeholder="<?php echo e(__('appointments::messages.search_phone')); ?>">
      </div>
      <div class="col-md-3">
        <label class="checkbox-inline" style="margin-top:8px">
          <input type="checkbox" name="only_trashed" value="1" <?php echo e(request('only_trashed') ? 'checked' : ''); ?>>
          <?php echo e(__('appointments::messages.only_trashed')); ?>

        </label>
      </div>
      <div class="col-md-2">
        <button class="btn btn-default"><?php echo e(__('appointments::messages.filter')); ?></button>
      </div>
    </form>

    
    <?php if($errors->any()): ?>
      <div class="alert alert-danger">
        <ul class="m-0 ps-3">
          <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li><?php echo e($error); ?></li>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
      </div>
    <?php endif; ?>

    <div class="table-responsive">
      <table class="table table-bordered table-striped">
        <thead>
          <tr>
            <th><?php echo e(__('appointments::messages.id')); ?></th>
            <th><?php echo e(__('appointments::messages.name')); ?></th>
            <th><?php echo e(__('appointments::messages.phone')); ?></th>
            <th><?php echo e(__('appointments::messages.status')); ?></th>
            <th class="text-end"><?php echo e(__('appointments::messages.actions')); ?></th>
          </tr>
        </thead>
        <tbody>
          <?php $__empty_1 = true; $__currentLoopData = $patients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr>
              <td><?php echo e($row->id); ?></td>
              <td><?php echo e($row->name['ar'] ?? $row->name['en'] ?? '-'); ?></td>
              <td><?php echo e($row->phone ?? '-'); ?></td>
              <td>
                <?php echo e($row->deleted_at ? __('appointments::messages.archived') : __('appointments::messages.active')); ?>

              </td>
              <td class="text-end">
                <div class="btn-group" role="group">
                  <a href="<?php echo e(route('patients.edit',$row->id)); ?>" class="btn btn-sm btn-info">
                    <?php echo e(__('appointments::messages.edit_btn')); ?>

                  </a>
                </div>

                <?php if($row->deleted_at): ?>
                  <div class="btn-group" role="group">
                    <form method="POST" action="<?php echo e(route('patients.restore',$row->id)); ?>" class="d-inline">
                      <?php echo csrf_field(); ?>
                      <button class="btn btn-sm btn-warning">
                        <?php echo e(__('appointments::messages.restore')); ?>

                      </button>
                    </form>
                  </div>
                <?php else: ?>
                  <div class="btn-group" role="group">
                    <form method="POST" action="<?php echo e(route('patients.destroy',$row->id)); ?>" class="d-inline">
                      <?php echo csrf_field(); ?>
                      <?php echo method_field('DELETE'); ?>
                      <button class="btn btn-sm btn-danger"
                              onclick="return confirm('<?php echo e(__('appointments::messages.are_you_sure_archive')); ?>')">
                        <?php echo e(__('appointments::messages.archive')); ?>

                      </button>
                    </form>
                  </div>
                <?php endif; ?>
              </td>
            </tr>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <tr>
              <td colspan="5" class="text-center text-muted"><?php echo e(__('appointments::messages.no_records')); ?></td>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>

    <?php echo e($patients->appends(request()->query())->links()); ?>

  </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('core::layouts.backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Dr-Mai-El-Hakim\packages\Solutions\Appointments\src\Providers/../Resources/views/patients_index.blade.php ENDPATH**/ ?>