<?php

/**
* Ticket class
*
* @since 1.0.0
*/
class WPSM_Ticket {

    /**
     * Hold ticket ID
     *
     * @var integer
     */
    private $id;

    /**
     * Ticket post data
     *
     * @var object
     */
    public $post;


    /**
    * Autometically loaded when class initiate
    *
    * @since 1.0.0
    */
    public function __construct( $ticket = null ) {
        if ( is_numeric( $ticket ) ) {
            $this->id   = absint( $ticket );
            $this->post = get_post( $this->id );
        } elseif ( $ticket instanceof self ) {
            $this->id   = absint( $ticket->id );
            $this->post = $ticket->post;
        } elseif ( isset( $ticket->ID ) ) {
            $this->id   = absint( $ticket->ID );
            $this->post = $ticket;
        }
    }

    /**
     * Create ticket
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
            'tags'        => 0,
            'attachments' => array()
        );

        $args = wp_parse_args( $args, $default );

        if ( empty( $args['subject'] ) ) {
            return new WP_Error( 'no-subject', __( 'Ticket subject must be required', 'wp-support-manager' ) );
        }

        // Create post object
        $ticket_args = array(
            'post_title'   => wp_strip_all_tags( $args['subject'] ),
            'post_content' => '',
            'post_status'  => $args['status'],
            'post_author'  => $args['author'],
            'post_type'    => 'wpsm_support_ticket'
        );

        // Insert the post into the database
        $this->id = wp_insert_post( $ticket_args );

        $this->set_category( $args['category'] );
        $this->set_tags( $args['tags'] );

        $this->create_thread( array(
            'body'       => $args['body'],
            'created_by' => $args['author']
        ) );

        return $this->id;
    }

    /**
     * Get all ticket according to query param
     *
     * @since 1.0.0
     *
     * @return void
     */
    public function get_all( $args = array() ) {
        $default = array(
            'created_by' => 0,
            'post_status' => array( 'open', 'closed' )
        );

        $args = wp_parse_args( $args, $default );

        $args['post_type'] = 'wpsm_support_ticket';
        $args['author'] = $args['created_by'];

        add_filter( 'posts_fields', array( $this, 'select_thread_clause' ) );
        add_filter( 'posts_join', array( $this, 'join_thread_table' ) );
        add_filter( 'posts_where' , array( $this, 'posts_where' ) );

        $query = new WP_Query( apply_filters( 'wpsm_get_ticket_args', $args ) );

        remove_filter( 'posts_fields', array( $this, 'select_thread_clause' ) );
        remove_filter( 'posts_join', array( $this, 'join_thread_table' ) );
        remove_filter( 'posts_where' , array( $this, 'posts_where' ) );


        return $query->posts;
    }

    /**
     * undocumented function
     *
     * @since 1.0.0
     *
     * @return void
     */
    public function select_thread_clause( $select ) {
        global $wpdb;

        $table_name = $wpdb->prefix . 'wpsm_ticket_thread';

        $select .= ", $table_name.*";

        return $select;
    }

    /**
     * undocumented function
     *
     * @since 1.0.0
     *
     * @return void
     */
    public function join_thread_table( $join ) {
        global $wp_query, $wpdb;

        $table = $wpdb->prefix . 'wpsm_ticket_thread';
        $join .= "LEFT JOIN $table ON $wpdb->posts.menu_order = {$table}.id";

        return $join;
    }

    /**
     * undocumented function
     *
     * @since 1.0.0
     *
     * @return void
     */
    public function posts_where( $where ) {
        global $wpdb;

        $where .= " AND {$wpdb->posts}.post_status IN ( 'open', 'closed' )";
        return $where;
    }


    /**
     * Create Thread
     *
     * @since 1.0.0
     *
     * @return void
     */
    public function create_thread( $args ) {
        global $wpdb;

        $default = array(
            'ticket_id'   => $this->id,
            'body'        => '',
            'created_by'  => 0,
            'guest_email' => '',
            'guest_name'  => '',
            'type'        => 'thread',
            'attachments' => '',
            'created_at'  => current_time( 'mysql' )
        );

        $data = wp_parse_args( $args, $default );

        $wpdb->insert( $wpdb->prefix . 'wpsm_ticket_thread', $data, array( '%d', '%s', '%d', '%s', '%s', '%s', '%s', '%s' ) );

        return $wpdb->insert_id;
    }

    /**
     * Set category
     *
     * @since 1.0.0
     *
     * @return void
     */
    public function set_category( $category_id ) {
        if ( ! empty( $category_id ) ) {
            $cat_ids = is_array( $category_id ) ? array_map( 'intval', (array)$category_id ) : (int)$category_id;
            wp_set_post_terms( $this->id, $category_id, 'wpsm_ticket_category' );
        }
    }

    /**
     * Set tags
     *
     * @since 1.0.0
     *
     * @return void
     */
    public function set_tags( $tags ) {
        if ( ! empty( $tags ) ) {
            $tag_ids = is_array( $tags ) ? array_map( 'intval', (array)$tags ) : (int)$tags;
            wp_set_post_terms( $this->id, $tag_ids, 'wpsm_ticket_tag' );
        }
    }

    /**
     * Set all attachment releated with main ticket
     *
     * @since 1.0.0
     *
     * @return void
     */
    public function set_attachments( $files ) {
        error_log( print_r( $files, true ) );
    }


}
