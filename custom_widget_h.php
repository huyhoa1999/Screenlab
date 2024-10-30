<?php
/**
 * Plugin Name:       Custom mini cart in editor design
 * Plugin URI:        https://cmsmart.net
 * Description:       Custom mini cart in editor design
 * Version:           1.0.1
 * Requires at least: 5.2
 * Requires PHP:      7.1
 * Author:            Huy
 * Author URI:        https://cmsmart.net
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       Custom mini cart in editor design
 * Domain Path:       /languages
 */

add_action('nbd_js_config','tppl_add_jss');
function tppl_add_jss(){
    ?>
        var add_js_mini_cart = 1;
    <?php 
} 

add_action('nbd_extra_css','templates_style_widget');
function templates_style_widget($path){
  ?>
        <link rel="stylesheet" href="<?= plugin_dir_url(__FILE__) . 'assets/style.css'; ?>">
  <?php
}

add_action('showCustomWarning','pageDesignScroll');
function pageDesignScroll() {
    if( !wp_is_mobile() ):
    ?>
        <div class="porto-thumnail custom_h">
            <div class="header_h">
                <span>Cart</span>
                <i class="icon-nbd icon-nbd-clear"></i>
            </div>
            <div class="sidebar design_sidebar_h">
                <?php
                    if ( function_exists( 'woocommerce_mini_cart' ) ) {
                        woocommerce_mini_cart();
                    }
                ?>
            </div>
            <div class="footer_h">
                <div class="elementor-menu-cart__footer-buttons">
                    <a href="<?php echo esc_url( wc_get_cart_url() ); ?>" class="elementor-button elementor-button--view-cart elementor-size-md">
                        <span class="elementor-button-text"><?php echo esc_html__( 'View cart', 'woocommerce' );?></span>
                    </a>
                    <a href="" ng-click='saveData();' class="elementor-button elementor-button--checkout elementor-size-md">
                        <span class="elementor-button-text"><?php echo esc_html__( 'Add to Cart', 'woocommerce' ); ?></span>
                    </a>
                </div>
            </div>
        </div>
    <?php endif;
}

add_filter('nbd_editor_process_action','nbd_editor_process_action_ft');
function nbd_editor_process_action_ft($process_action) {
    if( !wp_is_mobile() ) {
        $process_action = 'showMiniCart()';
    }
    return $process_action;
}

add_filter('change_url_ct_minicart','change_url_minicart_funt',10,2);
function change_url_minicart_funt($url,$pr_id) {
    $url = add_query_arg( array(
        'product_id'    => $pr_id,
    ), getUrlPageNBD( 'create' ) );
    return $url;
}