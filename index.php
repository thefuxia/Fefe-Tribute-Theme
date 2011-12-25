<?php # -*- coding: utf-8 -*-
/**
 * @package Fefe
 */
get_header();

if ( ! is_page() )
{
	print '<h2><a href="' . home_url( '/' ) . '">' . get_bloginfo( 'name' ) . '</a></h2>';
	print '<b>' . get_bloginfo( 'description' ) . '</b>';

	if ( is_active_sidebar( 'sub-head' ) )
	{
		print '<p align=right>';
		dynamic_sidebar( 'sub-head' );
	}
}
else
{
	the_title( '<h2>', '</h2>' );
		the_post();
		the_content();
		wp_link_pages();
}

if ( is_archive() or is_front_page() )
{
	$first_date_view = TRUE;

	print '<ul>';

	while ( have_posts() )
	{
		the_post();
		the_date(
			'D M d Y'
		,	( $first_date_view ? '<h3>' : '</ul><h3>' )
		,	( $first_date_view ? '</h3>' : '</h3><ul>' )
		);
		$first_date_view = FALSE;

		print '<li><a href="' . get_permalink() . '">[1]</a> ';
		the_content();
		wp_link_pages();
	}

	print '</ul>';
}

// Loads the sidebar too.
get_footer();