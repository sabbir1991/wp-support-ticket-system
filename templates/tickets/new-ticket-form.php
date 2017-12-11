<h2><?php _e( 'Create a new Ticket', 'wp-support-manager' ); ?></h2>

<div class="wpsm-create-support-form">
    <form method="post" class="wpsm-form-container" enctype="multipart/form-data">
        <div class="wpsm-form-group">
            <label for="wpsm-contorl-label"><?php _e( 'Subject', 'wp-support-manager' ); ?></label>
            <input type="text" class="wpsm-form-control" name="title">
        </div>

        <div class="wpsm-form-group">
            <label for="wpsm-contorl-label"><?php _e( 'Category', 'wp-support-manager' ); ?></label>
            <?php
                $category_args =  array(
                    'show_option_none' => __( '- Select a category -', 'wp-support-manager' ),
                    'hierarchical'     => 1,
                    'hide_empty'       => 0,
                    'name'             => 'ticket_category',
                    'id'               => 'wpsm_ticket_category',
                    'taxonomy'         => 'wpsm_ticket_category',
                    'title_li'         => '',
                    'class'            => 'wpsm_ticket_category wpsm-form-control wpsm-select2',
                    'exclude'          => '',
                    'selected'         => -1
                );
                wp_dropdown_categories( apply_filters( 'wpsm_ticket_category_dropdown_args', $category_args ) );
            ?>
        </div>

        <div class="wpsm-form-group">
            <label for="wpsm-contorl-label"><?php _e( 'Message', 'wp-support-manager' ); ?></label>
            <textarea name="body" id="body" class="wpsm-form-control"></textarea>
        </div>

        <div class="wpsm-form-group">
            <label for="wpsm-contorl-label"><?php _e( 'Attachments', 'wp-support-manager' ); ?></label>
            <input type="file" class="wpsm-form-control" multiple name="wpsm_ticket_attachment[]">
        </div>

        <div class="wpsm-form-group">
            <?php wp_nonce_field( 'wpsm_create_ticket_action', 'wpsm_create_ticket_nonce' ); ?>
            <input type="submit" class="wpsm-btn" name="wpsm_create_ticket" value="<?php _e( 'Create Ticket', 'wp-support-manager' ); ?>">
        </div>
    </form>
</div>