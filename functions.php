<?php # -*- coding: utf-8 -*-

add_action( 'after_setup_theme', 'fefe_setup' );
add_filter( 'the_content', 'fefe_strip_first_p', 11, 1 );
add_shortcode( 'searchform', 'fefe_searchform' );

function fefe_setup()
{
	add_theme_support( 'automatic-feed-links' );
	add_action( 'widgets_init', 'fefe_widgets_setup' );
	locate_template( array ( 'class.Unfiltered_Text_Widget.php' ), TRUE, TRUE );
	add_action( 'widgets_init', array ( 'Unfiltered_Text_Widget', 'register' ), 20 );
}

/**
 * Removes the opening '<p>' to let the_content() run inline.
 *
 * @param  string $content
 * @return string
 */
function fefe_strip_first_p( $content )
{
	if ( 0 !== strpos( $content, '<p>' ) )
	{
		return $content;
	}

	return substr( $content, 3, strlen( $content ) );
}

function fefe_searchform()
{
	$query = esc_attr( apply_filters( 'the_search_query', get_search_query( false ) ) );
	$url = home_url( '/' );
	$label = __( 'Suchbegriff:', 'fefe' );
	return "<form method=GET action='$url'><label>$label <input name=s value='$query'><input type=submit></label></form>";
}


/**
 * Registers the sidebars.
 *
 * @return void
 */
function fefe_widgets_setup()
{
	register_sidebar(
		array (
			'name'          => __( 'Fusszeile', 'fefe' )
		// You cannot name it just 'footer' or WordPress breaks in widgets.php.
		,	'id'            => 'fefe-footer'
		,	'description'   => __( 'Nutze hierzu das Widget Unfiltered Text', 'fefe' )
		,	'before_widget' => ''
		,	'after_widget'  => ''
		,	'before_title'  => ''
		,	'after_title'   => ''
		)
	);
	register_sidebar(
		array (
			'name'          => __( 'Header-Untertitel', 'fefe' )
		,	'id'            => 'sub-head'
		,	'description'   => __( 'Nutze hierzu das Widget Unfiltered Text', 'fefe' )
		,	'before_widget' => ''
		,	'after_widget'  => ''
		,	'before_title'  => ''
		,	'after_title'   => ''
		)
	);
}