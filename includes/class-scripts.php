<?php

/**
* Scripts class
*
* @package wp-support-manager
*/
class WPSM_Scripts {

    /**
     * Load autometically when class initiate
     *
     * @since 1.0.0
     */
    public function __construct() {

        add_action( 'init', array( $this, 'register_scripts' ), 10 );

        if ( is_admin() ) {
            add_action( 'admin_enqueue_scripts', array( $this, 'load_admin_scripts' ), 10 );
        } else {
            add_action( 'wp_enqueue_scripts', array( $this, 'load_frontend_scripts' ), 10 );
        }
    }

    /**
     * Register all scripts
     *
     * @since 1.0.0
     *
     * @return void
     */
    public function register_scripts() {

    }

    /**
     * Load admin scripts
     *
     * @since 1.0.0
     *
     * @return void
     */
    public function load_admin_scripts( $value='' ) {
        # code...
    }

    /**
     * Load frontend scripts
     *
     * @since 1.0.0
     *
     * @return void
     */
    public function load_frontend_scripts() {
        wp_enqueue_style( 'wpsm-frontend', WP_SUPPORT_MANAGER_ASSETS . '/css/frontend.css', array(), false, false );
    }
}
