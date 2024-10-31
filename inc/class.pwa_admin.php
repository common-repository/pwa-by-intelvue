<?php

class PWA_Admin {
   
    protected $view_path;
    
    public function __construct()
    {
        $this->view_path = __DIR__ . '/view/';
        
        add_action('init', array($this, 'init'));
        add_action( 'admin_enqueue_scripts', array($this, 'admin_enqueue_scripts') );
        add_action( 'admin_menu', array($this, 'admin_menu') );
        add_action('wp_ajax_save_pwa_settings', array($this, 'save_pwa_settings'));
    }

    public function init()
    {
        
        if(!pwa_is_secure()) {
            add_action( 'admin_notices', function() use ($e) {
                $class = 'notice notice-error';
                $message = __('Progressive web app is compatible only with secure protocol (https). Please enable SSL.', 'intelvue-pwa');
                printf( '<div class="%1$s"><p>%2$s</p></div>', esc_attr( $class ), esc_html( $message ) ); 
            } );
        }

        if(get_option('pwa_icon_sm') == '') {
            add_action( 'admin_notices', function() use ($e) {
                $class = 'notice notice-error';
                $message = __('You must upload small icon to run progressive web app. <a href="'.admin_url('admin.php?page=intelvue-pwa-settings').'">Upload now</a>', 'intelvue-pwa');
                printf( '<div class="%1$s"><p>%2$s</p></div>', esc_attr( $class ), $message ); 
            } );    
        }

    }

    public function admin_menu()
    {
        add_menu_page( 
            __('Intelvue PWA Settings', 'intelvue-pwa'), 
            __('Intelvue PWA', 'intelvue-pwa'), 
            'manage_options', 
            'intelvue-pwa-settings', 
            array($this, 'settings_page'), 
            plugins_url( 'assets/intelvue-icon.png', __DIR__ )
        );
    }

    public function settings_page()
    {
        $cache_image            = plugins_url( 'assets/1.jpg', __DIR__ );
        $push_notificaion_image = plugins_url( 'assets/2.jpg', __DIR__ );

        return $this->view('admin/settings.php', array(
            'cache_image' => $cache_image, 
            'push_notificaion_image' => $push_notificaion_image
        ));
    }
    
    public function view( $file_path, $data = array() )
    {
        $file_path = $this->view_path . $file_path;
        
        if( is_file($file_path) && file_exists($file_path) ) {
            extract($data);
            include($file_path);
        } else {
            echo __('Unable to find view file.');
            exit;
        }
        
    }

    public function admin_enqueue_scripts()
    {
        if( is_admin() ) {
            
            wp_enqueue_script( 
                'intelvue-pwa-admin', 
                plugins_url( 'assets/js/admin/main.js', __DIR__ ), 
                array( 'jquery', 'wp-color-picker' ), 
                '20180909'
            );
            
            wp_enqueue_style( 
                'intelvue-pwa-admin', 
                plugins_url( 'assets/css/admin/style.css', __DIR__ ) 
            );

        }
    }

    public function save_pwa_settings()
    {
        foreach ($_POST as $key => $value) {
            if(strpos($key, 'pwa_') === 0) {
                update_option($key, $value);
            }
        }

        try {
            pwa_build_manifest_file();
            UltimateUtils::response_json(array(), __('Data has been saved successfully!', 'intelvue-pwa'), true);
        } catch(Exception $e) {
            UltimateUtils::response_json(array(), $e->getMessage(), false);
        }

        wp_die();
    }
    
}

new PWA_Admin;