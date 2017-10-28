<?php

/**
 * Menu access capability
 *
 * @return string
 */
function wpsm_menu_access_capability() {
    return apply_filters( 'wpsm_menu_access_capability', 'manage_options' );
}