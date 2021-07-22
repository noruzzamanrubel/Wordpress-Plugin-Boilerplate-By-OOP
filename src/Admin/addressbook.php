<?php

namespace Noruzzaman\BoomDevs\Admin;

/**
 * AddressBook Handlar Class
 */
class AddressBook
{
    public function __construct()
    {
    }

    /**
     * plugin_page
     *
     * @return void
     */
    public function plugin_page()
    {
        $action = isset($_GET['action']) ? $_GET['action'] : 'list';

        switch ($action) {
            case 'new':
                $template = __DIR__ . '/view/address-new.php';
                break;

            case 'edit':
                $template = __DIR__ . '/view/address-edit.php';
                break;

            case 'view':
                $template = __DIR__ . '/view/address-view.php';
                break;

            default:
                $template = __DIR__ . '/view/address-list.php';
                break;
        }
        if (file_exists($template)) {
            include $template;
        }
    }

    public function form_handler()
    {
        if (!isset($_POST['submit_address'])) {
            return;
        }

        if (!wp_verify_nonce($_POST['_wpnonce'], 'new-address')) {
            wp_die('Are Your Cheating?');
        }

        if (!current_user_can('manage_options')) {
            wp_die('Are Your Cheating?');
        }
    }
}
