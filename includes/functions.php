<?php

/**
 * Menu access capability
 *
 * @since 1.0.0
 *
 * @return string
 */
function wpsm_menu_access_capability() {
    return apply_filters( 'wpsm_menu_access_capability', 'manage_options' );
}

/**
 * Menu position
 *
 * @since 1.0.0
 *
 * @return string
 */
function wpsm_menu_position() {
    return apply_filters( 'wpsm_menu_position', '25' );
}

/**
 * Get navigation url for the dashboard overvies menues
 *
 * @since 1.0.0
 *
 * @param  string $name
 *
 * @return string [url]
 */
function wpsm_get_nav_url( $slug = '' ) {
    $page_id = 4; // @TODO: dokan_get_option( 'dashboard', 'dokan_pages' );

    if ( ! $page_id ) {
        return;
    }

    if ( ! empty( $slug ) ) {
        $url = get_permalink( $page_id ) . $slug.'/';
    } else {
        $url = get_permalink( $page_id );
    }

    return apply_filters( 'wpsm_get_nav_url', $url, $slug );
}


/**
 * Get dashboard menus
 *
 * @since 1.0.0
 *
 * @return void
 */
function wpsm_get_dashboard_nav() {
    return apply_filters( 'wpsm_get_dashboard_nav', array(
        'overview' => array(
            'title' => __( 'Overview', 'wp-support-manager' ),
            'icon' => '',
            'url' => wpsm_get_nav_url()
        ),

        'tickets' => array(
            'title' => __( 'All Tickets', 'wp-support-manager' ),
            'icon' => '',
            'url' => wpsm_get_nav_url( 'tickets' )
        ),

        'add-new-ticket' => array(
            'title' => __( 'Add New Ticket', 'wp-support-manager' ),
            'icon' => '',
            'url' => wpsm_get_nav_url( 'add-new-ticket' )
        )
    ) );
}

/**
 * Upload file with create attachment post and return
 * attachemnt id
 *
 * @since 1.0.0
 *
 * @param string $filename
 * @param string $file_url
 *
 * @return integer $attachment_id
 */
function wpsm_handle_file_upload( $filename, $file_url ) {

    $upload_file = wp_upload_bits( $filename, null, file_get_contents( $file_url ) );

    if ( ! $upload_file['error'] ) {
        $wp_filetype = wp_check_filetype( $filename, null );

        $attachment = array(
            'post_mime_type' => $wp_filetype['type'],
            'post_parent'    => 0,
            'post_title'     => preg_replace( '/\.[^.]+$/', '', $filename ),
            'post_content'   => '',
            'post_status'    => 'inherit'
        );

        $attachment_id = wp_insert_attachment( $attachment, $upload_file['file'] );

        if ( ! is_wp_error( $attachment_id ) ) {
            require_once(ABSPATH . "wp-admin" . '/includes/image.php');
            $attachment_data = wp_generate_attachment_metadata( $attachment_id, $upload_file['file'] );
            wp_update_attachment_metadata( $attachment_id,  $attachment_data );

            return $attachment_id;
        }
    }

    return 0;
}

/**
 * Get ticket status
 *
 * @since 1.0.0
 *
 * @return void
 */
function wpsm_ticket_status( $status = '' ) {
    $statuses = apply_filters( 'wpsm_ticket_status', array(
        'open'   => __( 'Open', 'wp-support-manager' ),
        'closed' => __( 'Closed', 'wp-support-manager' ),
    ) );

    if ( ! empty( $status ) ) {
        return isset( $statuses[$status] ) ? $statuses[$status] : '';
    }

    return $statuses;
}

/**
 * Get ticket status label
 *
 * @since 1.0.0
 *
 * @param string $status
 *
 * @return string
 */
function wpsm_ticket_status_lable( $status = '' ) {

    $labels = apply_filters( 'wpsm_ticket_status_lable', array(
        'open'   => 'success',
        'closed' => 'danger'
    ) );

    if ( ! empty( $status ) ) {
        return isset( $labels[$status] ) ? $labels[$status] : 'default';
    }

    return 'default';
}

