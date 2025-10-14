<?php $__env->startPush('title'); ?> <?php echo e(__('blog::messages.edit_category')); ?> <?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<ul class="breadcrumb breadcrumb-top">
    <li><a href="/cp"><i class="fa fa-home"></i></a></li>
    <li><a href="<?php echo e(route('blog.categories.index')); ?>"><?php echo e(__('blog::messages.blog')); ?></a></li>
    <li><?php echo e(__('blog::messages.edit_category')); ?></li>
</ul>

<div class="block full">
    <div class="block-title d-flex align-items-center justify-content-between">
        <h2 class="m-0"><strong><?php echo e(__('blog::messages.edit_category')); ?></strong></h2>
        <div class="block-options pull-right">
            <a href="<?php echo e(route('blog.categories.index')); ?>" class="btn btn-sm btn-primary">
                <i class="fa fa-arrow-left"></i> <?php echo e(__('blog::messages.back')); ?>

            </a>
        </div>
    </div>

    <form action="<?php echo e(route('blog.categories.update', $category)); ?>" method="post" class="form-bordered">
        <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>
        <ul class="nav nav-tabs push" data-toggle="tabs">
            <?php $__currentLoopData = $langs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li class="<?php echo e($lang->code === $activeLocale ? 'active' : ''); ?>">
                    <a href="#tab-<?php echo e($lang->code); ?>"><?php echo e($lang->name); ?> (<?php echo e(strtoupper($lang->code)); ?>)</a>
                </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>

        <div class="tab-content mb-3">
            <?php $__currentLoopData = $langs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="tab-pane <?php echo e($lang->code === $activeLocale ? 'active' : ''); ?>" id="tab-<?php echo e($lang->code); ?>">
                    
                    <div class="form-group">
                        <label><?php echo e(__('blog::messages.name')); ?> (<?php echo e(strtoupper($lang->code)); ?>)</label>
                        <input type="text" name="name[<?php echo e($lang->code); ?>]" class="form-control"
                               value="<?php echo e(old('name.'.$lang->code, data_get($category,'name.'.$lang->code))); ?>"
                               placeholder="<?php echo e(__('blog::messages.enter_name', ['lang' => $lang->name])); ?>">
                    </div>

                    
                    <div class="form-group">
                        <label><?php echo e(__('blog::messages.description')); ?> (<?php echo e(strtoupper($lang->code)); ?>)</label>
                        <textarea name="description[<?php echo e($lang->code); ?>]" class="form-control" rows="4"
                                  placeholder="<?php echo e(__('blog::messages.enter_description', ['lang' => $lang->name])); ?>"><?php echo e(old('description.'.$lang->code, data_get($category,'description.'.$lang->code))); ?></textarea>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>




        
        <div class="row">

            <div class="col-md-4">
                <div class="form-group">
                    <label><?php echo e(__('blog::messages.parent')); ?></label>
                    <select name="parent_id" class="form-control">
                        <option value=""><?php echo e(__('blog::messages.none')); ?></option>
                        <?php $__currentLoopData = $parents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($cat->id); ?>" <?php echo e(old('parent_id', $category->parent_id) == $cat->id ? 'selected' : ''); ?>>
                                <?php echo e(data_get($cat->name,'en')); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label><?php echo e(__('blog::messages.order')); ?></label>
                    <input type="number" class="form-control" name="order" value="<?php echo e(old('order', $category->order)); ?>">
                </div>
            </div>
            <div class="col-md-4">

                <div class="form-group">
                    <label><?php echo e(__('blog::messages.status')); ?></label>
                    <div>
                        <input type="hidden" name="status" value="0">
                        <label class="switch switch-danger" style="vertical-align: middle;">
                            <input type="checkbox" name="status" value="1"  <?php echo e(old('status', $category->status) ? 'checked' : ''); ?>>
                            <span></span>
                        </label>
                        <span class="ms-2 align-middle"><?php echo e(__('blog::messages.active')); ?></span>
                    </div>
                </div>

   
            </div>
        </div>

        <div class="form-group mt-3">
            <button class="btn btn-success"><i class="fa fa-check"></i> <?php echo e(__('blog::messages.save')); ?></button>
        </div>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('core::layouts.backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Dr-Mai-El-Hakim\packages\Solutions\Blog\src\Providers/../Resources/views/categories/edit.blade.php ENDPATH**/ ?>