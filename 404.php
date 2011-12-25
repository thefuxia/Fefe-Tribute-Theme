<?php # -*- coding: utf-8 -*-
/**
 * @package Fefe Tribute Theme
 */

if ( preg_match( '~\.(jpe?g|png|gif|svg|bmp)(\?.*)?$~i', $_SERVER['REQUEST_URI'] ) )
{
	header( 'Content-Type: image/png' );
	locate_template( '404.png', TRUE, TRUE );
	exit;
}
?><title>Not Found</title>
No such file or directory.