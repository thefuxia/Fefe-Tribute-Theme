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

	load_theme_textdomain( 'theme_ftt', get_template_directory() . '/lang' );
}

/**
 * Hold all translatable strings
 *
 * @param int $index
 * @return string
 */
function ftt_string( $index )
{
	$strings = array (
		0 => __( 'Search term: ',                  'theme_ftt' )
	,	1 => __( 'Use the widget Unfiltered Text', 'theme_ftt' )
	,	2 => __( 'Header subtitle',                'theme_ftt' )
	,	3 => __( 'Footer',                         'theme_ftt' )
	,	4 => __( 'Unfiltered Text',                'theme_ftt' )
	,	5 => __( 'Pure Markup',                    'theme_ftt' )
	,	6 => __( 'Hommage to fefe’s blog at http://blog.fefe.de', 'theme_ftt' )
	,	7 => __( 'earlier', 'theme_ftt' )
	,	8 => __( 'now', 'theme_ftt' )
	,	9 => __( 'later', 'theme_ftt' )
	);

	return isset ( $strings[ $index ] ) ? $strings[ $index ] : '<b>MISSING STRING!</b>';
}

/**
 * Pagination links for archive lists.
 *
 * @return void
 */
function ftt_archive_pagination()
{
	$links = array ();

	$links[] = get_previous_posts_link( ftt_string( 9 ) );
	$links[]  = ( ! is_home() or is_paged() )
		? '<a href="' . home_url( '/' ) . '">' . ftt_string( 8 ) . '</a>'
		: '';
	$links[] = get_next_posts_link( ftt_string( 7 ) );

	// remove empty entries
	$links = array_filter( $links );

	if ( ! empty ( $links ) )
	{
		print '<div align=center>' . implode( ' -- ', $links ) . '</div>';
	}
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
	$label = ftt_string( 0 );
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
	$desc =  ftt_string( 1 );
	register_sidebar(
		array (
			'name'          => ftt_string( 2 )
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
			'name'          => ftt_string( 3 )
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