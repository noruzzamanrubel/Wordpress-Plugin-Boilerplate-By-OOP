<?php

namespace Noruzzaman\BoomDevs;

/**
 * The admin class
 */
class Admin {

    /**
     * Initialize the class
     */
    public function __construct() {
        $addressbook = new Admin\AddressBook();
        $this->dispatch_actions( $addressbook );
        new Admin\Menu( $addressbook );
    }

    /**
     * Dispatch and Bind Action
     *
     * @return void
     */
    public function dispatch_actions( $addressbook ) {
        add_action( 'admin_init', [$addressbook, 'form_handler'] );
    }
}
