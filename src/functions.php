<?php

/**
 * Insert a new address
 *
 * @param  array $args
 * @return int/WP_Error
 */
function bd_insert_address( $args = [] ) {

    global $wpdb;

    if ( empty( $args['name'] ) ) {
        return new \WP_Error( 'no-name', __( 'You must provide a name', 'boomdevs' ) );
    }

    $defaults = [
        'name'       => '',
        'address'    => '',
        'phone'      => '',
        'created_by' => get_current_user_id(),
        'created_at' => current_time( 'mysql' ),

    ];

    $data     = wp_parse_args( $args, $defaults );
    $inserted = $wpdb->insert(
        "{$wpdb->prefix}bd_addresses",
        $data,
        [
            '%s',
            '%s',
            '%s',
            '%d',
            '%s',
        ]
    );

    if ( ! $inserted ) {
        return new \WP_Error( 'failed-to-insert', __( 'Failed to insert data', 'boomdevs' ) );
    }

    return $wpdb->insert_id;
}

/**
 * Facth Address
 *
 * @param  array $args
 *
 * @return array
 */
function bd_get_address( $args = [] ) {
    global $wpdb;

    $defaults = [
        'number'  => '20',
        'offset'  => 0,
        'orderby' => 'id',
        'order'   => 'ASC',
    ];

    $args = wp_parse_args( $args, $defaults );

    $sql = $wpdb->prepare(
        "SELECT * FROM {$wpdb->prefix}bd_addresses
        ORDER BY {$args['orderby']} {$args['order']}
        LIMIT %d, %d",
        $args['offset'], $args['number']
    );

    $result = $wpdb->get_results( $sql );
    return $result;
}

/**
 * Get the count of total address
 *
 * @return int
 */
function bd_address_count() {
    global $wpdb;
    return (int) $wpdb->get_var( "SELECT COUNT(id) FROM {$wpdb->prefix}bd_addresses" );
}
