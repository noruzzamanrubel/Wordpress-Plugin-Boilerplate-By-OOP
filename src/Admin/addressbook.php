<?php

namespace Noruzzaman\BoomDevs\Admin;

/**
 * AddressBook Handlar Class
 */
class AddressBook {

    public $errors = [];

    /**
     * plugin_page
     *
     * @return void
     */
    public function plugin_page() {

        $action = isset( $_GET['action'] ) ? $_GET['action'] : 'list';

        switch ( $action ) {
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

        if ( file_exists( $template ) ) {
            include $template;
        }

    }

    /**
     * Plugin Form Handler
     *
     * @return void
     */
    public function form_handler() {

        if ( ! isset( $_POST['submit_address'] ) ) {
            return;
        }

        if ( ! wp_verify_nonce( $_POST['_wpnonce'], 'new-address' ) ) {
            wp_die( 'Are Your Cheating?' );
        }

        if ( ! current_user_can( 'manage_options' ) ) {
            wp_die( 'Are Your Cheating?' );
        }

        $name    = isset( $_POST['name'] ) ? sanitize_text_field( $_POST['name'] ) : '';
        $address = isset( $_POST['address'] ) ? sanitize_textarea_field( $_POST['address'] ) : '';
        $phone   = isset( $_POST['phone'] ) ? sanitize_text_field( $_POST['phone'] ) : '';

        if ( empty( $name ) ) {
            $this->errors['name'] = __( 'Please Provide a name', 'boomdevs' );
        }

        if ( empty( $phone ) ) {
            $this->errors['phone'] = __( 'Please Provide a phone number', 'boomdevs' );
        }

        if ( ! empty( $this->errors ) ) {
            return;
        }

        $insert_id = bd_insert_address( [
            'name'    => $name,
            'address' => $address,
            'phone'   => $phone,
        ] );

        if ( is_wp_error( $insert_id ) ) {
            wp_die( $insert_id->get_error_message() );
        }

        $redirected_to = admin_url( 'admin.php?page=boomdevs&inserted=true' );

        wp_redirect( $redirected_to );

    }

}
