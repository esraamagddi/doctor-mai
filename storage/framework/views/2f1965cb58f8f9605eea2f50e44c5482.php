<?php $__env->startPush('title'); ?>
  <?php echo e(__('appointments::messages.title')); ?> - <?php echo e(__('appointments::messages.add')); ?>

<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
  <ul class="breadcrumb breadcrumb-top">
    <li><a href="/cp"><i class="fa fa-home"></i></a></li>
    <li><a href="<?php echo e(route('appointments.index')); ?>"><?php echo e(__('appointments::messages.title')); ?></a></li>
    <li><?php echo e(__('appointments::messages.add')); ?></li>
  </ul>

  <div class="block full">
    <div class="block-title">
      <h2 class="m-0"><?php echo e(__('appointments::messages.add')); ?></h2>
                  <div class="block-options pull-right">

      <a href="<?php echo e(route('appointments.index')); ?>" class="btn btn-sm btn-default">
        <i class="fa fa-arrow-right"></i> <?php echo e(__('appointments::messages.back')); ?>

      </a>
    </div>
    </div>

    
    <?php if($errors->any()): ?>
      <div class="alert alert-danger">
        <ul class="m-0 ps-3">
          <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li><?php echo e($error); ?></li>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
      </div>
    <?php endif; ?>

    <form method="POST" action="<?php echo e(route('appointments.store')); ?>">
      <?php echo csrf_field(); ?>
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label class="control-label"><?php echo e(__('appointments::messages.patient')); ?></label>
            <select name="patient_id" class="form-control">
              <option value=""><?php echo e(__('appointments::messages.choose_patient')); ?></option>
              <?php $__currentLoopData = $patients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($p->id); ?>" <?php echo e(old('patient_id') == $p->id ? 'selected' : ''); ?>>
                  <?php echo e($p->name['ar'] ?? $p->name['en']); ?> - <?php echo e($p->phone); ?>

                </option>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
          </div>
        </div>

        <div class="col-md-6">
          <div class="form-group">
            <label class="control-label"><?php echo e(__('appointments::messages.service')); ?></label>
            <select name="service_id" class="form-control">
              <option value=""><?php echo e(__('appointments::messages.none')); ?></option>
              <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($s->id); ?>" <?php echo e(old('service_id') == $s->id ? 'selected' : ''); ?>>
                  <?php echo e($s->name['ar'] ?? $s->name['en']); ?>

                </option>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
          </div>
        </div>

        <div class="col-md-6">
          <div class="form-group">
            <label class="control-label"><?php echo e(__('appointments::messages.date')); ?></label>
            <input type="date" name="preferred_date" value="<?php echo e(old('preferred_date')); ?>" class="form-control">
          </div>
        </div>

        <div class="col-md-6">
          <div class="form-group">
            <label class="control-label"><?php echo e(__('appointments::messages.time')); ?></label>
            <input type="time" name="preferred_time" value="<?php echo e(old('preferred_time')); ?>" class="form-control">
          </div>
        </div>

        <div class="col-md-12">
          <div class="form-group">
            <label class="control-label">
              <?php echo e(__('appointments::messages.notes')); ?>

              <small class="text-muted">(<?php echo e(__('appointments::messages.optional')); ?>)</small>
            </label>
            <textarea name="notes" class="form-control" rows="4"><?php echo e(old('notes')); ?></textarea>
          </div>
        </div>
      </div>

      <button class="btn btn-success mt-3">
        <i class="fa fa-check"></i> <?php echo e(__('appointments::messages.save')); ?>

      </button>
    </form>
  </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('core::layouts.backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Dr-Mai-El-Hakim\packages\Solutions\Appointments\src\Providers/../Resources/views/create.blade.php ENDPATH**/ ?>