<form method="get" class="searchform search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<fieldset> 
		<input type="text" name="s" class="s" value="" placeholder="<?php esc_attr_e('Type here','wpconfigurator'); ?>"> 
		<button class="fa fa-search search-button" type="submit" value="<?php esc_attr_e('Search','wpconfigurator'); ?>"></button>
	</fieldset>
</form>