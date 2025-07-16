<?php if ( ( $adv = get_post_meta( get_the_ID(), 'faq_page', true ) ) && ( $faq = $adv['faq'] ) ) : ?>
    <?php if ( !empty( $faq['title'] ) ) : ?>
        <h2><?php echo $faq['title']; ?></h2>
    <?php endif; ?>
    <?php if ( !empty( $faq['item'] ) ) : ?>
        <?php foreach ( $faq['item'] as $item ) : ?>
            <?php if ( !empty( $item['question'] ) ) : ?>
                <h5><?php echo $item['question']; ?></h5>
            <?php endif; ?>
            <?php if ( !empty( $item['answer'] ) ) : ?>
                <p><?php echo $item['answer']; ?></p>
            <?php endif; ?>
        <?php endforeach; ?>
    <?php endif; ?>
<?php endif; ?>