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
 * QTS user mail get message template function
 *
 * @since 1.0.0
 */
if ( !function_exists( 'qts_user_mail_get_message_template' ) ) :

    function qts_user_mail_get_message_template() {

        $message = '<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional //EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
        <html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">
        <head>
        <!--[if gte mso 9]>
        <xml>
          <o:OfficeDocumentSettings>
            <o:AllowPNG/>
            <o:PixelsPerInch>96</o:PixelsPerInch>
          </o:OfficeDocumentSettings>
        </xml>
        <![endif]-->
          <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
          <meta name="viewport" content="width=device-width, initial-scale=1.0">
          <meta name="x-apple-disable-message-reformatting">
          <!--[if !mso]><!--><meta http-equiv="X-UA-Compatible" content="IE=edge"><!--<![endif]-->
          <title></title>
          
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
        body {
          margin: 0;
          padding: 0;
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
        
        table, td { color: #000000; } #u_body a { color: #0000ee; text-decoration: underline; } @media (max-width: 480px) { #u_content_heading_23 .v-font-size { font-size: 33px !important; } #u_content_heading_17 .v-container-padding-padding { padding: 30px 10px 5px 20px !important; } #u_content_text_5 .v-container-padding-padding { padding: 10px 10px 10px 20px !important; } #u_content_text_6 .v-container-padding-padding { padding: 10px 10px 15px 20px !important; } #u_content_heading_25 .v-container-padding-padding { padding: 30px 10px 5px 20px !important; } #u_content_text_7 .v-container-padding-padding { padding: 10px 10px 30px 20px !important; } #u_content_heading_26 .v-container-padding-padding { padding: 30px 10px 5px 20px !important; } #u_content_text_4 .v-container-padding-padding { padding: 10px 10px 10px 20px !important; } #u_content_heading_30 .v-container-padding-padding { padding: 30px 10px 5px 20px !important; } #u_content_text_13 .v-container-padding-padding { padding: 10px 10px 10px 20px !important; } #u_content_heading_31 .v-container-padding-padding { padding: 30px 10px 5px 20px !important; } #u_content_text_14 .v-container-padding-padding { padding: 10px 10px 10px 20px !important; } #u_content_heading_32 .v-container-padding-padding { padding: 30px 10px 5px 20px !important; } #u_content_text_15 .v-container-padding-padding { padding: 10px 10px 10px 20px !important; } #u_content_button_1 .v-size-width { width: auto !important; } #u_content_heading_21 .v-container-padding-padding { padding: 50px 10px 30px !important; } }
            </style>
          
          
        
        <!--[if !mso]><!--><link href="https://fonts.googleapis.com/css?family=Montserrat:400,700&display=swap" rel="stylesheet" type="text/css"><link href="https://fonts.googleapis.com/css?family=Rubik:400,700&display=swap" rel="stylesheet" type="text/css"><!--<![endif]-->
        
        </head>
        
        <body class="clean-body u_body" style="margin: 0;padding: 0;-webkit-text-size-adjust: 100%;background-color: #ffffff;color: #000000">
          <!--[if IE]><div class="ie-container"><![endif]-->
          <!--[if mso]><div class="mso-container"><![endif]-->
          <table id="u_body" style="border-collapse: collapse;table-layout: fixed;border-spacing: 0;mso-table-lspace: 0pt;mso-table-rspace: 0pt;vertical-align: top;min-width: 320px;Margin: 0 auto;background-color: #ffffff;width:100%" cellpadding="0" cellspacing="0">
          <tbody>
          <tr style="vertical-align: top">
            <td style="word-break: break-word;border-collapse: collapse !important;vertical-align: top">
            <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td align="center" style="background-color: #ffffff;"><![endif]-->
            
        
        <div class="u-row-container" style="padding: 0px;background-color: #26264f">
          <div class="u-row" style="Margin: 0 auto;min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: transparent;">
            <div style="border-collapse: collapse;display: table;width: 100%;height: 100%;background-color: transparent;">
              <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding: 0px;background-color: #26264f;" align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:600px;"><tr style="background-color: transparent;"><![endif]-->
              
        <!--[if (mso)|(IE)]><td align="center" width="600" style="width: 600px;padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;" valign="top"><![endif]-->
        <div class="u-col u-col-100" style="max-width: 320px;min-width: 600px;display: table-cell;vertical-align: top;">
          <div style="height: 100%;width: 100% !important;">
          <!--[if (!mso)&(!IE)]><!--><div style="height: 100%; padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;"><!--<![endif]-->
          
        <table style="font-family:arial,helvetica,sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
          <tbody>
            <tr>
              <td class="v-container-padding-padding" style="overflow-wrap:break-word;word-break:break-word;padding:20px 10px;font-family:arial,helvetica,sans-serif;" align="left">
                
          <div style="line-height: 140%; text-align: left; word-wrap: break-word;">
            <p style="font-size: 14px; line-height: 140%; text-align: center;"><span style="font-size: 28px; line-height: 39.2px;"><strong><span style="color: #edf0f0; line-height: 39.2px; font-size: 28px;">QTS (Quick Theme Support)</span></strong></span></p>
          </div>
        
              </td>
            </tr>
          </tbody>
        </table>
        
          <!--[if (!mso)&(!IE)]><!--></div><!--<![endif]-->
          </div>
        </div>
        <!--[if (mso)|(IE)]></td><![endif]-->
              <!--[if (mso)|(IE)]></tr></table></td></tr></table><![endif]-->
            </div>
          </div>
        </div>
        
        
        
        <div class="u-row-container" style="padding: 0px;background-image: url("images/image-7.jpeg");background-repeat: no-repeat;background-position: center top;background-color: transparent">
          <div class="u-row" style="Margin: 0 auto;min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: #ffffff;">
            <div style="border-collapse: collapse;display: table;width: 100%;height: 100%;background-color: transparent;">
              <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding: 0px;background-image: url("images/image-7.jpeg");background-repeat: no-repeat;background-position: center top;background-color: transparent;" align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:600px;"><tr style="background-color: #ffffff;"><![endif]-->
              
        <!--[if (mso)|(IE)]><td align="center" width="600" style="width: 600px;padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;" valign="top"><![endif]-->
        <div class="u-col u-col-100" style="max-width: 320px;min-width: 600px;display: table-cell;vertical-align: top;">
          <div style="height: 100%;width: 100% !important;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;">
          <!--[if (!mso)&(!IE)]><!--><div style="height: 100%; padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;"><!--<![endif]-->
          
        <table id="u_content_heading_23" style="font-family:arial,helvetica,sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
          <tbody>
            <tr>
              <td class="v-container-padding-padding" style="overflow-wrap:break-word;word-break:break-word;padding:30px 10px 10px;font-family:arial,helvetica,sans-serif;" align="left">
                
          <h1 class="v-font-size" style="margin: 0px; color: #3f4481; line-height: 140%; text-align: center; word-wrap: break-word; font-weight: normal; font-family: "Montserrat",sans-serif; font-size: 47px;">
            <div><strong>Support Notice</strong></div>
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
          <tr>
            <td style="padding-right: 0px;padding-left: 0px;" align="center">
              
              <img align="center" border="0" src="images/image-6.jpeg" alt="Support Notice" title="Support Notice" style="outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;clear: both;display: inline-block !important;border: none;height: auto;float: none;width: 100%;max-width: 580px;" width="580"/>
              
            </td>
          </tr>
        </table>
        
              </td>
            </tr>
          </tbody>
        </table>
        
          <!--[if (!mso)&(!IE)]><!--></div><!--<![endif]-->
          </div>
        </div>
        <!--[if (mso)|(IE)]></td><![endif]-->
              <!--[if (mso)|(IE)]></tr></table></td></tr></table><![endif]-->
            </div>
          </div>
        </div>
        
        
        
        <div class="u-row-container" style="padding: 0px;background-image: url("images/image-8.jpeg");background-repeat: no-repeat;background-position: center top;background-color: transparent">
          <div class="u-row" style="Margin: 0 auto;min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: #f0f5fa;">
            <div style="border-collapse: collapse;display: table;width: 100%;height: 100%;background-color: transparent;">
              <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding: 0px;background-image: url("images/image-8.jpeg");background-repeat: no-repeat;background-position: center top;background-color: transparent;" align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:600px;"><tr style="background-color: #f0f5fa;"><![endif]-->
              
        <!--[if (mso)|(IE)]><td align="center" width="600" style="width: 600px;padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;" valign="top"><![endif]-->
        <div class="u-col u-col-100" style="max-width: 320px;min-width: 600px;display: table-cell;vertical-align: top;">
          <div style="height: 100%;width: 100% !important;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;">
          <!--[if (!mso)&(!IE)]><!--><div style="height: 100%; padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;"><!--<![endif]-->
          
        <table style="font-family:arial,helvetica,sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
          <tbody>
            <tr>
              <td class="v-container-padding-padding" style="overflow-wrap:break-word;word-break:break-word;padding:30px 10px 10px 40px;font-family:arial,helvetica,sans-serif;" align="left">
                
          <div style="line-height: 140%; text-align: left; word-wrap: break-word;">
            <p style="font-size: 14px; line-height: 140%; text-align: left;"><span style="font-family: Rubik, sans-serif; font-size: 14px; line-height: 19.6px;">Hello Dear <strong>General support</strong> team, </span></p>
        <p style="font-size: 14px; line-height: 140%; text-align: left;"> </p>
        <p style="font-size: 14px; line-height: 140%; text-align: left;"><span style="font-family: Rubik, sans-serif; font-size: 14px; line-height: 19.6px;">This email is sent from the plugin <strong>QTS (Quick Theme Support)</strong> and to inform you the following information as per the user.</span></p>
          </div>
        
              </td>
            </tr>
          </tbody>
        </table>
        
        <table id="u_content_heading_17" style="font-family:arial,helvetica,sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
          <tbody>
            <tr>
              <td class="v-container-padding-padding" style="overflow-wrap:break-word;word-break:break-word;padding:20px 10px 5px 40px;font-family:arial,helvetica,sans-serif;" align="left">
                
          <h3 class="v-font-size" style="margin: 0px; color: #26264f; line-height: 140%; text-align: left; word-wrap: break-word; font-weight: normal; font-family: "Montserrat",sans-serif; font-size: 26px;">
            <div>
        <div>
        <div><strong>Support Title:</strong></div>
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
            <p style="font-size: 14px; line-height: 140%;"><span style="font-size: 18px; line-height: 25.2px; font-family: Rubik, sans-serif;">Regarding theme plugins and something else i want to talk about it later</span></p>
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
            <p style="font-size: 14px; line-height: 180%;"><span style="font-size: 18px; line-height: 32.4px; font-family: Rubik, sans-serif;">Full Name : <strong>Wilbert Keffort </strong></span></p>
        <p style="font-size: 14px; line-height: 180%;"><span style="font-size: 18px; line-height: 32.4px; font-family: Rubik, sans-serif;">Email : <strong>wilbert@zmail.com </strong></span></p>
        <p style="font-size: 14px; line-height: 180%;"><span style="font-size: 18px; line-height: 32.4px; font-family: Rubik, sans-serif;">Support Type :<strong> General Support</strong></span></p>
          </div>
        
              </td>
            </tr>
          </tbody>
        </table>
        
        <table id="u_content_heading_25" style="font-family:arial,helvetica,sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
          <tbody>
            <tr>
              <td class="v-container-padding-padding" style="overflow-wrap:break-word;word-break:break-word;padding:20px 10px 5px 40px;font-family:arial,helvetica,sans-serif;" align="left">
                
          <h3 class="v-font-size" style="margin: 0px; color: #26264f; line-height: 140%; text-align: left; word-wrap: break-word; font-weight: normal; font-family: "Montserrat",sans-serif; font-size: 26px;">
            <div>
        <div>
        <div>
        <div><strong>Message:</strong></div>
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
            <p style="font-size: 14px; line-height: 170%;"><span style="font-size: 18px; line-height: 30.6px; font-family: Rubik, sans-serif;">Keep in mind that, because we are using hooks, we can also tie existing WordPress functions to our AJAX calls. If you already have an awesome voting function, you could just tie it in after the fact by attaching it to the action. This, and the ease with which we can differentiate between logged-in states, make WordPress’ AJAX-handling system very powerful indeed.</span></p>
        <p style="font-size: 14px; line-height: 170%;"> </p>
          </div>
        
              </td>
            </tr>
          </tbody>
        </table>
        
        <table id="u_content_heading_26" style="font-family:arial,helvetica,sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
          <tbody>
            <tr>
              <td class="v-container-padding-padding" style="overflow-wrap:break-word;word-break:break-word;padding:5px 10px 5px 40px;font-family:arial,helvetica,sans-serif;" align="left">
                
          <h3 class="v-font-size" style="margin: 0px; color: #26264f; line-height: 140%; text-align: left; word-wrap: break-word; font-weight: normal; font-family: "Montserrat",sans-serif; font-size: 26px;">
            <div>
        <div>
        <div>
        <div>
        <div>
        <div>
        <div><strong>Site Info:</strong></div>
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
        
          <!--[if (!mso)&(!IE)]><!--></div><!--<![endif]-->
          </div>
        </div>
        <!--[if (mso)|(IE)]></td><![endif]-->
              <!--[if (mso)|(IE)]></tr></table></td></tr></table><![endif]-->
            </div>
          </div>
        </div>
        
        
        
        <div class="u-row-container" style="padding: 0px;background-image: url("images/image-8.jpeg");background-repeat: no-repeat;background-position: center top;background-color: transparent">
          <div class="u-row" style="Margin: 0 auto;min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: #f0f5fa;">
            <div style="border-collapse: collapse;display: table;width: 100%;height: 100%;background-color: transparent;">
              <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding: 0px;background-image: url("images/image-8.jpeg");background-repeat: no-repeat;background-position: center top;background-color: transparent;" align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:600px;"><tr style="background-color: #f0f5fa;"><![endif]-->
              
        <!--[if (mso)|(IE)]><td align="center" width="600" style="width: 600px;padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;" valign="top"><![endif]-->
        <div class="u-col u-col-100" style="max-width: 320px;min-width: 600px;display: table-cell;vertical-align: top;">
          <div style="height: 100%;width: 100% !important;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;">
          <!--[if (!mso)&(!IE)]><!--><div style="height: 100%; padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;"><!--<![endif]-->
          
        <table id="u_content_text_4" style="font-family:arial,helvetica,sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
          <tbody>
            <tr>
              <td class="v-container-padding-padding" style="overflow-wrap:break-word;word-break:break-word;padding:5px 40px;font-family:arial,helvetica,sans-serif;" align="left">
                
          <div style="color: #7a7a7e; line-height: 170%; text-align: left; word-wrap: break-word;">
            <p style="font-size: 14px; line-height: 170%;">Site URL:                 https://test.etailnepal.com<br />Home URL:                 https://test.etailnepal.com<br />Multisite:                    No<br />Active Theme:             Twenty Twenty-Two 1.2</p>
          </div>
        
              </td>
            </tr>
          </tbody>
        </table>
        
        <table id="u_content_heading_30" style="font-family:arial,helvetica,sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
          <tbody>
            <tr>
              <td class="v-container-padding-padding" style="overflow-wrap:break-word;word-break:break-word;padding:5px 10px 5px 40px;font-family:arial,helvetica,sans-serif;" align="left">
                
          <h3 class="v-font-size" style="margin: 0px; color: #26264f; line-height: 140%; text-align: left; word-wrap: break-word; font-weight: normal; font-family: "Montserrat",sans-serif; font-size: 26px;">
            <div>
        <div>
        <div>
        <div>
        <div>
        <div>
        <div>
        <div><strong>WordPress Configuration:</strong></div>
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
            <p style="font-size: 14px; line-height: 170%;">Version:                  6.0.2<br />Language:                 en_US<br />Permalink Structure:      /%year%/%monthnum%/%day%/%postname%/<br />WP Table Prefix:          wpya_<br />GMT Offset:               5.75<br />Memory Limit:             40M<br />Memory Max Limit:         512M<br />ABSPATH:                  /home/etailnep/test.etailnepal.com/<br />WP_DEBUG:                 Disabled<br />WP_DEBUG_LOG:              Disabled<br />SAVEQUERIES:              Not set<br />WP_SCRIPT_DEBUG:          Not set<br />DISABLE_WP_CRON:          Not set<br />WP_CRON_LOCK_TIMEOUT:     60<br />EMPTY_TRASH_DAYS:         30</p>
          </div>
        
              </td>
            </tr>
          </tbody>
        </table>
        
        <table id="u_content_heading_31" style="font-family:arial,helvetica,sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
          <tbody>
            <tr>
              <td class="v-container-padding-padding" style="overflow-wrap:break-word;word-break:break-word;padding:5px 10px 5px 40px;font-family:arial,helvetica,sans-serif;" align="left">
                
          <h3 class="v-font-size" style="margin: 0px; color: #26264f; line-height: 140%; text-align: left; word-wrap: break-word; font-weight: normal; font-family: "Montserrat",sans-serif; font-size: 26px;">
            <div>
        <div>
        <div>
        <div>
        <div>
        <div>
        <div>
        <div>
        <div><strong>Webserver Configuration:</strong></div>
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
            <p style="font-size: 14px; line-height: 170%;">PHP Version:              8.0.17<br />MySQL Version:            10.5.15<br />Web Server Info:          LiteSpeed<br />Platform:                 Linux</p>
          </div>
        
              </td>
            </tr>
          </tbody>
        </table>
        
        <table id="u_content_heading_32" style="font-family:arial,helvetica,sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
          <tbody>
            <tr>
              <td class="v-container-padding-padding" style="overflow-wrap:break-word;word-break:break-word;padding:5px 10px 5px 40px;font-family:arial,helvetica,sans-serif;" align="left">
                
          <h3 class="v-font-size" style="margin: 0px; color: #26264f; line-height: 140%; text-align: left; word-wrap: break-word; font-weight: normal; font-family: "Montserrat",sans-serif; font-size: 26px;">
            <div>
        <div>
        <div>
        <div>
        <div>
        <div>
        <div>
        <div>
        <div>
        <div><strong>PHP Configuration:</strong></div>
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
            <p style="font-size: 14px; line-height: 170%;">PHP Memory Limit:         512M<br />PHP Safe Mode:            No<br />PHP Upload Max Size:      512M<br />PHP Post Max Size:        512M<br />PHP Upload Max Filesize:  512M<br />PHP Time Limit:           60<br />PHP Max Input Vars:       10000<br />Display Errors:           N/A<br />PHP Arg Separator:        &amp;<br />PHP Allow URL File Open:  Yes</p>
          </div>
        
              </td>
            </tr>
          </tbody>
        </table>
        
        <table id="u_content_button_1" style="font-family:arial,helvetica,sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
          <tbody>
            <tr>
              <td class="v-container-padding-padding" style="overflow-wrap:break-word;word-break:break-word;padding:10px 10px 70px;font-family:arial,helvetica,sans-serif;" align="left">
                
          <!--[if mso]><style>.v-button {background: transparent !important;}</style><![endif]-->
        <div align="center">
          <!--[if mso]><v:roundrect xmlns:v="urn:schemas-microsoft-com:vml" xmlns:w="urn:schemas-microsoft-com:office:word" href="https://unlayer.com" style="height:64px; v-text-anchor:middle; width:435px;" arcsize="1.5%"  stroke="f" fillcolor="#6a71a8"><w:anchorlock/><center style="color:#FFFFFF;font-family:arial,helvetica,sans-serif;"><![endif]-->  
            <a href="https://unlayer.com" target="_blank" class="v-button v-size-width" style="box-sizing: border-box;display: inline-block;font-family:arial,helvetica,sans-serif;text-decoration: none;-webkit-text-size-adjust: none;text-align: center;color: #FFFFFF; background-color: #6a71a8; border-radius: 1px;-webkit-border-radius: 1px; -moz-border-radius: 1px; width:75%; max-width:100%; overflow-wrap: break-word; word-break: break-word; word-wrap:break-word; mso-border-alt: none;">
              <span style="display:block;padding:21px 20px;line-height:120%;"><span style="font-size: 18px; line-height: 21.6px; font-family: Rubik, sans-serif;"><span style="line-height: 21.6px; font-size: 18px;">Click Below to Pay &amp; Accept&nbsp;</span></span></span>
            </a>
          <!--[if mso]></center></v:roundrect><![endif]-->
        </div>
        
              </td>
            </tr>
          </tbody>
        </table>
        
          <!--[if (!mso)&(!IE)]><!--></div><!--<![endif]-->
          </div>
        </div>
        <!--[if (mso)|(IE)]></td><![endif]-->
              <!--[if (mso)|(IE)]></tr></table></td></tr></table><![endif]-->
            </div>
          </div>
        </div>
        
        
        
        <div class="u-row-container" style="padding: 0px;background-color: #26264f">
          <div class="u-row" style="Margin: 0 auto;min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: transparent;">
            <div style="border-collapse: collapse;display: table;width: 100%;height: 100%;background-color: transparent;">
              <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding: 0px;background-color: #26264f;" align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:600px;"><tr style="background-color: transparent;"><![endif]-->
              
        <!--[if (mso)|(IE)]><td align="center" width="600" style="width: 600px;padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;" valign="top"><![endif]-->
        <div class="u-col u-col-100" style="max-width: 320px;min-width: 600px;display: table-cell;vertical-align: top;">
          <div style="height: 100%;width: 100% !important;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;">
          <!--[if (!mso)&(!IE)]><!--><div style="height: 100%; padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;"><!--<![endif]-->
          
        <table id="u_content_heading_21" style="font-family:arial,helvetica,sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
          <tbody>
            <tr>
              <td class="v-container-padding-padding" style="overflow-wrap:break-word;word-break:break-word;padding:50px 10px 20px;font-family:arial,helvetica,sans-serif;" align="left">
                
          <h1 class="v-font-size" style="margin: 0px; color: #ffffff; line-height: 140%; text-align: center; word-wrap: break-word; font-weight: normal; font-family: "Montserrat",sans-serif; font-size: 31px;">
            Thank You for being with Us!
          </h1>
        
              </td>
            </tr>
          </tbody>
        </table>
        
        <table style="font-family:arial,helvetica,sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
          <tbody>
            <tr>
              <td class="v-container-padding-padding" style="overflow-wrap:break-word;word-break:break-word;padding:10px;font-family:arial,helvetica,sans-serif;" align="left">
                
        <div align="center">
          <div style="display: table; max-width:234px;">
          <!--[if (mso)|(IE)]><table width="234" cellpadding="0" cellspacing="0" border="0"><tr><td style="border-collapse:collapse;" align="center"><table width="100%" cellpadding="0" cellspacing="0" border="0" style="border-collapse:collapse; mso-table-lspace: 0pt;mso-table-rspace: 0pt; width:234px;"><tr><![endif]-->
          
            
            <!--[if (mso)|(IE)]><td width="32" style="width:32px; padding-right: 15px;" valign="top"><![endif]-->
            <table align="left" border="0" cellspacing="0" cellpadding="0" width="32" height="32" style="width: 32px !important;height: 32px !important;display: inline-block;border-collapse: collapse;table-layout: fixed;border-spacing: 0;mso-table-lspace: 0pt;mso-table-rspace: 0pt;vertical-align: top;margin-right: 15px">
              <tbody><tr style="vertical-align: top"><td align="left" valign="middle" style="word-break: break-word;border-collapse: collapse !important;vertical-align: top">
                <a href="https://twitter.com/" title="Twitter" target="_blank">
                  <img src="images/image-2.png" alt="Twitter" title="Twitter" width="32" style="outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;clear: both;display: block !important;border: none;height: auto;float: none;max-width: 32px !important">
                </a>
              </td></tr>
            </tbody></table>
            <!--[if (mso)|(IE)]></td><![endif]-->
            
            <!--[if (mso)|(IE)]><td width="32" style="width:32px; padding-right: 15px;" valign="top"><![endif]-->
            <table align="left" border="0" cellspacing="0" cellpadding="0" width="32" height="32" style="width: 32px !important;height: 32px !important;display: inline-block;border-collapse: collapse;table-layout: fixed;border-spacing: 0;mso-table-lspace: 0pt;mso-table-rspace: 0pt;vertical-align: top;margin-right: 15px">
              <tbody><tr style="vertical-align: top"><td align="left" valign="middle" style="word-break: break-word;border-collapse: collapse !important;vertical-align: top">
                <a href="https://linkedin.com/" title="LinkedIn" target="_blank">
                  <img src="images/image-1.png" alt="LinkedIn" title="LinkedIn" width="32" style="outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;clear: both;display: block !important;border: none;height: auto;float: none;max-width: 32px !important">
                </a>
              </td></tr>
            </tbody></table>
            <!--[if (mso)|(IE)]></td><![endif]-->
            
            <!--[if (mso)|(IE)]><td width="32" style="width:32px; padding-right: 15px;" valign="top"><![endif]-->
            <table align="left" border="0" cellspacing="0" cellpadding="0" width="32" height="32" style="width: 32px !important;height: 32px !important;display: inline-block;border-collapse: collapse;table-layout: fixed;border-spacing: 0;mso-table-lspace: 0pt;mso-table-rspace: 0pt;vertical-align: top;margin-right: 15px">
              <tbody><tr style="vertical-align: top"><td align="left" valign="middle" style="word-break: break-word;border-collapse: collapse !important;vertical-align: top">
                <a href="https://instagram.com/" title="Instagram" target="_blank">
                  <img src="images/image-3.png" alt="Instagram" title="Instagram" width="32" style="outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;clear: both;display: block !important;border: none;height: auto;float: none;max-width: 32px !important">
                </a>
              </td></tr>
            </tbody></table>
            <!--[if (mso)|(IE)]></td><![endif]-->
            
            <!--[if (mso)|(IE)]><td width="32" style="width:32px; padding-right: 15px;" valign="top"><![endif]-->
            <table align="left" border="0" cellspacing="0" cellpadding="0" width="32" height="32" style="width: 32px !important;height: 32px !important;display: inline-block;border-collapse: collapse;table-layout: fixed;border-spacing: 0;mso-table-lspace: 0pt;mso-table-rspace: 0pt;vertical-align: top;margin-right: 15px">
              <tbody><tr style="vertical-align: top"><td align="left" valign="middle" style="word-break: break-word;border-collapse: collapse !important;vertical-align: top">
                <a href="https://vimeo.com/" title="Vimeo" target="_blank">
                  <img src="images/image-5.png" alt="Vimeo" title="Vimeo" width="32" style="outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;clear: both;display: block !important;border: none;height: auto;float: none;max-width: 32px !important">
                </a>
              </td></tr>
            </tbody></table>
            <!--[if (mso)|(IE)]></td><![endif]-->
            
            <!--[if (mso)|(IE)]><td width="32" style="width:32px; padding-right: 0px;" valign="top"><![endif]-->
            <table align="left" border="0" cellspacing="0" cellpadding="0" width="32" height="32" style="width: 32px !important;height: 32px !important;display: inline-block;border-collapse: collapse;table-layout: fixed;border-spacing: 0;mso-table-lspace: 0pt;mso-table-rspace: 0pt;vertical-align: top;margin-right: 0px">
              <tbody><tr style="vertical-align: top"><td align="left" valign="middle" style="word-break: break-word;border-collapse: collapse !important;vertical-align: top">
                <a href="https://youtube.com/" title="YouTube" target="_blank">
                  <img src="images/image-4.png" alt="YouTube" title="YouTube" width="32" style="outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;clear: both;display: block !important;border: none;height: auto;float: none;max-width: 32px !important">
                </a>
              </td></tr>
            </tbody></table>
            <!--[if (mso)|(IE)]></td><![endif]-->
            
            
            <!--[if (mso)|(IE)]></tr></table></td></tr></table><![endif]-->
          </div>
        </div>
        
              </td>
            </tr>
          </tbody>
        </table>
        
        <table style="font-family:arial,helvetica,sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
          <tbody>
            <tr>
              <td class="v-container-padding-padding" style="overflow-wrap:break-word;word-break:break-word;padding:20px 10px 50px;font-family:arial,helvetica,sans-serif;" align="left">
                
          <div style="color: #d4d4d4; line-height: 180%; text-align: center; word-wrap: break-word;">
            <p style="font-size: 14px; line-height: 180%;"><span style="font-family: Rubik, sans-serif; font-size: 14px; line-height: 25.2px;">If you have any questions, feel free message us at support@mailus.com. </span><br /><span style="font-family: Rubik, sans-serif; font-size: 14px; line-height: 25.2px;">All rights reserved. Update email preferences or unsubscribe.</span><br /><span style="font-family: Rubik, sans-serif; font-size: 14px; line-height: 25.2px;">QTS (Quick Theme Support)</span><br /><span style="font-family: Rubik, sans-serif; font-size: 14px; line-height: 25.2px;">© 2022. All Rights Reserved.  </span></p>
          </div>
        
              </td>
            </tr>
          </tbody>
        </table>
        
          <!--[if (!mso)&(!IE)]><!--></div><!--<![endif]-->
          </div>
        </div>
        <!--[if (mso)|(IE)]></td><![endif]-->
              <!--[if (mso)|(IE)]></tr></table></td></tr></table><![endif]-->
            </div>
          </div>
        </div>
        
        
        
        <div class="u-row-container" style="padding: 0px;background-color: transparent">
          <div class="u-row" style="Margin: 0 auto;min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: transparent;">
            <div style="border-collapse: collapse;display: table;width: 100%;height: 100%;background-color: transparent;">
              <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding: 0px;background-color: transparent;" align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:600px;"><tr style="background-color: transparent;"><![endif]-->
              
        <!--[if (mso)|(IE)]><td align="center" width="600" style="width: 600px;padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;" valign="top"><![endif]-->
        <div class="u-col u-col-100" style="max-width: 320px;min-width: 600px;display: table-cell;vertical-align: top;">
          <div style="height: 100%;width: 100% !important;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;">
          <!--[if (!mso)&(!IE)]><!--><div style="height: 100%; padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;"><!--<![endif]-->
          
        <table style="font-family:arial,helvetica,sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
          <tbody>
            <tr>
              <td class="v-container-padding-padding" style="overflow-wrap:break-word;word-break:break-word;padding:20px 10px;font-family:arial,helvetica,sans-serif;" align="left">
                
          <div style="color: #95a5a6; line-height: 140%; text-align: center; word-wrap: break-word;">
            <p style="font-size: 14px; line-height: 140%;"><span style="font-family: Rubik, sans-serif; font-size: 14px; line-height: 19.6px;">&copy; 20XX Company. All Rights Reserved.</span></p>
          </div>
        
              </td>
            </tr>
          </tbody>
        </table>
        
          <!--[if (!mso)&(!IE)]><!--></div><!--<![endif]-->
          </div>
        </div>
        <!--[if (mso)|(IE)]></td><![endif]-->
              <!--[if (mso)|(IE)]></tr></table></td></tr></table><![endif]-->
            </div>
          </div>
        </div>
        
        
            <!--[if (mso)|(IE)]></td></tr></table><![endif]-->
            </td>
          </tr>
          </tbody>
          </table>
          <!--[if mso]></div><![endif]-->
          <!--[if IE]></div><![endif]-->
        </body>
        
        </html>';
        
        return $message;
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

            $subject =  esc_html__( 'QTS Mail: ', 'qts' ) . $support_title;

            $support_type = qts_user_mail_get_templates_support_types( $support_type_options );

            $message =  qts_user_mail_get_message_template();

            $headers = qts_user_mail_get_headers( $personal_fname, $personal_email );

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
            <p>User mode - Mail features</p>
        </div>
        <?php

        
    }
}
add_action( 'admin_notices', 'independence_notice_mail' );
