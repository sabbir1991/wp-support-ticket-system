<?php

/**
 * Menu access capability
 *
 * @since 1.0.0
 *
 * @return string
 */
function wpsm_menu_access_capability() {
    return apply_filters( 'wpsm_menu_access_capability', 'manage_options' );
}

/**
 * Menu position
 *
 * @since 1.0.0
 *
 * @return string
 */
function wpsm_menu_position() {
    return apply_filters( 'wpsm_menu_position', '25' );
}