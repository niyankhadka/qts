<?php

/**
 * Mode function of the plugin
 *
 * @since      1.0.0
 * @package    QTS
 * @subpackage QTS/includes/mode
 * @author     niyankhadka <niyankhadka.nk@gmail.com>
 */

// Exit if accessed directly.
if ( !defined( 'ABSPATH' ) ) {

    exit;
}

/*
* Function to get plugin use mode
* 
* returns either 'developer' or 'user' as mode
* 
* @since 1.0.0
*/
if ( !function_exists('qts_get_mode') ) :
    
    function qts_get_mode() {

        $default_mode = 'developer';
        
        /**
         * QTS mode filter declaration
         * Either 'developer' or 'user' mode
         * 
         * Default value : developer
         * @since 1.0.0
         */
        $mode = apply_filters( 'qts_mode_filter', $default_mode );

        if( $mode == 'developer' || $mode == 'user' ) {

            return $mode;

        } else {

            return $default_mode;
        }
    }
endif;


/**
 * Mode file call hook declaration
 *
 * @since 1.0.0
 */
if ( !function_exists('qts_mode_action') ) :
    
    function qts_mode_action() {

        $mode = qts_get_mode();

        if ( $mode == 'developer' ) {
            
            require_once plugin_dir_path( dirname( __FILE__ ) ) . 'mode/developer/developer.php';
        }

        if ( $mode == 'user' ) {
            
            require_once plugin_dir_path( dirname( __FILE__ ) ) . 'mode/user/user.php';
        }
    }
endif;
add_action( 'qts_mode', 'qts_mode_action', 20 );
