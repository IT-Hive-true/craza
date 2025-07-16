<?php
ini_set( 'display_errors', 0 );
ini_set ( 'upload_max_size' , '64M' ) ;
ini_set ( 'post_max_size' , '64M' ) ;
use it_hive\THEME;

require_once( 'inc/image.php' );
define( 'text_domain', 'craza' );

require_once( 'inc/lang_const.php' );
require_once( 'it-hive/loader.php' );

function set_url_const() {
	echo '<script type="text/javascript">
        window.ajaxurl = "' . admin_url( 'admin-ajax.php' ) . '";
    </script>';
}

add_action( 'wp_head', 'set_url_const' );

THEME::$textdomain = text_domain;

function craza_add_woocommerce_support() {
	add_theme_support( 'woocommerce' );
}

add_action( 'after_setup_theme', 'craza_add_woocommerce_support' );

// Custom logo support
function theme_add_logo_support() {
	add_theme_support( 'custom-logo' );
}

add_action( 'after_setup_theme', 'theme_add_logo_support' );

remove_action( 'wp_head', 'wp_generator' );

function theme_localization() {
	load_theme_textdomain( text_domain );
}

add_action( 'after_setup_theme', 'theme_localization' );

add_theme_support( 'title-tag' );

//Add [email]...[/email] shortcode
function shortcode_email( $atts, $content ) {
	return antispambot( $content );
}

add_shortcode( 'email', 'shortcode_email' );

//Register tag [template-url]
function filter_template_url( $text ) {
	return str_replace( '[template-url]', get_template_directory_uri(), $text );
}

add_filter( 'the_content', 'filter_template_url' );
add_filter( 'widget_text', 'filter_template_url' );

//Register tag [site-url]
function filter_site_url( $text ) {
	return str_replace( '[site-url]', home_url(), $text );
}

add_filter( 'the_content', 'filter_site_url' );
add_filter( 'widget_text', 'filter_site_url' );

//Replace standard wp menu classes
function change_menu_classes( $css_classes ) {
	return str_replace( array(
		'current-menu-item',
		'current-menu-parent',
		'current-menu-ancestor'
	), 'active', $css_classes );
}

add_filter( 'nav_menu_css_class', 'change_menu_classes' );

function clean_phone( $phone ) {
	return preg_replace( '/[^0-9]/', '', $phone );
}

//custom excerpt
function theme_the_excerpt() {
	global $post;
	if ( trim( $post->post_excerpt ) ) {
		the_excerpt();
	} elseif ( strpos( $post->post_content, '<!--more-->' ) !== false ) {
		the_content();
	} else {
		the_excerpt();
	}
}

function defer_js( $tag, $handle, $src ) {
	if ( ! is_admin() ) {
		$tag = str_replace( ' src=', ' defer src=', $tag );
	}

	return $tag;
}

$directory_uri = get_template_directory_uri();
$styles        = array(
	'style'         => $directory_uri . '/style.css',
	'selectBox-css' => $directory_uri . '/css/jquery.selectBox.css',
	'jquery-ui.css' => $directory_uri . '/css/jquery-ui.css',
	'all-style'     => $directory_uri . '/css/all.css',
	'font-style'    => 'https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,600,700',
);
$scripts       = array(
	'jquery'          => '',
	'selectBox-js'    => $directory_uri . '/js/jquery.selectBox.js',
	'jquery-ui.js'    => $directory_uri . '/js/jquery-ui.js',
	'jquery-ui-touch' => $directory_uri . '/js/jquery.ui.touch-punch.min.js',
	'hammerJS'        => $directory_uri . '/js/hammer.min.js',
	'hammerJSJquery'  => $directory_uri . '/js/jquery.hammer.js',
    'product-app-js'  => $directory_uri . '/js/product.app.js',
	'main-js'         => $directory_uri . '/js/main.js',
	'script-js'       => $directory_uri . '/js/script.js',
//	'product-js'      => $directory_uri . '/js/product.js',
	'uploadCareCustom-js'      => $directory_uri . '/js/uploadCareCustom.js',
	//'uploadcare-js' => $directory_uri . '/js/uploadcare.min.js'
);
THEME::addThemeStyles( $styles );
THEME::addThemeScripts( $scripts );

THEME::addMenus( array(
	'primary_menu' => 'Primary Menu',
	'footer_menu'  => 'Footer Menu'
) );

//THEME::addImageSizes( 'circle', 117, 117, true );

THEME::addOptionsPage( 'theme_options' );

THEME::loadMetaBox( 'home_page' );
THEME::loadMetaBox( 'faq_page' );
THEME::loadMetaBox( 'select_category_page' );
THEME::loadMetaBox( 'single_product' );
THEME::loadTermBox( 'products_cat' );
THEME::loadTermBox( 'badges' );

add_shortcode( 'coupon_field', 'display_coupon_field' );
function display_coupon_field() {
	if ( isset( $_GET['coupon'] ) && isset( $_GET['redeem-coupon'] ) ) {
		if ( $coupon = esc_attr( $_GET['coupon'] ) ) {
			$applied = WC()->cart->apply_coupon( $coupon );
		} else {
			$coupon = false;
		}

		$success = sprintf( __( 'Coupon "%s" Applied successfully.' ), $coupon );
		$error   = __( "This Coupon can't be applied" );

		$message = isset( $applied ) && $applied ? $success : $error;
	}

	$output = '<div class="redeem-coupon"><form id="coupon-redeem">
    <p><input type="text" name="coupon" id="coupon"/>
    <input type="submit" name="redeem-coupon" value="' . __( 'Redeem Offer' ) . '" /></p>';

	$output .= isset( $coupon ) ? '<p class="result">' . $message . '</p>' : '';

	return $output . '</form></div>';
}

$badges_labels = array(
	'search_items'      => __( 'Search badges', text_domain ),
	'all_items'         => __( 'All badges', text_domain ),
	'parent_item'       => __( 'Parent badges', text_domain ),
	'parent_item_colon' => __( 'Parent badges', text_domain ),
	'edit_item'         => __( 'Edit badge', text_domain ),
	'update_item'       => __( 'Update badge', text_domain ),
	'add_new_item'      => __( 'Add New badge', text_domain ),
	'new_item_name'     => __( 'New badge', text_domain ),
);
THEME::addTaxonomy( 'badges', __( 'badges', text_domain ), __( 'badges', text_domain ), 'product', $badges_labels, [ 'publicly_queryable' => false ] );

function render_product_badge( $term_id, $additional_classes = [] ) {
	$badge_meta  = get_term_meta( $term_id, 'badges', true );
	$classes_arr = array_merge( [ 'label' ], $additional_classes );
	$classes_str = implode( ' ', $classes_arr );
	ob_start();
	?>
    <span class="<?php echo $classes_str; ?>">
        <span><?php echo $badge_meta['label'] ?></span>
            <svg version="1.1"
                 id="Layer_1"
                 xmlns="http://www.w3.org/2000/svg"
                 x="0px"
                 y="0px"
                 viewBox="0 0 69 69.51"
                 style="enable-background:new 0 0 69 69.51; fill: <?php echo $badge_meta['color'] ?>"
                 xml:space="preserve">
                <path d="M68.1,34.37c-1.01-1.86-1.16-3.96-0.62-5.97c0.93-3.18-0.23-6.59-2.87-8.61c-1.71-1.24-2.79-3.03-3.1-5.12
								c-0.54-3.26-3.02-5.9-6.29-6.52c-2.02-0.39-3.88-1.55-5.04-3.26c-1.86-2.72-5.28-3.96-8.53-3.1c-2.02,0.54-4.11,0.31-5.9-0.78
								c-2.87-1.63-6.52-1.24-9,0.93c-1.55,1.4-3.57,2.02-5.66,1.94c-3.34-0.23-6.44,1.71-7.76,4.73c-0.86,1.94-2.33,3.41-4.27,4.19
								c-3.1,1.24-5.04,4.27-4.89,7.6c0.08,2.09-0.62,4.11-2.02,5.59c-2.32,2.56-2.79,6.21-1.24,9.16C1.91,37,2.07,39.1,1.53,41.12
								C0.6,44.3,1.76,47.71,4.4,49.73c1.71,1.24,2.79,3.02,3.1,5.12c0.54,3.26,3.02,5.9,6.29,6.52c2.02,0.39,3.88,1.55,5.04,3.26
								c1.86,2.72,5.28,3.96,8.53,3.1c2.02-0.54,4.11-0.31,5.9,0.78c2.87,1.63,6.52,1.24,9-0.93c1.55-1.4,3.57-2.02,5.66-1.94
								c3.34,0.23,6.44-1.71,7.76-4.73c0.85-1.94,2.33-3.41,4.27-4.19c3.1-1.24,5.04-4.27,4.89-7.6c-0.08-2.09,0.62-4.11,2.02-5.59
								C69.18,40.96,69.65,37.32,68.1,34.37"/>
            </svg>
    </span>
	<?php
	$badge = ob_get_clean();

	return $badge;
}


add_filter( 'woocommerce_checkout_get_value', 'custom_woocommerce_checkout_get_value', 10, 2 );
function custom_woocommerce_checkout_get_value( $value, $input ) {

	$user_id = $_COOKIE['user_checkout_id'];

	if ( ! empty( $_COOKIE[ "user_" . $user_id . "_billing_email" ] ) ) {
		$fields['billing_email'] = $_COOKIE[ "user_" . $user_id . "_billing_email" ];
	}
	if ( ! empty( $_COOKIE[ "user_" . $user_id . "_billing_phone" ] ) ) {
		$fields['billing_phone'] = $_COOKIE[ "user_" . $user_id . "_billing_phone" ];
	}
	if ( ! empty( $_COOKIE[ "user_" . $user_id . "_billing_first_name" ] ) ) {
		$fields['billing_first_name'] = $_COOKIE[ "user_" . $user_id . "_billing_first_name" ];
	}
	if ( ! empty( $_COOKIE[ "user_" . $user_id . "_billing_last_name" ] ) ) {
		$fields['billing_last_name'] = $_COOKIE[ "user_" . $user_id . "_billing_last_name" ];
	}
	if ( ! empty( $_COOKIE[ "user_" . $user_id . "_billing_company" ] ) ) {
		$fields['billing_company'] = $_COOKIE[ "user_" . $user_id . "_billing_company" ];
	}
	if ( ! empty( $_COOKIE[ "user_" . $user_id . "_billing_address_1" ] ) ) {
		$fields['billing_address_1'] = $_COOKIE[ "user_" . $user_id . "_billing_address_1" ];
	}
	if ( ! empty( $_COOKIE[ "user_" . $user_id . "_billing_address_2" ] ) ) {
		$fields['billing_address_2'] = $_COOKIE[ "user_" . $user_id . "_billing_address_2" ];
	}
	if ( ! empty( $_COOKIE[ "user_" . $user_id . "_billing_city" ] ) ) {
		$fields['billing_city'] = $_COOKIE[ "user_" . $user_id . "_billing_city" ];
	}
	if ( ! empty( $_COOKIE[ "user_" . $user_id . "_billing_state" ] ) ) {
		$fields['billing_state'] = $_COOKIE[ "user_" . $user_id . "_billing_state" ];
	}
	if ( ! empty( $_COOKIE[ "user_" . $user_id . "_billing_postcode" ] ) ) {
		$fields['billing_postcode'] = $_COOKIE[ "user_" . $user_id . "_billing_postcode" ];
	}
	if ( ! empty( $_COOKIE[ "user_" . $user_id . "_billing_country" ] ) ) {
		$fields['billing_country'] = $_COOKIE[ "user_" . $user_id . "_billing_country" ];
	}

	if ( ! empty( $_COOKIE[ "user_" . $user_id . "_shipping_phone" ] ) ) {
		$fields['shipping_phone'] = $_COOKIE[ "user_" . $user_id . "_shipping_phone" ];
	}
	if ( ! empty( $_COOKIE[ "user_" . $user_id . "_shipping_first_name" ] ) ) {
		$fields['shipping_first_name'] = $_COOKIE[ "user_" . $user_id . "_shipping_first_name" ];
	}
	if ( ! empty( $_COOKIE[ "user_" . $user_id . "_shipping_last_name" ] ) ) {
		$fields['shipping_last_name'] = $_COOKIE[ "user_" . $user_id . "_shipping_last_name" ];
	}
	if ( ! empty( $_COOKIE[ "user_" . $user_id . "_shipping_company" ] ) ) {
		$fields['shipping_company'] = $_COOKIE[ "user_" . $user_id . "_shipping_company" ];
	}
	if ( ! empty( $_COOKIE[ "user_" . $user_id . "_shipping_address_1" ] ) ) {
		$fields['shipping_address_1'] = $_COOKIE[ "user_" . $user_id . "_shipping_address_1" ];
	}
	if ( ! empty( $_COOKIE[ "user_" . $user_id . "_shipping_address_2" ] ) ) {
		$fields['shipping_address_2'] = $_COOKIE[ "user_" . $user_id . "_shipping_address_2" ];
	}
	if ( ! empty( $_COOKIE[ "user_" . $user_id . "_shipping_city" ] ) ) {
		$fields['shipping_city'] = $_COOKIE[ "user_" . $user_id . "_shipping_city" ];
	}
	if ( ! empty( $_COOKIE[ "user_" . $user_id . "_shipping_state" ] ) ) {
		$fields['shipping_state'] = $_COOKIE[ "user_" . $user_id . "_shipping_state" ];
	}
	if ( ! empty( $_COOKIE[ "user_" . $user_id . "_shipping_postcode" ] ) ) {
		$fields['shipping_postcode'] = $_COOKIE[ "user_" . $user_id . "_shipping_postcode" ];
	}
	if ( ! empty( $_COOKIE[ "user_" . $user_id . "_shipping_country" ] ) ) {
		$fields['shipping_country'] = $_COOKIE[ "user_" . $user_id . "_shipping_country" ];
	}

	if ( ! empty( $fields ) ) {
		foreach ( $fields as $key_field => $field_value ) {
			if ( $input == $key_field && ! empty( $field_value ) ) {
				$value = $field_value;
			}
		}
	}

	return $value;
}

add_filter( 'woocommerce_checkout_fields', 'add_and_edit_checkout_fields', - 1000 );
function add_and_edit_checkout_fields( $fields ) {

	unset( $fields['billing']['billing_last_name'] );
	unset( $fields['billing']['billing_company'] );
	unset( $fields['billing']['billing_country'] );
	unset( $fields['billing']['billing_postcode'] );
//	unset( $fields['billing']['billing_address_1'] );

	unset( $fields['shipping']['shipping_last_name'] );
	unset( $fields['shipping']['shipping_company'] );
	unset( $fields['shipping']['shipping_country'] );
	unset( $fields['shipping']['shipping_address_1'] );
	unset( $fields['shipping']['shipping_address_2'] );
	unset( $fields['shipping']['shipping_state'] );
	unset( $fields['shipping']['shipping_city'] );
	unset( $fields['shipping']['shipping_postcode'] );

	$fields['billing']['billing_first_name']['label'] = 'שם מלא (של המזמין)';
	$fields['billing']['billing_email']['label']      = 'אימייל (של המזמין)';
	$fields['billing']['billing_phone']['label']      = 'טלפון (של המזמין)';

//	$fields['billing']['billing_first_name_2'] = array(
//		'type'        => 'text',
//		'class'       => array( 'billing-first-name2' ),
//		'label'       => __( "שם מלא (של המקבל)*", text_domain ),
//		'placeholder' => "",
//		'priority'    => 50,
//		'required'    => true
//	);

	$fields['billing']['billing_address_1']['label']       = __( "כתובת למשלוח - רחוב ומספר בית", text_domain );
	$fields['billing']['billing_address_1']['placeholder'] = "";
	$fields['billing']['billing_address_1']['label_class'] = [];
	$fields['billing']['billing_address_1']['required']    = false;

	$fields['billing']['billing_address_2'] = array(
		'type'        => 'text',
		'class'       => array( 'billing-address-3' ),
		'label'       => __( "דירה וקומה", text_domain ),
		'placeholder' => "",
		'priority'    => 60,
		'required'    => false
	);
	$theme_options                          = THEME::getOptionsPage( 'theme_options' );
	$data                                   = $theme_options->renderGet();
	$billing_cities                         = ( $data && $data['billing_cities'] ) ? $data['billing_cities'] : [];

	if ( ! empty( $billing_cities ) ) {
		$option_cities     = array();
		$option_cities[''] = __( 'Choice Option', text_domain );
		foreach ( $billing_cities as $billing_city ) {
			if ( ! empty( $billing_city['city'] ) ) {
				$option_cities[ $billing_city['city'] ] = $billing_city['city'];
			}
		}
		$fields['billing']['billing_city']['type']    = 'select';
		$fields['billing']['billing_city']['label']   = 'עיר / ישוב';
		$fields['billing']['billing_city']['options'] = $option_cities;
	}

	$fields['billing']['billing_email']['priority'] = 20;
	$fields['billing']['billing_phone']['priority'] = 30;

	$fields['shipping']['shipping_first_name'] = array(
		'type'        => 'text',
		'class'       => array( 'shipping-phone' ),
		'label'       => __( "שם מלא (של המקבל)", text_domain ),
		'placeholder' => "",
		'priority'    => 20,
		'required'    => true
	);
	$fields['shipping']['shipping_phone']      = array(
		'type'        => 'tel',
		'class'       => array( 'shipping-phone' ),
		'label'       => __( "טלפון (של המקבל)", text_domain ),
		'placeholder' => "",
		'priority'    => 20,
		'required'    => true
	);

	return $fields;
}

add_action( 'woocommerce_checkout_update_order_meta', 'custom_save_extra_checkout_fields', 10, 2 );
function custom_save_extra_checkout_fields( $order_id, $posted ) {
//    global $woocommerce;
	if ( isset( $posted['shipping_phone'] ) ) {
		update_post_meta( $order_id, 'shipping_phone', sanitize_text_field( $posted['shipping_phone'] ) );
	}
	$session_data_images = WC()->session->get( 'user_images' );
	if ( ! empty( $session_data_images ) ) {
		update_post_meta( $order_id, 'user_images', $session_data_images );
	}
	$session_data_texts = WC()->session->get( 'user_texts' );
	if ( ! empty( $session_data_texts ) ) {
		update_post_meta( $order_id, 'user_texts', $session_data_texts );
	}
	$session_data_bg_path = WC()->session->get( 'bg_path_tmp' );
	if ( ! empty( $session_data_bg_path ) && file_exists( $session_data_bg_path ) ) {
		unlink( $session_data_bg_path );
	}
	WC()->session->set(
		'result_filename',
		'' );
}

add_action( 'woocommerce_admin_order_data_after_order_details', 'custom_display_order_data_in_admin' );
function custom_display_order_data_in_admin( $order ) {
	if ( $shipping_phone = get_post_meta( $order->id, 'shipping_phone', true ) ) :
		if ( $shipping_first_name = $order->get_shipping_first_name() ) : ?>
            <div class="order_data_column">
                <h4><?php _e( 'Shipping Name', text_domain ); ?></h4>
				<?php echo '<p>' . $shipping_first_name . '</p>'; ?>
            </div>
		<?php endif; ?>
        <div class="order_data_column">
            <h4><?php _e( 'Shipping Phone', text_domain ); ?></h4>
			<?php echo '<p>' . $shipping_phone . '</p>'; ?>
        </div>
	<?php endif;?>
    <?php
	if ( $user_images = get_post_meta( $order->id, 'user_images', true ) ) :
		?>
        <div class="order_data_column_container">
            <div class="order_data_column">
                <h4><?php _e( 'תמונות מצורפות', text_domain ); ?></h4>
				<?php
				foreach ( $user_images['attachments'] as $img ) {
					echo '<img src="'.$img.'">';
					echo '<a href="' . $img . '" download>' . __( 'הורד תמונה', text_domain ) . '</a>';
				}
				?>
                <h4><?php _e( 'כרזה להמחשה', text_domain ); ?></h4>
                <img src="<?php echo $user_images['result'] ?>">
                <a href="<?php echo $user_images['result']; ?>"
                   download><?php echo __( 'הורד תמונה', text_domain ); ?></a>

            </div>
        </div>
	<?php endif;
	$user_texts = get_post_meta( $order->id, 'user_texts', true );
	if ( ! empty( $user_texts ) ) :
		?>
        <div class="order_data_column_container">
            <div class="order_data_column">
                <h4><?php _e( 'טקסטים בכרזה:', text_domain ); ?></h4>
                <ul>
					<?php
					foreach ( $user_texts as $text ) {
						echo '<li>' . $text . '</li>';
					}
					?>
                </ul>

            </div>
        </div>
	<?php endif;
}

add_action( 'woocommerce_edit_account_form', 'display_checkbox_in_account_page' );
add_action( 'woocommerce_after_order_notes', 'display_checkbox_in_account_page' );
function display_checkbox_in_account_page() {
	woocommerce_form_field( 'newsletter-account', array(
		'type'  => 'checkbox',
		'class' => array( 'form-row-wide' ),
		'label' => __( 'מאשר/ת לשלוח לי מידע על מבצעים של כרזה', 'woocommerce' ),
	), get_user_meta( get_current_user_id(), 'newsletter-account', true ) );
}


add_action( 'woocommerce_save_account_details', 'save_checkbox_value_from_account_details', 10, 1 );
function save_checkbox_value_from_account_details( $user_id ) {
	$value = isset( $_POST['newsletter-account'] ) ? '1' : '0';
	update_user_meta( $user_id, 'newsletter-account', $value );
}

add_action( 'woocommerce_checkout_update_customer', 'custom_checkout_checkbox_update_customer', 100, 2 );
function custom_checkout_checkbox_update_customer( $customer, $data ) {
	$value = isset( $_POST['newsletter-account'] ) ? '1' : '0';
	update_user_meta( $customer->get_id(), 'newsletter-account', $value );
}

add_action( 'woocommerce_thankyou', 'custom_woocommerce_thankyou', 10, 1 );
function custom_woocommerce_thankyou( $order_id ) {
	if ( ! $order_id ) {
		return;
	}

	$order = wc_get_order( $order_id );

	$billing_email      = $order->get_billing_email();
	$billing_phone      = $order->get_billing_phone();
	$billing_first_name = $order->get_billing_first_name();
	$billing_last_name  = $order->get_billing_last_name();
	$billing_company    = $order->get_billing_company();
	$billing_address_1  = $order->get_billing_address_1();
	$billing_address_2  = $order->get_billing_address_2();
	$billing_city       = $order->get_billing_city();
	$billing_state      = $order->get_billing_state();
	$billing_postcode   = $order->get_billing_postcode();
	$billing_country    = $order->get_billing_country();

	$shipping_phone      = get_post_meta( $order->get_id(), 'shipping_phone', true );
	$shipping_first_name = $order->get_shipping_first_name();
	$shipping_last_name  = $order->get_shipping_last_name();
	$shipping_company    = $order->get_shipping_company();
	$shipping_address_1  = $order->get_shipping_address_1();
	$shipping_address_2  = $order->get_shipping_address_2();
	$shipping_city       = $order->get_shipping_city();
	$shipping_state      = $order->get_shipping_state();
	$shipping_postcode   = $order->get_shipping_postcode();
	$shipping_country    = $order->get_shipping_country();

	$time    = 7;
	$user_id = uniqid();
	setcookie( "user_checkout_id", $user_id, time() + ( 86400 * $time ), '/' );
	setcookie( "user_" . $user_id . "_billing_email", $billing_email, time() + ( 86400 * $time ), '/' );
	setcookie( "user_" . $user_id . "_billing_phone", $billing_phone, time() + ( 86400 * $time ), '/' );
	setcookie( "user_" . $user_id . "_billing_first_name", $billing_first_name, time() + ( 86400 * $time ), '/' );
	setcookie( "user_" . $user_id . "_billing_last_name", $billing_last_name, time() + ( 86400 * $time ), '/' );
	setcookie( "user_" . $user_id . "_billing_company", $billing_company, time() + ( 86400 * $time ), '/' );
	setcookie( "user_" . $user_id . "_billing_address_1", $billing_address_1, time() + ( 86400 * $time ), '/' );
	setcookie( "user_" . $user_id . "_billing_address_2", $billing_address_2, time() + ( 86400 * $time ), '/' );
	setcookie( "user_" . $user_id . "_billing_city", $billing_city, time() + ( 86400 * $time ), '/' );
	setcookie( "user_" . $user_id . "_billing_state", $billing_state, time() + ( 86400 * $time ), '/' );
	setcookie( "user_" . $user_id . "_billing_postcode", $billing_postcode, time() + ( 86400 * $time ), '/' );
	setcookie( "user_" . $user_id . "_billing_country", $billing_country, time() + ( 86400 * $time ), '/' );

	setcookie( "user_" . $user_id . "_shipping_phone", $shipping_phone, time() + ( 86400 * $time ), '/' );
	setcookie( "user_" . $user_id . "_shipping_first_name", $shipping_first_name, time() + ( 86400 * $time ), '/' );
	setcookie( "user_" . $user_id . "_shipping_last_name", $shipping_last_name, time() + ( 86400 * $time ), '/' );
	setcookie( "user_" . $user_id . "_shipping_company", $shipping_company, time() + ( 86400 * $time ), '/' );
	setcookie( "user_" . $user_id . "_shipping_address_1", $shipping_address_1, time() + ( 86400 * $time ), '/' );
	setcookie( "user_" . $user_id . "_shipping_address_2", $shipping_address_2, time() + ( 86400 * $time ), '/' );
	setcookie( "user_" . $user_id . "_shipping_city", $shipping_city, time() + ( 86400 * $time ), '/' );
	setcookie( "user_" . $user_id . "_shipping_state", $shipping_state, time() + ( 86400 * $time ), '/' );
	setcookie( "user_" . $user_id . "_shipping_postcode", $shipping_postcode, time() + ( 86400 * $time ), '/' );
	setcookie( "user_" . $user_id . "_shipping_country", $shipping_country, time() + ( 86400 * $time ), '/' );

}

add_action( 'wp_ajax_custom_coupon_handler', 'custom_coupon_handler' );
add_action( 'wp_ajax_nopriv_custom_coupon_handler', 'custom_coupon_handler' );

function custom_coupon_handler() {
	global $woocommerce;
	$code = $_POST['coupon_code'];
	if ( empty( $code ) || ! isset( $code ) ) {
		$response = array(
			'result'  => 'error',
			'message' => __( 'קוד קופון שהזנת אינו תקין', text_domain )
		);
		echo json_encode( $response );
		exit();
	}
	$coupon = new WC_Coupon( $code );
	if ( ! $coupon->get_id() ) {
		$response = array(
			'result'  => 'error',
			'message' => __( 'קוד קופון שהזנת אינו תקין', text_domain )
		);
		echo json_encode( $response );
		exit();
	} elseif ( ( $coupon->usage_limit - $coupon->usage_count ) >= 0 ) {
		$response = array(
			'result'  => 'error',
			'message' => __( 'קוד קופון זה כבר נוצל', text_domain )
		);
		echo json_encode( $response );
		exit();
	} else {

		$price = '';
		if ( ! empty( $_POST['product_id'] ) && ( $product_id = $_POST['product_id'] ) ) {
			$flag    = false;
			$items   = $woocommerce->cart->get_cart();
			$product = wc_get_product( $product_id );
			foreach ( $items as $item => $values ) {
				if ( $values['data']->get_id() == $product_id ) {
					$flag = true;
				}
			}
			if ( ! $flag ) {
				WC()->cart->add_to_cart( $product->get_id() );
			}
			WC()->cart->apply_coupon( $code );
			$price = round( $product->get_price() - ( $product->get_price() * $coupon->get_amount() / 100 ) );
		}
		$response = array(
			'result'   => 'success',
			'message'  => sprintf( __( 'Coupon "%s" Applied successfully.', text_domain ), $code ),
			'discount' => $coupon->get_discount_type(),
			'amount'   => $coupon->get_amount(),
			'price'    => $price,
		);
		echo json_encode( $response );
		exit();
	}
}

add_action( 'wp_ajax_custom_add_product', 'custom_add_product' );
add_action( 'wp_ajax_nopriv_custom_add_product', 'custom_add_product' );

function custom_add_product() {
	global $woocommerce;
	$response = array(
		'result'  => 'error',
		'message' => __( 'Product error.', text_domain )
	);
	if ( ! empty( $_POST['product_id'] ) && ( $product_id = $_POST['product_id'] ) ) {
		$flag    = false;
		$items   = $woocommerce->cart->get_cart();
		$product = wc_get_product( $product_id );
		foreach ( $items as $item => $values ) {
			if ( $values['data']->get_id() == $product_id ) {
				$flag = true;
			}
		}
		if ( ! $flag ) {
			WC()->cart->add_to_cart( $product->get_id() );
		}
		$response = array(
			'result'  => 'success',
			'message' => sprintf( __( '%s has been added to your cart.', text_domain ), $product->get_name() ),
		);
	}
	WC()->customer->set_country( 'IL' );
	WC()->customer->set_shipping_country( 'IL' );
	echo json_encode( $response );
	exit();
}

add_action( 'wp_ajax_subscribe_mailchimp', 'subscribe_mailchimp' );
add_action( 'wp_ajax_nopriv_subscribe_mailchimp', 'subscribe_mailchimp' );

function subscribe_mailchimp() {
	$request = $_POST;
	if ( ! empty( $request['fname'] ) && ! empty( $request['email'] ) ) {
		$response = array(
			'result'  => 'error',
			'message' => __( 'Error', text_domain )
		);
		$args     = array(
			'fname'  => $request['fname'],
			'email'  => $request['email'],
			'status' => 'subscribed',
		);

		$api_key = '84c27dcfb4e67c857fbb852b150f9100-us7';
		$list_id = '1b22e3c77b';

		$fname = $args['fname'];
		$email = $args['email'];

		/**
		 *  Possible Values for Status:
		 *  subscribed, unsubscribed, cleaned, pending, transactional
		 **/
		$status = $args['status'];

		$data = array(
			'apikey'        => $api_key,
			'email_address' => $email,
			'status'        => $status,
			'merge_fields'  => array(
				'FNAME' => $fname
			)
		);

		// URL to request
		$API_URL = 'https://' . substr( $api_key, strpos( $api_key, '-' ) + 1 ) . '.api.mailchimp.com/3.0/lists/' . $list_id . '/members/' . md5( strtolower( $data['email_address'] ) );

		$ch = curl_init();
		curl_setopt( $ch, CURLOPT_URL, $API_URL );
		curl_setopt( $ch, CURLOPT_HTTPHEADER, array(
			'Content-Type: application/json',
			'Authorization: Basic ' . base64_encode( 'user:' . $api_key )
		) );
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
		curl_setopt( $ch, CURLOPT_CUSTOMREQUEST, 'PUT' );
		curl_setopt( $ch, CURLOPT_TIMEOUT, 10 );
		curl_setopt( $ch, CURLOPT_POST, true );
		curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false );
		curl_setopt( $ch, CURLOPT_POSTFIELDS, json_encode( $data ) );
		$result = curl_exec( $ch );
		curl_close( $ch );

		$response = json_decode( $result );
		//print_r($response);

		if ( $response->status == 400 ) {
			$response = array(
				'result'  => 'error',
				'message' => __( 'Error', text_domain ) . ': ' . $response->detail
			);
		} elseif ( $response->status == 'subscribed' ) {
			$response = array(
				'result'  => 'success',
				'message' => __( 'Thank you. You have already subscribed.', text_domain )
			);
		} elseif ( $response->status == 'pending' ) {
			$response = array(
				'result'  => 'success',
				'message' => __( 'You subscription is Pending. Please check your email.', text_domain )
			);
		}
		echo json_encode( $response );
	}
	exit();
}

class Menu_With_Contact extends Walker_Nav_Menu {

	public function end_el( &$output, $item, $depth = 0, $args = null ) {
		if ( in_array( 'privacy-link', $item->classes ) ) {
			$theme_options = get_option( 'theme_options' )['contact_menu_item'];
			$output        .= '</li>';
			$output        .= '<li>';
			$output        .= "<a href='mailto:" . $theme_options['mailto'] . '?subject=' . $theme_options['subject'] . "'>";
			$output        .= $theme_options['menu_title'] . '</a></li>';
		}
	}

}

add_filter( 'woocommerce_order_button_html', 'custom_woocommerce_order_button_html' );
function custom_woocommerce_order_button_html( $html ) {
	$order_button_text = 'המשך לפרטי התשלום';
	$html              = '<button type="submit" class="button alt" name="woocommerce_checkout_place_order" id="place_order" value="' . esc_attr( $order_button_text ) . '" data-value="' . esc_attr( $order_button_text ) . '">המשך לפרטי התשלום</button>';

	return $html;
}

add_action( 'pre_get_posts', 'custom_shop_order', 99 );
function custom_shop_order( $query ) {

	if ( is_admin() && $_GET['post_type'] == 'shop_order' && empty( $_GET['orderby'] ) ) {
		$query->set( 'orderby', 'date' );
		$query->set( 'order', 'DESC' );
	}
}

add_action( 'woocommerce_email_customer_details', 'additional_order_mail_data', 99, 4 );
function additional_order_mail_data( $order, $sent_to_admin, $plain_text, $email ) {
	if ( $shipping_phone = get_post_meta( $order->id, 'shipping_phone', true ) ) :
		?>
        <h2>פרטי המקבל</h2>
		<?php
		if ( $shipping_first_name = $order->get_shipping_first_name() ) : ?>
            <div class="order_data_column">
                <h4><?php _e( 'Shipping Name', text_domain ); ?></h4>
				<?php echo '<p>' . $shipping_first_name . '</p>'; ?>
            </div>
		<?php endif; ?>
        <div class="order_data_column">
            <h4><?php _e( 'Shipping Phone', text_domain ); ?></h4>
			<?php echo '<p>' . $shipping_phone . '</p>'; ?>
        </div>
	<?php endif;
	if ( $user_images = get_post_meta( $order->id, 'user_images', true ) ) :
		?>
        <div class="order_data_column_container">
            <div class="order_data_column">
                <h4><?php _e( 'כרזה להמחשה', text_domain ); ?></h4>
                <img src="<?php echo $user_images['result'] ?>">
                <a href="<?php echo $user_images['result']; ?>"
                   download><?php echo __( 'הורד תמונה', text_domain ); ?></a>
            </div>
        </div>
	<?php endif;
}

add_action( 'woocommerce_init', 'enable_wc_session_cookie' );
function enable_wc_session_cookie() {
	if ( is_admin() ) {
		return;
	}

	if ( isset( WC()->session ) && ! WC()->session->has_session() ) {
		WC()->session->set_customer_session_cookie( true );
	}
}

add_action( 'template_redirect', 'redirect_visitor' );
function redirect_visitor() {
	if ( is_page( 'cart' ) || is_cart() ) {
		wp_safe_redirect( site_url() );
		exit();
	}
}
