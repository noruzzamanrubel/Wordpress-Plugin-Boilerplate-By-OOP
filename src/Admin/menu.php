<?php

namespace Noruzzaman\BoomDevs\Admin;

class Menu
{
    public function __construct()
    {
        add_action('admin_menu', [$this, 'admin_menu']);
    }

    public function admin_menu()
    {
        add_menu_page(__('BoomDevs','boomdevs'),__('BoomDevs', 'boomdevs'), 'manage_options', 'boomdevs', [$this, 'plugin_page'], 'dashicons-welcome-learn-more');
    }

    public function plugin_page()
    {
        echo 'Hello World';
    }
}
