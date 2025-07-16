<?php
/*
Template Name: FAQ Template
*/
get_header();
while ( have_posts() ) : the_post(); ?>
    <?php get_template_part( 'blocks/faq-content' ); ?>
<?php endwhile; ?>
<?php get_footer(); ?>
