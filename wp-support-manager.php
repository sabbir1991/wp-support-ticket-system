<?php
/*
Plugin Name: WP Support Manager
Plugin URI: http://sabbir.pro/
Description: A fully ticket based customer support system for WordPress
Version: 1.0.0
Author: Sabbir Ahmed, Rafsun Chowdhury
Author URI: http://sabbir.pro/
License: GPL2
*/

/**
 * Copyright (c) YEAR Sabbir Ahmed (email: sabbir.080170@gmail.com). All rights reserved.
 *
 * Released under the GPL license
 * http://www.opensource.org/licenses/gpl-license.php
 *
 * This is an add-on for WordPress
 * http://wordpress.org/
 *
 * **********************************************************************
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 * **********************************************************************
 */

// don't call the file directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * WP_Support_Manager class
 *
 * @class WP_Support_Manager The class that holds the entire WP_Support_Manager plugin
 */
class WP_Support_Manager {

     /**
     * Plugin version
     *
     * @var string
     */
    public $version = '1.0.0';

    /**
     * Holds all class instances
     *
     * @var array
     */
    private $container = array();

    /**
     * Constructor for the WP_Support_Manager class
     *
     * Sets up all the appropriate hooks and actions
     * within our plugin.
     *
     * @uses register_activation_hook()
     * @uses register_deactivation_hook()
     * @uses is_admin()
     * @uses add_action()
     */
    public function __construct() {

        // Define all constant
        $this->define_constant();

        register_activation_hook( __FILE__, array( $this, 'activate' ) );
        register_deactivation_hook( __FILE__, array( $this, 'deactivate' ) );

        add_action( 'plugins_loaded', array( $this, 'init_plugin' ) );
    }

    /**
     * Initializes the WP_Support_Manager() class
     *
     * Checks for an existing WP_Support_Manager() instance
     * and if it doesn't find one, creates it.
     */
    public static function init() {
        static $instance = false;

        if ( ! $instance ) {
            $instance = new WP_Support_Manager();
        }

        return $instance;
    }

    /**
     * Magic getter to bypass referencing plugin.
     *
     * @param $prop
     *
     * @return mixed
     */
    public function __get( $prop ) {
        if ( array_key_exists( $prop, $this->container ) ) {
            return $this->container[ $prop ];
        }

        return $this->{$prop};
    }

    /**
     * Magic isset to bypass referencing plugin.
     *
     * @param $prop
     *
     * @return mixed
     */
    public function __isset( $prop ) {
        return isset( $this->{$prop} ) || isset( $this->container[ $prop ] );
    }

    /**
     * Placeholder for activation function
     *
     * Nothing being called here yet.
     */
    public function activate() {

    }

    /**
     * Placeholder for deactivation function
     *
     * Nothing being called here yet.
     */
    public function deactivate() {

    }

    /**
     * Defined all constant
     *
     * @return void
     */
    private function define_constant() {
        define( 'WP_SUPPORT_MANAGER_VERSION', $this->version );
        define( 'WP_SUPPORT_MANAGER_FILE', __FILE__ );
        define( 'WP_SUPPORT_MANAGER_PATH', dirname( WP_SUPPORT_MANAGER_FILE ) );
        define( 'WP_SUPPORT_MANAGER_INC_PATH', WP_SUPPORT_MANAGER_PATH . '/includes' );
        define( 'WP_SUPPORT_MANAGER_ASSETS', plugins_url( '/assets', __FILE__ ) );
    }

    /**
     * Get the template path.
     *
     * @since 1.0.0
     *
     * @return string
     */
    public function template_path() {
        return apply_filters( 'wpsm_template_path', 'wpsupport/' );
    }

    /**
     * Get the plugin path.
     *
     * @since 1.0.0
     *
     * @return string
     */
    public function plugin_path() {
        return untrailingslashit( plugin_dir_path( WP_SUPPORT_MANAGER_FILE ) );
    }

    /**
     * Load the plugin after WP User Frontend is loaded
     *
     * @return void
     */
    public function init_plugin() {

        $this->includes();

        $this->init_hooks();

        do_action( 'wp_support_manager_loaded', $this );
    }

    /**
    * Includes all files
    *
    * @since 1.0.0
    *
    * @return void
    **/
    public function includes() {
        if ( is_admin() ) {
            require_once WP_SUPPORT_MANAGER_INC_PATH . '/admin/class-admin.php';
        } else {
            require_once WP_SUPPORT_MANAGER_INC_PATH . '/class-frontend.php';
        }

        require_once WP_SUPPORT_MANAGER_INC_PATH . '/class-scripts.php';
        require_once WP_SUPPORT_MANAGER_INC_PATH . '/class-rewrites.php';
        require_once WP_SUPPORT_MANAGER_INC_PATH . '/class-core.php';
        require_once WP_SUPPORT_MANAGER_INC_PATH . '/functions.php';
        require_once WP_SUPPORT_MANAGER_INC_PATH . '/core-functions.php';
    }

    /**
    * Init all filters
    *
    * @since 1.0.0
    *
    * @return void
    **/
    public function init_hooks() {
        // Localize our plugin
        add_action( 'init', array( $this, 'localization_setup' ) );

        // initialize the classes
        add_action( 'init', array( $this, 'init_classes' ) );
    }

    /**
    * Inistantiate all classes
    *
    * @since 1.0.0
    *
    * @return void
    **/
    public function init_classes() {
        if ( is_admin() ) {
            new WPSM_Admin();
        } else {
            new WPSM_Frontend();
        }

        $this->container['scripts'] = new WPSM_Scripts();
    }

    /**
     * Initialize plugin for localization
     *
     * @since 1.0.0
     *
     * @uses load_plugin_textdomain()
     */
    public function localization_setup() {
        load_plugin_textdomain( 'wp-support-manager', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
    }

}

/**
 * Initialize the plugin
 *
 * @return WP_Support_Manager
 */
function wpsm() {
    return WP_Support_Manager::init();
}

// Lets go..
wpsm();
