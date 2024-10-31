<?php
if(function_exists( 'wp_enqueue_media' )) {
    wp_enqueue_media();
} else {
    wp_enqueue_style('thickbox');
    wp_enqueue_script('media-upload');
    wp_enqueue_script('thickbox');
}
wp_enqueue_style( 'wp-color-picker' ); 
?>

<div class="ultimate-wrapper">
    <?php 
        echo UltimateForm::open(array(
            'method' => 'post', 
            'action' => admin_url('admin-ajax.php'), 
            'class' => 'ultimate-ajax-form ultimate-admin-form'
        )); 
    ?>
	
    <div class="ultimate-form-submit-box">
        <h1 style="float: left;"><?php _e('PWA Options', 'intelvue-pwa') ?></h1>
        <input type="submit" class="button button-primary button-large" value="Save" style="float: right; margin-top: 15px;" />
    </div>

    <div class="ultimate-content">
        <div class="ultimate-tabs">
            <ul class="col-3 ultimate-tab-nav">
                <li><a href="#" rel="#general"><?php _e('General', 'intelvue-pwa') ?></a></li>
                <li><a href="#" rel="#cache"><?php _e('Advanced Cache', 'intelvue-pwa') ?></a></li>
                <li><a href="#" rel="#push-notifications"><?php _e('Push Notifications', 'intelvue-pwa') ?></a></li>
            </ul>
            <div class="col-9 ultimate-tab-content">

                <?php if(!pwa_is_secure()): ?>
                    <p class="ultimate-error">
                        <?php _e('Oops! You site must use secure protocol. Please enable SSL.', 'intelvue-pwa') ?>
                    </p>
                <?php endif; ?>

                <div class="ultimate-tab" id="general">
                    <?php $this->view('admin/setting-tabs/general.php') ?>
                </div>
                <div class="ultimate-tab" id="cache">
                    <?php $this->view('admin/setting-tabs/cache.php',  array(
                        'cache_image' => $cache_image
                    )) ?>
                </div>
                <div class="ultimate-tab" id="push-notifications">
                    <?php $this->view('admin/setting-tabs/push-notifications.php', array( 
                        'push_notificaion_image' => $push_notificaion_image
                    )) ?>
                </div>
            </div>
        </div>
    </div>
	<?php echo UltimateForm::hidden('action', 'save_pwa_settings'); ?>
	<div class="loader-admin"></div>

    <div class="ultimate-form-submit-box">
        <input type="submit" class="button button-primary button-large" value="Save">
    </div>

    <?php echo UltimateForm::close(); ?>

    
</div>