<?php
/*
Template Name: Homepage Template
*/

use it_hive\THEME;

THEME::addBodyClasses( 'home' );
get_header();
while ( have_posts() ) : the_post(); ?>
	<?php get_template_part( 'blocks/home-content' ); ?>
	<?php get_template_part( 'blocks/home-advertising' ); ?>
	<?php get_template_part( 'blocks/home-video' ); ?>
	<?php get_template_part( 'blocks/home-button' ); ?>
	<?php get_template_part( 'blocks/home-promo' ); ?>
<?php endwhile; ?>
<?php get_footer(); ?>
