<?php
/*
Plugin Name: Schedulista Shortcode Plugin
Description: Enables shortcode to embed Schedulista scheduling button or form. Usage: <code>[schedulista type="button" code="salon"]</code>.
Version: 1.00
License: GPL
Author: Schedulista
Author URI: http://www.schedulista.com
*/

function createSchedulista($atts, $content = null) {
	extract(shortcode_atts(array(
		'type'   => 'button',
		'code'   => '',
		'width'     => '500',
		'height'     => '700',
    ), $atts));

	if (!$code) {

		$error = "
		<div style='border: 20px solid red; border-radius: 40px; padding: 40px; margin: 50px 0 70px;'>
			<h3>Copy & Paste Error</h3>
			<p style='margin: 0;'>Something is wrong with your Schedulista shortcode.</p>
		</div>";

		return $error;

	} elseif (strcmp(strtolower($type), 'widget') == 0) {
	    return createSchedulistaEmbedWidget($code, $width, $height);
	} else {
	    return createSchedulistaEmbedButton($code);
	}
}

function createSchedulistaEmbedButton($code) {
    $html =  "<a href='http://www.schedulista.com/schedule/$code'>";
    $html .=  "<img title='Schedule an Appointment Online' src='http://www.schedulista.com/images/schedule_now_button.png' alt='Schedule an Online Appointment'>";
    $html .=  "</a>";
    return $html;
}

function createSchedulistaEmbedWidget($code, $width, $height) {
    $html = "<iframe id='schedulista-widget' src='https://www.schedulista.com/schedule/$code?mode=widget' width='{$width}px' height='{$height}px' allowtransparency='true' frameborder='0' style='border-width: 0px; visibility: visible; background-color: transparent;' onload='this.style.visibility = \"visible\";'>";
    $html .= "</iframe>";
    return $html;
}

add_shortcode('schedulista', 'createSchedulista');

?>