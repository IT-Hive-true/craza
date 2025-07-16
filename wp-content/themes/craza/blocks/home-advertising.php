<?php if ( ( $adv = get_post_meta( get_the_ID(), 'adv', true ) ) && ( $items = $adv['slide'] ) ) : ?>
    <div class="promo-block">
	    <?php foreach ( $items as $item ) : ?>
            <div class="promo-block-item">
			    <?php if ( !empty( $item['title'] ) ) : ?>
                <span class="label"><?php echo $item['title']; ?></span>
			    <?php endif; ?>
			    <?php if ( !empty( $item['subtitle'] ) ) : ?>
                    <?php echo $item['subtitle']; ?>
			    <?php endif; ?>
			    <?php if ( !empty( $item['text'] ) ) : ?>
                <span class="note"> <?php echo $item['text']; ?> </span>
			    <?php endif; ?>
            </div>
	    <?php endforeach; ?>
    </div>
<?php endif; ?>