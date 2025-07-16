<?php if ( ( $video = get_post_meta( get_the_ID(), 'video', true ) ) && ( $url = $video['url'] ) ) : ?>
    <div class="welcome-video">
        <iframe width="720" height="540" src="<?php echo $url; ?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
    </div>
<?php endif; ?>