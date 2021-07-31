<?php

/**
 * Plugin Name: BoomDevs
 * Description: Test Plugin
 * Plugin URI: https://boomdevs.com
 * Author: Noruzzaman Rubel
 * Author URI:
 * Version: 1.0
 * License: GPL2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text-Domin:boomdevs
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

require_once __DIR__ . '/vendor/autoload.php';

final class Boom_Devs {
    /**
     * Plugin version
     *
     * @return string
     */
    const version = '1.0';

    /**
     * Class constructor
     *
     * @return void
     */
    private function __construct() {
        $this->define_constants();
        register_activation_hook( __FILE__, [$this, 'activate'] );
        add_action( 'plugins_loaded', [$this, 'init_plugin'] );
    }

    /**
     * Initializes singleton instance
     *
     * @return \Boom_Devs
     */
    public static function init() {
        static $instance = false;

        if ( ! $instance ) {
            $instance = new self();
        }

        return $instance;
    }

    /**
     * Define the required plugin constants
     *
     * @return void
     */
    public function define_constants() {
        define( 'BD_VERSION', self::version );
        define( 'BD_FILE', __FILE__ );
        define( 'BD_PATH', __DIR__ );
        define( 'BD_URL', plugins_url( '', BD_FILE ) );
        define( 'BD_ASSETS', BD_URL . '/assets' );
    }

    /**
     * plugin activate
     *
     * @return void
     */
    public function activate() {
        $installer = new Noruzzaman\BoomDevs\Installer();
        $installer->run();
    }

    /**
     * Initialize the plugin
     *
     * @return void
     */
    public function init_plugin() {

        new \Noruzzaman\BoomDevs\Assets();

        if ( is_admin() ) {
            new Noruzzaman\BoomDevs\Admin();
        } else {
            new Noruzzaman\BoomDevs\Frontend();
        }

    }

}

/**
 * Initialzes the main plugin
 *
 * @return \Boom_Devs
 */
function Boom_Devs() {
    return Boom_Devs::init();
}

/**
 * function call 
 *
 * @return void
 */
Boom_Devs();
