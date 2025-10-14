<?php $__env->startPush('title'); ?> <?php echo e(__('transformation::messages.sidebar_title')); ?> <?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<ul class="breadcrumb breadcrumb-top">
    <li><a href="/cp"><i class="fa fa-home"></i></a></li>
    <li><a href="<?php echo e(route('transformations.index')); ?>"><?php echo e(__('transformation::messages.sidebar_title')); ?></a></li>
    <li><?php echo e(isset($transformation) ? __('Edit') : __('Add')); ?></li>
</ul>

<div class="block full">
    <form action="<?php echo e(isset($transformation) ? route('transformations.update', $transformation) : route('transformations.store')); ?>" method="post" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <?php if(isset($transformation)): ?> <?php echo method_field('PUT'); ?> <?php endif; ?>

        <ul class="nav nav-tabs push" data-toggle="tabs">
            <?php $__currentLoopData = $langs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $L): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li class="<?php echo e($L->code === $activeLocale ? 'active' : ''); ?>">
                    <a href="#tab-<?php echo e($L->code); ?>"><?php echo e($L->name); ?> (<?php echo e($L->code); ?>)</a>
                </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>

        <div class="tab-content">
            <?php $__currentLoopData = $langs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="tab-pane <?php echo e($lang->code === $activeLocale ? 'active' : ''); ?>" id="tab-<?php echo e($lang->code); ?>">
                    <div class="form-group">
                        <label><?php echo app('translator')->get('Title'); ?> (<?php echo e($lang->code); ?>)</label>
                        <input type="text" name="title[<?php echo e($lang->code); ?>]" class="form-control"
                               value="<?php echo e(old('title.'.$lang->code, $transformation->title[$lang->code] ?? '')); ?>">
                    </div>
                    <div class="form-group">
                        <label><?php echo app('translator')->get('Description'); ?> (<?php echo e($lang->code); ?>)</label>
                        <textarea name="description[<?php echo e($lang->code); ?>]" class="form-control" rows="2"><?php echo e(old('description.'.$lang->code, $transformation->description[$lang->code] ?? '')); ?></textarea>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

        <div class="row">
            <?php $__currentLoopData = ['before_image' => 'Before Image', 'after_image' => 'After Image']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $field => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-md-6">
                <div class="form-group">
                    <label><?php echo e($label); ?></label>
                    <input type="file" name="<?php echo e($field); ?>" class="form-control" accept="image/*">
                    <?php if(isset($transformation) && !empty($transformation->{$field})): ?>
                        <img src="<?php echo e(asset('storage/'.$transformation->{$field})); ?>" style="width:100px; height:auto;" class="mt-2">
                    <?php endif; ?>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <div class="form-group form-actions mt-3">
            <button type="submit" class="btn btn-sm btn-primary">
                <i class="fa fa-save"></i> <?php echo e(isset($transformation) ? __('Update') : __('Add')); ?>

            </button>
        </div>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('core::layouts.backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Dr-Mai-El-Hakim\packages\Solutions\transformation\src\Providers/../Resources/views/form.blade.php ENDPATH**/ ?>