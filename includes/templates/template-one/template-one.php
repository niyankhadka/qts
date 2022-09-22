<?php

/**
 * Template one of the plugin
 *
 * @since      1.0.0
 * @package    QTS
 * @subpackage QTS/includes/templates/template-one
 * @author     niyankhadka <niyankhadka.nk@gmail.com>
 */

// Exit if accessed directly.
if ( !defined( 'ABSPATH' ) ) {

    exit;
}


/**
 * QTS user template one hook declaration
 *
 * @since 1.0.0
 */
if ( !function_exists('qts_user_template_one') ) :
    
    function qts_user_template_one() {

        ?>
        <nav class="qts-1-menu">
            <input type="checkbox" href="#" class="qts-1-menu-open" name="qts-1-menu-open" id="qts-1-menu-open" />
            <label class="qts-1-menu-open-button" for="qts-1-menu-open">
                <span class="qts-1-menu-open-icon-btn">
                    <i class="fa-solid fa-headset"></i>
                </span>
            </label>

            <a href="#" data-target="qts-mail-popup" class="qts-1-menu-item blue qts-mail-js-open-popup">
                <i class="fa fa-solid fa-envelope"></i>
            </a>
            <a href="#" class="qts-1-menu-item green">
                <i class="fa-solid fa-comment-dots"></i>
            </a>
            <a href="#" class="qts-1-menu-item red">
                <i class="fa fa-heart"></i>
            </a>

            <div class="qts-mail-popup qts-mail-js-popup" id="qts-mail-popup" data-popup="qts-mail-popup">
                
                <div class="qts-mail-popup__holder qts-mail-js-popup-holder">
                    <div class="qts-scrollbar-container">
                            <div class="qts-scrollbar-content">
                        <label class="qts-mail-popup__close qts-mail-js-close-popup">
                            <span class="qts-mail-close-popup-icon">
                                <i class="fa-solid fa-circle-xmark"></i>
                            </span>
                        </label>
                        <div class="qts-mail-qts-mail-form-card">
                            <h2 id="qts-mail-form-heading">Need Support ? Email Us</h2>
                            <p>Fill all form field to go to next step</p>
                            <form action="<?php echo esc_url(admin_url( 'admin-ajax.php' )); ?>" id="qts-mail-form-wizzard" method="post" enctype="multipart/form-data">
                                <!-- progressbar -->
                                <ul id="qts-mail-form-progressbar">
                                    <li class="active" id="support-type"><strong>Support Type</strong></li>
                                    <li id="personal"><strong>Personal</strong></li>
                                    <li id="message"><strong>Message</strong></li>
                                    <li id="confirm"><strong>Finish</strong></li>
                                </ul>
                                <!-- support-type-fieldset -->
                                <fieldset id="support-type-fieldset">
                                    <div class="qts-mail-form-card">
                                        <div class="qts-mail-form-row">
                                            <div class="qts-mail-form-col-7">
                                                <h2 class="qts-mail-form-fs-title">Support Information</h2>
                                            </div>
                                            <div class="qts-mail-form-col-5">
                                                <h2 class="qts-mail-form-steps">Step 1 - 4</h2>
                                            </div>
                                        </div>
                                        <label for="support_title" class="qts-mail-form-fieldlabels">Support Title</label>
                                            <input type="text" id="support_title" name="support_title" placeholder="Mention your main reason for support." />
                                        <label for="support_type_options" class="qts-mail-form-fieldlabels">Select Support Type</label>
                                            <select name="support_type_options" id="support_type_options">
                                                <option value="general_support">General Support</option>
                                                <option value="developer_support">Developer Support</option>
                                            </select>
                                    </div>
                                    <input type="button" name="next" class="qts-mail-form-next qts-mail-form-action-button" value="Next" />
                                </fieldset>
                                <!-- personal-fieldset -->
                                <fieldset id="personal-fieldset">
                                    <div class="qts-mail-form-card">
                                        <div class="qts-mail-form-row">
                                            <div class="qts-mail-form-col-7">
                                                <h2 class="qts-mail-form-fs-title">Personal Information:</h2>
                                            </div>
                                            <div class="qts-mail-form-col-5">
                                                <h2 class="qts-mail-form-steps">Step 2 - 4</h2>
                                            </div>
                                        </div>
                                        <label for="personal_fname" class="qts-mail-form-fieldlabels">First Name</label>
                                            <input type="text" id="personal_fname" name="personal_fname" placeholder="First Name" />
                                        <label for="personal_lname" class="qts-mail-form-fieldlabels">Last Name</label>
                                            <input type="text" id="personal_lname" name="personal_lname" placeholder="Last Name" />
                                        <label for="personal_email" class="qts-mail-form-fieldlabels">Email</label>
                                            <input type="email" id="personal_email" name="personal_email" placeholder="Email Id" value="" />
                                    </div>
                                    <input type="button" name="next" class="qts-mail-form-next qts-mail-form-action-button" value="Next" />
                                    <input type="button" name="previous" class="qts-mail-form-previous qts-mail-form-action-button-previous" value="Previous" />
                                </fieldset>
                                <!-- message-fieldset -->
                                <fieldset id="message-fieldset">
                                    <div class="qts-mail-form-card">
                                        <div class="qts-mail-form-row">
                                            <div class="qts-mail-form-col-7">
                                                <h2 class="qts-mail-form-fs-title">Message</h2>
                                            </div>
                                            <div class="qts-mail-form-col-5">
                                                <h2 class="qts-mail-form-steps">Step 3 - 4</h2>
                                            </div>
                                        </div>
                                        <label for="message_textarea" class="qts-mail-form-fieldlabels">Your Message</label>
                                            <textarea id="message_textarea" name="message_textarea" rows="4" cols="50">
                                            </textarea>
                                        <label for="message_file" class="qts-mail-form-fieldlabels">Upload File</label>
                                            <input type="file" id="message_file" name="message_file" accept="image/*">
                                    </div>
                                    <?php $nonce = wp_create_nonce( "qts_mail_form_nonce" ); ?>
                                    <input type="submit" data-nonce="<?php echo $nonce; ?>" id="qts_mail_form_submit" name="qts_mail_form_submit" class="qts-mail-form-action-button submit" value="Submit" />
                                    <span id="qts_mail_form_submit_error"></span>
                                    <input type="button" name="previous" class="qts-mail-form-previous qts-mail-form-action-button-previous" value="Previous" />
                                </fieldset>
                                <!-- confirm-fieldset -->
                                <fieldset id="confirm-fieldset">
                                    <div class="qts-mail-form-card">
                                        <div class="qts-mail-form-row">
                                            <div class="qts-mail-form-col-7">
                                                <h2 class="qts-mail-form-fs-title">Finish</h2>
                                            </div>
                                            <div class="qts-mail-form-col-5">
                                                <h2 class="qts-mail-form-steps">Step 4 - 4</h2>
                                            </div>
                                        </div>
                                        <br>
                                        <br>
                                        <h2 class="purple-text qts-mail-form-text-center">
                                            <strong>SUCCESS !</strong>
                                        </h2>
                                        <br>
                                        <div class="qts-mail-form-row qts-mail-form-justify-content-center">
                                            <div class="qts-mail-form-col-3">
                                                <img src="https://i.imgur.com/GwStPmg.png" class="qts-mail-form-fit-image">
                                            </div>
                                        </div> 
                                        <br>
                                        <br>
                                        <div class="qts-mail-form-row qts-mail-form-justify-content-center">
                                            <div class="qts-mail-form-col-7 qts-mail-form-text-center">
                                                <h5 class="purple-text qts-mail-form-text-center">Email has been sent to support team. Please wait for team to response in your email.</h5>
                                                <input type="button" name="resend" class="qts-mail-form-action-button resend" value="resend" />
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                            </form>
                        </div>





                        </div>
                    </div>
<!-- End Multi step form -->
                
                </div>
            </div>
        </nav>






        
      
	
	













        <?php
    }
endif;
add_action( 'in_admin_footer', 'qts_user_template_one', 40 );


/**
 * load qts user template one scripts
 *
 * @since 1.0.0
 */
if ( !function_exists('qts_user_template_one_scripts') ) :

    function qts_user_template_one_scripts() {

    $ver = QTS_PLUGIN_VERSION;
    wp_enqueue_style('fontawesome', plugin_dir_url( __FILE__ ) . "assets/css/fontawesome.min.css", '', $ver);
    wp_enqueue_style('qts-user-mail', plugin_dir_url( __FILE__ ) . "assets/css/qts-template-one.css", '', $ver);
    wp_enqueue_script('fontawesome', plugin_dir_url( __FILE__ ) . "assets/js/fontawesome.min.js", ['jquery'], $ver, true);
    wp_enqueue_script('qts-user-mail', plugin_dir_url( __FILE__ ) . "assets/js/qts-template-one.js", ['jquery'], $ver, true);
    wp_enqueue_script('qts-jquery-validate', plugin_dir_url( __FILE__ ) . "assets/js/jquery.validate.min.js", ['jquery'], $ver, true);
    wp_enqueue_script('qts-additional-methods', plugin_dir_url( __FILE__ ) . "assets/js/additional-methods.min.js", ['jquery'], $ver, true);
    
    // set variables for script
    wp_localize_script( 'qts-user-mail', 'qts_user_mail_loc', array(

        'ajaxurl'       => admin_url( 'admin-ajax.php' ),

        'support_title_required' => __( "Support title is required", "qts" ),
        'support_title_minlength' => __( "Minimum 5 letters are required", "qts" ),
        'personal_fname_required' => __( "First name is required", "qts" ),
        'personal_lname_required' => __( "Last name is required", "qts" ),
        'personal_email_required' => __( "Email is required", "qts" ),
        'personal_email_invalid' => __( "Email is invalid", "qts" ),
        'message_textarea_required' => __( "Message is required", "qts" ),
        'message_textarea_minlength' => __( "Minimum 10 letters are required", "qts" ),
        'message_textarea_maxlength' => __( "Minimum 1000 letters are required", "qts" ),
        'message_file_accept' => __( "Only image file is allowed", "qts" ),
        'message_file_size' => __( "Image file should not exceed 1 MB", "qts" ),
        'submit_invalid_nonce_message' => __( "Please refresh page and try again.", "qts" ),
        'submit_wp_mail_error_message' => __( "Error in sending email from your server. Please consult with your hosting provider.", "qts" ),
    ) );
}
endif;
add_action( 'admin_enqueue_scripts', 'qts_user_template_one_scripts', 40 );
