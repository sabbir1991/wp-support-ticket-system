<?php
/**
 *  Dokan Dashboard Template
 *
 *  Dokan Main Dahsboard template for Fron-end
 *
 *  @since 2.4
 *
 *  @package dokan
 */
?>
<div class="wpsm-content-wrap">
    <?php

        /**
         *  wpsm_content_before hook
         *
         *  @hooked get_dashboard_side_navigation
         *
         *  @since 2.4
         */
        wpsm_get_template( 'global/side-nav.php' );
    ?>

    <div class="wpsm-content">

        <?php

            /**
             *  wpsm_content_inside_before hook
             *
             *  @hooked show_seller_dashboard_notice
             *
             *  @since 2.4
             */
            do_action( 'wpsm_content_inside_before' );
        ?>

        <article class="wpsm-content-article">

            <div class="wpsm-ticket-list-wrap">

                <div class="heading wpsm-clearfix">
                    <h2 class="wpsm-left"><?php _e( 'All Tickets', 'wp-support-manager' ); ?></h2>

                    <a href="<?php echo wpsm_get_nav_url( 'add-new-ticket' ) ?>" class="wpsm-right"><?php _e( 'Add New Ticket', 'wp-support-manager' ); ?></a>
                </div>

                <div class="wpsm-inline-list-filters">
                    <ul>
                        <li><a href="#">All (11)</a></li>
                        <li><a href="#">Open (2)</a></li>
                        <li><a href="#">Closed (9)</a></li>
                    </ul>
                </div>

                <div class="wpsm-table-wrap wpsm-ticket-table">
                    <?php
                        $tickets = wpsm()->ticket->get_all( array( 'created_by' => '2' ) );
                    ?>

                    <table>
                        <thead>
                            <tr>
                                <th><?php _e( 'Status', 'wp-support-manager' ); ?></th>
                                <th><?php _e( 'Number', 'wp-support-manager' ); ?></th>
                                <th><?php _e( 'Title', 'wp-support-manager' ); ?></th>
                                <th><?php _e( 'Date', 'wp-support-manager' ); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ( $tickets as $key => $ticket ): ?>

                            <tr>
                                <td class="status" style="width: 10%;">
                                    <span class="wpsm-label wpsm-label-<?php echo wpsm_ticket_status_lable( $ticket->post_status ) ?>"><?php echo wpsm_ticket_status( $ticket->post_status ); ?></span>
                                </td>
                                <td><?php echo sprintf('<a class="ticket-number" href="%s">#%d</a>', esc_url( add_query_arg( array( 'ticket_id' => $ticket->ID ), wpsm_get_nav_url( 'single-ticket' ) ) ), $ticket->ID ); ?></td>
                                <td class="title_preview" style="width: 70%;">
                                    <span class="preview-fade"></span>
                                    <a href="<?php echo add_query_arg( array( 'ticket_id' => $ticket->ID ), wpsm_get_nav_url( 'single-ticket' ) ); ?>">
                                        <p class="title"><?php echo $ticket->post_title; ?></p>
                                        <p class="preview"><?php echo $ticket->body; ?></p>
                                    </a>
                                </td>
                                <td class="created_date">
                                    <?php echo sprintf( '%s %s', human_time_diff( time(), strtotime( $ticket->post_date ) ), __( 'ago', 'wp-support-manager' ) ); ?>
                                </td>
                            </tr>

                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

            </div>

        </article><!-- .dashboard-content-area -->

         <?php

            /**
             *  wpsm_content_inside_after hook
             *
             *  @since 2.4
             */
            do_action( 'wpsm_content_inside_after' );
        ?>


    </div><!-- .wpsm-content -->

    <?php

        /**
         *  wpsm_content_after hook
         *
         *  @since 2.4
         */
        do_action( 'wpsm_content_after' );
    ?>

</div><!-- .wpsm-content-wrap -->
