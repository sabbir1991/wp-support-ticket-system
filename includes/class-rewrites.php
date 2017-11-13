<?php

/**
* Rewrites core class
*/
class WPSM_Rewrites {

    /**
     * Hold all rewrites slug
     *
     * @var array
     */
    public $query_vars = array();

    /**
     * Load autometically when class initiate
     *
     * @since 1.0.0
     */
    public function __construct() {
        add_action( 'init', array( $this, 'register_rule' ) );
        add_filter( 'query_vars', array( $this, 'register_query_var' ) );
    }

    /**
     * Register all rewrite rule
     *
     * @return void
     */
    function register_rule() {
        $this->query_vars = apply_filters( 'wpsm_query_var_filter', array(
            'tickets',
            'add-new-ticket',
        ) );

        foreach ( $this->query_vars as $var ) {
            add_rewrite_endpoint( $var, EP_PAGES );
        }

        // Trigger rewrite flushing if needed
        do_action( 'wpsm_rewrite_slug_loaded', $this->query_vars );
    }

    /**
     * Register the rewrites slugs query var
     *
     * @since 1.0.0
     *
     * @param array $vars
     *
     * @return array
     */
    function register_query_var( $vars ) {
        foreach ( $this->query_vars as $var ) {
            $vars[] = $var;
        }

        return $vars;
    }
}

new WPSM_Rewrites();
