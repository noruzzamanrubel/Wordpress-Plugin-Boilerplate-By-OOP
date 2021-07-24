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
     * Create necessary database tables
     *
     * @return void
     */
    public function create_tables() {
        global $wpdb;

        $charset_collate = $wpdb->get_charset_collate();

        $schema = "CREATE TABLE IF NOT EXISTS `{$wpdb->prefix}bd_addresses` (
          `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
          `name` varchar(100) NOT NULL DEFAULT '',
          `address` varchar(255) DEFAULT NULL,
          `phone` varchar(30) DEFAULT NULL,
          `created_by` bigint(20) unsigned NOT NULL,
          `created_at` datetime NOT NULL,
          PRIMARY KEY (`id`)
        ) $charset_collate";

        if ( ! function_exists( 'dbDelta' ) ) {
            require_once ABSPATH . 'wp-admin/includes/upgrade.php';
        }

        dbDelta( $schema );
    }

}
