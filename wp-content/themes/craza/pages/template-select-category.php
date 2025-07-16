<?php
/*
Template Name: Select Category
*/
get_header();
$theme_options = get_option('theme_options');
if ( have_posts() ) :
	the_post();
	global $post;

	$theme_options = get_option('theme_options')['general'];
	$page_meta = get_post_meta($post->ID,'select_category_page',true);

	$for_men = get_term_by('slug', 'men', 'product_cat');
	$for_men_meta = get_term_meta($for_men->term_id,'products_cat',true);

	$for_women = get_term_by('slug', 'women', 'product_cat');
	$for_women_meta = get_term_meta($for_women->term_id,'products_cat',true);

	?>
<!--	<div class="container">-->
		<a href="<?php echo home_url();?>" class="back">Back</a>
		<section class="select-category-section">
			<div class="select-category" id="first-selection">
				<div class="slogan">
					<p><?php echo $page_meta['slogan'];?></p>
				</div>
				<h1> <span><?php echo $page_meta['question'];?></span> </h1>
				<div class="category-types">
                    <div class="category-type-item for-her-category">
                        <a href="<?php echo get_term_link($for_women->term_id, 'product_cat');?>">
                            <div class="image-holder">
                                <img src="<?php echo wp_get_attachment_image_url($for_women_meta['logo'],'full')?>" alt="" >
                            </div>
                            <h2><?php echo $for_women->name;?></h2>
                        </a>
                    </div>

					<div class="category-type-item for-him-category">
						<a href="<?php echo get_term_link($for_men->term_id, 'product_cat');?>">
							<div class="image-holder">
								<img src="<?php echo wp_get_attachment_image_url($for_men_meta['logo'],'full')?>" alt="" >
							</div>
							<h2><?php echo $for_men->name;?></h2>
						</a>
					</div>

					<div class="category-type-item for-them-category">
						<a href="<?php echo get_post_type_archive_link( 'product' );?>">
							<div class="image-holder">
								<img src="<?php echo wp_get_attachment_image_url($theme_options['all_categories_image']);?>" alt="" >
							</div>
							<h2>גם וגם</h2>
						</a>
					</div>
				</div>
			</div>
		</section>
		<div class="decoration-image">
			<img src="<?php echo wp_get_attachment_image_url($theme_options['category_decoration_image']);?>" alt="" width="209px">
		</div>
<!--	</div>-->

<?php endif;
get_footer();
