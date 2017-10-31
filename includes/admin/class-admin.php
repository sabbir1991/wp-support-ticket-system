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

        add_menu_page( 'WP Support', 'WP Supports', $capability, 'wp-support', array( $this, 'dasboard' ), 'dashicons-sos', $menu_position );
        add_submenu_page( 'wp-support', __( 'Tickets', 'wp-support-manager' ), __( 'Tickets', 'wp-support-manager' ), $capability, 'wp-support', array( $this, 'dasboard' ) );
        add_submenu_page( 'wp-support', __( 'Categories', 'wp-support-manager' ), __( 'Categories', 'wp-support-manager' ), $capability, 'edit-tags.php?taxonomy=wpsm_ticket_category' );
        add_submenu_page( 'wp-support', __( 'Tags', 'wp-support-manager' ), __( 'Tags', 'wp-support-manager' ), $capability, 'edit-tags.php?taxonomy=wpsm_ticket_tag' );
        add_submenu_page( 'wp-support', __( 'Status', 'wp-support-manager' ), __( 'Status', 'wp-support-manager' ), $capability, 'wp-support-status', array( $this, 'status' ) );
    }

    /**
     * Load dashboad page
     *
     * @since 1.0.0
     *
     * @return void
     */
    public function dasboard() {
        echo 'Hello Support';
    }

    /**
     * Tickets view page
     *
     * @since 1.0.0
     *
     * @return void
     */
    public function tickets() {
        echo 'Hellow Tickets';
    }

    /**
     * Tags view page
     *
     * @since 1.0.0
     *
     * @return void
     */
    public function tags() {
        echo 'Hellow Tickets';
    }
}









