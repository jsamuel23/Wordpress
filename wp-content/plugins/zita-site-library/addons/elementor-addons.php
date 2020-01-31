<?php
if ( ! defined( 'ABSPATH' ) ) {
   exit; // Exit if accessed directly.
}
if(!defined('ELAET_ADDON')):
// Version constant for easy CSS refreshes
define('ELAET_EXT_FILE', __FILE__ );
define('ELAET_UN_PLUGIN_URL', plugin_dir_url(ELAET_EXT_FILE));
define('ELAET_EXT_BASE', plugin_basename(ELAET_EXT_FILE) );
define('ELAET_EXT_DIR', plugin_dir_path(ELAET_EXT_FILE ) );
define('ELAET_LICENSE', get_option( 'zita_license_key'));

require_once plugin_dir_path( __FILE__ ).'classes/class-elaet-init.php';        
require_once plugin_dir_path( __FILE__ ).'modules/key-api/license.php';   
endif;     
