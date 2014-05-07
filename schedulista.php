<?php
/*
Plugin Name: Schedulista Wordpress Plugin
Description: Enables shortcode to embed Schedulista scheduling button or form. Usage: <code>[schedulista type="button" code="salon"]</code>.
Version: 2.00
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
    $html =  <<<EOS
<a href='http://$code.schedulista.com/?utm_source=schedule-now-button&utm_medium=wp&utm_campaign=app'>
<img title='Schedule an Appointment Online'
src='http://www.schedulista.com/assets/schedule_button.png' alt='Online
Scheduling Software'>
</a>
EOS;
    return $html;
}

function createSchedulistaEmbedWidget($code, $width, $height) {
    $html = <<<EOS
<iframe id="schedulista-widget-00"
src="https://www.schedulista.com/schedule/$code?mode=widget"
allowtransparency="true" frameborder="0" scrolling="no" width="100%"
height="900px"></iframe>
<script id="schedulista-widget-script-00" type="text/javascript"
src="https://www.schedulista.com/schedule/$code/widget.js"></script>
EOS;
    return $html;
}

add_shortcode('schedulista', 'createSchedulista');

?>
