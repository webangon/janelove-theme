<?php

require_once get_template_directory() . '/inc/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'janelove_register_required_plugins' );

function janelove_register_required_plugins() {

	$plugins = array(

		array(
			'name' => esc_attr__('janelove Addon','janelove'),
			'slug' => 'janelove-addon',
			'source' => get_template_directory_uri() . '/plugin/janelove-addon.zip',
			'required' => true,
			'version' => '', 
			'force_activation' => false,
			'force_deactivation' => false, 
			'external_url' => '',
		),
	);

    $config = array(
        'default_path' => '',
        'menu' => 'tgmpa-install-plugins',
        'has_notices' => true, 
        'dismissable' => true,
        'dismiss_msg' => '',
        'is_automatic' => false,
        'message'=> '',
    );

    tgmpa( $plugins, $config );

}