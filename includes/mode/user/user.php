<?php

/**
 * User Mode function of the plugin
 *
 * @since      1.0.0
 * @package    QTS
 * @subpackage QTS/includes/mode/user
 * @author     niyankhadka <niyankhadka.nk@gmail.com>
 */

// Exit if accessed directly.
if ( !defined( 'ABSPATH' ) ) {

    exit;
}


/*
* Function to get user mail feature status
* 
* returns true or false
* 
* @since 1.0.0
*/
if ( !function_exists('qts_get_user_mail_feature_status') ) :
    
    function qts_get_user_mail_feature_status() {

        $default_status = true;
        
        /**
         * QTS mail feature status filter declaration
         * 
         * Default value : true
         * @since 1.0.0
         */
        $status = apply_filters( 'qts_user_mail_feature_status_fitler', $default_status );

        return $status;
    }
endif;


/*
* Function to get user live chat feature status
* 
* returns true or false
* 
* @since 1.0.0
*/
if ( !function_exists('qts_get_user_live_chat_feature_status') ) :
    
    function qts_get_user_live_chat_feature_status() {

        $default_status = false;
        
        /**
         * QTS live chat feature status filter declaration
         * 
         * Default value : true
         * @since 1.0.0
         */
        $status = apply_filters( 'qts_user_live_chat_feature_status_fitler', $default_status );

        return $status;
    }
endif;


/**
 * Mail feature status hook declaration
 *
 * @since 1.0.0
 */
if ( !function_exists('qts_user_mail_feature_status_action') ) :
    
    function qts_user_mail_feature_status_action() {

        $status = qts_get_user_mail_feature_status();

        if ( $status == true ) {
            
            require_once plugin_dir_path( dirname( __DIR__ ) ) . 'features/mail/mail.php';
        }
    }
endif;
add_action( 'qts_user_mail_feature_status', 'qts_user_mail_feature_status_action', 40 );


/**
 * Live chat feature status hook declaration
 *
 * @since 1.0.0
 */
if ( !function_exists('qts_user_live_chat_feature_status_action') ) :
    
    function qts_user_live_chat_feature_status_action() {

        $status = qts_get_user_live_chat_feature_status();

        if ( $status == true ) {
            
            #call here live chat mode later on it
        }
    }
endif;
add_action( 'qts_user_live_chat_feature_status', 'qts_user_live_chat_feature_status_action', 40 );


/**
 * QTS features status hook declaration
 *
 * @since 1.0.0
 */
if ( !function_exists('qts_user_features_action') ) :
    
    function qts_user_features_action() {

        /**
        * Hook - qts_user_mail_feature_status
        *
        * @hooked qts_user_mail_feature_status_action - 40
        */
        do_action( 'qts_user_mail_feature_status' );

        /**
        * Hook - qts_user_live_chat_feature_status
        *
        * @hooked qts_user_live_chat_feature_status_action - 40
        */
        do_action( 'qts_user_live_chat_feature_status' );
    }
endif;
add_action( 'qts_user_features', 'qts_user_features_action', 60 );


/**
 * QTS user hook declaration
 *
 * @since 1.0.0
 */
if ( !function_exists('qts_user_action') ) :
    
    function qts_user_action() {

        /**
        * Hook - qts_user_features
        *
        * @hooked qts_user_features_action - 60
        */
        do_action( 'qts_user_features' );
    }
endif;
add_action( 'admin_init', 'qts_user_action', 80 );
