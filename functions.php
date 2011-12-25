<?php # -*- coding: utf-8 -*-
add_filter( 'the_content', 'fefe_strip_first_p', 11, 1 );

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