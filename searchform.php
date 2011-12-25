<?php 	# -*- coding: utf-8 -*-
/**
 * @package    Fefe Theme
 *
 * Has to be a separate file, because the search widget will load it then.
 * The original has no label.
 */
?>
<form method=GET action="/">
	<label>Suchbegriff:
		<input name=s value='<?php the_search_query(); ?>'>
		<input type=submit>
	</label>
</form>