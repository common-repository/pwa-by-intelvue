<?php 
    $pwa_display_options = array(
        'fullscreen' => 'Fullscreen',
        'standalone' => 'Standalone',
        'minimal-ui' => 'Minimal-UI',
        'browser' => 'Browser'
    );

    $pwa_orientation_options = array(
        'landscape' => 'Landscape',
        'portrait' => 'Portrait'
    );

    $pages = get_posts(array('post_type' => 'page', 'posts_per_page' => -1));
    $pages_options = array();

    foreach ($pages as $key => $page) {
        $pages_options[$page->ID] = $page->post_title;
    }

?>

<h2><?php _e('General') ?></h2>
<div class="form-item">
    <label for="pwa_name"><?php _e('Site Name', 'intelvue-pwa') ?></label>
    <?php echo UltimateForm::text('pwa_name', get_option('pwa_name'), array('class' => 'ultimate-input', 'id' => 'pwa_name')); ?>
</div>

<div class="form-item">
    <label for="pwa_short_name"><?php _e('Site Short Name', 'intelvue-pwa') ?></label>
    <?php echo UltimateForm::text('pwa_short_name', get_option('pwa_short_name'), array('class' => 'ultimate-input', 'id' => 'pwa_short_name')); ?>
</div>

<div class="form-item">
    <label for="pwa_icon_sm"><?php _e('Icon Small', 'intelvue-pwa') ?></label>
    <?php echo UltimateForm::media('pwa_icon_sm', get_option('pwa_icon_sm'), ['class' => 'ultimate-input', 'id' => 'pwa_icon_sm']); ?>
    <span class="ultimate-input-desc"><?php _e('Should be 192x192') ?></span>
</div>

<div class="form-item">
    <label for="pwa_icon_sm"><?php _e('Icon Large', 'intelvue-pwa') ?></label>
    <?php echo UltimateForm::media('pwa_icon_lg', get_option('pwa_icon_lg'), ['class' => 'ultimate-input', 'id' => 'pwa_icon_lg']); ?>
    <span class="ultimate-input-desc"><?php _e('Should be 512x512') ?></span>
</div>

<div class="form-item">
    <label for="pwa_start_url"><?php _e('Start URL', 'intelvue-pwa') ?></label>
    <?php echo UltimateForm::text('pwa_start_url', get_option('pwa_start_url'), array('class' => 'ultimate-input', 'id' => 'pwa_start_url')); ?>
</div>

<div class="form-item">
    <label for="pwa_start_url"><?php _e('Scope URL', 'intelvue-pwa') ?></label>
    <?php echo UltimateForm::text('pwa_scope', get_option('pwa_scope'), array('class' => 'ultimate-input', 'id' => 'pwa_scope')); ?>
</div>

<div class="form-item">
    <label for="pwa_display"><?php _e('Display Type', 'intelvue-pwa') ?></label>
    <?php echo UltimateForm::select('pwa_display', get_option('pwa_display'), $pwa_display_options, array('class' => 'ultimate-input', 'id' => 'pwa_display')); ?>
    <span class="ultimate-input-desc">
        <a href="https://developers.google.com/web/fundamentals/web-app-manifest/#display" target="_blank"><?php _e('See option details', 'intelvue-pwa') ?></a>
    </span>
</div>

<div class="form-item">
    <label for="pwa_orientation"><?php _e('Orientation', 'intelvue-pwa') ?></label>
    <?php echo UltimateForm::select('pwa_orientation', get_option('pwa_orientation'), $pwa_orientation_options, array('class' => 'ultimate-input', 'id' => 'pwa_orientation')); ?>
</div>

<div class="form-item">
    <label for="pwa_theme_color"><?php _e('Theme Color', 'intelvue-pwa') ?></label>
    <?php echo UltimateForm::text('pwa_theme_color', get_option('pwa_theme_color'), array('class' => 'ultimate-input color-field', 'id' => 'pwa_theme_color')); ?>
</div>

<div class="form-item">
    <label for="pwa_background_color"><?php _e('Background Color', 'intelvue-pwa') ?></label>
    <?php echo UltimateForm::text('pwa_background_color', get_option('pwa_background_color'), array('class' => 'ultimate-input color-field', 'id' => 'pwa_background_color')); ?>
</div>

<!--<div class="form-item">
    <label for="pwa_offline_page"><?php _e('Offline Page', 'intelvue-pwa') ?></label>
    <?php echo UltimateForm::select('pwa_offline_page', get_option('pwa_offline_page'), $pages_options, array('class' => 'ultimate-input', 'id' => 'pwa_offline_page')); ?>
</div> -->