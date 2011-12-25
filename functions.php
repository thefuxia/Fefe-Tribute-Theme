<?php # -*- coding: utf-8 -*-
/**
 * @package Fefe Tribute Theme
 */

add_action( 'after_setup_theme', 'ftt_setup' );
add_filter( 'the_content',       'ftt_strip_first_p', 11, 1 );
add_shortcode( 'searchform',     'ftt_searchform' );
add_action( 'admin_head',        'ftt_rel_favicon_link' );
add_action( 'login_head',        'ftt_rel_favicon_link', 10, 0 );
add_action( 'admin_head',        'ftt_toolbar_icon' );
add_action( 'wp_head',           'ftt_rel_favicon_link', 10, 0 );

/**
 * Runs on 'after_setup_theme'
 * @return void
 */
function ftt_setup()
{
	add_theme_support( 'automatic-feed-links' );
	add_action( 'widgets_init', 'ftt_widgets_setup' );
	locate_template( array ( 'class.Unfiltered_Text_Widget.php' ), TRUE, TRUE );
	add_action( 'widgets_init', array ( 'Unfiltered_Text_Widget', 'register' ), 20 );

	$lang_dir = get_template_directory() . '/lang';
	load_theme_textdomain( 'theme_ftt', $lang_dir );
}

/**
 * Removes the opening '<p>' to let the_content() run inline.
 *
 * @param  string $content
 * @return string
 */
function ftt_strip_first_p( $content )
{
	return 0 !== strpos( $content, '<p>' ) ? $content : substr( $content, 3 );
}

/**
 * Returns the search form.
 * Used by searchform.php and the shortcode.
 *
 * @return string
 */
function ftt_searchform()
{
	$query = esc_attr(
		apply_filters(
			'the_search_query'
		,	get_search_query( FALSE )
		)
	);
	$url   = home_url( '/' );
	// The original has no label.
	$label = __( 'Suchbegriff: ', 'theme_ftt' );
	return "<form method=GET action='$url'><label>$label<input name=s
	value='$query'><input type=submit></label></form>";
}


/**
 * Registers the sidebars.
 *
 * @return void
 */
function ftt_widgets_setup()
{
	$desc =  __( 'Nutze hierzu das Widget Unfiltered Text', 'theme_ftt' );
	register_sidebar(
		array (
			'name'          => __( 'Header-Untertitel', 'theme_ftt' )
		,	'id'            => 'head'
		,	'description'   => $desc
		,	'before_widget' => ''
		,	'after_widget'  => ''
		,	'before_title'  => ''
		,	'after_title'   => ''
		)
	);
	register_sidebar(
		array (
			'name'          => __( 'Fußzeile', 'theme_ftt' )
		// You cannot name it just 'footer' or WordPress breaks in widgets.php.
		,	'id'            => 'foot'
		,	'description'   => $desc
		,	'before_widget' => ''
		,	'after_widget'  => ''
		,	'before_title'  => ''
		,	'after_title'   => ''
		)
	);
}

/**
 * Prints the link rel=icon.
 *
 * @param  bool $print
 * @return void|string
 */
function ftt_rel_favicon_link()
{

	$url = get_stylesheet_directory_uri() . '/favicon.ico';

	print "<link rel='shortcut icon' href='$url' />";
}

/**
 * Replaces the WordPress icon in the toolbar with the current site's favicon.
 *
 * @return void
 */
function ftt_toolbar_icon()
{
	$url = get_stylesheet_directory_uri() . '/favicon.ico';
	print "<style>#wp-admin-bar-wp-logo .ab-icon{background:url($url) center no-repeat !important;}</style>";
}
/*
 * langen loop testen
 * seitennavigation
 * readme, hommage
 * sprachdateien
 */