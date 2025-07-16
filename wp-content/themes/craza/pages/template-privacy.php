<?php
/*
Template Name: Privacy Template
*/
get_header();
while ( have_posts() ) : the_post(); ?>
    <?php get_template_part( 'blocks/privacy-content' ); ?>
<?php endwhile; ?>
<?php get_footer(); ?>
