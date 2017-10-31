<?php

/**
* Core class for loaded every needs
*
* @since 1.0.0
*/
class WPSM_Core {

    /**
     * Load autometically when class initiate
     *
     * @since 1.0.0
     */
    public function __construct() {
        add_action( 'admin_enqueue_scripts', array( $this, 'add_scripts' ), 10, 1 );
        add_action( 'init', array( $this, 'init_post_types' ), 10 );
        add_filter( 'parent_file', array( $this, 'set_category_menu' ) );

        // Handle ticket taxonomies
        // add_action( 'wpsm_ticket_category_add_form_fields', array( $this, 'add_color_field' ), 10, 2 );
        add_filter( 'manage_edit-wpsm_ticket_category_columns', array( $this, 'manage_edit_project_category_columns' ) );
        add_filter( 'manage_edit-wpsm_ticket_tag_columns', array( $this, 'manage_edit_project_category_columns' ) );
        add_action( 'wpsm_ticket_category_row_actions', array( $this, 'manage_category_row_action' ), 10, 2 );
        add_action( 'wpsm_ticket_tag_row_actions', array( $this, 'manage_category_row_action' ), 10, 2 );
    }

    /**
     * Add admin scripts
     *
     * @since 1.0.0
     *
     * @return void
     */
    public function add_scripts( $hook ) {
        if ( 'edit-tags.php' == $hook ) {
            wp_enqueue_style( 'wp-color-picker' );
            wp_enqueue_script( 'wp-color-picker' );
        }
    }

    /**
    * Register all post_types and taxonomies
    *
    * @since 1.0.0
    *
    * @return void
    **/
    public function init_post_types() {

        $labels = apply_filters( 'wpsm_ticket_post_type_labels', [
            'name'                  => __( 'Ticket', 'wp-support-manager' ),
            'singular_name'         => __( 'Ticket', 'wp-support-manager' ),
            'menu_name'             => __( 'Tickets', 'wp-support-manager' ),
            'add_new'               => __( 'Add Ticket', 'wp-support-manager' ),
            'add_new_item'          => __( 'Add New Ticket', 'wp-support-manager' ),
            'edit'                  => __( 'Edit', 'wp-support-manager' ),
            'edit_item'             => __( 'Edit Ticket', 'wp-support-manager' ),
            'new_item'              => __( 'New Ticket', 'wp-support-manager' ),
            'view'                  => __( 'View Ticket', 'wp-support-manager' ),
            'view_item'             => __( 'View Ticket', 'wp-support-manager' ),
            'search_items'          => __( 'Search Ticket', 'wp-support-manager' ),
            'not_found'             => __( 'No Ticket Found', 'wp-support-manager' ),
            'not_found_in_trash'    => __( 'No Ticket found in trash', 'wp-support-manager' ),
            'parent'                => __( 'Parent Ticket', 'wp-support-manager' ),
            'featured_image'        => __( 'Ticket Logo', 'wp-support-manager' ),
            'set_featured_image'    => __( 'Set Ticket logo', 'wp-support-manager' ),
            'remove_featured_image' => __( 'Remove Ticket logo', 'wp-support-manager' ),
            'use_featured_image'    => __( 'Use as Ticket logo', 'wp-support-manager' ),
        ] );

        $category_labels = apply_filters( 'wpsm_ticket_category_labels', [
            'name'              => _x( 'Categories', 'Ticket general name' ),
            'singular_name'     => _x( 'Ticket Category', 'Ticket singular name' ),
            'search_items'      => __( 'Search Ticket Categories', 'wp-support-manager' ),
            'all_items'         => __( 'All Ticket Categories', 'wp-support-manager' ),
            'parent_item'       => __( 'Parent Ticket Category', 'wp-support-manager' ),
            'parent_item_colon' => __( 'Parent Ticket Category:', 'wp-support-manager' ),
            'edit_item'         => __( 'Edit Ticket Category', 'wp-support-manager' ),
            'update_item'       => __( 'Update Ticket Category', 'wp-support-manager' ),
            'add_new_item'      => __( 'Add New Ticket Category', 'wp-support-manager' ),
            'new_item_name'     => __( 'New Ticket Category Name', 'wp-support-manager' ),
            'menu_name'         => __( 'Ticket Categories', 'wp-support-manager' ),
        ] );

        $tag_labels = apply_filters( 'wpsm_ticket_tag_labels', [
            'name'              => _x( 'Tags', 'Ticket general name' ),
            'singular_name'     => _x( 'Ticket Tags', 'Ticket singular name' ),
            'search_items'      => __( 'Search Ticket tag', 'wp-support-manager' ),
            'all_items'         => __( 'All Ticket Tags', 'wp-support-manager' ),
            'parent_item'       => __( 'Parent Ticket Tag', 'wp-support-manager' ),
            'parent_item_colon' => __( 'Parent Ticket Tag:', 'wp-support-manager' ),
            'edit_item'         => __( 'Edit Ticket Tag', 'wp-support-manager' ),
            'update_item'       => __( 'Update Ticket Tag', 'wp-support-manager' ),
            'add_new_item'      => __( 'Add New Ticket Tag', 'wp-support-manager' ),
            'new_item_name'     => __( 'New Ticket Tag Name', 'wp-support-manager' ),
            'menu_name'         => __( 'Ticket Tags', 'wp-support-manager' ),
        ] );


        register_post_type( 'wpsm_ticket', [
            'label'               => __( 'Ticket', 'wp-support-manager' ),
            'description'         => __( 'ticket post type', 'wp-support-manager' ),
            'public'              => false,
            'show_in_admin_bar'   => false,
            'exclude_from_search' => true,
            'publicly_queryable'  => false,
            'show_in_admin_bar'   => false,
            'show_ui'             => false,
            'show_in_menu'        => false,
            'capability_type'     => 'post',
            'hierarchical'        => false,
            'rewrite'             => [ 'slug' => '' ],
            'query_var'           => true,
            'supports'            => [ 'title', 'comments'],
            'taxonomies' => array( 'post_tag' ),
            'show_in_json'        => true,
            'labels'              => $labels
        ] );

        register_taxonomy( 'wpsm_ticket_category', 'wpsm_ticket', [
            'hierarchical' => true,
            'labels'       => $category_labels,
            'rewrite'      => array(
                'slug'         => 'wpsm-ticket-category',
                'with_front'   => false,
                'hierarchical' => true
            ),
        ] );

        register_taxonomy( 'wpsm_ticket_tag', 'wpsm_ticket', [
            'hierarchical' => false,
            'labels'       => $tag_labels,
            'rewrite'      => array(
                'slug'         => 'wpsm-ticket-tag',
                'with_front'   => false,
                'hierarchical' => false
            ),
        ] );
    }

    /**
     * Modifies columns in project category table.
     *
     * @since 1.0.0
     *
     * @return array
     */
    public function manage_edit_project_category_columns( $columns ) {
        error_log( print_r( $columns, true ) );
        unset( $columns['posts'] );
        return $columns;
    }

    /**
     * Set category menu in main project page
     *
     * @since 1.0.0
     *
     * @param string $parent_file
     */
    public function set_category_menu( $parent_file ) {
        global $current_screen;

        if ( $current_screen->taxonomy == 'wpsm_ticket_category' || $current_screen->taxonomy == 'wpsm_ticket_tag' ) {
            $parent_file = 'wp-support';
        }

        return $parent_file;
    }

    /**
     * Manage category row actions
     *
     * @since 1.0.0
     *
     * @return void
     */
    public function manage_category_row_action( $actions, $post ) {
        unset( $actions['view'] );
        return $actions;
    }

    /**
     * Add color field
     *
     * @since 1.0.0
     *
     * @return void
     */
    public function add_color_field( $term ) {
        ?>
        <div class="form-field term-bd-color">
            <label for="bg_color"><?php _e( 'Background Color', 'wp-support-manager' ); ?></label>
            <input type="text" id="bg_color" class="wp-color-picker-field" name="bg_color" value="">
        </div>

        <script>
            ;(function($) {
                $(document).ready( function() {
                    $('.wp-color-picker-field').wpColorPicker();
                });
            })(jQuery);
        </script>
        <?php
    }

}

new WPSM_Core();