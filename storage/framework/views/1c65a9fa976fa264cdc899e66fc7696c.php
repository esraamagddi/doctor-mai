<?php $__env->startPush('title'); ?> <?php echo e(__('media::messages.edit_video')); ?> <?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <ul class="breadcrumb breadcrumb-top">
        <li><a href="/cp"><i class="fa fa-home"></i></a></li>
        <li><a href="<?php echo e(route('media.videos.index')); ?>"><?php echo e(__('media::messages.videos')); ?></a></li>
        <li><?php echo e(__('media::messages.edit')); ?></li>
    </ul>

    <div class="block full">
        <div class="block-title d-flex align-items-center justify-content-between">
            <h2 class="m-0"><strong><?php echo e(__('media::messages.edit')); ?> :</strong>
                <?php echo e(data_get($video->title, app()->getLocale(), data_get($video->title, 'en'))); ?></h2>
            <div class="block-options pull-right">
                <a href="<?php echo e(route('media.videos.index')); ?>" class="btn btn-sm btn-primary">
                    <i class="fa fa-arrow-left me-1"></i> <?php echo e(__('media::messages.back')); ?>

                </a>
            </div>
        </div>

        <form action="<?php echo e(route('media.videos.update', $video)); ?>" method="post" class="form-bordered"
            enctype="multipart/form-data">
            <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>

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
                            <label><?php echo e(__('media::messages.title_' . $lang->code)); ?></label>
                            <input type="text" name="title[<?php echo e($lang->code); ?>]" class="form-control"
                                value="<?php echo e(old('title.' . $lang->code, $video->title[$lang->code] ?? '')); ?>"
                                placeholder="<?php echo e(__('media::messages.enter_title_' . $lang->code)); ?>">
                        </div>
                        <div class="form-group">
                            <label><?php echo e(__('media::messages.description_' . $lang->code)); ?></label>
                            <textarea name="description[<?php echo e($lang->code); ?>]" class="form-control" rows="3"
                                placeholder="<?php echo e(__('media::messages.enter_description_' . $lang->code)); ?>"><?php echo e(old('description.' . $lang->code, $video->description[$lang->code] ?? '')); ?></textarea>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><?php echo e(__('media::messages.category')); ?></label>
                            <select name="category_id" class="form-control">
                                <option value=""><?php echo e(__('media::messages.select_category')); ?></option>
                                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($cat->id); ?>"
                                        <?php echo e(old('category_id', $video->category_id ?? null) == $cat->id ? 'selected' : ''); ?>>
                                        <?php echo e(data_get($cat->name, app()->getLocale(), data_get($cat->name, 'en'))); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><?php echo e(__('Cover Image')); ?></label>
                            <input type="file" name="image" class="file-input" accept="image/*">
                            <?php if(!empty($video->image)): ?>
                                <div class="mt-2">
                                    <img src="<?php echo e(asset('storage/' . $video->image)); ?>" alt="Cover Image" class="img-fluid rounded"
                                        style="max-width: 250px;">
                                </div>
                                <small class="text-success">Stored file: <?php echo e($video->image); ?></small>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label><?php echo e(__('media::messages.embed_code')); ?></label>
                        <textarea name="embed_code" class="form-control" rows="3"
                            placeholder="<?php echo e(__('media::messages.enter_embed_code')); ?>"><?php echo e(old('embed_code', $video->embed_code)); ?></textarea>
                    </div>
                </div>



                <div class="col-md-12">
                    <div class="form-group">
                        <label><?php echo e(__('media::messages.order')); ?></label>
                        <input type="number" name="order" class="form-control" min="0"
                            value="<?php echo e(old('order', $video->order)); ?>">
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <label><?php echo e(__('media::messages.status')); ?></label>
                        <div>
                            <input type="hidden" name="status" value="0">
                            <label class="switch switch-danger" style="vertical-align: middle;">
                                <input type="checkbox" name="status" value="1" <?php echo e(old('status', $video->status) ? 'checked': ''); ?>>
                                <span></span>
                            </label>
                            <span class="ms-2 align-middle"><?php echo e(__('media::messages.active')); ?></span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group form-actions">
                <button class="btn btn-sm btn-primary"><i class="fa fa-save"></i> <?php echo e(__('media::messages.update')); ?></button>
                <a href="<?php echo e(route('media.videos.index')); ?>" class="btn btn-sm btn-warning"><i class="fa fa-repeat"></i> <?php echo e(__('media::messages.cancel')); ?></a>
            </div>
        </form>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('core::layouts.backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Dr-Mai-El-Hakim\packages\Solutions\Media\src\Providers/../Resources/views/videos/edit.blade.php ENDPATH**/ ?>