<?php if ( ( $promo = get_post_meta( get_the_ID(), 'promo', true ) ) && ( $items = $promo['slider'] ) ) : ?>
    <section class="benefits-section">
	    <?php if ( $title = $promo['title'] ) : ?>
            <h2><span><?php echo $title; ?></span></h2>
	    <?php endif; ?>
        <div class="benefits-holder">
	        <?php foreach ( $items as $item ) : ?>
                <div class="benefit-block">
			        <?php if ( !empty( $item['title'] ) ) : ?>
                        <h3><?php echo $item['title']; ?></h3>
			        <?php endif; ?>
			        <?php if ( !empty( $item['text'] ) ) : ?>
                        <p><?php echo $item['text']; ?></p>
			        <?php endif; ?>
                </div>
	        <?php endforeach; ?>
        </div>
    </section>
<?php endif; ?>