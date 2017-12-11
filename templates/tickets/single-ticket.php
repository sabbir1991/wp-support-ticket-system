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
