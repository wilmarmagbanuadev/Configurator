<form method="get" class="searchform search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<fieldset> 
		<input type="text" name="s" class="s" value="" placeholder="<?php esc_html_e('Type here','blank'); ?>"> 
		<button class="fa fa-search search-button" type="submit" value="<?php esc_html_e('Search','blank'); ?>"></button>
	</fieldset>
</form>