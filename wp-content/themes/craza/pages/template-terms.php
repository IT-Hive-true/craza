<?php
/*
Template Name: Terms Template
*/
get_header();
while ( have_posts() ) : the_post(); ?>
    <?php get_template_part( 'blocks/terms-content' ); ?>
<?php endwhile; ?>
<?php get_footer(); ?>
