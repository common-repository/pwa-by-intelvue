<?php

/**
 * Plugin Name: PWA By Intelvue
 * Plugin URI: https://www.intelvue.com/wordpress-progressive-web-app?utm=pwa-plugin-page
 * Description: A plugin for generating progressive web app features like splash and home icon
 * Version: 0.1.5
 * Author: Intelvue
 * Author URI: https://www.intelvue.com/?utm=pwa-plugin-page
 * Requires at least: 4.2
 * Tested up to: 4.7
 *
 * Text Domain: intelvue-pwa
 * Domain Path: /languages/
 */

class PWA_Bootstrap {

    /**
     * Initialize all main files
     */
	public function __construct() 
    {
        require_once __DIR__ . '/inc/functions.php';
        require_once __DIR__ . '/inc/class.pwa_admin.php';
        require_once __DIR__ . '/inc/class.pwa_frontend.php';
        require_once __DIR__ . '/inc/lib/UltimateForm.php';
        require_once __DIR__ . '/inc/lib/UltimateUtil.php';

        register_activation_hook( __FILE__, array($this, 'plugin_activate') );
        register_activation_hook( __FILE__, array($this, 'plugin_deactivate') );

    }

    /**
     * On plugin activation set default values
     */
    public function plugin_activate() 
    {
        update_option('pwa_name', get_option('blogname'));
        update_option('pwa_short_name', get_option('blogname'));
        update_option('pwa_start_url', site_url('/'));
        update_option('pwa_scope', site_url('/'));
        update_option('pwa_display', 'standalone');
        update_option('pwa_orientation', 'portrait');

        try {
            pwa_build_manifest_file();
            add_action( 'activated_plugin', function() {
                exit( wp_redirect( admin_url( 'admin.php?page=intelvue-pwa-settings&intro=true' ) ) );
            });
        } catch(Exception $e) {
            add_action( 'admin_notices', function() use ($e) {
                $class = 'notice notice-error';
                $message = $e->getMessage();
                printf( '<div class="%1$s"><p>%2$s</p></div>', esc_attr( $class ), esc_html( $message ) ); 
            } );
        }
    }

    /**
     * On plugin deactivate remove created files
     */
    public function plugin_deactivate() 
    {
        try {
            pwa_unbuild_manifest_file();
        } catch(Exception $e) {
            add_action( 'admin_notices', function() use ($e) {
                $class = 'notice notice-error';
                $message = $e->getMessage();
                printf( '<div class="%1$s"><p>%2$s</p></div>', esc_attr( $class ), esc_html( $message ) ); 
            } );
        }
    }

}

new PWA_Bootstrap;