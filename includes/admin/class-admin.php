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

        add_menu_page( 'WP Support', 'WP Support', $capability, 'wp-support', array( $this, 'dasboard' ), 'dashicons-sos', 25 );
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
}









