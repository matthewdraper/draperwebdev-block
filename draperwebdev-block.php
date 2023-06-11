<?php
/**
 * Plugin Name:       Draperwebdev Block
 * Description:       Example block scaffolded with Create Block tool.
 * Requires at least: 6.1
 * Requires PHP:      7.0
 * Version:           0.1.0
 * Author:            The WordPress Contributors
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       draperwebdev-block
 *
 * @package           create-block
 */

/**
 * Registers the block using the metadata loaded from the `block.json` file.
 * Behind the scenes, it registers also all assets so they can be enqueued
 * through the block editor in the corresponding context.
 *
 * @see https://developer.wordpress.org/reference/functions/register_block_type/
 */
function create_block_draperwebdev_block_block_init() {
	register_block_type( __DIR__ . '/build' );
	register_setting('general', 'contact_phone_number_display', 'esc_attr');
}


function draperwebdev_block_admin_init() {
	add_settings_field(
		'contact_phone_number_display',
		'<label for="contact_phone_number">'.__('Contact Phone Number Display' , 'contact_phone_number_display' ).'</label>',
		'draperwebdev_block_textbox_callback',
		'general',
		'default',
		[
			'label_for' => 'contact_phone_number_display',
			'class' => 'contact_phone_number_display',
			'id' => 'contact_phone_number_display',  // $args for callback
			'name' => 'contact_phone_number_display'
		]
	);
	add_settings_field(
		'contact_phone_number',
		'<label for="contact_phone_number">'.__('Contact Phone Number' , 'contact_phone_number' ).'</label>',
		'draperwebdev_block_textbox_callback',
		'general',
		'default',
		[
			'label_for' => 'contact_phone_number',
			'class' => 'contact_phone_number',
			'id' => 'contact_phone_number',  // $args for callback
			'name' => 'contact_phone_number'
		]
	);
}

// My Shared Callback
function draperwebdev_block_textbox_callback($args) {

	$id = $args['id'] ?? '';
	$name = $args['id'] ?? '';
	$option = get_option($name) ?: '';

	echo "<input type=\"text\" id=\"$id\" name=\"$name\" value=\"$option\">";

}

function draperwebdev_block_render_cta() {
	$phone_display = get_option('contact_phone_number_display') ?? '(555) 555-5555';
	$phone_actual = get_option('contact_phone_number') ?? '+15555555555';
	return "<div class=\"draperwebdev-cta\"><a href=\"tel:$phone_actual\"><div class=\"draperwebdev-cta-small\"><i class=\"fa-solid fa-coffee\"></i>Call Now</div><div class=\"draperwebdev-cta-phone\">$phone_display</div></a></div>";
}

add_action( 'init', 'create_block_draperwebdev_block_block_init' );
add_action('admin_init', 'draperwebdev_block_admin_init');



