<?php $__env->startPush('title'); ?> <?php echo e(__('blog::messages.edit_post')); ?> <?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<ul class="breadcrumb breadcrumb-top">
    <li><a href="/cp"><i class="fa fa-home"></i></a></li>
    <li><a href="<?php echo e(route('blog.posts.index')); ?>"><?php echo e(__('blog::messages.blog')); ?></a></li>
    <li><?php echo e(__('blog::messages.edit_post')); ?></li>
</ul>

<div class="block full">
    <div class="block-title d-flex align-items-center justify-content-between">
        <h2 class="m-0"><strong><?php echo e(__('blog::messages.edit_post')); ?></strong></h2>
        <div class="block-options pull-right">
            <a href="<?php echo e(route('blog.posts.index')); ?>" class="btn btn-sm btn-primary">
                <i class="fa fa-arrow-left"></i> <?php echo e(__('blog::messages.back')); ?>

            </a>
        </div>
    </div>

    <form action="<?php echo e(route('blog.posts.update', $post)); ?>" method="post" class="form-bordered"
        enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>

        
        <ul class="nav nav-tabs push" data-toggle="tabs">
            <?php $__currentLoopData = $langs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li class="<?php echo e($lang->code === $activeLocale ? 'active' : ''); ?>">
                <a href="#tab-<?php echo e($lang->code); ?>"><?php echo e($lang->name); ?> (<?php echo e(strtoupper($lang->code)); ?>)</a>
            </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>

        <div class="tab-content">
            <?php $__currentLoopData = $langs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="tab-pane <?php echo e($lang->code === $activeLocale ? 'active' : ''); ?>" id="tab-<?php echo e($lang->code); ?>">
                
                <div class="form-group">
                    <label><?php echo e(__('blog::messages.title')); ?> (<?php echo e(strtoupper($lang->code)); ?>)</label>
                    <input type="text" name="title[<?php echo e($lang->code); ?>]" class="form-control"
                        value="<?php echo e(old('title.' . $lang->code, $post->title[$lang->code] ?? '')); ?>"
                        placeholder="<?php echo e(__('blog::messages.enter_title', ['lang' => $lang->name])); ?>">
                </div>


             <div class="form-group">
                    <label><?php echo e(__('blog::messages.author')); ?> (<?php echo e(strtoupper($lang->code)); ?>)</label>
                    <input type="text" name="author[<?php echo e($lang->code); ?>]" class="form-control"
                        value="<?php echo e(old('author.' . $lang->code, $post->author[$lang->code] ?? '')); ?>"
                        placeholder="<?php echo e(__('blog::messages.enter_author', ['lang' => $lang->name])); ?>">
                </div>
                <div class="form-group">
                    <label><?php echo e(__('blog::messages.description')); ?> (<?php echo e(strtoupper($lang->code)); ?>)</label>
                    <textarea name="description[<?php echo e($lang->code); ?>]" class="form-control" rows="5"
                        placeholder="<?php echo e(__('blog::messages.enter_description', ['lang' => $lang->name])); ?>"><?php echo e(old('description.' . $lang->code, $post->description[$lang->code] ?? '')); ?></textarea>
                </div>

                
                <div class="form-group">
                    <label><?php echo e(__('blog::messages.content')); ?> (<?php echo e(strtoupper($lang->code)); ?>)</label>
                    <textarea id="editor-content-<?php echo e($lang->code); ?>" name="content[<?php echo e($lang->code); ?>]"
                        class="form-control" rows="5"
                        placeholder="<?php echo e(__('blog::messages.enter_content', ['lang' => $lang->name])); ?>"><?php echo e(old('content.' . $lang->code, $post->content[$lang->code] ?? '')); ?></textarea>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>



        <div class="row">
            
            <div class="col-md-12">
                <div class="form-group">
                    <label><?php echo e(__('blog::messages.image')); ?></label>
                    <?php if($post->image): ?>
                    <div class="mb-2">
                        <img src="<?php echo e(asset('storage/'.$post->image)); ?>" alt="Current Image" style="max-width:150px">
                    </div>
                    <?php endif; ?>
                    <input type="file" name="image" class="file-input" accept="image/*">

                </div>
            </div>

            
            <div class="col-md-6">
                <div class="form-group">
                    <label><?php echo e(__('blog::messages.category')); ?></label>
                    <select name="category_id" class="form-control">
                        <option value=""><?php echo e(__('blog::messages.none')); ?></option>
                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($cat->id); ?>" <?php echo e(old('category_id', $post->category_id ?? '') == $cat->id ?
                            'selected' : ''); ?>>
                            <?php echo e(data_get($cat->name,'en')); ?>

                        </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
            </div>
   
            
            <div class="col-md-6">
                <div class="form-group">
                    <label><?php echo e(__('blog::messages.order')); ?></label>
                    <input type="number" class="form-control" name="order" value="<?php echo e(old('order', $post->order ?? 0)); ?>"
                        min="0">
                </div>
            </div>



            
            <div class="col-md-6">
                <div class="form-group">
                    <label><?php echo e(__('blog::messages.published_at')); ?></label>
                    <input type="datetime-local" class="form-control" name="published_at"
                        value="<?php echo e(old('published_at', optional($post->published_at)->format('Y-m-d\TH:i'))); ?>">
                </div>
            </div>
                        
            <div class="col-md-6">
                <div class="form-group">
                    <label><?php echo e(__('blog::messages.status')); ?></label>
                    <div>
                        <input type="hidden" name="status" value="0">
                        <label class="switch switch-danger" style="vertical-align: middle;">
                            <input type="checkbox" name="status" value="1" <?php echo e(old('status', $post->status ?? 1) ?
                            'checked' : ''); ?>>
                            <span></span>
                        </label>
                        <span class="ms-2 align-middle"><?php echo e(__('blog::messages.active')); ?></span>
                    </div>
                </div>
            </div>
        </div>

        
        <div class="form-group form-actions">
            <button class="btn btn-success"><i class="fa fa-check"></i> <?php echo e(__('blog::messages.save')); ?></button>
            <a href="<?php echo e(route('blog.posts.index')); ?>" class="btn btn-warning"><i class="fa fa-repeat"></i> <?php echo e(__('blog::messages.cancel')); ?></a>
        </div>
    </form>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        <?php $__currentLoopData = $langs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        initCkEditor('editor-content-<?php echo e($lang->code); ?>');

        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    });
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('core::layouts.backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Dr-Mai-El-Hakim\packages\Solutions\Blog\src\Providers/../Resources/views/posts/edit.blade.php ENDPATH**/ ?>