<?php # -*- coding: utf-8 -*-

add_action( 'after_setup_theme', 'fefe_setup' );
add_filter( 'the_content', 'fefe_strip_first_p', 11, 1 );

function fefe_setup()
{
	add_theme_support( 'automatic-feed-links' );
	add_action( 'widgets_init', 'fefe_widgets_setup' );
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


/**
 * Registers the sidebars.
 *
 * @return void
 */
function fefe_widgets_setup()
{
	register_sidebar(
		array (
			'name'          => __( 'Header-Untertitel', 'fefe' )
		,	'id'            => 'sub-head'
		,	'description'   => __( 'Nutze hierzu das Widget »Nur Markup«', 'fefe' )
		,	'before_widget' => ''
		,	'after_widget'  => ''
		,	'before_title'  => ''
		,	'after_title'   => '',
		)
	);
	register_sidebar(
		array (
			'name'          => __( 'Fußzeile', 'fefe' )
		,	'id'            => 'footer'
		,	'description'   => __( 'Nutze hierzu das Widget »Nur Markup«', 'fefe' )
		,	'before_widget' => ''
		,	'after_widget'  => ''
		,	'before_title'  => ''
		,	'after_title'   => '',
		)
	);
}