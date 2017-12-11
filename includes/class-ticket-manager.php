<?php

/**
* Ticket manager class
*
* @since 1.0.0
*
* @package wp-support-manager
*/
class WPSM_Ticket_Manager {

    /**
     * Get all tickets with all threads
     *
     * @since 1.0.0
     *
     * @return void
     */
    public function all( $args = array() ) {

    }

    /**
     * Get a signle tickets with all threads
     *
     * @since 1.0.0
     *
     * @return void
     */
    public function get( $args = array() ) {
        # code...
    }

    /**
     * Create a ticket
     *
     * @since 1.0.0
     *
     * @return void
     */
    public function create_ticket( $args = array() ) {
        $default = array(
            'subject'     => '',
            'status'      => 'open', // @TODO: need to change as a functions
            'author'      => 0,
            'category'    => 0,
            'attachments' => array()
        );

        $args = wp_parse_args( $args, $default );

        if ( empty( $args['subject'] ) ) {
            return new WP_Error( 'no-subject', __( 'Ticket subject must be required', 'wp-support-manager' ) );
        }

        // Create post object
        $my_post = array(
            'post_title'   => wp_strip_all_tags( $args['subject'] ),
            'post_content' => '',
            'post_status'  => $args['status'],
            'post_author'  => $args['author'],
            'post_type'    => 'wpsm_support_ticket'
        );

        // Insert the post into the database
        $ticket_id = wp_insert_post( $my_post );
    }


}