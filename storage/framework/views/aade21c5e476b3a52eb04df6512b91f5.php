<?php $__env->startPush('title'); ?>
  <?php echo e(__('appointments::messages.patients')); ?> - <?php echo e(__('appointments::messages.edit_patient')); ?>

<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
  <ul class="breadcrumb breadcrumb-top">
    <li><a href="/cp"><i class="fa fa-home"></i></a></li>
    <li><a href="<?php echo e(route('patients.index')); ?>"><?php echo e(__('appointments::messages.patients')); ?></a></li>
    <li><?php echo e(__('appointments::messages.edit_patient')); ?></li>
  </ul>

  <div class="block full">
    <div class="block-title">
      <h2 class="m-0"><?php echo e(__('appointments::messages.edit_patient')); ?></h2>
      <div class="block-options pull-right">
        <a href="<?php echo e(route('patients.index')); ?>" class="btn btn-sm btn-default">
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

    <form method="POST" action="<?php echo e(route('patients.update', $patient->id)); ?>">
      <?php echo csrf_field(); ?>
      <?php echo method_field('PUT'); ?>

      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label class="control-label"><?php echo e(__('appointments::messages.name_ar')); ?></label>
            <input class="form-control" name="name[ar]" value="<?php echo e(old('name.ar', $patient->name['ar'] ?? '')); ?>">
          </div>
        </div>

        <div class="col-md-6">
          <div class="form-group">
            <label class="control-label"><?php echo e(__('appointments::messages.name_en')); ?></label>
            <input class="form-control" name="name[en]" value="<?php echo e(old('name.en', $patient->name['en'] ?? '')); ?>">
          </div>
        </div>

        <div class="col-md-6">
          <div class="form-group">
            <label class="control-label"><?php echo e(__('appointments::messages.phone')); ?></label>
            <input class="form-control" name="phone" value="<?php echo e(old('phone', $patient->phone)); ?>">
          </div>
        </div>

        <div class="col-md-6">
          <div class="form-group">
            <label class="control-label"><?php echo e(__('appointments::messages.email')); ?></label>
            <input class="form-control" type="email" name="email" value="<?php echo e(old('email', $patient->email)); ?>">
          </div>
        </div>

        <div class="col-md-6">
          <div class="form-group">
            <label class="control-label"><?php echo e(__('appointments::messages.gender')); ?></label>
            <select name="gender" class="form-control">
              <option value=""><?php echo e(__('appointments::messages.undefined')); ?></option>
              <option value="male" <?php echo e(old('gender', $patient->gender) == 'male' ? 'selected' : ''); ?>>
                <?php echo e(__('appointments::messages.male')); ?>

              </option>
              <option value="female" <?php echo e(old('gender', $patient->gender) == 'female' ? 'selected' : ''); ?>>
                <?php echo e(__('appointments::messages.female')); ?>

              </option>
              <option value="other" <?php echo e(old('gender', $patient->gender) == 'other' ? 'selected' : ''); ?>>
                <?php echo e(__('appointments::messages.other')); ?>

              </option>
            </select>
          </div>
        </div>

        <div class="col-md-6">
          <div class="form-group">
            <label class="control-label"><?php echo e(__('appointments::messages.birthdate')); ?></label>
            <input class="form-control" type="date" name="birthdate"
                   value="<?php echo e(old('birthdate', optional($patient->birthdate)->format('Y-m-d'))); ?>">
          </div>
        </div>

        <div class="col-md-6">
          <div class="form-group">
            <label class="control-label"><?php echo e(__('appointments::messages.file_number')); ?></label>
            <input class="form-control" name="file_number" value="<?php echo e(old('file_number', $patient->file_number)); ?>">
          </div>
        </div>

        <div class="col-md-12">
          <div class="form-group">
            <label class="control-label">
              <?php echo e(__('appointments::messages.notes')); ?>

              <small class="text-muted">(<?php echo e(__('appointments::messages.optional')); ?>)</small>
            </label>
            <textarea class="form-control" name="notes" rows="4"><?php echo e(old('notes', $patient->notes)); ?></textarea>
          </div>
        </div>

        <div class="col-md-12">
          <label>
            <input type="checkbox" name="is_active" value="1"
                   <?php echo e(old('is_active', $patient->is_active) ? 'checked' : ''); ?>>
            <?php echo e(__('appointments::messages.active')); ?>

          </label>
        </div>
      </div>

      <button class="btn btn-success mt-3">
        <i class="fa fa-save"></i> <?php echo e(__('appointments::messages.update')); ?>

      </button>
    </form>
  </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('core::layouts.backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Dr-Mai-El-Hakim\packages\Solutions\Appointments\src\Providers/../Resources/views/patients_edit.blade.php ENDPATH**/ ?>