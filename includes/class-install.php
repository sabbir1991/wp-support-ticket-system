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
        $this->create_role();
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

        $sqls = array(
            "CREATE TABLE IF NOT EXISTS `{$wpdb->prefix}wpsm_ticket_thread` (
                `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
                `ticket_id` int(11) DEFAULT NULL,
                `body` longtext,
                `created_by` int(11) DEFAULT NULL,
                `guest_email` varchar(255) DEFAULT NULL,
                `guest_name` varchar(255) DEFAULT NULL,
                `type` varchar(100) DEFAULT '',
                `attachments` varchar(255) DEFAULT NULL,
                `created_at` datetime DEFAULT NULL,
                PRIMARY KEY (`id`),
                KEY `ticket_id` (`ticket_id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;",

            "CREATE TABLE IF NOT EXISTS `{$wpdb->prefix}wpsm_ticket_user` (
                `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
                `ticket_id` int(11) DEFAULT NULL,
                `user_id` int(11) DEFAULT NULL,
                PRIMARY KEY (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;"
        );

        include_once ABSPATH . 'wp-admin/includes/upgrade.php';

        foreach ( $sqls as $sql ) {
            dbDelta( $sql );
        }
    }

    /**
     * Create roles
     *
     * @since 1.0.0
     *
     * @return void
     */
    public function create_role() {
        add_role( 'support-agent', __( 'Support Agent', 'wp-project-manager' ), array(
            'read'         => true,
            'upload_files' => true
        ) );
    }

}