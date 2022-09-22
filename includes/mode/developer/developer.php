<?php

/**
 * Developer Mode function of the plugin
 *
 * @since      1.0.0
 * @package    QTS
 * @subpackage QTS/includes/mode/developer
 * @author     niyankhadka <niyankhadka.nk@gmail.com>
 */

// Exit if accessed directly.
if ( !defined( 'ABSPATH' ) ) {

    exit;
}

add_action( 'admin_notices', 'independence_notice_developer' );

function independence_notice_developer() {
    global $pagenow;
	$admin_pages = [ 'index.php', 'edit.php', 'plugins.php' ];
    if ( in_array( $pagenow, $admin_pages ) ) {
        ?>
        <div class="notice notice-warning is-dismissible">
            <p>Developer mode</p>
        </div>
        <?php
    }
}