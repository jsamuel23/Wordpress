<?php 
if ( ! function_exists( 'zita_pro_license_style' ) ) :
function zita_pro_license_style(){
    wp_enqueue_style( 'zita-pro-admin', ELAET_UN_PLUGIN_URL.'modules/key-api/assets/css/admin.css', '', '' );
}
add_action( 'admin_enqueue_scripts', 'zita_pro_license_style' );
endif;


if ( ! function_exists( 'zita_license_menu' ) ) :
    function zita_license_menu() {
        $icon_url = set_url_scheme( ELAET_UN_PLUGIN_URL.'modules/key-api/assets/image/zita-icon.png');
        $zta_nme  = apply_filters( 'zita_theme_name','Zita');
        add_menu_page('Zita Pro License', $zta_nme . ' License', 'manage_options', 'zita-license','zita_license',$icon_url,81);
    }
    add_action('admin_menu', 'zita_license_menu');

    function zita_license(){
        add_action( 'wp_enqueue_scripts', 'zita_pro_js_scripts' );
     require_once ELAET_EXT_DIR . 'modules/key-api/form.php';
    }
endif;