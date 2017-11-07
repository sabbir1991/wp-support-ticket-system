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
        array(
            'title' => __( 'Overview', 'wp-support-manager' ),
            'icon' => '',
            'url' => wpsm_get_nav_url()
        ),

        array(
            'title' => __( 'All Tickets', 'wp-support-manager' ),
            'icon' => '',
            'url' => wpsm_get_nav_url( 'tickets' )
        ),

        array(
            'title' => __( 'Add New Tickets', 'wp-support-manager' ),
            'icon' => '',
            'url' => wpsm_get_nav_url( 'add-new-tickets' )
        )

    ) );

}