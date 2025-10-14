<?php $__env->startPush('title'); ?>
    <?php echo e(__('main_slider::messages.edit_main_slider')); ?>

<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>

<ul class="breadcrumb breadcrumb-top">
    <li><a href="/cp"><i class="fa fa-home"></i></a></li>
    <li><a href="<?php echo e(route('mainslider.index')); ?>"><?php echo e(__('main_slider::messages.main_slider')); ?></a></li>
    <li><?php echo e(__('main_slider::messages.edit')); ?></li>
</ul>

<div class="block full">
    <div class="block-title d-flex align-items-center justify-content-between">
        <h2 class="m-0">
            <strong><?php echo e(__('main_slider::messages.edit')); ?> :</strong>
            <?php echo e(data_get($mainSlider->title, app()->getLocale(), data_get($mainSlider->title, 'en'))); ?>

        </h2>
        <div class="block-options pull-right">
            <a href="<?php echo e(route('mainslider.index')); ?>" class="btn btn-sm btn-primary">
                <i class="fa fa-arrow-left me-1"></i> <?php echo e(__('main_slider::messages.back')); ?>

            </a>
        </div>
    </div>

    <form action="<?php echo e(route('mainslider.update', $mainSlider->id)); ?>"
          method="post" class="form-bordered" enctype="multipart/form-data">
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
                        <label><?php echo e(__('main_slider::messages.title_'.$lang->code)); ?></label>
                        <input type="text"
                               name="title[<?php echo e($lang->code); ?>]"
                               class="form-control"
                               value="<?php echo e(old('title.'.$lang->code, $mainSlider->title[$lang->code] ?? '')); ?>">
                    </div>

                    
                    <div class="form-group">
                        <label><?php echo e(__('main_slider::messages.subtitle_'.$lang->code)); ?></label>
                        <input type="text"
                               name="subtitle[<?php echo e($lang->code); ?>]"
                               class="form-control"
                               value="<?php echo e(old('subtitle.'.$lang->code, $mainSlider->subtitle[$lang->code] ?? '')); ?>">
                    </div>

                    
                    <div class="form-group">
                        <label><?php echo e(__('main_slider::messages.description_'.$lang->code)); ?></label>
                        <textarea name="description[<?php echo e($lang->code); ?>]"
                                  id="editor-description-<?php echo e($lang->code); ?>"
                                  class="form-control" rows="3"><?php echo e(old('description.'.$lang->code, $mainSlider->description[$lang->code] ?? '')); ?></textarea>
                    </div>

                    
                    <div class="row">
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><?php echo e(__('main_slider::messages.button1_text_'.$lang->code)); ?></label>
                                <input type="text"
                                       name="button1_text[<?php echo e($lang->code); ?>]"
                                       class="form-control"
                                       value="<?php echo e(old('button1_text.'.$lang->code, $mainSlider->button1_text[$lang->code] ?? '')); ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><?php echo e(__('main_slider::messages.button1_link')); ?></label>
                                <input type="text"
                                       name="button1_link"
                                       class="form-control"
                                       value="<?php echo e(old('button1_link', $mainSlider->button1_link ?? '')); ?>">
                            </div>
                        </div>

                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><?php echo e(__('main_slider::messages.button2_text_'.$lang->code)); ?></label>
                                <input type="text"
                                       name="button2_text[<?php echo e($lang->code); ?>]"
                                       class="form-control"
                                       value="<?php echo e(old('button2_text.'.$lang->code, $mainSlider->button2_text[$lang->code] ?? '')); ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><?php echo e(__('main_slider::messages.button2_link')); ?></label>
                                <input type="text"
                                       name="button2_link"
                                       class="form-control"
                                       value="<?php echo e(old('button2_link', $mainSlider->button2_link ?? '')); ?>">
                            </div>
                        </div>

                        
                        <div class="col-md-12">
                            <div class="form-group">
                                <label><?php echo e(__('main_slider::messages.background_image_'.$lang->code)); ?></label>
                                <input type="file" name="background_<?php echo e($lang->code); ?>" class="file-input" accept="image/*">
                                <?php if($mainSlider->background_image): ?>
                                    <div class="mt-2">
                                        <img src="<?php echo e(asset('storage/'.$mainSlider->{'background_'.$lang->code})); ?>"
                                            alt="" style="max-width: 150px;">
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>



        
        <div class="row">
            
            <div class="col-md-12">
                <div class="form-group">
                    <label><?php echo e(__('main_slider::messages.image')); ?></label>
                    <input type="file" name="image" class="file-input" accept="image/*">
                    <?php if($mainSlider->image): ?>
                        <div class="mt-2">
                            <img src="<?php echo e(asset('storage/'.$mainSlider->image)); ?>"
                                 alt="" style="max-width: 150px;">
                        </div>
                    <?php endif; ?>
                </div>
            </div>


            
            <div class="col-md-12">
                <div class="form-group">
                    <label><?php echo e(__('main_slider::messages.video_url')); ?></label>
                    <input type="text"
                           name="video_url"
                           class="form-control"
                           value="<?php echo e(old('video_url', $mainSlider->video_url ?? '')); ?>">
                </div>
            </div>
        </div>

        
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label><?php echo e(__('main_slider::messages.overlay_color')); ?></label>
                    <input type="color"
                           name="overlay_color"
                           class="form-control"
                           value="<?php echo e(old('overlay_color', $mainSlider->overlay_color)); ?>">
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label><?php echo e(__('main_slider::messages.order')); ?></label>
                    <input type="number"
                           name="order"
                           class="form-control"
                           value="<?php echo e(old('order', $mainSlider->order)); ?>">
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label><?php echo e(__('main_slider::messages.status')); ?></label>
                    <div>
                        <input type="hidden" name="status" value="0">
                        <label class="switch switch-danger">
                            <input type="checkbox"
                                   name="status" value="1"
                                   <?php echo e(old('status', $mainSlider->status) ? 'checked' : ''); ?>>
                            <span></span>
                        </label>
                    </div>
                </div>
            </div>
        </div>

        
        <div class="form-group form-actions">
            <button type="submit" class="btn btn-sm btn-primary">
                <i class="fa fa-save"></i> <?php echo e(__('main_slider::messages.update')); ?>

            </button>
            <a href="<?php echo e(route('mainslider.index')); ?>" class="btn btn-sm btn-warning">
                <i class="fa fa-repeat"></i> <?php echo e(__('main_slider::messages.cancel')); ?>

            </a>
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

<?php echo $__env->make('core::layouts.backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Dr-Mai-El-Hakim\packages\Solutions\MainSlider\src\Providers/../Resources/views/edit.blade.php ENDPATH**/ ?>