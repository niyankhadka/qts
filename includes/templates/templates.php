<?php

/**
 * Templates of the plugin
 *
 * @since      1.0.0
 * @package    QTS
 * @subpackage QTS/includes/templates
 * @author     niyankhadka <niyankhadka.nk@gmail.com>
 */

// Exit if accessed directly.
if ( !defined( 'ABSPATH' ) ) {

    exit;
}


/*
* Function to get template selection
* 
* @since 1.0.0
*/
if ( !function_exists('qts_get_user_template') ) :
    
    function qts_get_user_template() {

        $default_template = 'one';
        
        /**
         * QTS mail feature status filter declaration
         * 
         * Default value : true
         * @since 1.0.0
         */
        $template = apply_filters( 'qts_get_user_template_filter', $default_template );

        if( $template == 'one' || $template == 'two' ) {

            return $template;

        } else {

            return $default_template;
        }
    }
endif;


/**
 * Template file call hook declaration
 *
 * @since 1.0.0
 */
if ( !function_exists('qts_user_templates_action') ) :
    
    function qts_user_templates_action() {

        $template = qts_get_user_template();
            
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'templates/template-' . $template . '/template-' . $template . '.php';
    }
endif;
add_action( 'qts_user_templates', 'qts_user_templates_action', 20 );