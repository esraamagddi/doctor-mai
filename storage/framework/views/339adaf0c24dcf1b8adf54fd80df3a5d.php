<?php $__env->startPush('title'); ?> <?php echo e(__('transformation::messages.sidebar_title')); ?> <?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>

<ul class="breadcrumb breadcrumb-top">
    <li><a href="/cp"><i class="fa fa-home"></i></a></li>
    <li><?php echo e(__('transformation::messages.sidebar_title')); ?></li>
</ul>

<div class="block full">

    <div class="block-title d-flex align-items-center justify-content-between">
        <h2 class="m-0"><strong><?php echo e(__('transformation::messages.sidebar_title')); ?></strong></h2>
            <a href="<?php echo e(route('transformations.create')); ?>" class="btn btn-success btn-sm">
                <i class="fa fa-plus"></i> <?php echo e(__('Add Transformation')); ?>

            </a>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th><?php echo app('translator')->get('Title'); ?></th>
                    <th><?php echo app('translator')->get('Before'); ?></th>
                    <th><?php echo app('translator')->get('After'); ?></th>
                    <th><?php echo app('translator')->get('Actions'); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($item->title[app()->getLocale()] ?? '-'); ?></td>
                        <td><img src="<?php echo e(asset('storage/' . $item->before_image)); ?>" style="width:60px"></td>
                        <td><img src="<?php echo e(asset('storage/' . $item->after_image)); ?>" style="width:60px"></td>
                        <td>
                                <a href="<?php echo e(route('transformations.edit', $item)); ?>" class="btn btn-sm btn-info"><i class="fa fa-edit"></i></a>
                                <form action="<?php echo e(route('transformations.destroy', $item)); ?>" method="POST" style="display:inline;">
                                    <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Delete?')">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </form>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php if(!$items->count()): ?>
                    <tr>
                        <td colspan="4" class="text-center"><?php echo app('translator')->get('No records found'); ?></td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('core::layouts.backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Dr-Mai-El-Hakim\packages\Solutions\transformation\src\Providers/../Resources/views/index.blade.php ENDPATH**/ ?>