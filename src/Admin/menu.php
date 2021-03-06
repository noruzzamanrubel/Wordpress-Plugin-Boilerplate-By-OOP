<?php

namespace Noruzzaman\BoomDevs\Admin;

class Menu {

    public $addressbook;

    /**
     * Initialize the class
     *
     * @return void
     */
    public function __construct( $addressbook ) {
        $this->addressbook = $addressbook;
        add_action( 'admin_menu', [$this, 'admin_menu'] );
    }

    /**
     * Register Admin Menu
     *
     * @return void
     */
    public function admin_menu() {
        $parent_slug = 'boomdevs';
        $capability  = 'manage_options';
        add_menu_page( __( 'BoomDevs', 'boomdevs' ), __( 'BoomDevs', 'boomdevs' ), $capability, $parent_slug, [$this->addressbook, 'plugin_page'], 'dashicons-welcome-learn-more' );
        add_submenu_page( $parent_slug, __( 'Address Book', 'boomdevs' ), __( 'Address Book', 'boomdevs' ), $capability, $parent_slug, [$this->addressbook, 'plugin_page'] );
        add_submenu_page( $parent_slug, __( 'Setting', 'boomdevs' ), __( 'Setting', 'boomdevs' ), $capability, 'address-book-setting', [$this, 'setting_page'] );

    }

    public function setting_page() {
        echo "hello from Setting";
    }
}
