<?php if ( ( $button = get_post_meta( get_the_ID(), 'button', true ) ) && ( $title = $button['title'] ) && ( $url = $button['url'] ) ) : ?>
    <div class="main-button-holder">
        <a href="<?php echo $url; ?>" class="main-order-btn">
            <strong><?php echo $title; ?></strong>
	        <?php if ( $subtitle = $button['subtitle'] ) : ?> <span><?php echo $subtitle; ?></span><?php endif; ?>
        </a>
    </div>
<?php endif; ?>