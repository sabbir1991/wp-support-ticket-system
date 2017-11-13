<?php

/**
* Frontend class
*
* @since 1.0.0
*/
class WPSM_Frontend {

    /**
     * Load autometically when class initiate
     *
     * @since 1.0.0
     */
    public function __construct() {
        add_shortcode( 'wpsm-support-dashboard', array( $this, 'load_support_dashboard_shortcodes' ) );
    }

    /**
     * Load support short
     *
     * @since 1.0.0
     *
     * @return void
     */
    public function load_support_dashboard_shortcodes() {
        global $wp;

        ob_start();

        if ( isset( $wp->query_vars['tickets'] ) ) {
            wpsm_get_template( 'tickets/tickets.php' );
            return ob_get_clean();
        }

        if ( isset( $wp->query_vars['add-new-ticket'] ) ) {
            wpsm_get_template( 'tickets/add-new-ticket.php' );
            return ob_get_clean();
        }

        if ( isset( $wp->query_vars['page'] ) ) {
            wpsm_get_template( 'dashboard/dashboard.php' );
            return ob_get_clean();
        }

        do_action( 'wpsm_load_other_template' );
    }
}