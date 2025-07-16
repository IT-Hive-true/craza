<?php get_header(); ?>
    <?php if ( is_order_received_page() ) : ?>
        <a class="close-checkout" href="#">close</a>
    <?php endif; ?>
	<div id="content">
		<?php while ( have_posts() ) : the_post(); ?>
            <?php if ( is_checkout() && !is_order_received_page() ) : ?>
                <div class="title"><h1><span>פרטי הזמנה</span> / <span class="mark">עדכון כתובת</span></h1></div>
            <?php elseif ( !is_order_received_page() ) : ?>
                <?php the_title( '<div class="title"><h1>', '</h1></div>' ); ?>
                <?php the_post_thumbnail( 'full' ); ?>
            <?php endif; ?>
			<?php the_content(); ?>
			<?php //edit_post_link( __( 'Edit', text_domain ) ); ?>
		<?php endwhile; ?>
		<?php wp_link_pages(); ?>
		<?php comments_template(); ?>
        <div class="bottom-image">
            <div class="text-for-bottom-image">
                <span>אוי, זה פשוט נהדר!</span>
            </div>
            <img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/img2.png" alt="object_couple">
        </div>
	</div>

	<?php get_sidebar(); ?>
<?php get_footer(); ?>