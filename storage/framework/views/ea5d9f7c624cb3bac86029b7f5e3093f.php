<?php $__env->startPush('title'); ?> <?php echo e(__('aboutus::messages.about_us')); ?> <?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>

<ul class="breadcrumb breadcrumb-top">
    <li><a href="/cp"><i class="fa fa-home"></i></a></li>
    <li><a href="<?php echo e(route('aboutus.index')); ?>"><?php echo e(__('aboutus::messages.about_us')); ?></a></li>
    <li><?php echo e(__('aboutus::messages.add')); ?></li>
</ul>

<div class="block full">
    <div class="block-title d-flex align-items-center justify-content-between">
        <h2 class="m-0"><strong><?php echo e(__('aboutus::messages.about_us')); ?></strong></h2>
    </div>

    <form action="<?php echo e(route('aboutus.store')); ?>" method="post" class="form-bordered" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>

        
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
                        <label><?php echo e(__('aboutus::messages.title')); ?> (<?php echo e($lang->code); ?>)</label>
                        <input type="text" name="title[<?php echo e($lang->code); ?>]" class="form-control"
                               value="<?php echo e(old('title.'.$lang->code, $aboutUs->title[$lang->code] ?? '')); ?>">
                    </div>

                    
                    <div class="form-group">
                        <label><?php echo e(__('aboutus::messages.sub_title')); ?> (<?php echo e($lang->code); ?>)</label>
                        <input type="text" name="sub_title[<?php echo e($lang->code); ?>]" class="form-control"
                               value="<?php echo e(old('sub_title.'.$lang->code, $aboutUs->sub_title[$lang->code] ?? '')); ?>">
                    </div>

                    
                    <div class="form-group">
                        <label><?php echo e(__('aboutus::messages.mission')); ?> (<?php echo e($lang->code); ?>)</label>
                        <textarea id="editor-mission-<?php echo e($lang->code); ?>" 
                                  name="mission[<?php echo e($lang->code); ?>]" rows="3"><?php echo e(old('mission.'.$lang->code, $aboutUs->mission[$lang->code] ?? '')); ?></textarea>
                    </div>

                    
                    <div class="form-group">
                        <label><?php echo e(__('aboutus::messages.vision')); ?> (<?php echo e($lang->code); ?>)</label>
                        <textarea id="editor-vision-<?php echo e($lang->code); ?>" 
                                  name="vision[<?php echo e($lang->code); ?>]" rows="3"><?php echo e(old('vision.'.$lang->code, $aboutUs->vision[$lang->code] ?? '')); ?></textarea>
                    </div>

                    
                    <div class="form-group">
                        <label><?php echo e(__('aboutus::messages.values')); ?> (<?php echo e($lang->code); ?>)</label>
                        <textarea name="values[<?php echo e($lang->code); ?>]" class="form-control" rows="2"><?php echo e(old('values.'.$lang->code, $aboutUs->values[$lang->code] ?? '')); ?></textarea>
                    </div>

                    
                    <div class="form-group">
                        <label><?php echo e(__('aboutus::messages.goals')); ?> (<?php echo e($lang->code); ?>)</label>
                        <textarea id="editor-goals-<?php echo e($lang->code); ?>" 
                                  name="goals[<?php echo e($lang->code); ?>]" rows="2"><?php echo e(old('goals.'.$lang->code, $aboutUs->goals[$lang->code] ?? '')); ?></textarea>
                    </div>

                    
                    <div class="form-group">
                        <label><?php echo e(__('aboutus::messages.history')); ?> (<?php echo e($lang->code); ?>)</label>
                        <textarea name="history[<?php echo e($lang->code); ?>]" class="form-control" rows="3"><?php echo e(old('history.'.$lang->code, $aboutUs->history[$lang->code] ?? '')); ?></textarea>
                    </div>

                    
                    <h4 class="mt-3">Statistics (<?php echo e($lang->name); ?>)</h4>
                    <?php for($i = 1; $i <= 2; $i++): ?>
                        <div class="form-group">
                            <label>Stat <?php echo e($i); ?> Title (<?php echo e($lang->code); ?>)</label>
                            <input type="text" name="stat<?php echo e($i); ?>_title[<?php echo e($lang->code); ?>]" class="form-control"
                                   value="<?php echo e(old('stat'.$i.'_title.'.$lang->code, $aboutUs->{'stat'.$i.'_title'}[$lang->code] ?? '')); ?>">
                        </div>
                        <div class="form-group">
                            <label>Stat <?php echo e($i); ?> Value (<?php echo e($lang->code); ?>)</label>
                            <input type="text" name="stat<?php echo e($i); ?>_value[<?php echo e($lang->code); ?>]" class="form-control"
                                   value="<?php echo e(old('stat'.$i.'_value.'.$lang->code, $aboutUs->{'stat'.$i.'_value'}[$lang->code] ?? '')); ?>">
                        </div>
                        <div class="form-group">
                            <label>Stat <?php echo e($i); ?> Description (<?php echo e($lang->code); ?>)</label>
                            <textarea name="stat<?php echo e($i); ?>_description[<?php echo e($lang->code); ?>]" class="form-control" rows="2"><?php echo e(old('stat'.$i.'_description.'.$lang->code, $aboutUs->{'stat'.$i.'_description'}[$lang->code] ?? '')); ?></textarea>
                        </div>
                    <?php endfor; ?>

                    <hr class="my-4">

                    
                    <h4 class="mt-4 mb-3 text-primary">
                        <i class="fa fa-graduation-cap"></i> Education & Qualifications (<?php echo e($lang->name); ?>)
                    </h4>

                    <div class="form-group">
                        <label>Education Description (<?php echo e($lang->code); ?>)</label>
                        <textarea id="editor-education-desc-<?php echo e($lang->code); ?>" 
                                  name="education_description[<?php echo e($lang->code); ?>]" 
                                  class="form-control" 
                                  rows="3"><?php echo e(old('education_description.'.$lang->code, $aboutUs->education_description[$lang->code] ?? '')); ?></textarea>
                    </div>

                    <div class="form-group">
                        <label>Education Degree (<?php echo e($lang->code); ?>)</label>
                        <input type="text" 
                               name="education_degree[<?php echo e($lang->code); ?>]" 
                               class="form-control"
                               value="<?php echo e(old('education_degree.'.$lang->code, $aboutUs->education_degree[$lang->code] ?? '')); ?>">
                    </div>

                    <div class="form-group">
                        <label>Education Degree Description (<?php echo e($lang->code); ?>)</label>
                        <textarea name="education_degree_description[<?php echo e($lang->code); ?>]" 
                                  class="form-control" 
                                  rows="2"><?php echo e(old('education_degree_description.'.$lang->code, $aboutUs->education_degree_description[$lang->code] ?? '')); ?></textarea>
                    </div>

                    <hr class="my-4">

                    
                    <h4 class="mt-4 mb-3 text-success">
                        <i class="fa fa-lightbulb-o"></i> Experience & Philosophy (<?php echo e($lang->name); ?>)
                    </h4>

                    <div class="form-group">
                        <label>Treatment Techniques (<?php echo e($lang->code); ?>)</label>
                        <textarea id="editor-treatment-<?php echo e($lang->code); ?>" 
                                  name="treatment_techniques[<?php echo e($lang->code); ?>]" 
                                  class="form-control" 
                                  rows="3"><?php echo e(old('treatment_techniques.'.$lang->code, $aboutUs->treatment_techniques[$lang->code] ?? '')); ?></textarea>
                    </div>

                    <div class="form-group">
                        <label>Philosophy Quote (<?php echo e($lang->code); ?>)</label>
                        <textarea name="philosophy_quote[<?php echo e($lang->code); ?>]" 
                                  class="form-control" 
                                  rows="2"><?php echo e(old('philosophy_quote.'.$lang->code, $aboutUs->philosophy_quote[$lang->code] ?? '')); ?></textarea>
                    </div>

                    <div class="form-group">
                        <label>Philosophy Author (<?php echo e($lang->code); ?>)</label>
                        <input type="text" 
                               name="philosophy_author[<?php echo e($lang->code); ?>]" 
                               class="form-control"
                               value="<?php echo e(old('philosophy_author.'.$lang->code, $aboutUs->philosophy_author[$lang->code] ?? '')); ?>">
                    </div>

                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

        
        <div class="form-group mt-4">
            <label class="text-info">
                <i class="fa fa-calendar"></i> Experience Years (Number)
            </label>
            <input type="number" 
                   name="experience_years" 
                   class="form-control" 
                   min="0"
                   value="<?php echo e(old('experience_years', $aboutUs->experience_years ?? '')); ?>"
                   placeholder="e.g., 15">
            <small class="form-text text-muted">Enter the number of years of experience (e.g., 15)</small>
        </div>

        <hr class="my-4">

        
        <h4 class="mb-3"><i class="fa fa-image"></i> Images</h4>
        <div class="row">
            <?php $__currentLoopData = ['image' => 'Main Image', 'vision_image' => 'Vision Image', 'goal_image' => 'Goal Image', 'stats_image' => 'Stats Image']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $field => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-md-3">
                <div class="form-group">
                    <label><?php echo e($label); ?></label>
                    <input type="file" name="<?php echo e($field); ?>" class="file-input" accept="image/*">
                    <?php if(!empty($aboutUs->{$field})): ?>
                        <div class="mt-2">
                            <img src="<?php echo e(asset('storage/'.$aboutUs->{$field})); ?>" alt="<?php echo e($label); ?>" style="width:100px; height:auto; border:1px solid #ccc; padding:2px;">
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

        <hr class="my-4">

        
        <h4 class="mb-3"><i class="fa fa-phone"></i> Contact Information</h4>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label><?php echo e(__('aboutus::messages.video_url')); ?></label>
                    <input type="url" name="video_url" class="form-control" value="<?php echo e(old('video_url', $aboutUs->video_url ?? '')); ?>">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label><?php echo e(__('aboutus::messages.contact_email')); ?></label>
                    <input type="email" name="contact_email" class="form-control" value="<?php echo e(old('contact_email', $aboutUs->contact_email ?? '')); ?>">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label><?php echo e(__('aboutus::messages.contact_phone')); ?></label>
                    <input type="text" name="contact_phone" class="form-control" value="<?php echo e(old('contact_phone', $aboutUs->contact_phone ?? '')); ?>">
                </div>
            </div>
        </div>

        <hr class="my-4">

        
        <h4 class="mb-3"><i class="fa fa-share-alt"></i> Social Media Links</h4>
        <div class="row">
            <?php $__currentLoopData = ['facebook','twitter','linkedin','instagram','youtube']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $social): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>
                            <i class="fa fa-<?php echo e($social); ?>"></i> <?php echo e(ucfirst($social)); ?>

                        </label>
                        <input type="text" name="<?php echo e($social); ?>" class="form-control" value="<?php echo e(old($social, $aboutUs->$social ?? '')); ?>" placeholder="https://<?php echo e($social); ?>.com/...">
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

        
        <div class="form-group form-actions mt-4">
            <button type="submit" class="btn btn-sm btn-primary">
                <i class="fa fa-save"></i> <?php echo e(__('aboutus::messages.save')); ?>

            </button>
        </div>
    </form>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
document.addEventListener("DOMContentLoaded", function() {
    <?php $__currentLoopData = $langs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        // Original editors
        initCkEditor('editor-mission-<?php echo e($lang->code); ?>');
        initCkEditor('editor-vision-<?php echo e($lang->code); ?>');
        initCkEditor('editor-goals-<?php echo e($lang->code); ?>');
        
        // New editors for Education & Philosophy
        initCkEditor('editor-education-desc-<?php echo e($lang->code); ?>');
        initCkEditor('editor-treatment-<?php echo e($lang->code); ?>');
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
});
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('core::layouts.backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Dr-Mai-El-Hakim\packages\Solutions\AboutUs\src\Providers/../Resources/views/index.blade.php ENDPATH**/ ?>