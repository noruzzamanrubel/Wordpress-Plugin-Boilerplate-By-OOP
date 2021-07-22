<?php

namespace Noruzzaman\BoomDevs;

/**
 * The admin class
 */
class Admin
{

    /**
     * Initialize the class
     */
    public function __construct()
    {
        $this->dispatch_actions();
        new Admin\Menu();
    }

    /**
     * Dispatch and Bind Action
     *
     * @return void
     */
    public function dispatch_actions()
    {
        $addressbook = new Admin\AddressBook();
        add_action('admin_init', [$addressbook, 'form_handler']);
    }
}
