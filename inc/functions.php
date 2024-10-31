<?php
if(!function_exists('pwa_build_manifest_file')) {
    
    function pwa_build_manifest_file() {
        if(!is_file(ABSPATH . '/manifest-backup.json') && is_file(ABSPATH . '/manifest.json')) {
            if(!rename(ABSPATH . '/manifest.json', ABSPATH . '/manifest-backup.json')) {
                throw new Exception(__("Unable to take backup or current manifest file.", 'intelvue-pwa'));
            }
        }

        $manifest_data = array(
            'icons' => array()
        );

        if($short_name = get_option('pwa_short_name')) {
            $manifest_data['short_name'] = $short_name;
        }

        if($name = get_option('pwa_name')) {
            $manifest_data['name'] = $name;
        }

        if($icon_lg = get_option('pwa_icon_lg')) {
            $manifest_data['icons'][] = array(
                'src' => $icon_lg,
                'type' => pwa_get_content_type($icon_lg),
                'sizes' => '512x512'
            );        
        }

        if($icon_sm = get_option('pwa_icon_sm')) {



            $manifest_data['icons'][] = array(
                'src' => $icon_sm,
                'type' => pwa_get_content_type($icon_sm),
                'sizes' => '192x192'
            );
        }

        if($start_url = get_option('pwa_start_url')) {
            $manifest_data['start_url'] = $start_url;
        }

        if($scope = get_option('pwa_scope')) {
            $manifest_data['scope'] = $scope;
        }

        if($display = get_option('pwa_display')) {
            $manifest_data['display'] = $display;                    
        }

        if($orientation = get_option('pwa_orientation')) {
            $manifest_data['orientation'] = $orientation;        
        }

        if($theme_color = get_option('pwa_theme_color')) {
            $manifest_data['theme_color'] = $theme_color;        
        }

        if($background_color = get_option('pwa_background_color')) {
            $manifest_data['background_color'] = $background_color;        
        }

        file_put_contents(ABSPATH . '/manifest.json', json_encode($manifest_data));

        $cache_urls = array();

        //$offline_page = get_post(get_option('pwa_offline_page'));

        //$cache_urls[] = get_permalink($offline_page->ID);
        $cache_urls[] = home_url('/');
        $cache_urls[] = get_stylesheet_uri();

        // js code for main service worker file
        $sw_content = '';
        file_put_contents(ABSPATH . '/pwasw.js', $sw_content);
    }  
      
}

if(!function_exists('pwa_unbuild_manifest_file')) {
    function pwa_unbuild_manifest_file() {
        @unlink(ABSPATH . '/pwasw.js');
    }
}


if(!function_exists('pwa_is_secure')) {
    function pwa_is_secure() {
        return (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || $_SERVER['SERVER_PORT'] == 443;
    }
}

if(!function_exists('pwa_get_content_type')) {
    function pwa_get_content_type($image_url) {
        $ext = strtolower(substr($image_url, -4));
        switch ($ext) {
            case 'jpeg':
            case 'jpg':
                return 'image/jpeg';
                
            case '.gif':
                return 'image/gif';
                
        }

       return 'image/png';
    }
}