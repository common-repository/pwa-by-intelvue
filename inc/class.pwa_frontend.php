<?php

class PWA_Frontend {

	public function __construct()
	{
		add_action('wp_head', array($this, 'wp_head'));
		add_action('wp_footer', array($this, 'wp_footer'));
	}

	public function wp_head()
	{
		if(is_file(ABSPATH . 'manifest.json')) {
			echo '<link rel="manifest" href="'.site_url('/manifest.json').'" />' . "\n";
			echo '<meta name="theme-color" content="'.get_option('pwa_theme_color', '#000000').'" />' . "\n";
		}
	}

	public function wp_footer()
	{
		echo '<script type="text/javascript">

				if ("serviceWorker" in navigator) {
				  navigator.serviceWorker.register("'.site_url('/pwasw.js').'", {scope: "'.get_option('pwa_scope').'"})
				  .then(function(registration) {
				    //console.log("Registration successful, scope is:", registration.scope);
				  })
				  .catch(function(error) {
				  });
				}
			</script>';
	}

}

new PWA_Frontend;