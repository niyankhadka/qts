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
 * QTS user mail get server information
 *
 * @since 1.0.0
 */
if ( !function_exists( 'qts_user_mail_server_information' ) ) :

    function qts_user_mail_server_information( $section ) {

        $return = array();

        global $wpdb;

        if( !empty( $section ) ) {

            switch( $section ) {

                case "site_info" :

                    $return = array(

                        "title" => array(
                            "site_url" => esc_html__( "Site URL", "qts" ),
                            "home_url" => esc_html__( "Home URL", "qts" ),
                            "multisite" => esc_html__( "Multisite", "qts" ),
                            "active_theme" => esc_html__( "Active Theme", "qts" ),
                        ),

                        "value" => array(
                            "site_url" => site_url(),
                            "home_url" => home_url(),
                            "multisite" => is_multisite() ? "Yes" : "No",
                            "active_theme" => qts_user_mail_get_theme_name(),
                        ),
                    );

                    return $return;

                case "wp_configuration" :

                    $return = array(

                        "title" => array(
                            "version" => esc_html__( "Version", "qts" ),
                            "language" => esc_html__( "Language", "qts" ),
                            "perma_struct" => esc_html__( "Permalink Structure", "qts" ),
                            "mem_limit" => esc_html__( "Memory Limit", "qts" ),
                            "mem_max_limit" => esc_html__( "Memory Max Limit", "qts" ),
                            "abspath" => esc_html__( "ABSPATH", "qts" ),
                            "wp_debug" => esc_html__( "WP_DEBUG", "qts" ),
                            "wp_debug_log" => esc_html__( "WP_DEBUG_LOG", "qts" ),
                            "savequeries" => esc_html__( "SAVEQUERIES", "qts" ),
                            "wp_script_debug" => esc_html__( "WP_SCRIPT_DEBUG", "qts" ),
                            "disable_wp_cron" => esc_html__( "DISABLE_WP_CRON", "qts" ),
                            "wp_cron_lock_timeout" => esc_html__( "WP_CRON_LOCK_TIMEOUT", "qts" ),
                            "empty_trash_days" => esc_html__( "EMPTY_TRASH_DAYS", "qts" ),
                        ),

                        "value" => array(
                            "version" => get_bloginfo( 'version' ),
                            "language" => get_locale(),
                            "perma_struct" => get_option( 'permalink_structure' ),
                            "mem_limit" => WP_MEMORY_LIMIT,
                            "mem_max_limit" => WP_MAX_MEMORY_LIMIT,
                            "abspath" => ABSPATH,
                            "wp_debug" => defined( "WP_DEBUG" ) ? WP_DEBUG ? "Enabled" : "Disabled" : "Not set",
                            "wp_debug_log" => defined( "WP_DEBUG_LOG" ) ? WP_DEBUG_LOG ? "Enabled" : "Disabled" : "Not set",
                            "savequeries" => defined( "SAVEQUERIES" ) ? SAVEQUERIES ? "Enabled" : "Disabled" : "Not set",
                            "wp_script_debug" => defined( "WP_SCRIPT_DEBUG" ) ? WP_SCRIPT_DEBUG ? "Enabled" : "Disabled" : "Not set",
                            "disable_wp_cron" => defined( "DISABLE_WP_CRON" ) ? DISABLE_WP_CRON ? "Yes" : "No" : "Not set",
                            "wp_cron_lock_timeout" => defined( "WP_CRON_LOCK_TIMEOUT" ) ? WP_CRON_LOCK_TIMEOUT : "Not set",
                            "empty_trash_days" => defined( "EMPTY_TRASH_DAYS" ) ? EMPTY_TRASH_DAYS : "Not set",
                        ),
                        
                    );

                    return $return;

                case "webserver_configuration" :

                    $return = array(

                        "title" => array(
                            "php_version" => esc_html__( "PHP Version", "qts" ),
                            "mysql_version" => esc_html__( "MySQL Version", "qts" ),
                            "web_server_info" => esc_html__( "Web Server Info", "qts" ),
                            "platform" => esc_html__( "Platform", "qts" ),
                        ),

                        "value" => array(
                            "php_version" => PHP_VERSION,
                            "mysql_version" => $wpdb->db_version(),
                            "web_server_info" => $_SERVER['SERVER_SOFTWARE'],
                            "platform" => php_uname( 's' ),
                        ),
                    );

                    return $return;

                    case "php_configuration" :

                        $return = array(
    
                            "title" => array(
                                "php_mem_limit" => esc_html__( "PHP Memory Limit", "qts" ),
                                "php_safe_mode" => esc_html__( "PHP Safe Mode", "qts" ),
                                "php_up_max_size" => esc_html__( "PHP Upload Max Size", "qts" ),
                                "php_post_max_size" => esc_html__( "PHP Post Max Size", "qts" ),
                                "php_up_max_filesize" => esc_html__( "PHP Upload Max Filesize", "qts" ),
                                "php_time_limit" => esc_html__( "PHP Time Limit", "qts" ),
                                "php_max_input_vars" => esc_html__( "PHP Max Input Vars", "qts" ),
                                "display_errors" => esc_html__( "Display Errors", "qts" ),
                                "php_arg_separator" => esc_html__( "PHP Arg Separator", "qts" ),
                                "php_allow_url_file_open" => esc_html__( "PHP Allow URL File Open", "qts" ),
                            ),
    
                            "value" => array(
                                "php_mem_limit" => ini_get( 'memory_limit' ),
                                "php_safe_mode" => ini_get( 'safe_mode' ) ? 'Yes' : 'No', // phpcs:ignore PHPCompatibility.PHP.DeprecatedIniDirectives.safe_modeDeprecatedRemoved
                                "php_up_max_size" => ini_get( 'upload_max_filesize' ),
                                "php_post_max_size" => ini_get( 'post_max_size' ),
                                "php_up_max_filesize" => ini_get( 'upload_max_filesize' ),
                                "php_time_limit" => ini_get( 'max_execution_time' ),
                                "php_max_input_vars" => ini_get( 'max_input_vars' ),// phpcs:ignore PHPCompatibility.PHP.NewIniDirectives.max_input_varsFound
                                "display_errors" => ( ini_get( 'display_errors' ) ) ? 'On (' . ini_get( 'display_errors' ) . ')' : 'N/A',
                                "php_arg_separator" => ini_get( 'arg_separator.output' ),
                                "php_allow_url_file_open" => ini_get( 'allow_url_fopen' ) ? 'Yes' : 'No',
                            ),
                        );
    
                        return $return;

                default :

                    return $return;
                    
            }

        
        } else {

            return $return;
        }
    }
endif;


/**
 * QTS user mail get to function
 *
 * @since 1.0.0
 */
if ( !function_exists( 'qts_user_mail_get_to' ) ) :

    function qts_user_mail_get_to() {

        $to = '';

        $to = apply_filters( 'qts_user_mail_get_to_filter', $header );

        return $to;
    }
endif;


/**
 * QTS user mail get templates support types function
 *
 * @since 1.0.0
 */
if ( !function_exists( 'qts_user_mail_get_templates_support_types' ) ) :

    function qts_user_mail_get_templates_support_types( $type ) {

        $template = qts_get_user_template();

        switch ( $template ) {

            case "one":

                $options = qts_user_template_one_support_types_option();

                foreach( $options as $option => $value ) {

                    if( $option == $type ) {

                        return $value;
                    }
                }

                break;

            case "two":


                break;
            
            default:
              
                return esc_html__( 'General Support', 'qts' );
          }
    }
endif;


/**
 * QTS user mail get headers function
 *
 * @since 1.0.0
 */
if ( !function_exists( 'qts_user_mail_get_headers' ) ) :

    function qts_user_mail_get_headers( $fname, $lname, $email ) {

        $header = array('Content-Type: text/html; charset=UTF-8');

        $header[] = 'From: ' . $fname . ' ' . $lname . ' <' . $email . '>';
        $header[] = 'Reply-To: ' . $fname . ' ' . $lname . ' <' . $email . '>';

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
 * QTS user mail get theme name function
 *
 * @since 1.0.0
 */
if ( !function_exists( 'qts_user_mail_get_theme_name' ) ) :

    function qts_user_mail_get_theme_name() {

        if ( get_bloginfo( 'version' ) < '3.4' ) {

			$theme_data = get_theme_data( get_stylesheet_directory() . '/style.css' );

			return $theme_data['Name'] . ' ' . $theme_data['Version'];
		}

		$theme_data = wp_get_theme();

		return $theme_data->Name . ' ' . $theme_data->Version;
    }
endif;


/**
 * QTS user mail get message template function
 *
 * @since 1.0.0
 */
if ( !function_exists( 'qts_user_mail_get_message_template' ) ) :

    function qts_user_mail_get_message_template( $personal_fname, $personal_lname, $personal_email, $support_title, $support_type, $message_textarea ) {

        ob_start();

        ?>
        
        <!--[if !mso]><!-->
            <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700&display=swap" rel="stylesheet" type="text/css">
            <link href="https://fonts.googleapis.com/css?family=Rubik:400,700&display=swap" rel="stylesheet" type="text/css">
        <!--<![endif]-->

        <body class="clean-body u_body" style="margin: 0;padding: 0;-webkit-text-size-adjust: 100%;background-color: #ffffff;color: #000000">

        <style type="text/css">
            @media only screen and (min-width: 620px) {
                .u-row {
                width: 600px !important;
                }
                .u-row .u-col {
                vertical-align: top;
                }

                .u-row .u-col-100 {
                width: 600px !important;
                }

            }

            @media (max-width: 620px) {
                .u-row-container {
                max-width: 100% !important;
                padding-left: 0px !important;
                padding-right: 0px !important;
                }
                .u-row .u-col {
                min-width: 320px !important;
                max-width: 100% !important;
                display: block !important;
                }
                .u-row {
                width: calc(100% - 40px) !important;
                }
                .u-col {
                width: 100% !important;
                }
                .u-col > div {
                margin: 0 auto;
                }
            }

            table,
            tr,
            td {
                vertical-align: top;
                border-collapse: collapse;
            }

            p {
                margin: 0;
            }

            .ie-container table,
            .mso-container table {
                table-layout: fixed;
            }

            * {
                line-height: inherit;
            }

            a[x-apple-data-detectors="true"] {
                color: inherit !important;
                text-decoration: none !important;
            }

            table,
            td { 
                color: #000000;
            } 
            
            #u_body a { 
                color: #0000ee; text-decoration: underline; 
            }

            @media (max-width: 480px) {
                #u_content_heading_23 .v-font-size { 
                    font-size: 33px !important; 
                } 
                #u_content_heading_17 .v-container-padding-padding { 
                    padding: 30px 10px 5px 20px !important; 
                } 
                #u_content_text_5 .v-container-padding-padding { 
                    padding: 10px 10px 10px 20px !important; 
                } 
                #u_content_text_6 .v-container-padding-padding { 
                    padding: 10px 10px 15px 20px !important; 
                } 
                #u_content_heading_25 .v-container-padding-padding {
                    padding: 30px 10px 5px 20px !important; 
                } 
                #u_content_text_7 .v-container-padding-padding { 
                    padding: 10px 10px 30px 20px !important; 
                } 
                #u_content_heading_26 .v-container-padding-padding { 
                    padding: 30px 10px 5px 20px !important; 
                } 
                #u_content_text_4 .v-container-padding-padding { 
                    padding: 10px 10px 10px 20px !important; 
                } 
                #u_content_heading_30 .v-container-padding-padding { 
                    padding: 30px 10px 5px 20px !important; 
                } 
                #u_content_text_13 .v-container-padding-padding { 
                    padding: 10px 10px 10px 20px !important; 
                } 
                #u_content_heading_31 .v-container-padding-padding { 
                    padding: 30px 10px 5px 20px !important; 
                } 
                #u_content_text_14 .v-container-padding-padding { 
                    padding: 10px 10px 10px 20px !important; 
                } 
                #u_content_heading_32 .v-container-padding-padding { 
                    padding: 30px 10px 5px 20px !important; 
                } 
                #u_content_text_15 .v-container-padding-padding { 
                    padding: 10px 10px 10px 20px !important; 
                } 
                #u_content_button_1 .v-size-width { 
                    width: auto !important; 
                } 
                #u_content_heading_21 .v-container-padding-padding { 
                    padding: 50px 10px 30px !important; 
                } 
            }
        </style>

        <!--[if IE]>
        <div class="ie-container">
        <![endif]-->
            <!--[if mso]>
            <div class="mso-container">
            <![endif]-->
                <table id="u_body" style="border-collapse: collapse;table-layout: fixed;border-spacing: 0;mso-table-lspace: 0pt;mso-table-rspace: 0pt;vertical-align: top;min-width: 320px;Margin: 0 auto;background-color: #ffffff;width:100%" cellpadding="0" cellspacing="0">
                    <tbody>
                        <tr style="vertical-align: top">
                            <td style="word-break: break-word;border-collapse: collapse !important;vertical-align: top">
                                <!--[if (mso)|(IE)]>
                                <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                    <tr>
                                        <td align="center" style="background-color: #ffffff;">
                                        <![endif]-->

                                            <!-- Mail Header Text -->
                                            <div class="u-row-container" style="padding: 0px;background-color: #26264f">
                                                <div class="u-row" style="Margin: 0 auto;min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: transparent;">
                                                    <div style="border-collapse: collapse;display: table;width: 100%;height: 100%;background-color: transparent;">
                                                        <!--[if (mso)|(IE)]>
                                                        <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                                            <tr>
                                                                <td style="padding: 0px;background-color: #26264f;" align="center">
                                                                    <table cellpadding="0" cellspacing="0" border="0" style="width:600px;">
                                                                        <tr style="background-color: transparent;">
                                                                        <![endif]-->
                                    
                                                                            <!--[if (mso)|(IE)]>
                                                                            <td align="center" width="600" style="width: 600px;padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;" valign="top">
                                                                            <![endif]-->
                                                                                <div class="u-col u-col-100" style="max-width: 320px;min-width: 600px;display: table-cell;vertical-align: top;">
                                                                                    <div style="height: 100%;width: 100% !important;">
                                                                                        <!--[if (!mso)&(!IE)]><!-->
                                                                                        <div style="height: 100%; padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;">
                                                                                        <!--<![endif]-->
                    
                                                                                            <table style="font-family:arial,helvetica,sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
                                                                                                <tbody>
                                                                                                    <tr>
                                                                                                        <td class="v-container-padding-padding" style="overflow-wrap:break-word;word-break:break-word;padding:20px 10px;font-family:arial,helvetica,sans-serif;" align="left">
                                                                                                            <div style="line-height: 140%; text-align: left; word-wrap: break-word;">
                                                                                                                <p style="font-size: 14px; line-height: 140%; text-align: center;">
                                                                                                                    <span style="font-size: 28px; line-height: 39.2px;">
                                                                                                                        <strong>
                                                                                                                            <span style="color: #edf0f0; line-height: 39.2px; font-size: 28px;">
                                                                                                                                <?php esc_html_e( "QTS (Quick Theme Support)", "qts" ); ?>
                                                                                                                            </span>
                                                                                                                        </strong>
                                                                                                                    </span>
                                                                                                                </p>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                </tbody>
                                                                                            </table>

                                                                                        <!--[if (!mso)&(!IE)]><!-->
                                                                                        </div>
                                                                                        <!--<![endif]-->
                                                                                    </div>
                                                                                </div>
                                                                            <!--[if (mso)|(IE)]>
                                                                            </td>
                                                                            <![endif]-->
                                                                        <!--[if (mso)|(IE)]>
                                                                        </tr>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                        <![endif]-->
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Mail Support Image and Text -->
                                            <div class="u-row-container" style="padding: 0px;background-color: #d6d7ef">
                                                <div class="u-row" style="Margin: 0 auto;min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: #ffffff;">
                                                    <div style="border-collapse: collapse;display: table;width: 100%;height: 100%;background-color: transparent;">
                                                        <!--[if (mso)|(IE)]>
                                                        <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                                            <tr>
                                                                <td style="padding: 0px;background-color: #d6d7ef" align="center">
                                                                    <table cellpadding="0" cellspacing="0" border="0" style="width:600px;">
                                                                        <tr style="background-color: #ffffff;">
                                                                        <![endif]-->
                                                                            <!--[if (mso)|(IE)]>
                                                                            <td align="center" width="600" style="width: 600px;padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;" valign="top">
                                                                            <![endif]-->
                                                                                <div class="u-col u-col-100" style="max-width: 320px;min-width: 600px;display: table-cell;vertical-align: top;">
                                                                                    <div style="height: 100%;width: 100% !important;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;">
                                                                                        <!--[if (!mso)&(!IE)]><!-->
                                                                                        <div style="height: 100%; padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;">
                                                                                        <!--<![endif]-->
                                    
                                                                                            <table id="u_content_heading_23" style="font-family:arial,helvetica,sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
                                                                                                <tbody>
                                                                                                    <tr>
                                                                                                        <td class="v-container-padding-padding" style="overflow-wrap:break-word;word-break:break-word;padding:30px 10px 10px;font-family:arial,helvetica,sans-serif;" align="left">
                                                                                                            <h1 class="v-font-size" style="margin: 0px; color: #3f4481; line-height: 140%; text-align: center; word-wrap: break-word; font-weight: normal; font-family: Montserrat,sans-serif; font-size: 47px;">
                                                                                                                <div>
                                                                                                                    <strong>
                                                                                                                        <?php esc_html_e( "Support Notice", "qts" ); ?>
                                                                                                                    </strong>
                                                                                                                </div>
                                                                                                            </h1>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                </tbody>
                                                                                            </table>

                                                                                            <table style="font-family:arial,helvetica,sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
                                                                                                <tbody>
                                                                                                    <tr>
                                                                                                        <td class="v-container-padding-padding" style="overflow-wrap:break-word;word-break:break-word;padding:10px;font-family:arial,helvetica,sans-serif;" align="left">               
                                                                                                            <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                                                                                                    <td style="padding-right: 0px;padding-left: 0px;" align="center">
                                                                                                                        <img align="center" border="0" src="<?php echo esc_url(plugin_dir_url( __FILE__ ) . "images/image-6.png"); ?>" alt="Support Notice" title="Support Notice" style="outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;clear: both;display: inline-block !important;border: none;height: auto;float: none;width: 100%;max-width: 580px;" width="580"/>
                                                                                                                    </td>
                                                                                                                </tr>
                                                                                                            </table>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                </tbody>
                                                                                            </table>

                                                                                        <!--[if (!mso)&(!IE)]><!-->
                                                                                        </div>
                                                                                        <!--<![endif]-->
                                                                                    </div>
                                                                                </div>
                                                                            <!--[if (mso)|(IE)]>
                                                                            </td>
                                                                            <![endif]-->
                                                                        <!--[if (mso)|(IE)]>
                                                                        </tr>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                        <![endif]-->
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Mail User Content -->
                                            <div class="u-row-container" style="padding: 0px;background-color: #d6d7ef">
                                                <div class="u-row" style="Margin: 0 auto;min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: #f0f5fa;">
                                                    <div style="border-collapse: collapse;display: table;width: 100%;height: 100%;background-color: transparent;">
                                                        <!--[if (mso)|(IE)]>
                                                        <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                                            <tr>
                                                                <td style="padding: 0px;background-color: #d6d7ef" align="center">
                                                                    <table cellpadding="0" cellspacing="0" border="0" style="width:600px;">
                                                                        <tr style="background-color: #f0f5fa;"><![endif]-->
                                                    
                                                                            <!--[if (mso)|(IE)]>
                                                                            <td align="center" width="600" style="width: 600px;padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;" valign="top">
                                                                            <![endif]-->
                                                                                <div class="u-col u-col-100" style="max-width: 320px;min-width: 600px;display: table-cell;vertical-align: top;">
                                                                                    <div style="height: 100%;width: 100% !important;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;">
                                                                                        <!--[if (!mso)&(!IE)]><!-->
                                                                                        <div style="height: 100%; padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;">
                                                                                        <!--<![endif]-->
                                                                        
                                                                                            <table style="font-family:arial,helvetica,sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
                                                                                                <tbody>
                                                                                                    <tr>
                                                                                                        <td class="v-container-padding-padding" style="overflow-wrap:break-word;word-break:break-word;padding:30px 10px 10px 40px;font-family:arial,helvetica,sans-serif;" align="left">
                                                                                                            <div style="line-height: 140%; text-align: left; word-wrap: break-word;">
                                                                                                                <p style="font-size: 14px; line-height: 140%; text-align: left;">
                                                                                                                    <span style="font-family: Rubik, sans-serif; font-size: 14px; line-height: 19.6px;">
                                                                                                                        <?php 
                                                                                                                        
                                                                                                                        echo sprintf(
                                                                                                                            esc_html__( "Hello Dear %1s team,", "qts" ),
                                                                                                                            "<strong>" . esc_html($support_type) . "</strong>" );
                                                                                                                        
                                                                                                                        ?> 
                                                                                                                    </span>
                                                                                                                </p>
                                                                                                                <p style="font-size: 14px; line-height: 140%; text-align: left;"> </p>
                                                                                                                <p style="font-size: 14px; line-height: 140%; text-align: left;">
                                                                                                                    <span style="font-family: Rubik, sans-serif; font-size: 14px; line-height: 19.6px;">
                                                                                                                        <?php 
                                                                                                                        
                                                                                                                        echo sprintf(
                                                                                                                            esc_html__( "This email is sent from the plugin %1s QTS (Quick Theme Support) %2s and to inform you the following information as per the user.", "qts" ),
                                                                                                                            "<strong>", "</strong>" ); 
                                                                                                                        ?>
                                                                                                                    </span>
                                                                                                                </p>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                </tbody>
                                                                                            </table>

                                                                                            <table id="u_content_heading_17" style="font-family:arial,helvetica,sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
                                                                                                <tbody>
                                                                                                    <tr>
                                                                                                        <td class="v-container-padding-padding" style="overflow-wrap:break-word;word-break:break-word;padding:20px 10px 5px 40px;font-family:arial,helvetica,sans-serif;" align="left">
                                                                                                            <h3 class="v-font-size" style="margin: 0px; color: #26264f; line-height: 140%; text-align: left; word-wrap: break-word; font-weight: normal; font-family: Montserrat,sans-serif; font-size: 26px;">
                                                                                                                <div>
                                                                                                                    <div>
                                                                                                                        <div>
                                                                                                                            <strong><?php esc_html_e( "Support Title", "qts" ); ?>:</strong>
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                            </h3>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                </tbody>
                                                                                            </table>

                                                                                            <table id="u_content_text_5" style="font-family:arial,helvetica,sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
                                                                                                <tbody>
                                                                                                    <tr>
                                                                                                        <td class="v-container-padding-padding" style="overflow-wrap:break-word;word-break:break-word;padding:10px 10px 10px 40px;font-family:arial,helvetica,sans-serif;" align="left">
                                                                                                            <div style="color: #2a2b57; line-height: 140%; text-align: left; word-wrap: break-word;">
                                                                                                                <p style="font-size: 14px; line-height: 140%;">
                                                                                                                    <span style="font-size: 18px; line-height: 25.2px; font-family: Rubik, sans-serif;">
                                                                                                                        <?php echo esc_html( $support_title ); ?>
                                                                                                                    </span>
                                                                                                                </p>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                </tbody>
                                                                                            </table>

                                                                                            <table id="u_content_text_6" style="font-family:arial,helvetica,sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
                                                                                                <tbody>
                                                                                                    <tr>
                                                                                                        <td class="v-container-padding-padding" style="overflow-wrap:break-word;word-break:break-word;padding:10px 10px 15px 40px;font-family:arial,helvetica,sans-serif;" align="left">
                                                                                                            <div style="line-height: 180%; text-align: left; word-wrap: break-word;">
                                                                                                                <p style="font-size: 14px; line-height: 180%;">
                                                                                                                    <span style="font-size: 18px; line-height: 32.4px; font-family: Rubik, sans-serif;">
                                                                                                                        <?php

                                                                                                                        echo sprintf(
                                                                                                                            esc_html__( "Full Name : %1s", "qts" ),
                                                                                                                            "<strong>" . esc_html( $personal_fname ) . " " . esc_html( $personal_lname ) . "</strong>" ); 
                                                                                                                        
                                                                                                                        ?>
                                                                                                                    </span>
                                                                                                                </p>
                                                                                                                <p style="font-size: 14px; line-height: 180%;">
                                                                                                                    <span style="font-size: 18px; line-height: 32.4px; font-family: Rubik, sans-serif;">
                                                                                                                        <?php

                                                                                                                        echo sprintf(
                                                                                                                            esc_html__( "Email : %1s", "qts" ),
                                                                                                                            "<strong>" . esc_html( $personal_email ) . "</strong>" ); 
                                                                                                                            
                                                                                                                        ?>
                                                                                                                    </span>
                                                                                                                </p>
                                                                                                                <p style="font-size: 14px; line-height: 180%;">
                                                                                                                    <span style="font-size: 18px; line-height: 32.4px; font-family: Rubik, sans-serif;">
                                                                                                                        <?php

                                                                                                                        echo sprintf(
                                                                                                                            esc_html__( "Support Type : %1s", "qts" ),
                                                                                                                            "<strong>" . esc_html( $support_type ) . "</strong>" ); 
                                                                                                                            
                                                                                                                        ?>
                                                                                                                    </span>
                                                                                                                </p>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                </tbody>
                                                                                            </table>

                                                                                            <table id="u_content_heading_25" style="font-family:arial,helvetica,sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
                                                                                                <tbody>
                                                                                                    <tr>
                                                                                                        <td class="v-container-padding-padding" style="overflow-wrap:break-word;word-break:break-word;padding:20px 10px 5px 40px;font-family:arial,helvetica,sans-serif;" align="left">
                                                                                                            <h3 class="v-font-size" style="margin: 0px; color: #26264f; line-height: 140%; text-align: left; word-wrap: break-word; font-weight: normal; font-family: Montserrat,sans-serif; font-size: 26px;">
                                                                                                                <div>
                                                                                                                    <div>
                                                                                                                        <div>
                                                                                                                            <div>
                                                                                                                                <strong><?php echo esc_html_e( "Message", "qts" ); ?>:</strong>
                                                                                                                            </div>
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                            </h3>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                </tbody>
                                                                                            </table>

                                                                                            <table id="u_content_text_7" style="font-family:arial,helvetica,sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
                                                                                                <tbody>
                                                                                                    <tr>
                                                                                                        <td class="v-container-padding-padding" style="overflow-wrap:break-word;word-break:break-word;padding:10px 10px 10px 40px;font-family:arial,helvetica,sans-serif;" align="left">
                                                                                                            <div style="color: #2a2b57; line-height: 170%; text-align: left; word-wrap: break-word;">
                                                                                                                <p style="font-size: 14px; line-height: 170%;">
                                                                                                                    <span style="font-size: 18px; line-height: 30.6px; font-family: Rubik, sans-serif;">
                                                                                                                        <?php echo esc_textarea( $message_textarea ); ?>
                                                                                                                    </span>
                                                                                                                </p>
                                                                                                                <p style="font-size: 14px; line-height: 170%;"> </p>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                </tbody>
                                                                                            </table>
                                                                                        <!--[if (!mso)&(!IE)]><!-->
                                                                                        </div>
                                                                                        <!--<![endif]-->
                                                                                    </div>
                                                                                </div>
                                                                            <!--[if (mso)|(IE)]>
                                                                            </td>
                                                                            <![endif]-->
                                                                        <!--[if (mso)|(IE)]>
                                                                        </tr>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                        <![endif]-->
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <!-- Mail Server Info Content -->
                                            <div class="u-row-container" style="padding: 0px;background-color: #d6d7ef">
                                                <div class="u-row" style="Margin: 0 auto;min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: #f0f5fa;">
                                                    <div style="border-collapse: collapse;display: table;width: 100%;height: 100%;background-color: transparent;">
                                                        <!--[if (mso)|(IE)]>
                                                        <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                                            <tr>
                                                                <td style="padding: 0px;background-color: #d6d7ef" align="center">
                                                                    <table cellpadding="0" cellspacing="0" border="0" style="width:600px;">
                                                                        <tr style="background-color: #f0f5fa;">
                                                                        <![endif]-->
                                                                            <!--[if (mso)|(IE)]>
                                                                            <td align="center" width="600" style="width: 600px;padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;" valign="top">
                                                                            <![endif]-->
                                                                                <div class="u-col u-col-100" style="max-width: 320px;min-width: 600px;display: table-cell;vertical-align: top;">
                                                                                    <div style="height: 100%;width: 100% !important;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;">
                                                                                        <!--[if (!mso)&(!IE)]><!-->
                                                                                        <div style="height: 100%; padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;">
                                                                                        <!--<![endif]-->
                                                                                            
                                                                                            <!-- Site info content -->
                                                                                            <table id="u_content_heading_29" style="font-family:arial,helvetica,sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
                                                                                                <tbody>
                                                                                                    <tr>
                                                                                                        <td class="v-container-padding-padding" style="overflow-wrap:break-word;word-break:break-word;padding:5px 10px 5px 40px;font-family:arial,helvetica,sans-serif;" align="left">
                                                                                                            <h3 class="v-font-size" style="margin: 0px; color: #26264f; line-height: 140%; text-align: left; word-wrap: break-word; font-weight: normal; font-family: Montserrat,sans-serif; font-size: 26px;">
                                                                                                                <div>
                                                                                                                    <div>
                                                                                                                        <div>
                                                                                                                            <div>
                                                                                                                                <div>
                                                                                                                                    <div>
                                                                                                                                        <div>
                                                                                                                                            <div>
                                                                                                                                                <strong><?php echo esc_html_e( "Site Info", "qts" ); ?> :</strong>
                                                                                                                                            </div>
                                                                                                                                        </div>
                                                                                                                                    </div>
                                                                                                                                </div>
                                                                                                                            </div>
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                            </h3>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                </tbody>
                                                                                            </table>

                                                                                            <table id="u_content_text_4" style="font-family:arial,helvetica,sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
                                                                                                <tbody>
                                                                                                    <tr>
                                                                                                        <td class="v-container-padding-padding" style="overflow-wrap:break-word;word-break:break-word;padding:5px 40px;font-family:arial,helvetica,sans-serif;" align="left">
                                                                                                            <div style="color: #7a7a7e; line-height: 170%; text-align: left; word-wrap: break-word;">
                                                                                                                <p style="font-size: 14px; line-height: 170%;">
                                                                                                                    <?php
                                                                                                                    $site_info = qts_user_mail_server_information( "site_info" );

                                                                                                                    $titles = $site_info["title"];
                                                                                                                    $values = $site_info["value"];

                                                                                                                    foreach( $titles as $key => $title ) {
                                                                                                                        
                                                                                                                        echo esc_html( $title ) . " : " . esc_html( $values[$key] );
                                                                                                                        echo "<br>";
                                                                                                                    }
                                                                                                                    ?>
                                                                                                                </p>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                </tbody>
                                                                                            </table>

                                                                                            <!-- WP Configuration -->
                                                                                            <table id="u_content_heading_30" style="font-family:arial,helvetica,sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
                                                                                                <tbody>
                                                                                                    <tr>
                                                                                                        <td class="v-container-padding-padding" style="overflow-wrap:break-word;word-break:break-word;padding:5px 10px 5px 40px;font-family:arial,helvetica,sans-serif;" align="left">
                                                                                                            <h3 class="v-font-size" style="margin: 0px; color: #26264f; line-height: 140%; text-align: left; word-wrap: break-word; font-weight: normal; font-family: Montserrat,sans-serif; font-size: 26px;">
                                                                                                                <div>
                                                                                                                    <div>
                                                                                                                        <div>
                                                                                                                            <div>
                                                                                                                                <div>
                                                                                                                                    <div>
                                                                                                                                        <div>
                                                                                                                                            <div>
                                                                                                                                                <strong><?php esc_html_e( "WordPress Configuration", "qts" ); ?> :</strong>
                                                                                                                                            </div>
                                                                                                                                        </div>
                                                                                                                                    </div>
                                                                                                                                </div>
                                                                                                                            </div>
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                            </h3>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                </tbody>
                                                                                            </table>

                                                                                            <table id="u_content_text_13" style="font-family:arial,helvetica,sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
                                                                                                <tbody>
                                                                                                    <tr>
                                                                                                        <td class="v-container-padding-padding" style="overflow-wrap:break-word;word-break:break-word;padding:5px 40px;font-family:arial,helvetica,sans-serif;" align="left">
                                                                                                            <div style="color: #7a7a7e; line-height: 170%; text-align: left; word-wrap: break-word;">
                                                                                                                <p style="font-size: 14px; line-height: 170%;">
                                                                                                                    <?php
                                                                                                                    $site_info = qts_user_mail_server_information( "wp_configuration" );

                                                                                                                    $titles = $site_info["title"];
                                                                                                                    $values = $site_info["value"];

                                                                                                                    foreach( $titles as $key => $title ) {
                                                                                                                        
                                                                                                                        echo esc_html( $title ) . " : " . esc_html( $values[$key] );
                                                                                                                        echo "<br>";
                                                                                                                    }
                                                                                                                    ?>
                                                                                                                </p>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                </tbody>
                                                                                            </table>

                                                                                            <!-- Webserver Configuration -->
                                                                                            <table id="u_content_heading_31" style="font-family:arial,helvetica,sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
                                                                                                <tbody>
                                                                                                    <tr>
                                                                                                        <td class="v-container-padding-padding" style="overflow-wrap:break-word;word-break:break-word;padding:5px 10px 5px 40px;font-family:arial,helvetica,sans-serif;" align="left">
                                                                                                            <h3 class="v-font-size" style="margin: 0px; color: #26264f; line-height: 140%; text-align: left; word-wrap: break-word; font-weight: normal; font-family: Montserrat,sans-serif; font-size: 26px;">
                                                                                                                <div>
                                                                                                                    <div>
                                                                                                                        <div>
                                                                                                                            <div>
                                                                                                                                <div>
                                                                                                                                    <div>
                                                                                                                                        <div>
                                                                                                                                            <div>
                                                                                                                                                <div>
                                                                                                                                                    <strong><?php esc_html_e( "Webserver Configuration", "qts" ) ?> :</strong>
                                                                                                                                                </div>
                                                                                                                                            </div>
                                                                                                                                        </div>
                                                                                                                                    </div>
                                                                                                                                </div>
                                                                                                                            </div>
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                            </h3>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                </tbody>
                                                                                            </table>

                                                                                            <table id="u_content_text_14" style="font-family:arial,helvetica,sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
                                                                                                <tbody>
                                                                                                    <tr>
                                                                                                        <td class="v-container-padding-padding" style="overflow-wrap:break-word;word-break:break-word;padding:5px 40px;font-family:arial,helvetica,sans-serif;" align="left">
                                                                                                            <div style="color: #7a7a7e; line-height: 170%; text-align: left; word-wrap: break-word;">
                                                                                                                <p style="font-size: 14px; line-height: 170%;">
                                                                                                                    <?php
                                                                                                                    $site_info = qts_user_mail_server_information( "webserver_configuration" );

                                                                                                                    $titles = $site_info["title"];
                                                                                                                    $values = $site_info["value"];

                                                                                                                    foreach( $titles as $key => $title ) {
                                                                                                                        
                                                                                                                        echo esc_html( $title ) . " : " . esc_html( $values[$key] );
                                                                                                                        echo "<br>";
                                                                                                                    }
                                                                                                                    ?>
                                                                                                                </p>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                </tbody>
                                                                                            </table>
                                                                                                        
                                                                                            <!-- PHP Configuration Content -->
                                                                                            <table id="u_content_heading_32" style="font-family:arial,helvetica,sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
                                                                                                <tbody>
                                                                                                    <tr>
                                                                                                        <td class="v-container-padding-padding" style="overflow-wrap:break-word;word-break:break-word;padding:5px 10px 5px 40px;font-family:arial,helvetica,sans-serif;" align="left">
                                                                                                            <h3 class="v-font-size" style="margin: 0px; color: #26264f; line-height: 140%; text-align: left; word-wrap: break-word; font-weight: normal; font-family: Montserrat,sans-serif; font-size: 26px;">
                                                                                                                <div>
                                                                                                                    <div>
                                                                                                                        <div>
                                                                                                                            <div>
                                                                                                                                <div>
                                                                                                                                    <div>
                                                                                                                                        <div>
                                                                                                                                            <div>
                                                                                                                                                <div>
                                                                                                                                                    <div>
                                                                                                                                                        <strong><?php esc_html_e( "PHP Configuration", "qts" ); ?> :</strong>
                                                                                                                                                    </div>
                                                                                                                                                </div>
                                                                                                                                            </div>
                                                                                                                                        </div>
                                                                                                                                    </div>
                                                                                                                                </div>
                                                                                                                            </div>
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                            </h3>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                </tbody>
                                                                                            </table>

                                                                                            <table id="u_content_text_15" style="font-family:arial,helvetica,sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
                                                                                                <tbody>
                                                                                                    <tr>
                                                                                                        <td class="v-container-padding-padding" style="overflow-wrap:break-word;word-break:break-word;padding:5px 40px 20px;font-family:arial,helvetica,sans-serif;" align="left">
                                                                                                            <div style="color: #7a7a7e; line-height: 170%; text-align: left; word-wrap: break-word;">
                                                                                                                <p style="font-size: 14px; line-height: 170%;">
                                                                                                                    <?php
                                                                                                                    $site_info = qts_user_mail_server_information( "php_configuration" );

                                                                                                                    $titles = $site_info["title"];
                                                                                                                    $values = $site_info["value"];

                                                                                                                    foreach( $titles as $key => $title ) {
                                                                                                                        
                                                                                                                        echo esc_html( $title ) . " : " . esc_html( $values[$key] );
                                                                                                                        echo "<br>";
                                                                                                                    }
                                                                                                                    ?>
                                                                                                                </p>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                </tbody>
                                                                                            </table>
                                                                                        <!--[if (!mso)&(!IE)]><!-->
                                                                                        </div>
                                                                                        <!--<![endif]-->
                                                                                    </div>
                                                                                </div>
                                                                            <!--[if (mso)|(IE)]>
                                                                            </td>
                                                                            <![endif]-->
                                                                        <!--[if (mso)|(IE)]>
                                                                        </tr>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                        <![endif]-->
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <!-- Footer Content -->
                                            <div class="u-row-container" style="padding: 0px;background-color: #26264f">
                                                <div class="u-row" style="Margin: 0 auto;min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: transparent;">
                                                    <div style="border-collapse: collapse;display: table;width: 100%;height: 100%;background-color: transparent;">
                                                        <!--[if (mso)|(IE)]>
                                                        <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                                            <tr>
                                                                <td style="padding: 0px;background-color: #26264f;" align="center">
                                                                    <table cellpadding="0" cellspacing="0" border="0" style="width:600px;">
                                                                        <tr style="background-color: transparent;">
                                                                        <![endif]-->
                                                                            <!--[if (mso)|(IE)]>
                                                                            <td align="center" width="600" style="width: 600px;padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;" valign="top">
                                                                            <![endif]-->
                                                                                <div class="u-col u-col-100" style="max-width: 320px;min-width: 600px;display: table-cell;vertical-align: top;">
                                                                                    <div style="height: 100%;width: 100% !important;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;">
                                                                                        <!--[if (!mso)&(!IE)]><!-->
                                                                                        <div style="height: 100%; padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;">
                                                                                        <!--<![endif]-->
                                                                                            <table id="u_content_heading_21" style="font-family:arial,helvetica,sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
                                                                                                <tbody>
                                                                                                    <tr>
                                                                                                        <td class="v-container-padding-padding" style="overflow-wrap:break-word;word-break:break-word;padding:50px 10px 20px;font-family:arial,helvetica,sans-serif;" align="left">
                                                                                                            <h1 class="v-font-size" style="margin: 0px; color: #ffffff; line-height: 140%; text-align: center; word-wrap: break-word; font-weight: normal; font-family: Montserrat,sans-serif; font-size: 31px;">
                                                                                                                <?php esc_html_e( "Thank You for being with Us!", "qts" ); ?>
                                                                                                            </h1>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                </tbody>
                                                                                            </table>

                                                                                            <!-- Social Links Content -->
                                                                                            <table style="font-family:arial,helvetica,sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
                                                                                                <tbody>
                                                                                                    <tr>
                                                                                                        <td class="v-container-padding-padding" style="overflow-wrap:break-word;word-break:break-word;padding:10px;font-family:arial,helvetica,sans-serif;" align="left">
                                                                                                            <div align="center">
                                                                                                                <div style="display: table; max-width:234px;">
                                                                                                                    <!--[if (mso)|(IE)]>
                                                                                                                    <table width="234" cellpadding="0" cellspacing="0" border="0">
                                                                                                                        <tr>
                                                                                                                            <td style="border-collapse:collapse;" align="center">
                                                                                                                                <table width="100%" cellpadding="0" cellspacing="0" border="0" style="border-collapse:collapse; mso-table-lspace: 0pt;mso-table-rspace: 0pt; width:234px;">
                                                                                                                                    <tr>
                                                                                                                                    <![endif]-->
                                                                                                                                        <!--[if (mso)|(IE)]>
                                                                                                                                        <td width="32" style="width:32px; padding-right: 15px;" valign="top">
                                                                                                                                        <![endif]-->
                                                                                                                                            <table align="left" border="0" cellspacing="0" cellpadding="0" width="32" height="32" style="width: 32px !important;height: 32px !important;display: inline-block;border-collapse: collapse;table-layout: fixed;border-spacing: 0;mso-table-lspace: 0pt;mso-table-rspace: 0pt;vertical-align: top;margin-right: 15px">
                                                                                                                                                <tbody>
                                                                                                                                                    <tr style="vertical-align: top">
                                                                                                                                                        <td align="left" valign="middle" style="word-break: break-word;border-collapse: collapse !important;vertical-align: top">
                                                                                                                                                            <a href="<?php echo esc_url( "https://github.com/niyankhadka/" ); ?>" title="GitHub" target="_blank">
                                                                                                                                                                <img src="<?php echo esc_url( plugin_dir_url( __FILE__ ) . "images/image-github.png" ); ?>" alt="GitHub" title="GitHub" width="32" style="outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;clear: both;display: block !important;border: none;height: auto;float: none;max-width: 32px !important">
                                                                                                                                                            </a>
                                                                                                                                                        </td>
                                                                                                                                                    </tr>
                                                                                                                                                </tbody>
                                                                                                                                            </table>
                                                                                                                                        <!--[if (mso)|(IE)]>
                                                                                                                                        </td>
                                                                                                                                        <![endif]-->
                                                                                                
                                                                                                                                        <!--[if (mso)|(IE)]>
                                                                                                                                        <td width="32" style="width:32px; padding-right: 15px;" valign="top">
                                                                                                                                        <![endif]-->
                                                                                                                                            <table align="left" border="0" cellspacing="0" cellpadding="0" width="32" height="32" style="width: 32px !important;height: 32px !important;display: inline-block;border-collapse: collapse;table-layout: fixed;border-spacing: 0;mso-table-lspace: 0pt;mso-table-rspace: 0pt;vertical-align: top;margin-right: 15px">
                                                                                                                                                <tbody>
                                                                                                                                                    <tr style="vertical-align: top">
                                                                                                                                                        <td align="left" valign="middle" style="word-break: break-word;border-collapse: collapse !important;vertical-align: top">
                                                                                                                                                            <a href="<?php echo esc_url( "https://www.linkedin.com/in/niyankhadka/" ); ?>" title="LinkedIn" target="_blank">
                                                                                                                                                                <img src="<?php echo esc_url( plugin_dir_url( __FILE__ ) . "images/image-linkedin.png" ); ?>" alt="LinkedIn" title="LinkedIn" width="32" style="outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;clear: both;display: block !important;border: none;height: auto;float: none;max-width: 32px !important">
                                                                                                                                                            </a>
                                                                                                                                                        </td>
                                                                                                                                                    </tr>
                                                                                                                                                </tbody>
                                                                                                                                            </table>
                                                                                                                                        <!--[if (mso)|(IE)]>
                                                                                                                                        </td>
                                                                                                                                        <![endif]-->
                                                                                                
                                                                                                                                        <!--[if (mso)|(IE)]>
                                                                                                                                        <td width="32" style="width:32px; padding-right: 15px;" valign="top">
                                                                                                                                        <![endif]-->
                                                                                                                                            <table align="left" border="0" cellspacing="0" cellpadding="0" width="32" height="32" style="width: 32px !important;height: 32px !important;display: inline-block;border-collapse: collapse;table-layout: fixed;border-spacing: 0;mso-table-lspace: 0pt;mso-table-rspace: 0pt;vertical-align: top;margin-right: 15px">
                                                                                                                                                <tbody>
                                                                                                                                                    <tr style="vertical-align: top">
                                                                                                                                                        <td align="left" valign="middle" style="word-break: break-word;border-collapse: collapse !important;vertical-align: top">
                                                                                                                                                            <a href="<?php echo esc_url( "https://www.instagram.com/niyankhadka/" ); ?>" title="Instagram" target="_blank">
                                                                                                                                                                <img src="<?php echo esc_url( plugin_dir_url( __FILE__ ) . "images/image-instagram.png" ); ?>" alt="Instagram" title="Instagram" width="32" style="outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;clear: both;display: block !important;border: none;height: auto;float: none;max-width: 32px !important">
                                                                                                                                                            </a>
                                                                                                                                                        </td>
                                                                                                                                                    </tr>
                                                                                                                                                </tbody>
                                                                                                                                            </table>
                                                                                                                                        <!--[if (mso)|(IE)]>
                                                                                                                                        </td>
                                                                                                                                        <![endif]-->
                                                                                                    
                                                                                                                                    <!--[if (mso)|(IE)]>
                                                                                                                                    </tr>
                                                                                                                                </table>
                                                                                                                            </td>
                                                                                                                        </tr>
                                                                                                                    </table>
                                                                                                                    <![endif]-->
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                </tbody>
                                                                                            </table>

                                                                                            <!-- message from author -->
                                                                                            <table style="font-family:arial,helvetica,sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
                                                                                                <tbody>
                                                                                                    <tr>
                                                                                                        <td class="v-container-padding-padding" style="overflow-wrap:break-word;word-break:break-word;padding:20px 10px 50px;font-family:arial,helvetica,sans-serif;" align="left">
                                                                                                            <div style="color: #d4d4d4; line-height: 180%; text-align: center; word-wrap: break-word;">
                                                                                                                <p style="font-size: 14px; line-height: 180%;">
                                                                                                                    <span style="font-family: Rubik, sans-serif; font-size: 14px; line-height: 25.2px;">
                                                                                                                        <?php esc_html_e( "If you have any questions, feel free message at niyankhadka.nk@gmail.com.", "qts" ); ?> 
                                                                                                                    </span>
                                                                                                                </p>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                </tbody>
                                                                                            </table>
                                                                                        <!--[if (!mso)&(!IE)]><!-->
                                                                                        </div>
                                                                                        <!--<![endif]-->
                                                                                    </div>
                                                                                </div>
                                                                            <!--[if (mso)|(IE)]>
                                                                            </td><![endif]-->
                                                                        <!--[if (mso)|(IE)]>
                                                                        </tr>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                        <![endif]-->
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <!-- Footer Copyright Content -->
                                            <div class="u-row-container" style="padding: 0px;background-color: transparent">
                                                <div class="u-row" style="Margin: 0 auto;min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: transparent;">
                                                    <div style="border-collapse: collapse;display: table;width: 100%;height: 100%;background-color: transparent;">
                                                        <!--[if (mso)|(IE)]>
                                                        <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                                            <tr>
                                                                <td style="padding: 0px;background-color: transparent;" align="center">
                                                                    <table cellpadding="0" cellspacing="0" border="0" style="width:600px;">
                                                                        <tr style="background-color: transparent;">
                                                                        <![endif]-->
                                                    
                                                                            <!--[if (mso)|(IE)]>
                                                                            <td align="center" width="600" style="width: 600px;padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;" valign="top">
                                                                            <![endif]-->
                                                                                <div class="u-col u-col-100" style="max-width: 320px;min-width: 600px;display: table-cell;vertical-align: top;">
                                                                                    <div style="height: 100%;width: 100% !important;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;">
                                                                                        <!--[if (!mso)&(!IE)]><!-->
                                                                                        <div style="height: 100%; padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;">
                                                                                        <!--<![endif]-->
                                                                                            <table style="font-family:arial,helvetica,sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
                                                                                                <tbody>
                                                                                                    <tr>
                                                                                                        <td class="v-container-padding-padding" style="overflow-wrap:break-word;word-break:break-word;padding:20px 10px;font-family:arial,helvetica,sans-serif;" align="left">
                                                                                                            <div style="color: #95a5a6; line-height: 140%; text-align: center; word-wrap: break-word;">
                                                                                                                <p style="font-size: 14px; line-height: 140%;">
                                                                                                                    <span style="font-family: Rubik, sans-serif; font-size: 14px; line-height: 19.6px;">
                                                                                                                        &copy; <?php echo date('Y') ?> <?php echo QTS_PLUGIN_NAME; ?>. 
                                                                                                                        <?php esc_html_e( "All Rights Reserved.", "qts" ); ?> 
                                                                                                                    </span>
                                                                                                                </p>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                </tbody>
                                                                                            </table>
                                                                                        <!--[if (!mso)&(!IE)]><!-->
                                                                                        </div>
                                                                                        <!--<![endif]-->
                                                                                    </div>
                                                                                </div>
                                                                            <!--[if (mso)|(IE)]>
                                                                            </td>
                                                                            <![endif]-->
                                                                        <!--[if (mso)|(IE)]>
                                                                        </tr>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                        <![endif]-->
                                                    </div>
                                                </div>
                                            </div>
                                        <!--[if (mso)|(IE)]>
                                        </td>
                                    </tr>
                                </table>
                                <![endif]-->
                            </td>
                        </tr>
                    </tbody>
                </table>
            <!--[if mso]>
            </div>
            <![endif]-->
        <!--[if IE]>
        </div>
        <![endif]-->
        </body>

        <?php
        return ob_get_clean();
        
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
            
            $to      =  qts_user_mail_get_to();

            $subject =  esc_html__( 'QTS Mail : ', 'qts' ) . $support_title;

            $support_type = qts_user_mail_get_templates_support_types( $support_type_options );

            $message =  qts_user_mail_get_message_template( $personal_fname, $personal_lname, $personal_email, $support_title, $support_type, $message_textarea );

            $headers = qts_user_mail_get_headers( $personal_fname, $personal_lname, $personal_email );

            $send_mail_status = wp_mail($to, $subject, $message, $headers);

            if( $send_mail_status == true ) {

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
	$admin_pages = [ 'index.php', 'edit.php', 'plugins.php', 'email-log' ];
    if ( in_array( $pagenow, $admin_pages ) ) {
        ?>
        <div class="notice notice-warning is-dismissible">
            <p>User mode - Mail features original</p>
        </div>
        <?php

        ?>
                                                                                            
        <?php

    }
}
add_action( 'admin_notices', 'independence_notice_mail' );
