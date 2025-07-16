<?php
$wp_query->set_404();
status_header( 404 );
get_template_part( 404 );
exit();
global $post;
get_header();
?>
	<div id="content">
		<?php if ( have_posts() ) : ?>
			<div class="title">
				<h1><?php printf( __( 'Search Results for: %s', text_domain ), '<span>' . get_search_query() . '</span>'); ?></h1>
			</div>
			<?php while ( have_posts() ) : the_post(); ?>
                <div class="content">
                    <a href="<?php echo get_permalink();?>">
	                    <h2><?php echo get_the_title();?></h2>
	                    <?php the_post_thumbnail( 'medium' ); ?>
	                    <?php the_content();?>
                    </a>
                </div>
			<?php endwhile; ?>
		<?php else : ?>
			<?php get_template_part( 'blocks/not_found' ); ?>
		<?php endif; ?>
	</div>
<?php get_footer(); ?>