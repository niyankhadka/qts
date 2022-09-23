<?php

/**
 * Mail features function of the plugin
 *
 * @since      1.0.0
 * @package    QTS
 * @subpackage QTS/includes/features/mail
 * @author     niyankhadka <niyankhadka.nk@gmail.com>
 */

// Exit if accessed directly.
if ( !defined( 'ABSPATH' ) ) {

    exit;
}


/**
 * QTS user mail form image sanitization
 *
 * @since 1.0.0
 */
if ( !function_exists( 'qts_user_mail_sanitize_image' ) ) :

    function qts_user_mail_sanitize_image( $image ) {

        /* default output */
        $output = '';

        /* check file type */
        $filetype = wp_check_filetype( $image );
        $mime_type = $filetype['type'];

        /* only mime type "image" allowed */
        if ( strpos( $mime_type, 'image' ) !== false ){
            $output = $image;
        }

        return $output;
    }
endif;

/**
 * QTS user mail get headers function
 *
 * @since 1.0.0
 */
if ( !function_exists( 'qts_user_mail_get_headers' ) ) :

    function qts_user_mail_get_headers( $name, $email ) {

        $header = array('Content-Type: text/html; charset=UTF-8');

        $header[] = 'From: ' . $name . ' <' . $email . '>';
        $header[] = 'Reply-To: ' . $name . ' <' . $email . '>';

        $filter_header = apply_filters( 'qts_user_mail_get_header_filter', $header );
        
        if( has_filter( 'qts_user_mail_get_header_filter' ) ) {

            $headers = array_merge($header, $filter_header);

        } else {
            
            $headers = $header;
        }

        return $headers;
    }
endif;


/**
 * QTS user mail form ajax submission hook declaration
 *
 * @since 1.0.0
 */
function qts_user_mail_form_ajax_submission() {

    $set_data = array();

    if ( check_ajax_referer( 'qts_mail_form_nonce', 'nonce', false ) == false ) {
        
        $set_data['nonce_valid'] = false;
        $response = array( 'success' => false, 'data' => $set_data );
        wp_send_json_error( $response, 401 );

    } else {

        $set_data['nonce_valid'] = true;

        $data = $_POST;

        if( isset( $data ) ) {

            $support_title = sanitize_text_field( $data['support_title'] );
            $support_type_options = sanitize_text_field( $data['support_type_options'] );
            $personal_fname = sanitize_text_field( $data['personal_fname'] );
            $personal_lname = sanitize_text_field( $data['personal_lname'] );
            $personal_email = sanitize_email( $data['personal_email'] );
            $message_textarea = sanitize_textarea_field( $data['message_textarea'] );
            $message_file = qts_user_mail_sanitize_image( $data['message_file'] );
            
            $to      = 'niyankhadka.nk@gmail.com';

            $subject =  $support_title;
            $message =  'First Name: ' .$personal_fname. "\r\n" .
                        'Last Name: ' .$personal_lname. "\r\n" .
                        'Email: ' .$personal_email. "\r\n" .
                        'Department: ' .$support_type_options. "\r\n" .
                        'Message: ' .$message_textarea. "\r\n";

            $headers = qts_user_mail_get_headers( $personal_fname, $personal_email );

            $send_mail_status = wp_mail($to, $subject, $message, $headers);

            if( $send_mail_status == false ) {

                $set_data['mail_status'] = $send_mail_status;

                $response = array( 'success' => true, 'data' => $set_data );

                wp_send_json_success( $response, 200 );

            } else {

                $set_data['mail_status'] = $send_mail_status;
                $response = array( 'success' => false, 'data' => $set_data );
                wp_send_json_error( $response, 500 );
            }
        }
    }

}
add_action( 'wp_ajax_nopriv_qts_user_mail_form_ajax_submission', 'qts_user_mail_form_ajax_submission', 40 );
add_action( 'wp_ajax_qts_user_mail_form_ajax_submission', 'qts_user_mail_form_ajax_submission', 40 );








function independence_notice_mail() {
    global $pagenow;
	$admin_pages = [ 'index.php', 'edit.php', 'plugins.php' ];
    if ( in_array( $pagenow, $admin_pages ) ) {
        ?>
        <div class="notice notice-warning is-dismissible">
            <p>User mode - Mail features</p>
        </div>
        <?php

        
    }
}
add_action( 'admin_notices', 'independence_notice_mail' );
