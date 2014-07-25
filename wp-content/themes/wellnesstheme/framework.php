<?php
/**
 * The Mysitemyway class. Defines the necessary constants 
 * and includes the necessary files for theme's operation.
 *
 * @package Mysitemyway
 * @subpackage Myriad
 */

class Mysitemyway {
	
	/**
	 * Initializes the theme framework by loading
	 * required files and functions for the theme.
	 *
	 * @since 1.0
	 */
	function init( $options ) {
		self::constants( $options );
		self::functions();
		self::extensions();
		self::classes();
		self::variables();
		self::actions();
		self::filters();
		self::supports();
		self::locale();
		self::admin();
	}
	
	/**
	 * Define theme constants.
	 *
	 * @since 1.0
	 */
	function constants( $options ) {
		define( 'THEME_NAME', $options['theme_name'] );
		define( 'THEME_SLUG', get_template() );
		define( 'THEME_VERSION', $options['theme_version'] );
		define( 'FRAMEWORK_VERSION', '2.1' );
		define( 'DOCUMENTATION_URL', 'http://mysitemyway.com/docs/index.php/Main_Page' );
		define( 'SUPPORT_URL', 'http://mysitemyway.com/support' );
		define( 'MYSITE_PREFIX', 'mysite' );
		define( 'MYSITE_TEXTDOMAIN', THEME_SLUG );
		define( 'MYSITE_ADMIN_TEXTDOMAIN', THEME_SLUG . '_admin' );

		define( 'MYSITE_SETTINGS', 'mysite_' . THEME_SLUG . '_options' );
		define( 'MYSITE_INTERNAL_SETTINGS', 'mysite_' . THEME_SLUG . '_internal_options' );
		define( 'MYSITE_SIDEBARS', 'mysite_' . THEME_SLUG . '_sidebars' );
		define( 'MYSITE_SKINS', 'mysite_' . THEME_SLUG . '_skins' );
		define( 'MYSITE_ACTIVE_SKIN', 'mysite_' . THEME_SLUG . '_active_skin' );
		define( 'MYSITE_SKIN_NT_WRITABLE', 'mysite_' . THEME_SLUG . '_skins_nt_writable' );

		define( 'THEME_URI', get_template_directory_uri() );
		define( 'THEME_DIR', get_template_directory() );

		define( 'THEME_LIBRARY', THEME_DIR . '/lib' );
		define( 'THEME_ADMIN', THEME_LIBRARY . '/admin' );
		define( 'THEME_FUNCTIONS', THEME_LIBRARY . '/functions' );
		define( 'THEME_CLASSES', THEME_LIBRARY . '/classes' );
		define( 'THEME_EXTENSIONS', THEME_LIBRARY . '/extensions' );
		define( 'THEME_SHORTCODES', THEME_LIBRARY . '/shortcodes' );
		define( 'THEME_CACHE', THEME_DIR . '/cache' );
		define( 'THEME_FONTS', THEME_LIBRARY . '/scripts/fonts' );
		define( 'THEME_STYLES_DIR', THEME_DIR . '/styles' );
		define( 'THEME_PATTERNS_DIR', THEME_STYLES_DIR . '/_patterns' );
		define( 'THEME_SPRITES_DIR', THEME_STYLES_DIR . '/_sprites' );
		define( 'THEME_IMAGES_DIR', THEME_DIR . '/images' );

		define( 'THEME_PATTERNS', '_patterns' );
		define( 'THEME_IMAGES', THEME_URI . '/images' );
		define( 'THEME_IMAGES_ASSETS', THEME_IMAGES . '/assets' );
		define( 'THEME_JS', THEME_URI . '/lib/scripts' );
		define( 'THEME_STYLES', THEME_URI . '/styles' );
		define( 'THEME_SPRITES', THEME_STYLES . '/_sprites' );

		define( 'THEME_ADMIN_FUNCTIONS', THEME_ADMIN . '/functions' );
		define( 'THEME_ADMIN_CLASSES', THEME_ADMIN . '/classes');
		define( 'THEME_ADMIN_OPTIONS', THEME_ADMIN . '/options');
		define( 'THEME_ADMIN_ASSETS_URI', THEME_URI . '/lib/admin/assets' );
		
		define( 'DEFAULT_SKIN', 'orange.css' );
		define( 'FANCY_PORTFOLIO', TRUE );
		define( 'DISABLE_SLIDEMENU', TRUE );
	}
		
	/**
	 * Loads theme functions.
	 *
	 * @since 1.0
	 */
	function functions() {
		require_once( THEME_DIR . '/activation.php' );
		require_once( THEME_FUNCTIONS . '/hooks-actions.php' );
		require_once( THEME_FUNCTIONS . '/context.php' );
		require_once( THEME_FUNCTIONS . '/core.php' );
		require_once( THEME_FUNCTIONS . '/theme.php' );
		require_once( THEME_FUNCTIONS . '/sliders.php' );
		require_once( THEME_FUNCTIONS . '/scripts.php' );
		require_once( THEME_FUNCTIONS . '/image.php' );
		require_once( THEME_FUNCTIONS . '/twitter.php' );
		require_once( THEME_FUNCTIONS . '/bookmarks.php' );
		require_once( THEME_FUNCTIONS . '/hooks-actions.php' );
	}
	
	/**
	 * Loads theme extensions.
	 *
	 * @since 1.0
	 */
	function extensions() {
		require_once( THEME_EXTENSIONS . '/breadcrumbs-plus/breadcrumbs-plus.php' );
	}
	
	/**
	 * Loads theme classes.
	 *
	 * @since 1.0
	 */
	function classes() {
		require_once( THEME_CLASSES . '/contact.php' );
		require_once( THEME_CLASSES . '/menu-walker.php' );
	}
	
	/**
	 * Loads theme actions.
	 *
	 * @since 1.0
	 */
	function actions() {
		
		# WordPress actions
		add_action( 'init', 'mysite_shortcodes_init' );
		add_action( 'init', 'mysite_menus' );
		add_action( 'init', 'mysite_post_types'  );
		add_action( 'init', 'mysite_register_script' );
		add_action( 'init', 'mysite_wp_image_resize', 11 );
		add_action( 'init', array( 'mysiteForm', 'init'), 11 );
		add_action( 'widgets_init', 'mysite_sidebars' );
		add_action( 'widgets_init', 'mysite_widgets' );
		add_action( 'wp_head', 'mysite_seo_meta' );
		add_action( 'wp_head', 'mysite_accordion_menu' );
		add_action( 'wp_head', 'mysite_fancy_search_script' );
		add_action( 'wp_head', 'mysite_footer_toggle_script' );
		add_action( 'wp_head', 'mysite_browser_resize_width' );
		add_action( 'wp_head', 'mysite_custom_js_hover' );
		add_action( 'wp_head', 'mysite_jscroll' );
		add_action( 'wp_head', 'mysite_analytics' );
		add_action( 'wp_head', 'mysite_custom_bg' );
		add_action( 'wp_head', 'mysite_additional_headers', 99 );
		add_action( 'template_redirect', 'mysite_enqueue_script' );
		add_action( 'template_redirect', 'mysite_squeeze_page' );
		add_action( 'comment_form_defaults', 'mysite_comment_form_args' );
		remove_action( 'wp_head', 'rel_canonical' );
		
		# Mysitemyway actions
		add_action( 'mysite_head', 'mysite_header_scripts' );
		add_action( 'mysite_before_header', 'mysite_fullscreen_bg' );
		add_action( 'mysite_header', 'mysite_logo' );
		add_action( "mysite_header", 'mysite_primary_menu' );
		add_action( 'mysite_header', 'mysite_header_extras' );
		add_action( 'mysite_after_header', create_function('','echo "<div id=\"content_wrap\">";') );
		add_action( 'mysite_after_header', 'mysite_slider_module' );
		add_action( 'mysite_intro_end', 'mysite_breadcrumbs' );
		add_action( 'mysite_after_header', 'mysite_teaser' );
		add_action( 'mysite_before_page_content', 'mysite_home_content' );
		add_action( 'mysite_before_page_content', 'mysite_page_content' );
		add_action( 'mysite_before_page_content', 'mysite_page_title' );
		add_action( 'mysite_before_page_content', 'mysite_query_posts' );
		add_action( 'mysite_post_image_end', 'mysite_post_img_overlay' );
		add_action( 'mysite_before_post', 'mysite_post_image' );
		add_action( 'mysite_before_entry', 'mysite_post_title' );
		add_action( 'mysite_before_entry', 'mysite_comment_bubble' );
		
		add_action( 'mysite_before_entry', 'mysite_post_meta' );
		add_action( 'mysite_singular-page_before_entry', 'mysite_post_image' );
		add_action( 'mysite_singular-post_after_entry', 'mysite_post_meta_bottom' );
		add_action( 'mysite_singular-post_after_entry', 'mysite_post_nav' );
		add_action( 'mysite_singular-post_after_post', 'mysite_post_sociables' );
		add_action( 'mysite_singular-portfolio_after_post', 'mysite_post_sociables' );
		add_action( 'mysite_singular-post_after_post', 'mysite_like_module' );
		add_action( 'mysite_singular-post_after_post', 'mysite_about_author' );
		add_action( 'mysite_after_post', 'mysite_page_navi' );
		add_action( 'mysite_after_main', 'mysite_get_sidebar' );
		add_action( 'mysite_before_footer', 'mysite_footer_teaser' );
		add_action( 'mysite_footer', 'mysite_main_footer' );
		add_action( 'mysite_after_footer_inner', 'mysite_fancy_search' );
		add_action( 'mysite_after_footer_inner', 'mysite_footer_toggle' );
		
		add_action( 'mysite_after_footer', 'mysite_sub_footer' );
		add_action( 'mysite_after_footer', create_function('','echo "</div>";') );
		add_action( 'mysite_body_end', 'mysite_print_cufon' );
		add_action( 'mysite_body_end', 'mysite_image_preloading' );
		add_action( 'mysite_body_end', 'mysite_custom_javascript' );
	}
	
	/**
	 * Loads theme filters.
	 *
	 * @since 1.0
	 */
	function filters() {
		
		# Mysitemyway filters
		add_filter( 'mysite_avatar_size', create_function('','return "70";') );
		add_filter( 'mysite_author_avatar_size', create_function('','return "70";') );
		
		add_filter( 'mysite_date_format', create_function('','return __( "m-d-y", MYSITE_TEXTDOMAIN );') );
		add_filter( 'mysite_read_more', 'mysite_read_more' );
		add_filter( 'mysite_portfolio_read_more', 'mysite_portfolio_read_more', 1, 2 );
		add_filter( 'mysite_portfolio_visit_site', 'mysite_portfolio_visit_site', 1, 2 );
				
		# WordPress filters
		remove_filter( 'the_content', 'wpautop' );
		remove_filter( 'the_content', 'wptexturize' );
		add_filter( 'the_content', 'mysite_texturize_shortcode_before' );
		add_filter( 'the_content', 'mysite_formatter', 99 );
		add_filter( 'widget_text', 'mysite_formatter', 99 );
		add_filter( 'the_content_more_link', 'mysite_full_read_more', 10, 2 );
		add_filter( 'excerpt_length', create_function('','return "20";'), 999 );
		add_filter( 'excerpt_more', create_function('','return " ...";') );
		add_filter( 'posts_where', 'mysite_multi_tax_terms' );
		add_filter( 'pre_get_posts', 'mysite_exclude_category_feed' );
		add_filter( 'pre_get_posts', 'mysite_custom_search' );
		add_filter( 'widget_categories_args', 'mysite_exclude_category_widget' );
		add_filter( 'query_vars', 'mysite_queryvars' );
		add_filter( 'rewrite_rules_array', 'mysite_rewrite_rules',10,2 );
		add_filter( 'widget_text', 'do_shortcode' );
		add_filter( 'wp_page_menu_args', 'mysite_page_menu_args' );
		add_filter( 'the_password_form', 'mysite_password_form' );
		add_filter( 'wp_feed_cache_transient_lifetime', 'mysite_twitter_feed_cahce', 10, 2 );
	}
	
	/**
	 * Loads theme supports.
	 *
	 * @since 1.0
	 */
	function supports() {
		add_theme_support( 'menus' );
		add_theme_support( 'widgets' );
		add_theme_support( 'post-thumbnails', array( 'post', 'page', 'portfolio' ) );
		add_theme_support( 'automatic-feed-links' );
	}
	
	/**
	 * Handles the locale functions file and translations.
	 *
	 * @since 1.0
	 */
	function locale() {
		# Get the user's locale.
		$locale = get_locale();

		if( is_admin() ) {
			# Load admin theme textdomain.
			load_theme_textdomain( MYSITE_ADMIN_TEXTDOMAIN, THEME_ADMIN . '/languages' );
			$locale_file = THEME_ADMIN . "/languages/$locale.php";

		} else {
			# Load theme textdomain.
			load_theme_textdomain( MYSITE_TEXTDOMAIN, THEME_DIR . '/languages' );
			$locale_file = THEME_DIR . "/languages/$locale.php";
		}

		if ( is_readable( $locale_file ) )
			require_once( $locale_file );
	}
		
	/**
	 * Loads admin files.
	 *
	 * @since 1.0
	 */
	function admin() {
		if( !is_admin() ) return;
			
		require_once( THEME_ADMIN . '/admin.php' );
		mysiteAdmin::init();
	}
	
	/**
	 * Define theme variables.
	 *
	 * @since 1.0
	 */
	function variables() {
		global $mysite;
		
		$layout = '';
		$img_set = get_option( MYSITE_SETTINGS );
		$img_set = ( !empty( $img_set ) && !isset( $_POST[MYSITE_SETTINGS]['reset'] ) ) ? $img_set : array();
		$blog_layout = apply_filters( 'mysite_blog_layout', mysite_get_setting( 'blog_layout' ) );
		
		$images = array(
			'one_column_portfolio' => array( 
				( !empty( $img_set['one_column_portfolio_full']['w'] ) ? $img_set['one_column_portfolio_full']['w'] : 640 ),
				( !empty( $img_set['one_column_portfolio_full']['h'] ) ? $img_set['one_column_portfolio_full']['h'] : 457 )),
			'two_column_portfolio' => array( 
				( !empty( $img_set['two_column_portfolio_full']['w'] ) ? $img_set['two_column_portfolio_full']['w'] : 307 ),
				( !empty( $img_set['two_column_portfolio_full']['h'] ) ? $img_set['two_column_portfolio_full']['h'] : 219 )),
			'three_column_portfolio' => array( 
				( !empty( $img_set['three_column_portfolio_full']['w'] ) ? $img_set['three_column_portfolio_full']['w'] : 196 ),
				( !empty( $img_set['three_column_portfolio_full']['h'] ) ? $img_set['three_column_portfolio_full']['h'] : 140 )),
			'four_column_portfolio' => array( 
				( !empty( $img_set['four_column_portfolio_full']['w'] ) ? $img_set['four_column_portfolio_full']['w'] : 140 ),
				( !empty( $img_set['four_column_portfolio_full']['h'] ) ? $img_set['four_column_portfolio_full']['h'] : 100 )),

			'one_column_blog' => array( 
				( !empty( $img_set['one_column_blog_full']['w'] ) ? $img_set['one_column_blog_full']['w'] : 640 ),
				( !empty( $img_set['one_column_blog_full']['h'] ) ? $img_set['one_column_blog_full']['h'] : 457 )),
			'two_column_blog' => array( 
				( !empty( $img_set['two_column_blog_full']['w'] ) ? $img_set['two_column_blog_full']['w'] : 307 ),
				( !empty( $img_set['two_column_blog_full']['h'] ) ? $img_set['two_column_blog_full']['h'] : 219 )),
			'three_column_blog' => array( 
				( !empty( $img_set['three_column_blog_full']['w'] ) ? $img_set['three_column_blog_full']['w'] : 196 ),
				( !empty( $img_set['three_column_blog_full']['h'] ) ? $img_set['three_column_blog_full']['h'] : 140 )),
			'four_column_blog' => array( 
				( !empty( $img_set['four_column_blog_full']['w'] ) ? $img_set['four_column_blog_full']['w'] : 140 ),
				( !empty( $img_set['four_column_blog_full']['h'] ) ? $img_set['four_column_blog_full']['h'] : 100 )),

			'small_post_list' => array( 
				( !empty( $img_set['small_post_list_full']['w'] ) ? $img_set['small_post_list_full']['w'] : 50 ),
				( !empty( $img_set['small_post_list_full']['h'] ) ? $img_set['small_post_list_full']['h'] : 50 )),
			'medium_post_list' => array( 
				( !empty( $img_set['medium_post_list_full']['w'] ) ? $img_set['medium_post_list_full']['w'] : 200 ),
				( !empty( $img_set['medium_post_list_full']['h'] ) ? $img_set['medium_post_list_full']['h'] : 200 )),
			'large_post_list' => array( 
				( !empty( $img_set['large_post_list_full']['w'] ) ? $img_set['large_post_list_full']['w'] : 418 ),
				( !empty( $img_set['large_post_list_full']['h'] ) ? $img_set['large_post_list_full']['h'] : 298 )),

			'portfolio_single_full' => array( 
				( !empty( $img_set['portfolio_single_full_full']['w'] ) ? $img_set['portfolio_single_full_full']['w'] : 700 ),
				( !empty( $img_set['portfolio_single_full_full']['h'] ) ? $img_set['portfolio_single_full_full']['h'] : 500 )),
			'additional_posts_grid' => array( 
				( !empty( $img_set['additional_posts_grid_full']['w'] ) ? $img_set['additional_posts_grid_full']['w'] : 140 ),
				( !empty( $img_set['additional_posts_grid_full']['h'] ) ? $img_set['additional_posts_grid_full']['h'] : 100 )),

		);

		$big_sidebar_images = array(
			'one_column_portfolio' => array( 
				( !empty( $img_set['one_column_portfolio_big']['w'] ) ? $img_set['one_column_portfolio_big']['w'] : 390 ),
				( !empty( $img_set['one_column_portfolio_big']['h'] ) ? $img_set['one_column_portfolio_big']['h'] : 278 )),
			'two_column_portfolio' => array( 
				( !empty( $img_set['two_column_portfolio_big']['w'] ) ? $img_set['two_column_portfolio_big']['w'] : 187 ),
				( !empty( $img_set['two_column_portfolio_big']['h'] ) ? $img_set['two_column_portfolio_big']['h'] : 133 )),
			'three_column_portfolio' => array( 
				( !empty( $img_set['three_column_portfolio_big']['w'] ) ? $img_set['three_column_portfolio_big']['w'] : 119 ),
				( !empty( $img_set['three_column_portfolio_big']['h'] ) ? $img_set['three_column_portfolio_big']['h'] : 85 )),
			'four_column_portfolio' => array( 
				( !empty( $img_set['four_column_portfolio_big']['w'] ) ? $img_set['four_column_portfolio_big']['w'] : 85 ),
				( !empty( $img_set['four_column_portfolio_big']['h'] ) ? $img_set['four_column_portfolio_big']['h'] : 60 )),

			'one_column_blog' => array( 
				( !empty( $img_set['one_column_blog_big']['w'] ) ? $img_set['one_column_blog_big']['w'] : 390 ),
				( !empty( $img_set['one_column_blog_big']['h'] ) ? $img_set['one_column_blog_big']['h'] : 278 )),
			'two_column_blog' => array( 
				( !empty( $img_set['two_column_blog_big']['w'] ) ? $img_set['two_column_blog_big']['w'] : 187 ),
				( !empty( $img_set['two_column_blog_big']['h'] ) ? $img_set['two_column_blog_big']['h'] : 133 )),
			'three_column_blog' => array( 
				( !empty( $img_set['three_column_blog_big']['w'] ) ? $img_set['three_column_blog_big']['w'] : 119 ),
				( !empty( $img_set['three_column_blog_big']['h'] ) ? $img_set['three_column_blog_big']['h'] : 85 )),
			'four_column_blog' => array( 
				( !empty( $img_set['four_column_blog_big']['w'] ) ? $img_set['four_column_blog_big']['w'] : 85 ),
				( !empty( $img_set['four_column_blog_big']['h'] ) ? $img_set['four_column_blog_big']['h'] : 60 )),

			'small_post_list' => array( 
				( !empty( $img_set['small_post_list_big']['w'] ) ? $img_set['small_post_list_big']['w'] : 50 ),
				( !empty( $img_set['small_post_list_big']['h'] ) ? $img_set['small_post_list_big']['h'] : 50 )),
			'medium_post_list' => array( 
				( !empty( $img_set['medium_post_list_big']['w'] ) ? $img_set['medium_post_list_big']['w'] : 200 ),
				( !empty( $img_set['medium_post_list_big']['h'] ) ? $img_set['medium_post_list_big']['h'] : 200 )),
			'large_post_list' => array( 
				( !empty( $img_set['large_post_list_big']['w'] ) ? $img_set['large_post_list_big']['w'] : 254 ),
				( !empty( $img_set['large_post_list_big']['h'] ) ? $img_set['large_post_list_big']['h'] : 181 )),

			'portfolio_single_full' => array( 
				( !empty( $img_set['portfolio_single_full_big']['w'] ) ? $img_set['portfolio_single_full_big']['w'] : 450 ),
				( !empty( $img_set['portfolio_single_full_big']['h'] ) ? $img_set['portfolio_single_full_big']['h'] : 321 )),
			'additional_posts_grid' => array( 
				( !empty( $img_set['additional_posts_grid_big']['w'] ) ? $img_set['additional_posts_grid_big']['w'] : 85 ),
				( !empty( $img_set['additional_posts_grid_big']['h'] ) ? $img_set['additional_posts_grid_big']['h'] : 60 )),

		);

		$small_sidebar_images = array(
			'one_column_portfolio' => array( 
				( !empty( $img_set['one_column_portfolio_small']['w'] ) ? $img_set['one_column_portfolio_small']['w'] : 480 ),
				( !empty( $img_set['one_column_portfolio_small']['h'] ) ? $img_set['one_column_portfolio_small']['h'] : 342 )),
			'two_column_portfolio' => array( 
				( !empty( $img_set['two_column_portfolio_small']['w'] ) ? $img_set['two_column_portfolio_small']['w'] : 230 ),
				( !empty( $img_set['two_column_portfolio_small']['h'] ) ? $img_set['two_column_portfolio_small']['h'] : 164 )),
			'three_column_portfolio' => array( 
				( !empty( $img_set['three_column_portfolio_small']['w'] ) ? $img_set['three_column_portfolio_small']['w'] : 147 ),
				( !empty( $img_set['three_column_portfolio_small']['h'] ) ? $img_set['three_column_portfolio_small']['h'] : 105 )),
			'four_column_portfolio' => array( 
				( !empty( $img_set['four_column_portfolio_small']['w'] ) ? $img_set['four_column_portfolio_small']['w'] : 105 ),
				( !empty( $img_set['four_column_portfolio_small']['h'] ) ? $img_set['four_column_portfolio_small']['h'] : 75 )),

			'one_column_blog' => array( 
				( !empty( $img_set['one_column_blog_small']['w'] ) ? $img_set['one_column_blog_small']['w'] : 480 ),
				( !empty( $img_set['one_column_blog_small']['h'] ) ? $img_set['one_column_blog_small']['h'] : 342 )),
			'two_column_blog' => array( 
				( !empty( $img_set['two_column_blog_small']['w'] ) ? $img_set['two_column_blog_small']['w'] : 230 ),
				( !empty( $img_set['two_column_blog_small']['h'] ) ? $img_set['two_column_blog_small']['h'] : 164 )),
			'three_column_blog' => array( 
				( !empty( $img_set['three_column_blog_small']['w'] ) ? $img_set['three_column_blog_small']['w'] : 147 ),
				( !empty( $img_set['three_column_blog_small']['h'] ) ? $img_set['three_column_blog_small']['h'] : 105 )),
			'four_column_blog' => array( 
				( !empty( $img_set['four_column_blog_small']['w'] ) ? $img_set['four_column_blog_small']['w'] : 105 ),
				( !empty( $img_set['four_column_blog_small']['h'] ) ? $img_set['four_column_blog_small']['h'] : 75 )),

			'small_post_list' => array( 
				( !empty( $img_set['small_post_list_small']['w'] ) ? $img_set['small_post_list_small']['w'] : 50 ),
				( !empty( $img_set['small_post_list_small']['h'] ) ? $img_set['small_post_list_small']['h'] : 50 )),
			'medium_post_list' => array( 
				( !empty( $img_set['medium_post_list_small']['w'] ) ? $img_set['medium_post_list_small']['w'] : 200 ),
				( !empty( $img_set['medium_post_list_small']['h'] ) ? $img_set['medium_post_list_small']['h'] : 200 )),
			'large_post_list' => array( 
				( !empty( $img_set['large_post_list_small']['w'] ) ? $img_set['large_post_list_small']['w'] : 313 ),
				( !empty( $img_set['large_post_list_small']['h'] ) ? $img_set['large_post_list_small']['h'] : 223 )),

			'portfolio_single_full' => array( 
				( !empty( $img_set['portfolio_single_full_small']['w'] ) ? $img_set['portfolio_single_full_small']['w'] : 540 ),
				( !empty( $img_set['portfolio_single_full_small']['h'] ) ? $img_set['portfolio_single_full_small']['h'] : 385 )),
			'additional_posts_grid' => array( 
				( !empty( $img_set['additional_posts_grid_small']['w'] ) ? $img_set['additional_posts_grid_small']['w'] : 105 ),
				( !empty( $img_set['additional_posts_grid_small']['h'] ) ? $img_set['additional_posts_grid_small']['h'] : 75 )),

		);

		$additional_images = array(
		    'one_column_portfolio' => array( 
		        ( !empty( $img_set['one_column_portfolio_fancy']['w'] ) ? $img_set['one_column_portfolio_fancy']['w'] : 698 ),
		        ( !empty( $img_set['one_column_portfolio_fancy']['h'] ) ? $img_set['one_column_portfolio_fancy']['h'] : 698 )),
		    'two_column_portfolio' => array( 
		        ( !empty( $img_set['two_column_portfolio_fancy']['w'] ) ? $img_set['two_column_portfolio_fancy']['w'] : 348 ),
		        ( !empty( $img_set['two_column_portfolio_fancy']['h'] ) ? $img_set['two_column_portfolio_fancy']['h'] : 348 )),
		    'three_column_portfolio' => array( 
		        ( !empty( $img_set['three_column_portfolio_fancy']['w'] ) ? $img_set['three_column_portfolio_fancy']['w'] : 233 ),
		        ( !empty( $img_set['three_column_portfolio_fancy']['h'] ) ? $img_set['three_column_portfolio_fancy']['h'] : 233 )),
		    'four_column_portfolio' => array( 
		        ( !empty( $img_set['four_column_portfolio_fancy']['w'] ) ? $img_set['four_column_portfolio_fancy']['w'] : 174 ),
		        ( !empty( $img_set['four_column_portfolio_fancy']['h'] ) ? $img_set['four_column_portfolio_fancy']['h'] : 174 )),

		    'one_column_blog_full' => array( 
		        ( !empty( $img_set['one_column_blog_fancy_full']['w'] ) ? $img_set['one_column_blog_fancy_full']['w'] : 700 ),
		        ( !empty( $img_set['one_column_blog_fancy_full']['h'] ) ? $img_set['one_column_blog_fancy_full']['h'] : 500 )),
		    'two_column_blog_full' => array( 
		        ( !empty( $img_set['two_column_blog_fancy_full']['w'] ) ? $img_set['two_column_blog_fancy_full']['w'] : 350 ),
		        ( !empty( $img_set['two_column_blog_fancy_full']['h'] ) ? $img_set['two_column_blog_fancy_full']['h'] : 250 )),

		    'one_column_blog_big' => array( 
		        ( !empty( $img_set['one_column_blog_fancy_big']['w'] ) ? $img_set['one_column_blog_fancy_big']['w'] : 450 ),
		        ( !empty( $img_set['one_column_blog_fancy_big']['h'] ) ? $img_set['one_column_blog_fancy_big']['h'] : 320 )),
		    'two_column_blog_big' => array( 
		        ( !empty( $img_set['two_column_blog_fancy_big']['w'] ) ? $img_set['two_column_blog_fancy_big']['w'] : 225 ),
		        ( !empty( $img_set['two_column_blog_fancy_big']['h'] ) ? $img_set['two_column_blog_fancy_big']['h'] : 160 )),

		    'one_column_blog_small' => array( 
		        ( !empty( $img_set['one_column_blog_fancy_small']['w'] ) ? $img_set['one_column_blog_fancy_small']['w'] : 540 ),
		        ( !empty( $img_set['one_column_blog_fancy_small']['h'] ) ? $img_set['one_column_blog_fancy_small']['h'] : 385 )),
		    'two_column_blog_small' => array( 
		        ( !empty( $img_set['two_column_blog_fancy_small']['w'] ) ? $img_set['two_column_blog_fancy_small']['w'] : 270 ),
		        ( !empty( $img_set['two_column_blog_fancy_small']['h'] ) ? $img_set['two_column_blog_fancy_small']['h'] : 192 )),
		
			'image_banner_intro' => array( 
		        ( !empty( $img_set['image_banner_intro_full']['w'] ) ? $img_set['image_banner_intro_full']['w'] : 700 ),
		        ( !empty( $img_set['image_banner_intro_full']['h'] ) ? $img_set['image_banner_intro_full']['h'] : 400 )),

		);



		# Slider
		$images_slider = array(
			'nivo_slide' => array( 700, 400 ),
			'floating_slide' => array( 640, 340 ),
			'staged_slide' => array( 640, 340 ),
			'partial_staged_slide' => array( 370, 340 ),
			'partial_gradient_slide' => array( 700, 400 ),
			'overlay_slide' => array( 700, 400 ),
			'full_slide' => array( 700, 400 ),
			'nav_thumbs' => array( 45, 34 )
		);
		
		foreach( $images as $key => $value ) {
			foreach( $value as $img => $size ) {
				$size = str_replace( ' ', '', $size );
				$new_size[$img] = str_replace( 'px', '', $size );
			}
			$images[$key] = $new_size;
		}

		foreach( $big_sidebar_images as $key => $value ) {
			foreach( $value as $img => $size ) {
				$size = str_replace( ' ', '', $size );
				$new_size[$img] = str_replace( 'px', '', $size );
			}
			$big_sidebar_images[$key] = $new_size;
		}

		foreach( $small_sidebar_images as $key => $value ) {
			foreach( $value as $img => $size ) {
				$size = str_replace( ' ', '', $size );
				$new_size[$img] = str_replace( 'px', '', $size );
			}
			$small_sidebar_images[$key] = $new_size;
		}
		
		foreach( $additional_images as $key => $value ) {
			foreach( $value as $img => $size ) {
				$size = str_replace( ' ', '', $size );
				$new_size[$img] = str_replace( 'px', '', $size );
			}
			$additional_images[$key] = $new_size;
		}
		
		# Blog layouts
		switch( $blog_layout ) {
			case "blog_layout1":
				$layout = array(
					'blog_layout' => $blog_layout,
					'main_class' => 'post_grid blog_layout1',
					'post_class' => 'post_grid_module',
					'content_class' => 'post_grid_content',
					'img_class' => 'post_grid_image'
				);
				break;
			case "blog_layout2":
				$layout = array(
					'blog_layout' => $blog_layout,
					'main_class' => 'post_list blog_layout2',
					'post_class' => 'post_list_module',
					'content_class' => 'post_list_content',
					'img_class' => 'post_list_image'
				);
				break;
			case "blog_layout3":
				$columns_num = 2;
				$featured = 1;
				$columns = ( $columns_num == 2 ? 'one_half'
				: ( $columns_num == 3 ? 'one_third'
				: ( $columns_num == 4 ? 'one_fourth'
				: ( $columns_num == 5 ? 'one_fifth'
				: ( $columns_num == 6 ? 'one_sixth'
				: ''
				)))));

				$layout = array(
					'blog_layout' => $blog_layout,
					'main_class' => 'post_grid blog_layout3',
					'post_class' => 'post_grid_module',
					'content_class' => 'post_grid_content',
					'img_class' => 'post_grid_image',
					'columns_num' => ( !empty( $columns_num ) ? $columns_num : '' ),
					'featured' => ( !empty( $featured ) ? $featured : '' ),
					'columns' => ( !empty( $columns ) ? $columns : '' )
				);
				break;
		}

		$mysite->layout['blog'] = $layout;
		$mysite->layout['images'] = array_merge( $images, array( 'image_padding' => 0 ) );
		$mysite->layout['big_sidebar_images'] = $big_sidebar_images;
		$mysite->layout['small_sidebar_images'] = $small_sidebar_images;
		$mysite->layout['additional_images'] = $additional_images;
		$mysite->layout['images_slider'] = $images_slider;
	}
	
}


/**
 * Functions & Pluggable functions specific to theme.
 *
 * @package Mysitemyway
 * @subpackage Myriad
 */

if ( !function_exists( 'mysite_excerpt_length_short' ) ) :
function mysite_excerpt_length_short( $length ) {
	return 10;
}
endif;

if ( !function_exists( 'mysite_excerpt_length_medium' ) ) :
function mysite_excerpt_length_medium( $length ) {
	return 10;
}
endif;

if ( !function_exists( 'mysite_read_more' ) ) :
function mysite_read_more() {
	global $post;
	$out = '<span class="post_more_link"><a class="post_more_link_a" href="' . esc_url( get_permalink( $post->ID ) ) . '">' . __( 'More', MYSITE_TEXTDOMAIN ) . '</a></span>';
	return $out;
}
endif;

if ( !function_exists( 'mysite_portfolio_read_more' ) ) :
/**
 *
 */
function mysite_portfolio_read_more( $read_more, $url ) {
	return '<span class="post_more_link portfolio_more"><a href="' . $url  . '" class="post_more_link_a">' . __( 'More', MYSITE_TEXTDOMAIN ) . '</a></span>';
}
endif;

if ( !function_exists( 'mysite_portfolio_visit_site' ) ) :
/**
 *
 */
function mysite_portfolio_visit_site( $visit_site, $url ) {
	return '<span class="post_more_link portfolio_link"><a href="' . $url  . '" class="post_more_link_a">' . __( 'Visit', MYSITE_TEXTDOMAIN ) . '</a></span>';
}
endif;

if ( !function_exists( 'mysite_post_img_overlay' ) ) :
/**
 *
 */
function mysite_post_img_overlay() {
	$out = '<span class="image_overlay"></span>';
	echo $out;
}
endif;

if ( !function_exists( 'mysite_comment_bubble' ) ) :
/**
 *
 */
function mysite_comment_bubble( $args = array() ) {
	$defaults = array(
		'shortcode' => false,
		'echo' => true
	);
	
	$number = get_comments_number();
	if( ( $number<1 && !comments_open() ) || ( is_attachment() ) || ( is_singular( 'portfolio' ) ) ) return;
	
	$args = wp_parse_args( $args, $defaults );
	extract( $args );
	
	if ( is_page() && !$shortcode ) return;
	
	$meta_options = mysite_get_setting( 'disable_meta_options' );
	if( is_array( $meta_options ) && in_array( 'comments_meta', $meta_options ) )
		return;
	
	$out = '<div class="post_comments_bubble">[post_comments text="" more="%1$s" one="1" zero="0"]</div>';
	
	if( $echo )
		echo apply_atomic_shortcode( 'comment_bubble', $out );
	else
		return apply_atomic_shortcode( 'comment_bubble', $out );
}
endif;

if ( !function_exists( 'mysite_post_meta' ) ) :
/**
 *
 */
function mysite_post_meta( $args = array() ) {
	$defaults = array(
		'shortcode' => false,
		'echo' => true
	);
	
	$args = wp_parse_args( $args, $defaults );
	
	extract( $args );
	
	if( is_page() && !$shortcode ) return;
	if( !empty( $shortcode ) && strpos( $disable, 'meta' ) !== false ) return;
	
	$out = '';
	$meta_options = mysite_get_setting( 'disable_meta_options' );
	$_meta = ( is_array( $meta_options ) ) ? $meta_options : array();
	$meta_output = '';
	
		
	if( !in_array( 'author_meta', $_meta ) )
		$meta_output .= '[post_author text="' . __( '<em>by</em>', MYSITE_TEXTDOMAIN ) . ' "] ';
		
	if( !in_array( 'date_meta', $_meta ) )
		$meta_output .= '[post_date text="' . __( '<em>on</em>', MYSITE_TEXTDOMAIN ) . ' " format="' . __( 'm-d-y', MYSITE_TEXTDOMAIN ) . '"] ';

	if( !in_array( 'categories_meta', $_meta ) )
		$meta_output .= '[post_terms taxonomy="category" text="' . __( '<em>in</em>', MYSITE_TEXTDOMAIN ) . ' "] ';

	
	if( !empty( $meta_output ) )
		$out .='<p class="post_meta">' . $meta_output . '</p>';
	
	if( $echo )
		echo apply_atomic_shortcode( 'post_meta', $out );
	else
		return apply_atomic_shortcode( 'post_meta', $out );
}
endif;

if ( !function_exists( 'mysite_post_meta_bottom' ) ) :
/**
 *
 */
function mysite_post_meta_bottom() {
	if( is_page() ) return;
	
	$out = '';
	$meta_options = mysite_get_setting( 'disable_meta_options' );
	$_meta = ( is_array( $meta_options ) ) ? $meta_options : array();
	$meta_output = '';

	if( !in_array( 'tags_meta', $_meta ) )
		$meta_output .= '[post_terms text=' . __( '<em>Tags:</em>&nbsp;', MYSITE_TEXTDOMAIN ) . ']';

	if( !empty( $meta_output ) )
		$out .='<p class="post_meta_bottom">' . $meta_output . '</p>';
	
	echo apply_atomic_shortcode( 'post_meta_bottom', $out );
}
endif;

if ( !function_exists( 'mysite_about_author' ) ) :
/**
 *
 */
function mysite_about_author() {
	$disable_post_author = apply_atomic( 'disable_post_author', mysite_get_setting( 'disable_post_author' ) );
	if( !is_singular( 'post' ) || !empty( $disable_post_author ) )
		return;
		
	$out = '';
	
	if( get_the_author_meta( 'description' ) ) {
		$out .= '<div class="about_author_module">';
		$out .= '<div class="about_author_content">';
		
		$out .= get_avatar( get_the_author_meta('user_email'), apply_filters( 'mysite_author_avatar_size', '80' ), THEME_IMAGES_ASSETS . '/author_gravatar_default.png' );
		$out .= '<p class="author_bio"><span class="about_author_title">' . __( 'About the Author', MYSITE_TEXTDOMAIN ) . ' : <span class="author_name">' . esc_attr(get_the_author()) . '</span></span>'
		. get_the_author_meta( 'description' );
		
		$out .= '[fancy_link link="' . get_author_posts_url( get_the_author_meta( 'ID' ) ) . '"]' . sprintf( __( 'View all posts by %s', MYSITE_TEXTDOMAIN ), get_the_author() ) . '[/fancy_link]';
		$out .= '</p><!-- .author_bio -->';
		
		$out .= '<div class="clearboth"></div>';
		$out .= '</div><!-- .about_author_content -->';
		$out .= '</div><!-- .about_author_module -->';
	}
	
	echo apply_atomic_shortcode( 'about_author', $out );
}
endif;

if ( !function_exists( 'mysite_footer_toggle' ) ) :
/**
 *
 */
function mysite_footer_toggle() {
	echo '<div id="footer_toggle"></div>';
}
endif;

if ( !function_exists( 'mysite_footer_toggle_script' ) ) :
/**
 *
 */
function mysite_footer_toggle_script() {
	
	$out = "<script type=\"text/javascript\">
	/* <![CDATA[ */
	jQuery(document).ready(function() {
		jQuery('#footer_toggle').toggle(function(){
			jQuery(this).addClass('active');
			}, function () {
			jQuery(this).removeClass('active');
		});

		jQuery('#footer_toggle').click(function(){
			footerInnerHeight = jQuery( '#footer_inner' ).actual( 'height' );
			jQuery('#footer_inner').css('height',footerInnerHeight);
			jQuery('#footer_inner').slideToggle();
		});
		
		jQuery(window).bind('resize', function() {
			if( jQuery( '#footer_inner' ).is(':visible') ) {
				jQuery( '#footer_inner' ).height('')
			}
		});
	});
	/* ]]> */
	</script>";
	
	echo preg_replace( "/(\r\n|\r|\n)\s*/i", '', $out ) . "\r";
}
endif;

if ( !function_exists( 'mysite_fancy_search' ) ) :
/**
 * 
 */
function mysite_fancy_search() {
	
	$out = '<div id="fancy_search" class="search_hidden">';
	$out .= '<form method="get" action="' . home_url() . '/">';
	$out .= '<input class="text" name="s" id="s" style="width:0px;margin:0;display:none;" />';
	$out .= '<input type="submit" value="submit" class="submit" />';
	$out .= '</form>';
	$out .= '</div>';
	
	echo apply_atomic( 'fancy_search', $out );
}
endif;

if ( !function_exists( 'mysite_fancy_search_script' ) ) :
/**
 *
 */
function mysite_fancy_search_script() {
	
	$out = "<script type=\"text/javascript\">
	/* <![CDATA[ */
		jQuery(document).ready(function() {
			var search = jQuery('#fancy_search'),
			    searchField = search.find('input.text');

			var hoverConfigSearch = {
				interval:100,
				timeout:2000,
				over:function(){
					jQuery(searchField).css('display', 'block');
					searchField.animate({width:160}, 400, 'easeInOutQuad').focus();
				},
				out:function(){
					searchField.animate({width:0}, 400, 'easeInOutQuad', function(){ jQuery(searchField).css('display', 'none') } ).blur();
				}
			};
			search.hoverIntent(hoverConfigSearch);
	});
	/* ]]> */
	</script>";
	
	echo preg_replace( "/(\r\n|\r|\n)\s*/i", '', $out ) . "\r";
}
endif;

if ( !function_exists( 'mysite_accordion_menu' ) ) :
/**
 *
 */
function mysite_accordion_menu() {
	
	$out = "<script type=\"text/javascript\">
	/* <![CDATA[ */
		(function($){

			var ulIndent = 0,
				slideSpeed = 'fast';

			$(document).ready(function() {
				var menu = $('.jqueryslidemenu').children(),
					menuId = menu[0].id;
				
				if( menuId != '' ){
					$('#' +menuId).accordionMenu('#' +menuId);
				}
			});

		    $.fn.accordionMenu = function(menuId) {
				var navWidth = $(menuId).actual( 'width' );
		        $(menuId).css('width', navWidth + 'px');
			    $(menuId+ ' ul').css('width', navWidth + 'px');

			    $(menuId+ ' a').each(function() {
			    	var level = $(this).parents('ul').length,
						liWidth = navWidth - (ulIndent * level);
			    	$(this).parent('li').css('width', liWidth + 'px');
			    });    

			    
			    $(menuId+ ' li').each(function () {
			        if ($(this).children('ul').length > 0) {
			            if ($(this).children('ul').is(':visible')) {
			                $(this).prepend('<img class=\"primary_menu_icon\" src=\"' +assetsUri+ '/imgOnOpen.png\" />');
			            }
			            else {
			                $(this).prepend('<img class=\"primary_menu_icon\" src=\"' +assetsUri+ '/imgOffClosed.png\" />');
			            }
			        }
			    });

			    
			    $(menuId+ ' img').click(function() {
			        if ($(this).parent('li').children('ul').html() != null) {
			            $(this).parent('li').parent('ul').children('li').children('ul').hide(slideSpeed);
			            $(this).parent('li').parent('ul').children('li').children('img').attr('src', assetsUri + '/imgOffClosed.png');
			            $(this).delay(100).is(':hidden');
			            if ($(this).parent('li').children('ul').css('display') == 'block') {
			                $(this).parent('li').children('ul').hide(slideSpeed, function() {
							    var logo = jQuery( '.logo' ).actual( 'outerHeight', { includeMargin : true }),
									menu = jQuery( '#primary_menu' ).actual( 'outerHeight', { includeMargin : true });
									extras = jQuery( '#header_extras_inner' ).actual( 'outerHeight', { includeMargin : true }),
									browserHeight = jQuery(window).height();
									
								if(logo+menu+extras < browserHeight){
									jQuery('#header').css('position','fixed');
								}
							  });
			                $(this).attr('src', assetsUri + '/imgOffClosed.png');
			            } else {
			                $(this).parent('li').children('ul').show(slideSpeed, function() {
							    var logo = jQuery( '.logo' ).actual( 'outerHeight', { includeMargin : true }),
									menu = jQuery( '#primary_menu' ).actual( 'outerHeight', { includeMargin : true });
									extras = jQuery( '#header_extras_inner' ).actual( 'outerHeight', { includeMargin : true }),
									browserHeight = jQuery(window).height();
									
								if(logo+menu+extras > browserHeight){
									jQuery('#header').css('position','absolute');
								}
							  });
			                $(this).attr('src', assetsUri + '/imgOnOpen.png');
			            }
			
			            return false;
			        }
			    });

		    };
		})(jQuery);
	/* ]]> */
	</script>";
	
	echo preg_replace( "/(\r\n|\r|\n)\s*/i", '', $out ) . "\r";
}
endif;

if ( !function_exists( 'mysite_custom_js_hover' ) ) :
/**
 *
 */
function mysite_custom_js_hover() {
	
	$out = "<script type=\"text/javascript\">
	/* <![CDATA[ */
	jQuery(document).ready(function() {
		fancyPortfolio = false;
		if (jQuery('body').hasClass('fancy_portfolio')) {
			fancyPortfolio = true;
		}
		
		jQuery(document).delegate('.myriad_hover_fade_js', 'mouseenter mouseleave', function(e) {
			if( e.type == 'mouseenter'){
				_this = jQuery(this);
				if(fancyPortfolio){
					_this.find('.post_grid_content').css('display','block');
				}
				_this.find('.hover_overlay').fadeIn(300);
			}
			if( e.type == 'mouseleave'){
				if(fancyPortfolio){
					_this.find('.post_grid_content').css('display','none');
				}
				_this.find('.hover_overlay').fadeOut('fast');
			}
		});
		
	});
	/* ]]> */
	</script>";
	
	echo preg_replace( "/(\r\n|\r|\n)\s*/i", '', $out ) . "\r";
}
endif;

if ( !function_exists( 'mysite_jscroll' ) ) :
/**
 *
 */
function mysite_jscroll() {
	
	$out = "<script type=\"text/javascript\">
	/* <![CDATA[ */
	jQuery(document).ready(function() {
		jQuery(function() {
		    jQuery('.share_this_module').jScroll({speed : 'fast', top : 0});
		});
	});
	/* ]]> */
	</script>";
	
	echo preg_replace( "/(\r\n|\r|\n)\s*/i", '', $out ) . "\r";
}
endif;

if ( !function_exists( 'mysite_browser_resize_width' ) ) :
/**
 *
 */
function mysite_browser_resize_width() {
	
	$out = "<script type=\"text/javascript\">
	/* <![CDATA[ */
	jQuery(document).ready(function() {
		var wrap = jQuery( '#content_wrap' ).actual( 'outerWidth', { includeMargin : true }),
			bodyInner = jQuery('#body_inner').css('margin-left');
			bodyWidth = parseInt(wrap)+parseInt(bodyInner);

		jQuery(window).bind('resize', function() {
			browserWidth = jQuery(window).width();

			if(bodyWidth>browserWidth){
				jQuery('#header').css('position','absolute');
			}
			if(bodyWidth<browserWidth){
				jQuery('#header').css('position','fixed');
			}
		});
	});
	/* ]]> */
	</script>";
	
	echo preg_replace( "/(\r\n|\r|\n)\s*/i", '', $out ) . "\r";
}
endif;

if ( !function_exists( 'mysite_image_preloading' ) ) :
/**
 *
 */
function mysite_image_preloading() {
	
	$out = "
	<script type=\"text/javascript\">
	/* <![CDATA[ */
	
	fancyPortfolio = false;
	if (jQuery('body').hasClass('fancy_portfolio')) {
		fancyPortfolio = true;
	}
	
	jQuery( '.blog_layout1' ).preloader({ imgSelector: '.blog_index_image_load span img', imgAppend: '.blog_index_image_load',
		oneachload: function(image){
			var img = jQuery(image),
				link = img.parent().parent();
				
			img.removeClass('hover_fade_js');
			link.addClass('myriad_hover_fade_js');
			link.prepend('<span class=\"hover_overlay\"><span class=\"hover_icon\"></span></span>');
			if(link.css('backgroundImage')=='none'){
				link.find('.hover_icon').css('backgroundImage','url(' +assetsUri+ '/link.png)');
			}
		}
	});
	
	jQuery( '.blog_layout2' ).preloader({ imgSelector: '.blog_index_image_load span img', imgAppend: '.blog_index_image_load',
		oneachload: function(image){
			var img = jQuery(image),
				link = img.parent().parent();
				
			img.removeClass('hover_fade_js');
			link.addClass('myriad_hover_fade_js');
			link.prepend('<span class=\"hover_overlay\"><span class=\"hover_icon\"></span></span>');
			if(link.css('backgroundImage')=='none'){
				link.find('.hover_icon').css('backgroundImage','url(' +assetsUri+ '/link.png)');
			}
		}
	});
	
	jQuery( '.blog_layout3' ).preloader({ imgSelector: '.blog_index_image_load span img', imgAppend: '.blog_index_image_load',
		oneachload: function(image){
			var img = jQuery(image),
				link = img.parent().parent();
				
			img.removeClass('hover_fade_js');
			link.addClass('myriad_hover_fade_js');
			link.prepend('<span class=\"hover_overlay\"><span class=\"hover_icon\"></span></span>');
			if(link.css('backgroundImage')=='none'){
				link.find('.hover_icon').css('backgroundImage','url(' +assetsUri+ '/link.png)');
			}
		}
	});
	
	jQuery( '#main_inner' ).preloader({ imgSelector: '.blog_index_image_load span img', imgAppend: '.blog_index_image_load',
		oneachload: function(image){
			var img = jQuery(image),
				link = img.parent().parent();
				
			img.removeClass('hover_fade_js');
			link.addClass('myriad_hover_fade_js');
			link.prepend('<span class=\"hover_overlay\"><span class=\"hover_icon\"></span></span>');
			if(link.css('backgroundImage').search('play.png')>0){
				link.find('.hover_icon').css('backgroundImage','url(' +assetsUri+ '/play.png)');
			}
			link.css('backgroundImage','none');
		}
	});
	
	jQuery( '.one_column_portfolio' ).preloader({ imgSelector: '.portfolio_img_load span img', imgAppend: '.portfolio_img_load',
		oneachload: function(image){
			var img = jQuery(image),
				post = img.parent().parent().parent().parent(),
				link = img.parent().parent();
			
			img.removeClass('hover_fade_js');
			if(fancyPortfolio){
				post.addClass('myriad_hover_fade_js');
			}else{
				link.addClass('myriad_hover_fade_js');
			}
			post.find('.date').css('display','block');
			link.prepend('<span class=\"hover_overlay\"><span class=\"hover_icon\"></span></span>');
			if(link.css('backgroundImage').search('play.png')>0){
				link.find('.hover_icon').css('backgroundImage','url(' +assetsUri+ '/play.png)');
			}
			if(link.css('backgroundImage')=='none'){
				link.find('.hover_icon').css('backgroundImage','url(' +assetsUri+ '/link.png)');
				if(fancyPortfolio){
					if(post.find('.portfolio_more').length>0){
						link.find('.hover_icon').remove();
					}
				}
				
			}
			link.css('backgroundImage','none');
		}
	});
	
	jQuery( '.two_column_portfolio' ).preloader({ imgSelector: '.portfolio_img_load span img', imgAppend: '.portfolio_img_load',
		oneachload: function(image){
			var img = jQuery(image),
				post = img.parent().parent().parent().parent(),
				link = img.parent().parent();
			
			img.removeClass('hover_fade_js');
			if(fancyPortfolio){
				post.addClass('myriad_hover_fade_js');
			}else{
				link.addClass('myriad_hover_fade_js');
			}
			post.find('.date').css('display','block');
			link.prepend('<span class=\"hover_overlay\"><span class=\"hover_icon\"></span></span>');
			if(link.css('backgroundImage').search('play.png')>0){
				link.find('.hover_icon').css('backgroundImage','url(' +assetsUri+ '/play.png)');
			}
			if(link.css('backgroundImage')=='none'){
				link.find('.hover_icon').css('backgroundImage','url(' +assetsUri+ '/link.png)');
				if(fancyPortfolio){
					if(post.find('.portfolio_more').length>0){
						link.find('.hover_icon').remove();
					}
				}
				
			}
			link.css('backgroundImage','none');
		}
	});
	
	jQuery( '.three_column_portfolio' ).preloader({ imgSelector: '.portfolio_img_load span img', imgAppend: '.portfolio_img_load',
		oneachload: function(image){
			var img = jQuery(image),
				post = img.parent().parent().parent().parent(),
				link = img.parent().parent();
			
			img.removeClass('hover_fade_js');
			if(fancyPortfolio){
				post.addClass('myriad_hover_fade_js');
			}else{
				link.addClass('myriad_hover_fade_js');
			}
			post.find('.date').css('display','block');
			link.prepend('<span class=\"hover_overlay\"><span class=\"hover_icon\"></span></span>');
			if(link.css('backgroundImage').search('play.png')>0){
				link.find('.hover_icon').css('backgroundImage','url(' +assetsUri+ '/play.png)');
			}
			if(link.css('backgroundImage')=='none'){
				link.find('.hover_icon').css('backgroundImage','url(' +assetsUri+ '/link.png)');
				if(fancyPortfolio){
					if(post.find('.portfolio_more').length>0){
						link.find('.hover_icon').remove();
					}
				}
				
			}
			link.css('backgroundImage','none');
		}
	});
	
	jQuery( '.four_column_portfolio' ).preloader({ imgSelector: '.portfolio_img_load span img', imgAppend: '.portfolio_img_load',
		oneachload: function(image){
			var img = jQuery(image),
				post = img.parent().parent().parent().parent(),
				link = img.parent().parent();
			
			img.removeClass('hover_fade_js');
			if(fancyPortfolio){
				post.addClass('myriad_hover_fade_js');
			}else{
				link.addClass('myriad_hover_fade_js');
			}
			post.find('.date').css('display','block');
			link.prepend('<span class=\"hover_overlay\"><span class=\"hover_icon\"></span></span>');
			if(link.css('backgroundImage').search('play.png')>0){
				link.find('.hover_icon').css('backgroundImage','url(' +assetsUri+ '/play.png)');
			}
			if(link.css('backgroundImage')=='none'){
				link.find('.hover_icon').css('backgroundImage','url(' +assetsUri+ '/link.png)');
				if(fancyPortfolio){
					if(post.find('.portfolio_more').length>0){
						link.find('.hover_icon').remove();
					}
				}
				
			}
			link.css('backgroundImage','none');
		}
	});
	
	jQuery( '.portfolio_gallery.large_post_list' ).preloader({ imgSelector: '.portfolio_img_load span img', imgAppend: '.portfolio_img_load',
		oneachload: function(image){
			var img = jQuery(image),
				post = img.parent().parent().parent().parent(),
				link = img.parent().parent();
				
			img.removeClass('hover_fade_js');
			link.addClass('myriad_hover_fade_js');
			post.find('.date').css('display','block');
			link.prepend('<span class=\"hover_overlay\"><span class=\"hover_icon\"></span></span>');
			if(link.css('backgroundImage').search('play.png')>0){
				link.find('.hover_icon').css('backgroundImage','url(' +assetsUri+ '/play.png)');
			}
			link.css('backgroundImage','none');
		}
	});
	
	jQuery( '.portfolio_gallery.medium_post_list' ).preloader({ imgSelector: '.portfolio_img_load span img', imgAppend: '.portfolio_img_load',
		oneachload: function(image){
			var img = jQuery(image),
				post = img.parent().parent().parent().parent(),
				link = img.parent().parent();
				
			img.removeClass('hover_fade_js');
			link.addClass('myriad_hover_fade_js');
			post.find('.date').css('display','block');
			link.prepend('<span class=\"hover_overlay\"><span class=\"hover_icon\"></span></span>');
			if(link.css('backgroundImage').search('play.png')>0){
				link.find('.hover_icon').css('backgroundImage','url(' +assetsUri+ '/play.png)');
			}
			link.css('backgroundImage','none');
		}
	});
	
	jQuery( '.portfolio_gallery.small_post_list' ).preloader({ imgSelector: '.portfolio_img_load span img', imgAppend: '.portfolio_img_load',
		oneachload: function(image){
			var img = jQuery(image),
				post = img.parent().parent().parent().parent(),
				link = img.parent().parent();
				
			img.removeClass('hover_fade_js');
			link.addClass('myriad_hover_fade_js');
			link.prepend('<span class=\"hover_overlay\"><span class=\"hover_icon\"></span></span>');
			if(link.css('backgroundImage').search('play.png')>0){
				link.find('.hover_icon').css('backgroundImage','url(' +assetsUri+ '/play.png)');
			}
			link.css('backgroundImage','none');
		}
	});
	
	jQuery( '#main_inner' ).preloader({ imgSelector: '.blog_sc_image_load span img', imgAppend: '.blog_sc_image_load',
		oneachload: function(image){
			var img = jQuery(image),
				link = img.parent().parent();
				
			img.removeClass('hover_fade_js');
			link.addClass('myriad_hover_fade_js');
			link.prepend('<span class=\"hover_overlay\"><span class=\"hover_icon\"></span></span>');
			if(link.css('backgroundImage')=='none'){
				link.find('.hover_icon').css('backgroundImage','url(' +assetsUri+ '/link.png)');
			}
			link.css('backgroundImage','none');
			
		}
	});
	
	jQuery( '#main_inner' ).preloader({ imgSelector: '.fancy_image_load span img', imgAppend: '.fancy_image_load',
		oneachload: function(image){
			var imageCaption = jQuery(image).parent().parent().next();
			if(imageCaption.length>0){
				imageCaption.remove();
				jQuery(image).parent().addClass('has_caption_frame');
				jQuery(image).parent().append(imageCaption);
				jQuery(image).next().css('display','block');
			}
			
			var img = jQuery(image),
				link = img.parent().parent();
				
			img.removeClass('hover_fade_js');
			link.css('backgroundImage','none');
			link.addClass('myriad_hover_fade_js');
			link.prepend('<span class=\"hover_overlay\"><span class=\"hover_icon\"></span></span>');
		}
	});
	
	jQuery( '#intro_inner' ).preloader({ imgSelector: '.fancy_image_load span img', imgAppend: '.fancy_image_load',
		oneachload: function(image){
			var imageCaption = jQuery(image).parent().parent().next();
			if(imageCaption.length>0){
				imageCaption.remove();
				jQuery(image).parent().addClass('has_caption_frame');
				jQuery(image).parent().append(imageCaption);
				jQuery(image).next().css('display','block');
			}
			
			var img = jQuery(image),
				link = img.parent().parent();
				
			img.removeClass('hover_fade_js');
			link.css('backgroundImage','none');
			link.addClass('myriad_hover_fade_js');
			link.prepend('<span class=\"hover_overlay\"><span class=\"hover_icon\"></span></span>');
		}
	});
	
	jQuery( '#footer_inner' ).preloader({ imgSelector: '.fancy_image_load span img', imgAppend: '.fancy_image_load',
		oneachload: function(image){
			var imageCaption = jQuery(image).parent().parent().next();
			if(imageCaption.length>0){
				imageCaption.remove();
				jQuery(image).parent().addClass('has_caption_frame');
				jQuery(image).parent().append(imageCaption);
				jQuery(image).next().css('display','block');
			}
			
			var img = jQuery(image),
				link = img.parent().parent();
				
			img.removeClass('hover_fade_js');
			link.css('backgroundImage','none');
			link.addClass('myriad_hover_fade_js');
			link.prepend('<span class=\"hover_overlay\"><span class=\"hover_icon\"></span></span>');
		}
	});
	
	jQuery( '#main_inner' ).preloader({ imgSelector: '.portfolio_full_image span img', imgAppend: '.portfolio_full_image',
		oneachload: function(image){
			var img = jQuery(image),
				link = img.parent().parent();
				
			img.removeClass('hover_fade_js');
			link.addClass('myriad_hover_fade_js');
			link.prepend('<span class=\"hover_overlay\"><span class=\"hover_icon\"></span></span>');
			if(link.css('backgroundImage').search('play.png')>0){
				link.find('.hover_icon').css('backgroundImage','url(' +assetsUri+ '/play.png)');
			}
			link.css('backgroundImage','none');
		}
 	});

	function mysite_jcarousel_setup(c) {
		c.clip.parent().parent().parent().parent().parent().removeClass('noscript');
		var jcarousel_img_load = c.clip.children().children().find('.post_grid_image .portfolio_img_load');
		
		if( jcarousel_img_load.length>1 ) {
			var link = jcarousel_img_load.parent().parent().children().find('.portfolio_img_load'),
				imgWidth = jcarousel_img_load.children().width(),
				imgHeight = jcarousel_img_load.children().height();
			
			jcarousel_img_load.css('width',imgWidth).css('height',imgHeight);
			jcarousel_img_load.children().removeClass('hover_fade_js');
			jcarousel_img_load.addClass('myriad_hover_fade_js');
			jcarousel_img_load.prepend('<span class=\"hover_overlay\"><span class=\"hover_icon\"></span></span>');
			
			jcarousel_img_load.each(function(i) {
				var filename = jQuery(this).attr('href'),
					videos=['swf','youtube','vimeo','mov'];
					
				for(var v in videos){
				    if(filename.match(videos[v])){
						jcarousel_img_load.find('.hover_icon').css('backgroundImage','url(' +assetsUri+ '/play.png)');
					}
				}
			});
		}
	}
	
	/* ]]> */
	</script>";

	echo preg_replace( "/(\r\n|\r|\n)\s*/i", '', $out ) . "\r";

}
endif;

?>