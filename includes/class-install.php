<?php

/**
* Installer Class
*
* @since 1.0.0
*
* @package wp-support-mnager
*/
class WPSM_Install {

    /**
     * Load autometically when class initiate
     *
     * @since 1.0.0
     */
    public function do_install() {
        $this->create_tables();
    }

    /**
     * Create all tables
     *
     * @since 1.0.0
     *
     * @return void
     */
    public function create_tables() {
        global $wpdb;

        $sql = array(
        )

        include_once ABSPATH . 'wp-admin/includes/upgrade.php';
        dbDelta( $sql );

    }


}