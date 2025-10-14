<?php $__env->startPush('title'); ?> <?php echo e(__('services::messages.edit_service')); ?> <?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>

<ul class="breadcrumb breadcrumb-top">
    <li><a href="/cp"><i class="fa fa-home"></i></a></li>
    <li><a href="<?php echo e(route('services.index')); ?>"><?php echo e(__('services::messages.services')); ?></a></li>
    <li><?php echo e(__('services::messages.edit')); ?></li>
</ul>

<div class="block full">
    <div class="block-title d-flex align-items-center justify-content-between">
        <h2 class="m-0"><strong><?php echo e(__('services::messages.edit')); ?> :</strong> <?php echo e(data_get($service->name, app()->getLocale(), data_get($service->name, 'en'))); ?></h2>
        <div class="block-options pull-right">
            <a href="<?php echo e(route('services.index')); ?>" class="btn btn-sm btn-primary">
                <i class="fa fa-arrow-left me-1"></i> <?php echo e(__('services::messages.back')); ?>

            </a>
        </div>
    </div>

    <form action="<?php echo e(route('services.update', $service)); ?>" method="post" class="form-bordered" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>

        
        <ul class="nav nav-tabs push" data-toggle="tabs">
            <?php $__currentLoopData = $langs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $L): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li class="<?php echo e($L->code === $activeLocale ? 'active' : ''); ?>">
                    <a href="#tab-<?php echo e($L->code); ?>"><?php echo e($L->name); ?> (<?php echo e($L->code); ?>)</a>
                </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>

        <div class="tab-content">
            <?php $__currentLoopData = $langs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="tab-pane <?php echo e($lang->code === $activeLocale ? 'active' : ''); ?>" id="tab-<?php echo e($lang->code); ?>">
                    <div class="form-group">
                        <label><?php echo e(__('services::messages.name_'.$lang->code)); ?></label>
                        <input type="text" name="name[<?php echo e($lang->code); ?>]" class="form-control"
                               value="<?php echo e(old('name.'.$lang->code, $service->name[$lang->code] ?? '')); ?>"
                               placeholder="<?php echo e(__('services::messages.enter_name_'.$lang->code)); ?>">
                        <small class="form-text text-muted"><?php echo e(__('services::messages.enter_name_'.$lang->code)); ?></small>
                    </div>

                    <div class="form-group">
                        <label><?php echo e(__('services::messages.description_'.$lang->code)); ?></label>
                        <textarea name="description[<?php echo e($lang->code); ?>]" class="form-control" rows="3" id="editor-description-<?php echo e($lang->code); ?>"
                                  placeholder="<?php echo e(__('services::messages.enter_description_'.$lang->code)); ?>"><?php echo e(old('description.'.$lang->code, $service->description[$lang->code] ?? '')); ?></textarea>
                        <small class="form-text text-muted"><?php echo e(__('services::messages.enter_description_'.$lang->code)); ?></small>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

        
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label><?php echo e(__('services::messages.image')); ?></label>
                    <input type="file" name="image" class="file-input">
                    <small class="form-text text-muted"><?php echo e(__('services::messages.image_helper')); ?></small>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label><?php echo e(__('services::messages.icon')); ?></label>
                    <input type="file" name="icon" class="file-input">
                    <small class="form-text text-muted"><?php echo e(__('services::messages.icon_helper')); ?></small>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label><?php echo e(__('services::messages.link')); ?></label>
                    <input type="url" name="link" class="form-control" value="<?php echo e(old('link', $service->link)); ?>" placeholder="<?php echo e(__('services::messages.enter_link')); ?>">
                    <small class="form-text text-muted"><?php echo e(__('services::messages.enter_link')); ?></small>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label><?php echo e(__('services::messages.pdf')); ?></label>
                    <input type="file" name="pdf" class="file-input">
                    <small class="form-text text-muted"><?php echo e(__('services::messages.pdf_helper')); ?></small>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label><?php echo e(__('services::messages.order')); ?></label>
                    <input type="number" name="order" class="form-control" min="0" value="<?php echo e(old('order', $service->order)); ?>">
                    <small class="form-text text-muted"><?php echo e(__('services::messages.order_helper')); ?></small>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label><?php echo e(__('services::messages.status')); ?></label>
                    <div>
                        <input type="hidden" name="status" value="0">
                        <label class="switch switch-danger" style="vertical-align: middle;">
                            <input type="checkbox" name="status" value="1" <?php echo e(old('status', $service->status) ? 'checked' : ''); ?>>
                            <span></span>
                        </label>
                        <span class="ms-2 align-middle"><?php echo e(__('services::messages.active')); ?></span>
                    </div>
                </div>
            </div>
        </div>

        
        <div class="form-group form-actions mt-3">
            <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-save"></i> <?php echo e(__('services::messages.update')); ?></button>
            <a href="<?php echo e(route('services.index')); ?>" class="btn btn-sm btn-warning"><i class="fa fa-repeat"></i> <?php echo e(__('services::messages.cancel')); ?></a>
        </div>
    </form>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        <?php $__currentLoopData = $langs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            initCkEditor('editor-description-<?php echo e($lang->code); ?>');
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    });
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('core::layouts.backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Dr-Mai-El-Hakim\packages\Solutions\Services\src\Providers/../Resources/views/edit.blade.php ENDPATH**/ ?>