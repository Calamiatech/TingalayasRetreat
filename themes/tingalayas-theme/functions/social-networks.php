<?php

add_action ( 'admin_menu', 'create_theme_options_page' );

function	create_theme_options_page () {

	add_options_page ( 'Social Networks', 'Social Networks', 'administrator', __FILE__, 'build_options_page' );

}

add_action ( 'admin_init', 'register_and_build_fields' );

function	register_and_build_fields () { 

	register_setting ( 'plugin_options', 'plugin_options', 'validate_setting' );

	add_settings_section ( 'customtheme_social_networks', 'Social Networks Settings', 'customtheme_social_networks', __FILE__ );
	
	add_settings_field ( 'account_facebook', 'Facebook:', 'account_facebook_setting', __FILE__, 'customtheme_social_networks' );

	add_settings_field ( 'account_twitter', 'Twitter:', 'account_twitter_setting', __FILE__, 'customtheme_social_networks' );
	
#	add_settings_field ( 'account_linkedin', 'LinkedIn:', 'account_linkedin_setting', __FILE__, 'customtheme_social_networks' );
	
	add_settings_field ( 'account_youtube', 'YouTube:', 'account_youtube_setting', __FILE__, 'customtheme_social_networks' );
	
#	add_settings_field ( 'account_contact', 'Contact:', 'account_contact_setting', __FILE__, 'customtheme_social_networks' );
	
#	add_settings_field ( 'account_rss', 'RSS:', 'account_rss_setting', __FILE__, 'customtheme_social_networks' );

	add_settings_field ( 'account_vimeo', 'Vimeo:', 'account_vimeo_setting', __FILE__, 'customtheme_social_networks' );

	add_settings_field ( 'account_flickr', 'Flickr:', 'account_flickr_setting', __FILE__, 'customtheme_social_networks' );

}

function	validate_setting ( $plugin_options ) {
	
	return $plugin_options;

}

function 	customtheme_social_networks () {}

function	account_twitter_setting () {

	$options = get_option ( 'plugin_options' );

	echo	'<input type="text" name="plugin_options[account_twitter]" value="' . $options['account_twitter'] . '" size="80" />';

}

function	account_linkedin_setting () {

	$options = get_option ( 'plugin_options' );

	echo	'<input type="text" name="plugin_options[account_linkedin]" value="' . $options['account_linkedin'] . '" size="80" />';

}

function	account_facebook_setting () {

	$options = get_option ( 'plugin_options' );

	echo	'<input type="text" name="plugin_options[account_facebook]" value="' . $options['account_facebook'] . '" size="80" />';

}

function	account_youtube_setting () {

	$options = get_option ( 'plugin_options' );

	echo	'<input type="text" name="plugin_options[account_youtube]" value="' . $options['account_youtube'] . '" size="80" />';

}

function	account_contact_setting () {

	$options = get_option ( 'plugin_options' );

	echo	'<input type="text" name="plugin_options[account_contact]" value="' . $options['account_contact'] . '" size="80" />';

}

function	account_rss_setting () {

	$options = get_option ( 'plugin_options' );

	echo	'<input type="checkbox" name="plugin_options[account_rss]" value="1"' . ( $options['account_rss'] ? ' checked="checked"' : '' ) . ' />';

}

function	account_vimeo_setting () {

	$options = get_option ( 'plugin_options' );

	echo	'<input type="text" name="plugin_options[account_vimeo]" value="' . $options['account_vimeo'] . '" size="80" />';

}

function	account_flickr_setting () {

	$options = get_option ( 'plugin_options' );

	echo	'<input type="text" name="plugin_options[account_flickr]" value="' . $options['account_flickr'] . '" size="80" />';

}

function 	build_options_page () { ?>

	<div class="wrap">
	
		<div class="icon32" id="icon-tools">&nbsp;</div>
	
		<h2>Social Networks</h2>
	
		<form action="options.php" method="post" enctype="multipart/form-data">
		
			<fieldset>
			
				<?php settings_fields ( 'plugin_options' ); ?>
				
				<?php do_settings_sections ( __FILE__ ); ?>
	
				<p class="submit">
		
					<input name="Submit" type="submit" class="button-primary" value="<?php esc_attr_e ( 'Save Changes' ); ?>" />
		
				</p>
	
			</fieldset>
			
		</form>
		
	</div>

<?php } ?>