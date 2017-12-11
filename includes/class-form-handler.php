<?php

/**
* Handle all form submission
*/
class WPSM_Form_Handler {

    /**
     * Load autometically when class initiate
     *
     * @since 1.0.0
     */
    public function __construct() {
        add_action( 'template_redirect', array( $this, 'handle_create_ticket' ), 10 );
    }

    /**
     * Handle ticket create form
     *
     * @since 1.0.0
     *
     * @return void
     */
    public function handle_create_ticket() {
        if ( isset( $_POST['wpsm_create_ticket'] ) && wp_verify_nonce( $_POST['wpsm_create_ticket_nonce'], 'wpsm_create_ticket_action' ) ) {
            $result = wpsm()->ticket->create_ticket( array(
                'subject'  => sanitize_text_field( $_POST['title'] ),
                'status'   => 'open', // @TODO: need to change as a functions
                'author'   => get_current_user_id(),
                'category' => $_POST['ticket_category'],
                'body'     => $_POST['body'],
            ) );

            if ( ! is_wp_error( $result ) ) {
                wp_redirect( wpsm_get_nav_url( 'add-new-ticket' ) );
                exit();
            }
        }
    }

}

new WPSM_Form_Handler();