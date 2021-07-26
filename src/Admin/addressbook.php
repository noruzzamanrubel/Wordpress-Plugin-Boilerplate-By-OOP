<?php

namespace Noruzzaman\BoomDevs\Admin;

use Noruzzaman\BoomDevs\Traits\Form_Error;

/**
 * AddressBook Handlar Class
 */
class AddressBook {

    use Form_Error;
    /**
     * plugin_page
     *
     * @return void
     */
    public function plugin_page() {

        $action = isset( $_GET['action'] ) ? $_GET['action'] : 'list';
        $id     = isset( $_GET['id'] ) ? intval( $_GET['id'] ) : 0;

        switch ( $action ) {
            case 'new':
                $template = __DIR__ . '/view/address-new.php';
                break;

            case 'edit':
                $address  = bd_get_address_data( $id );
                $template = __DIR__ . '/view/address-edit.php';
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

        $id      = isset( $_GET['id'] ) ? intval( $_GET['id'] ) : 0;
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

        $args = [
            'name'    => $name,
            'address' => $address,
            'phone'   => $phone,
        ];

        if ( $id ) {
            $args['id'] = $id;
        }

        $insert_id = bd_insert_address( $args );

        if ( is_wp_error( $insert_id ) ) {
            wp_die( $insert_id->get_error_message() );
        }

        if ( $id ) {
            $redirected_to = admin_url( 'admin.php?page=boomdevs&action=edit&address-updated=true&id=' . $id );
        } else {
            $redirected_to = admin_url( 'admin.php?page=boomdevs&inserted=true' );
        }

        wp_redirect( $redirected_to );
        exit;

    }

    /**
     * Single address has been delete
     *
     * @return void
     */
    public function delete_address() {

        if ( ! wp_verify_nonce( $_REQUEST['_wpnonce'], 'bd-delete-address' ) ) {
            wp_die( 'Are you cheating?' );
        }

        if ( ! current_user_can( 'manage_options' ) ) {
            wp_die( 'Are you cheating?' );
        }

        $id = isset( $_REQUEST['id'] ) ? intval( $_REQUEST['id'] ) : 0;

        if ( bd_delete_address( $id ) ) {
            $redirected_to = admin_url( 'admin.php?page=boomdevs&address-deleted=true' );
        } else {
            $redirected_to = admin_url( 'admin.php?page=boomdevs&address-deleted=false' );
        }

        wp_redirect( $redirected_to );
        exit;
    }

}
