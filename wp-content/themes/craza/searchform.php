<?php $sq = get_search_query() ? get_search_query() : __( 'Enter search terms&hellip;', text_domain ); ?>
<form method="get" class="search-form" action="<?php echo home_url(); ?>" >
	<fieldset>
		<input type="search" name="s" placeholder="<?php echo $sq; ?>" value="<?php echo get_search_query(); ?>" />
		<input type="submit" value="<?php _e( 'Search', text_domain ); ?>" />
	</fieldset>
</form>