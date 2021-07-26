<?php

namespace Noruzzaman\BoomDevs;

/**
 * Assets handlers class
 */
class Assets {

    /**
     * class constructor
     */
    public function __construct() {
        add_action( 'wp_enqueue_scripts', [$this, 'frontend_assets'] );
        add_action( 'admin_enqueue_scripts', [$this, 'admin_assets'] );
    }

    /**
     * Frontend Assets loaded
     *
     * @return void
     */
    public function frontend_assets() {
        wp_enqueue_style( 'boomdevs-style', BD_ASSETS . '/css/frontend/frontend.css', null, filemtime( BD_PATH . '/assets/css/frontend/frontend.css' ) );
        wp_enqueue_script( 'boomdevs-script', BD_ASSETS . '/js/frontend/frontend.js', ['jquery'], filemtime( BD_PATH . '/assets/js/frontend/frontend.js' ), true );
    }

    /**
     * Admin Assets loaded
     *
     * @return void
     */
    public function admin_assets() {
        wp_enqueue_style( 'admin-style', BD_ASSETS . '/css/admin/admin.css', null, filemtime( BD_PATH . '/assets/css/admin/admin.css' ) );
        wp_enqueue_script( 'admin-script', BD_ASSETS . '/js/admin/admin.js', ['jquery'], filemtime( BD_PATH . '/assets/js/admin/admin.js' ), true );
    }
}