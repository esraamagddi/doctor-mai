<?php $__env->startPush('title'); ?> <?php echo e(__('founder::messages.founder')); ?> <?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>

<ul class="breadcrumb breadcrumb-top">
    <li><a href="/cp"><i class="fa fa-home"></i></a></li>
    <li><a href="<?php echo e(route('founder.index')); ?>"><?php echo e(__('founder::messages.founder')); ?></a></li>
    <li><?php echo e(__('founder::messages.add')); ?></li>
</ul>

<div class="block full">
    <div class="block-title d-flex align-items-center justify-content-between">
        <h2 class="m-0"><strong><?php echo e(__('founder::messages.founder')); ?></strong></h2>
    </div>

    <form action="<?php echo e(route('founder.store')); ?>" method="post" class="form-bordered" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>

        
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
                        <label><?php echo e(__('founder::messages.name_'.$lang->code)); ?></label>
                        <input type="text" name="name[<?php echo e($lang->code); ?>]" class="form-control"
                               value="<?php echo e(old('name.'.$lang->code, $founder->name[$lang->code] ?? '')); ?>"
                               placeholder="<?php echo e(__('founder::messages.enter_name_'.$lang->code)); ?>">
                    </div>

                    
                    <div class="form-group">
                        <label><?php echo e(__('founder::messages.position_'.$lang->code)); ?></label>
                        <input type="text" name="position[<?php echo e($lang->code); ?>]" class="form-control"
                               value="<?php echo e(old('position.'.$lang->code, $founder->position[$lang->code] ?? '')); ?>"
                               placeholder="<?php echo e(__('founder::messages.enter_position_'.$lang->code)); ?>">
                    </div>

                    
                    <div class="form-group">
                        <label><?php echo e(__('founder::messages.short_desc_'.$lang->code)); ?></label>
                        <input type="text" name="short_desc[<?php echo e($lang->code); ?>]" class="form-control"
                               value="<?php echo e(old('short_desc.'.$lang->code, $founder->short_desc[$lang->code] ?? '')); ?>"
                               placeholder="<?php echo e(__('founder::messages.enter_short_desc_'.$lang->code)); ?>">
                    </div>

                    
                    <div class="form-group">
                        <label><?php echo e(__('founder::messages.speech_'.$lang->code)); ?></label>
                        <textarea id="editor-speech-<?php echo e($lang->code); ?>" name="speech[<?php echo e($lang->code); ?>]" class="form-control" rows="4"
                                  placeholder="<?php echo e(__('founder::messages.enter_speech_'.$lang->code)); ?>"><?php echo e(old('speech.'.$lang->code, $founder->speech[$lang->code] ?? '')); ?></textarea>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

        
        <div class="row mt-3">
            <div class="col-md-6">
                <div class="form-group">
                    <label><?php echo e(__('founder::messages.image')); ?></label>
                    <input type="file" name="image" class="file-input" accept="image/*">
                </div>
            </div>

            
            <div class="col-md-6">
                <div class="form-group">
                    <label><?php echo e(__('founder::messages.email')); ?></label>
                    <input type="email" name="email" class="form-control" value="<?php echo e(old('email', $founder->email ?? '')); ?>" placeholder="<?php echo e(__('founder::messages.enter_email')); ?>">
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label><?php echo e(__('founder::messages.phone')); ?></label>
                    <input type="text" name="phone" class="form-control" value="<?php echo e(old('phone', $founder->phone ?? '')); ?>" placeholder="<?php echo e(__('founder::messages.enter_phone')); ?>">
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label><?php echo e(__('founder::messages.facebook')); ?></label>
                    <input type="url" name="facebook" class="form-control" value="<?php echo e(old('facebook', $founder->facebook ?? '')); ?>" placeholder="<?php echo e(__('founder::messages.enter_facebook')); ?>">
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label><?php echo e(__('founder::messages.twitter')); ?></label>
                    <input type="url" name="twitter" class="form-control" value="<?php echo e(old('twitter', $founder->twitter ?? '')); ?>" placeholder="<?php echo e(__('founder::messages.enter_twitter')); ?>">
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label><?php echo e(__('founder::messages.linkedin')); ?></label>
                    <input type="url" name="linkedin" class="form-control" value="<?php echo e(old('linkedin', $founder->linkedin ?? '')); ?>" placeholder="<?php echo e(__('founder::messages.enter_linkedin')); ?>">
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label><?php echo e(__('founder::messages.instagram')); ?></label>
                    <input type="url" name="instagram" class="form-control" value="<?php echo e(old('instagram', $founder->instagram ?? '')); ?>" placeholder="<?php echo e(__('founder::messages.enter_instagram')); ?>">
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label><?php echo e(__('founder::messages.youtube')); ?></label>
                    <input type="url" name="youtube" class="form-control" value="<?php echo e(old('youtube', $founder->youtube ?? '')); ?>" placeholder="<?php echo e(__('founder::messages.enter_youtube')); ?>">
                </div>
            </div>
        </div>

        <div class="form-group form-actions mt-3">
            <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-save"></i> <?php echo e(__('founder::messages.save')); ?></button>
        </div>
    </form>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        <?php $__currentLoopData = $langs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            initCkEditor('editor-speech-<?php echo e($lang->code); ?>');
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    });
</script>
<?php $__env->stopPush(); ?>
   
<?php echo $__env->make('core::layouts.backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Dr-Mai-El-Hakim\packages\Solutions\Founder\src\Providers/../Resources/views/index.blade.php ENDPATH**/ ?>