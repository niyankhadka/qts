<?php

/**
 * Template two of the plugin
 *
 * @since      1.0.0
 * @package    QTS
 * @subpackage QTS/includes/templates/template-two
 * @author     niyankhadka <niyankhadka.nk@gmail.com>
 */

// Exit if accessed directly.
if ( !defined( 'ABSPATH' ) ) {

    exit;
}


add_action( 'in_admin_footer', 'qts_user_template_two', 40 );

/**
 * QTS user template two hook declaration
 *
 * @since 1.0.0
 */
if ( !function_exists('qts_user_template_two') ) :
    
    function qts_user_template_two() {

        ?>
        <div class="help-tip">
            <p>This is the inline help tip! It can contain all kinds of HTML. Style it as you please.<br />
                <a href="#">Here is a link</a>
            </p>
        </div>
        <?php
    }
endif;


add_action( 'admin_enqueue_scripts', function () {

    $ver = QTS_PLUGIN_VERSION;
    wp_enqueue_style('qts-user-mail', plugin_dir_url( __FILE__ ) . "assets/css/qts-template-two.css", '', $ver);
    wp_enqueue_script('qts-user-mail', plugin_dir_url( __FILE__ ) . "assets/js/qts-template-two.js", ['jquery'], $ver, true);
    
});