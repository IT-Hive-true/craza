            </div>
        </div>
        <footer id="footer">
            <div class="container">
                <?php $footer_options = get_option('theme_options')['general']; ?>
                <?php if ( !empty( $footer_options['copyright'] ) ) : ?>
                    <p><?php echo $footer_options['copyright']; ?></p>
                <?php endif; ?>
            </div>
        </footer>
        <?php if ( !empty( $footer_options['faq_page'] ) && ( $post = $footer_options['faq_page'] ) ) : ?>
            <?php setup_postdata( $post ); ?>
            <div class="product-popup-holder popup-questions-overlay">
                <a class="close-popup" href="#">close</a>
                <div class="wrapper-popup">
                    <?php get_template_part( 'blocks/faq-content' ); ?>
                </div>
                <a class="close-popup for-mobile" href="#">close</a>
            </div>
            <?php wp_reset_postdata(); ?>
        <?php endif; ?>
        <?php if ( !empty( $footer_options['terms_page'] ) && ( $post = $footer_options['terms_page'] ) ) : ?>
            <?php setup_postdata( $post ); ?>
            <div class="product-popup-holder popup-terms-overlay">
                <a class="close-popup" href="#">close</a>
                <div class="wrapper-popup">
                    <?php get_template_part( 'blocks/terms-content' ); ?>
                </div>
                <a class="close-popup for-mobile" href="#">close</a>
            </div>
            <?php wp_reset_postdata(); ?>
        <?php endif; ?>
            <?php if ( !empty( $footer_options['privacy_page'] ) && ( $post = $footer_options['privacy_page'] ) ) : ?>
                <?php setup_postdata( $post ); ?>
                <div class="product-popup-holder popup-privacy-overlay">
                    <a class="close-popup" href="#">close</a>
                    <div class="wrapper-popup">
                        <?php get_template_part( 'blocks/privacy-content' ); ?>
                    </div>
                    <a class="close-popup for-mobile" href="#">close</a>
                </div>
                <?php wp_reset_postdata(); ?>
            <?php endif; ?>
    </div>
    <div class="loader"></div>
    <!-- Start of LiveChat (www.livechatinc.com) code -->

    <script type="text/javascript">
        window.__lc = window.__lc || {};
        window.__lc.license = 12758814;
        ;(function(n,t,c){function i(n){return e._h?e._h.apply(null,n):e._q.push(n)};
            var e={_q:[],_h:null,_v:"2.0",on:function(){i(["on",c.call(arguments)])},once:function(){
                    i(["once",c.call(arguments)])},off:function(){i(["off",c.call(arguments)])},
                get:function(){if(!e._h)throw new Error("[LiveChatWidget] You can't use getters before load.");
                    return i(["get",c.call(arguments)])},call:function(){i(["call",c.call(arguments)])},init:function(){
                    var n=t.createElement("script");
                    n.async=!0,n.type="text/javascript",
                        n.src="https://cdn.livechatinc.com/tracking.js",t.head.appendChild(n)}};
            !n.__lc.asyncInit&&e.init(),n.LiveChatWidget=n.LiveChatWidget||e}(window,document,[].slice))
        jQuery('.livechat a').click(function (e) {
            e.preventDefault();
            $('.menu-holder').fadeOut();
            LiveChatWidget.call('maximize');
        })
    </script>
    <noscript>
        <a href="https://www.livechatinc.com/chat-with/12758814/" rel="nofollow"><?php _e( 'Chat with us', text_domain ); ?></a>,
        powered by <a href="https://www.livechatinc.com/?welcome" rel="noopener nofollow" target="_blank"><?php _e( 'LiveChat', text_domain ); ?></a>
    </noscript>
    <!-- End of LiveChat code -->
    <input type="hidden" role="uploadcare-uploader" data-public-key="demopublickey" data-images-only />
    <?php wp_footer(); ?>
</body>
</html>
