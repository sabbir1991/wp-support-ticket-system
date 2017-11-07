<?php

/**
* Admin class for handle menus and scripts
*/
class WPSM_Admin {

    /**
     * Load autometically when class initiate
     *
     * @since 1.0.0
     */
    public function __construct() {
        add_action( 'admin_menu', array( $this, 'admin_menu' ), 10 );
    }

    /**
     * Register admin menus
     *
     * @since 1.0.0
     *
     * @return void
     */
    public function admin_menu() {

        $capability = wpsm_menu_access_capability();
        $menu_position = wpsm_menu_position();

        add_menu_page( 'WP Support', 'WP Supports', $capability, 'wp-support', array( $this, 'tickets' ), 'dashicons-sos', $menu_position );
        $tickets = add_submenu_page( 'wp-support', __( 'Tickets', 'wp-support-manager' ), __( 'Tickets', 'wp-support-manager' ), $capability, 'wp-support', array( $this, 'tickets' ) );
        add_submenu_page( 'wp-support', __( 'Categories', 'wp-support-manager' ), __( 'Categories', 'wp-support-manager' ), $capability, 'edit-tags.php?taxonomy=wpsm_ticket_category' );
        add_submenu_page( 'wp-support', __( 'Tags', 'wp-support-manager' ), __( 'Tags', 'wp-support-manager' ), $capability, 'edit-tags.php?taxonomy=wpsm_ticket_tag' );

        add_action( $tickets, array($this, 'tickets_script' ) );
    }

    /**
     * Load dashboad page
     *
     * @since 1.0.0
     *
     * @return void
     */
    public function tickets() {
        require_once WP_SUPPORT_MANAGER_INC_PATH . '/admin/views/tickets.php';
    }

    /**
     * Add ticket scripts
     *
     * @since 1.0.0
     *
     * @return void
     */
    public function tickets_script() {
        wp_enqueue_script( 'wpsm-tickets', WP_SUPPORT_MANAGER_ASSETS . '/js/build-tickets.js', array( 'jquery' ), false, false );
    }

}









