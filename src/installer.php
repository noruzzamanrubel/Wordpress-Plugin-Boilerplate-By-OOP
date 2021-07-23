<?php

namespace Noruzzaman\BoomDevs;

class Installer {

    /**
     * run the instance
     *
     * @return void
     */
    public function run() {
        $this->activation();
        $this->Create_Tables();
    }

    /**
     * plugin activation
     *
     * @return void
     */
    public function activation() {
        $installed = get_option( 'bd_install' );

        if ( ! $installed ) {
            update_option( 'bd_install', time() );
        }

    }

    /**
     * Create necessary database table
     *
     * @return void
     */
    public function Create_Tables() {
        global $wpdb;
        $charset_collate = $wpdb->get_charset_collate();

        $schema = "CREATE TABLE IF NOT EXISTS `{$wpdb->prefix}bd_addresses` ( `id` INT(11) NOT NULL , `name` VARCHAR(255) NOT NULL , `address` VARCHAR(255) NULL , `phone` VARCHAR(30) NULL , `created_by` BIGINT(20) NULL , `created_at` DATETIME NOT NULL ) $charset_collate";

        if ( ! function_exists( 'dbDelta' ) ) {
            require_once ABSPATH . 'wp-admin/includes/upgrade.php';
        }

        dbDelta( $schema );
    }

}
