<?php # -*- coding: utf-8 -*-
/**
 * @package Fefe Tribute Theme
 */
get_header();

if ( ! is_page() )
{
	print '<h2><a href="' . home_url( '/' )
		. '" style="text-decoration:none;color:black">'
		. get_bloginfo( 'name' ) . '</a></h2>'
		. '<b>' . get_bloginfo( 'description' ) . '</b>';

	is_active_sidebar( 'head' )
		and print '<p align=right>'
		and dynamic_sidebar( 'head' );
}
else
{
	the_post();
	the_title( '<h2>', '</h2>' );
	the_content();
	wp_link_pages();
}

if ( is_archive() or is_front_page() or is_search() or is_single() )
{

	$ftt_date = get_the_date( 'D M d Y' );
	print "<h3>$ftt_date</h3><ul>";

	while ( have_posts() )
	{
		the_post();

		$ftt_date_new = get_the_date( 'D M d Y' );
		$ftt_date != $ftt_date_new and print "</ul><h3>$ftt_date_new</h3><ul>";
		$ftt_date = $ftt_date_new;

		print '<li><a href="' . get_permalink() . '">[1]</a> ';
		the_content();
		wp_link_pages();
	}

	print '</ul>';
	ftt_archive_pagination();
}

get_footer();