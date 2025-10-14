<?php $__env->startPush('title'); ?> <?php echo e(__('sitesetting::messages.site_settings')); ?> <?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<ul class="breadcrumb breadcrumb-top">
    <li><a href="/cp"><i class="fa fa-home"></i></a></li>
    <li><?php echo e(__('sitesetting::messages.site_settings')); ?></li>
</ul>

<div class="block full">
    <div class="block-title d-flex align-items-center justify-content-between">
        <h2 class="m-0"><strong><?php echo e(__('sitesetting::messages.site_settings')); ?></strong></h2>
    </div>

    <?php if($errors->any()): ?>
    <div class="alert alert-danger">
        <ul class="m-0">
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li><?php echo e($error); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
    <?php endif; ?>

    <form action="<?php echo e(route('sitesetting.update')); ?>" method="post" class="form-bordered" enctype="multipart/form-data">
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
                    <label><?php echo e(__('sitesetting::messages.name_' . $lang->code)); ?></label>
                    <input type="text" name="site_name[<?php echo e($lang->code); ?>]" class="form-control"
                        value="<?php echo e(old('site_name.' . $lang->code, $setting->site_name[$lang->code] ?? '')); ?>"
                        placeholder="<?php echo e(__('sitesetting::messages.enter_name_' . $lang->code)); ?>">
                    <span class="help-block"><?php echo e(__('sitesetting::messages.name_help_' . $lang->code)); ?></span>
                </div>

                <div class="form-group">
                    <label><?php echo e(__('sitesetting::messages.tagline_' . $lang->code)); ?></label>
                    <input type="text" name="site_tagline[<?php echo e($lang->code); ?>]" class="form-control"
                        value="<?php echo e(old('site_tagline.' . $lang->code, $setting->site_tagline[$lang->code] ?? '')); ?>"
                        placeholder="<?php echo e(__('sitesetting::messages.enter_tagline_' . $lang->code)); ?>">
                    <span class="help-block"><?php echo e(__('sitesetting::messages.tagline_help_' . $lang->code)); ?></span>
                </div>

                <div class="form-group">
                    <label><?php echo e(__('sitesetting::messages.desc_' . $lang->code)); ?></label>
                    <textarea id="editor-desc-<?php echo e($lang->code); ?>" name="site_description[<?php echo e($lang->code); ?>]" class="form-control" rows="3"
                        placeholder="<?php echo e(__('sitesetting::messages.enter_desc_' . $lang->code)); ?>"><?php echo e(old('site_description.' . $lang->code, $setting->site_description[$lang->code] ?? '')); ?></textarea>
                    <span class="help-block"><?php echo e(__('sitesetting::messages.desc_help_' . $lang->code)); ?></span>
                </div>
                <div class="form-group">
                    <label><?php echo e(__('sitesetting::messages.address_' . $lang->code)); ?></label>
                    <input type="text" name="address[<?php echo e($lang->code); ?>]" class="form-control"
                        value="<?php echo e(old('address.' . $lang->code, $setting->address[$lang->code] ?? '')); ?>"
                        placeholder="<?php echo e(__('sitesetting::messages.enter_address_' . $lang->code)); ?>">
                    <span class="help-block"><?php echo e(__('sitesetting::messages.address_help_' . $lang->code)); ?></span>
                </div>

                <div class="form-group">
                    <label><?php echo e(__('sitesetting::messages.working_hours')); ?></label>
                    <input type="text" name="working_hours[<?php echo e($lang->code); ?>]" class="form-control"
                        value="<?php echo e(old('working_hours.' . $lang->code, $setting->working_hours[$lang->code] ?? '')); ?>"
                        placeholder="<?php echo e(__('sitesetting::messages.enter_working_hours_' . $lang->code)); ?>">
                    <span class="help-block"><?php echo e(__('sitesetting::messages.working_hours_help')); ?></span>
                </div>
                <div class="form-group">
                    <label><?php echo e(__('sitesetting::messages.working_days')); ?></label>
                    <input type="text" name="working_days[<?php echo e($lang->code); ?>]" class="form-control"
                        value="<?php echo e(old('working_days.' . $lang->code, $setting->working_days[$lang->code] ?? '')); ?>"
                        placeholder="<?php echo e(__('sitesetting::messages.enter_working_days')); ?>">
                    <span class="help-block"><?php echo e(__('sitesetting::messages.working_days_help')); ?></span>
                </div>

            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

        <div class="row">
            
            <div class="col-md-4">
                <div class="form-group">
                    <label><?php echo e(__('sitesetting::messages.logo_light')); ?></label>
                    <input type="file" name="logo_light" class="file-input" accept="image/*">
                    <span class="help-block"><?php echo e(__('sitesetting::messages.logo_light_help')); ?></span>
                    <?php if(!empty($setting->logo_light)): ?>
                    <div class="mt-2"><img src="<?php echo e(asset('storage/' . $setting->logo_light)); ?>"
                            style="max-width:150px;height:auto;"></div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label><?php echo e(__('sitesetting::messages.logo_dark')); ?></label>
                    <input type="file" name="logo_dark" class="file-input" accept="image/*">
                    <span class="help-block"><?php echo e(__('sitesetting::messages.logo_dark_help')); ?></span>
                    <?php if(!empty($setting->logo_dark)): ?>
                    <div class="mt-2"><img src="<?php echo e(asset('storage/' . $setting->logo_dark)); ?>"
                            style="max-width:150px;height:auto;"></div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label><?php echo e(__('sitesetting::messages.favicon')); ?></label>
                    <input type="file" name="favicon" class="file-input" accept="image/*">
                    <span class="help-block"><?php echo e(__('sitesetting::messages.favicon_help')); ?></span>
                    <?php if(!empty($setting->favicon)): ?>
                    <div class="mt-2"><img src="<?php echo e(asset('storage/' . $setting->favicon)); ?>"
                            style="max-width:64px;height:auto;"></div>
                    <?php endif; ?>
                </div>
            </div>

            
            <div class="col-md-6">
                <div class="form-group">
                    <label><?php echo e(__('sitesetting::messages.emails')); ?></label>
                    <input type="text" name="contact_emails" class="form-control"
                        value="<?php echo e(old('contact_emails', $setting->contact_emails ?? '')); ?>"
                        placeholder="<?php echo e(__('sitesetting::messages.emails_placeholder')); ?>">
                    <span class="help-block"><?php echo e(__('sitesetting::messages.emails_help')); ?></span>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label><?php echo e(__('sitesetting::messages.phones')); ?></label>
                    <input
                        type="text"
                        name="contact_phones"
                        class="form-control"
                        value="<?php echo e(old('contact_phones', $setting->contact_phones ?? '')); ?>"
                        placeholder="<?php echo e(__('sitesetting::messages.phones_placeholder')); ?>">
                    <span class="help-block"><?php echo e(__('sitesetting::messages.phones_help')); ?></span>
                </div>
            </div>

            <div class="col-md-12">
                <hr>
            </div>

            
            <?php $social = is_array($setting->social ?? null) ? $setting->social : []; ?>

            <div class="col-md-4">
                <div class="form-group">
                    <label><?php echo e(__('sitesetting::messages.facebook')); ?></label>
                    <input type="url" name="social[facebook]" class="form-control"
                        value="<?php echo e(old('social.facebook', $social['facebook'] ?? '')); ?>"
                        placeholder="<?php echo e(__('sitesetting::messages.enter_facebook_url')); ?>">
                    <span class="help-block"><?php echo e(__('sitesetting::messages.social_optional')); ?></span>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label><?php echo e(__('sitesetting::messages.twitter')); ?></label>
                    <input type="url" name="social[twitter]" class="form-control"
                        value="<?php echo e(old('social.twitter', $social['twitter'] ?? '')); ?>"
                        placeholder="<?php echo e(__('sitesetting::messages.enter_twitter_url')); ?>">
                    <span class="help-block"><?php echo e(__('sitesetting::messages.social_optional')); ?></span>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label><?php echo e(__('sitesetting::messages.linkedin')); ?></label>
                    <input type="url" name="social[linkedin]" class="form-control"
                        value="<?php echo e(old('social.linkedin', $social['linkedin'] ?? '')); ?>"
                        placeholder="<?php echo e(__('sitesetting::messages.enter_linkedin_url')); ?>">
                    <span class="help-block"><?php echo e(__('sitesetting::messages.social_optional')); ?></span>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label><?php echo e(__('sitesetting::messages.instagram')); ?></label>
                    <input type="url" name="social[instagram]" class="form-control"
                        value="<?php echo e(old('social.instagram', $social['instagram'] ?? '')); ?>"
                        placeholder="<?php echo e(__('sitesetting::messages.enter_instagram_url')); ?>">
                    <span class="help-block"><?php echo e(__('sitesetting::messages.social_optional')); ?></span>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label><?php echo e(__('sitesetting::messages.youtube')); ?></label>
                    <input type="url" name="social[youtube]" class="form-control"
                        value="<?php echo e(old('social.youtube', $social['youtube'] ?? '')); ?>"
                        placeholder="<?php echo e(__('sitesetting::messages.enter_youtube_url')); ?>">
                    <span class="help-block"><?php echo e(__('sitesetting::messages.social_optional')); ?></span>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label><?php echo e(__('sitesetting::messages.tiktok')); ?></label>
                    <input type="url" name="social[tiktok]" class="form-control"
                        value="<?php echo e(old('social.tiktok', $social['tiktok'] ?? '')); ?>"
                        placeholder="<?php echo e(__('sitesetting::messages.enter_tiktok_url')); ?>">
                    <span class="help-block"><?php echo e(__('sitesetting::messages.social_optional')); ?></span>
                </div>
            </div>

            <div class="col-md-12">
                <hr>
            </div>

            
            <div class="col-md-4">
                <div class="form-group">
                    <label><?php echo e(__('sitesetting::messages.ga4_measurement_id')); ?></label>
                    <input type="text" name="ga4_measurement_id" class="form-control"
                        value="<?php echo e(old('ga4_measurement_id', $setting->ga4_measurement_id)); ?>"
                        placeholder="<?php echo e(__('sitesetting::messages.enter_ga4_measurement_id')); ?>">
                    <span class="help-block"><?php echo e(__('sitesetting::messages.ga4_measurement_id_help')); ?></span>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label><?php echo e(__('sitesetting::messages.gtm_container_id')); ?></label>
                    <input type="text" name="gtm_container_id" class="form-control"
                        value="<?php echo e(old('gtm_container_id', $setting->gtm_container_id)); ?>"
                        placeholder="<?php echo e(__('sitesetting::messages.enter_gtm_container_id')); ?>">
                    <span class="help-block"><?php echo e(__('sitesetting::messages.gtm_container_id_help')); ?></span>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label><?php echo e(__('sitesetting::messages.fb_pixel_id')); ?></label>
                    <input type="text" name="fb_pixel_id" class="form-control"
                        value="<?php echo e(old('fb_pixel_id', $setting->fb_pixel_id)); ?>"
                        placeholder="<?php echo e(__('sitesetting::messages.enter_fb_pixel_id')); ?>">
                    <span class="help-block"><?php echo e(__('sitesetting::messages.fb_pixel_id_help')); ?></span>
                </div>
            </div>

            
            <div class="col-md-12">
                <div class="form-group">
                    <label><?php echo e(__('sitesetting::messages.custom_head_code')); ?></label>
                    <textarea name="custom_head_code" class="form-control" rows="3"
                        placeholder="<?php echo e(__('sitesetting::messages.enter_custom_head_code')); ?>"><?php echo e(old('custom_head_code', $setting->custom_head_code)); ?></textarea>
                    <span class="help-block"><?php echo e(__('sitesetting::messages.custom_head_code_help')); ?></span>
                </div>
            </div>

            <div class="col-md-12">
                <div class="form-group">
                    <label><?php echo e(__('sitesetting::messages.custom_body_code')); ?></label>
                    <textarea name="custom_body_code" class="form-control" rows="3"
                        placeholder="<?php echo e(__('sitesetting::messages.enter_custom_body_code')); ?>"><?php echo e(old('custom_body_code', $setting->custom_body_code)); ?></textarea>
                    <span class="help-block"><?php echo e(__('sitesetting::messages.custom_body_code_help')); ?></span>
                </div>
            </div>

            
            <div class="col-md-12">
                <div class="form-group">
                    <label><?php echo e(__('sitesetting::messages.google_map_embed')); ?></label>
                    <textarea name="google_map_embed" class="form-control" rows="3"
                        placeholder="<?php echo e(__('sitesetting::messages.google_map_embed_placeholder')); ?>"><?php echo e(old('google_map_embed', $setting->google_map_embed ?? '')); ?></textarea>
                    <span class="help-block"><?php echo e(__('sitesetting::messages.google_map_embed_help')); ?></span>
                </div>
            </div>
        </div>
        <div class="form-group form-actions">
            <button class="btn btn-sm btn-primary"><i class="fa fa-save"></i>
                <?php echo e(__('sitesetting::messages.update')); ?></button>
        </div>
    </form>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
<script>
document.addEventListener("DOMContentLoaded", function() {
    <?php $__currentLoopData = $langs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        initCkEditor('editor-desc-<?php echo e($lang->code); ?>');
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
});
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('core::layouts.backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Dr-Mai-El-Hakim\packages\Solutions\SiteSetting\src\Providers/../Resources/views/edit.blade.php ENDPATH**/ ?>