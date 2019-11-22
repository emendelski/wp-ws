<?php
/**
 * Plugin Name:     Contact Form
 * Plugin URI:      PLUGIN SITE HERE
 * Description:     PLUGIN DESCRIPTION HERE
 * Author:          YOUR NAME HERE
 * Author URI:      YOUR SITE HERE
 * Text Domain:     contact-form
 * Domain Path:     /languages
 * Version:         0.1.0
 *
 * @package         Contact_Form
 */

add_shortcode('contact-form', function($atts, $content = '') {
	$defaults = [];

	$shortcode_atts = shortcode_atts($defaults, $atts);
	wp_enqueue_script('contact-form');

	ob_start();

	include('templates/form.php');

	return ob_get_clean();
});

add_action('wp_ajax_nopriv_send-form', 'contact_form_proceed');
add_action('wp_ajax_send-form', 'contact_form_proceed');

add_action('wp_enqueue_scripts', function(){
	wp_register_script('contact-form', plugin_dir_url(__FILE__) . 'assets/js/main.js', ['jquery']);
});

function contact_form_proceed(){
	check_ajax_referer('send-form');

	$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
	$message = filter_input(INPUT_POST, 'message', FILTER_DEFAULT);

	if(!$email) {
		wp_send_json_error([
			'message' => 'Empty email'
		]);
	}

	if(empty($message)) {
		wp_send_json_error([
			'message' => 'Empty message'
		]);
	}

	$result = wp_mail('admin@gootek.pl', 'Message from ' . $email, $message);

	if($result) {
		wp_send_json_success();
	}

	wp_send_json_error([
		'message' => "Can't send your message, sorry"
	]);
}
