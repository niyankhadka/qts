(function( $ ) {
	'use strict';

    function customPopup() {

        let $btnShowPopup = $('.qts-mail-js-open-popup');
        let $btnClosePopup = $('.qts-mail-js-close-popup');
        let $popup = $('.qts-mail-js-popup');
    
        $btnShowPopup.on('click', function () {
    
            let targetPopup = $(this).attr('data-target');
            $("[data-popup=" + targetPopup + "]").addClass('is-active');
    
        });
    
        $btnClosePopup.on('click', function () {
            $(this).parents('.is-active').removeClass('is-active');
        });
    
        $popup.on('click', function (event) {
            if (!$(event.target).closest('.qts-mail-js-popup-holder').length && !$(event.target).is('qts-mail-js-popup')) {
                if ($popup.hasClass('is-active')) {
                    $popup.removeClass('is-active');
                }
            }
        });
    
    }
    customPopup();

    // $(document).ready(function(){
    //     $('.next').click(function(){
    //           var current = $(this).parent();
    //           var next = $(this).parent().next();
    //           $("#qts-mail-form-progressbar li").eq($("fieldset").index(next)).addClass("active");
    //           current.hide();
    //           next.show();
    //     })
        
    //     $('.previous').click(function(){
    //           var current = $(this).parent();
    //           var prev = $(this).parent().prev()
    //           $("#qts-mail-form-progressbar li").eq($("fieldset").index(current)).removeClass("active");
    //           current.hide();
    //           prev.show();
    //     })
    //   })

	$(document).ready(function() {

        var current_fs, next_fs, previous_fs; //fieldsets
        var opacity;
        
        $(".qts-mail-form-next").click(function(){

            $.validator.addMethod('filesize', function(value, element, param) {
                // param = size (in bytes) 
                // element = element to validate (<input>)
                // value = value of the element (file name)
                return this.optional(element) || (element.files[0].size <= param) 
            });

            var form = $("#qts-mail-form-wizzard");
            form.validate({
                errorClass: "qts-mail-form-error qts-mail-form-fail-alert",
                validClass: "qts-mail-form-valid qts-mail-form-success-alert",
                // in 'rules' user have to specify all the constraints for respective fields
                rules: {
                    support_title: {
                        required: true,
                        minlength: 5,
                    },
                    personal_fname: {
                        required: true,
                        minlength: 3,
                    },
                    personal_lname: {
                        required: true,
                        minlength: 3,
                    },
                    personal_email: {
                        required: true,
                        email: true,
                        minlength: 3,
                    },
                    message_textarea: {
                        required: true,
                        minlength: 10,
                        maxlength: 1000,
                    },
                    message_file: {
                        accept: "image/*",
                        filesize: 1048576,
                    },
                },
                // in 'messages' user have to specify message as per rules
                messages: {
                    support_title: {
                        required: qts_user_mail_loc.support_title_required,
                        minlength: qts_user_mail_loc.support_title_minlength,
                    },
                    personal_fname: {
                        required: qts_user_mail_loc.personal_fname_required,
                    },
                    personal_lname: {
                        required: qts_user_mail_loc.personal_lname_required,
                    },
                    personal_email: {
                        required: qts_user_mail_loc.personal_email_required,
                        email: qts_user_mail_loc.personal_email_invalid,
                    },
                    message_textarea: {
                        required: qts_user_mail_loc.message_textarea_required,
                        minlength: qts_user_mail_loc.message_textarea_minlength,
                        maxlength: qts_user_mail_loc.message_textarea_maxlength,
                    },
                    message_file: {
                        accept: qts_user_mail_loc.message_file_accept,
                        filesize: qts_user_mail_loc.message_file_size,
                    },
                }
            });
            if (form.valid() === true){
                
                current_fs = $(this).parent();
                next_fs = $(this).parent().next();
                
                //Add Class Active
                $("#qts-mail-form-progressbar li").eq($("#qts-mail-form-wizzard fieldset").index(next_fs)).addClass("active");
                
                //show the next fieldset
                next_fs.show();
                //hide the current fieldset with style
                current_fs.animate({opacity: 0}, {
                    step: function(now) {
                        // for making fielset appear animation
                        opacity = 1 - now;
                        
                        current_fs.css({
                        'display': 'none',
                        'position': 'relative'
                        });
                        next_fs.css({'opacity': opacity});
                        },
                    duration: 500
                });
            }
            
        });
        
        $(".qts-mail-form-previous").click(function(){
        
            current_fs = $(this).parent();
            previous_fs = $(this).parent().prev();
            
            //Remove class active
            $("#qts-mail-form-progressbar li").eq($("#qts-mail-form-wizzard fieldset").index(current_fs)).removeClass("active");
            
            //show the previous fieldset
            previous_fs.show();
            
            //hide the current fieldset with style
            current_fs.animate({opacity: 0}, {
                step: function(now) {
                // for making fielset appear animation
                opacity = 1 - now;
                
                current_fs.css({
                'display': 'none',
                'position': 'relative'
                });
                previous_fs.css({'opacity': opacity});
                },
                duration: 500
            });
            
        });

        $( '#qts-mail-form-wizzard' ).on( 'click', '#qts_mail_form_submit', function( e ) {

            var $button = $( this );

            e.preventDefault();
            $button.val( "Sending" );
        
            // set ajax data
            var mail_form_data = {
                'action' : 'qts_user_mail_form_ajax_submission',
                'nonce' : $button.data('nonce'),
                'support_title' : document.getElementById('support_title').value,
                'support_type_options' : document.getElementById('support_type_options').value,
                'personal_fname' : document.getElementById('personal_fname').value,
                'personal_lname' : document.getElementById('personal_lname').value,
                'personal_email' : document.getElementById('personal_email').value,
                'message_textarea' : document.getElementById('message_textarea').value,
                'message_file' : document.getElementById('message_file').value,
            };

            $.ajax({
                url: qts_user_mail_loc.ajaxurl,
                data: mail_form_data,
                dataType: 'json',
                method: 'POST',
                success: function(response) {

                    if( response.success == true ) {

                        if( response.data["data"].nonce_valid == true ) {

                            if( response.data["data"].mail_status == false ) {

                                $button.val("Submit");
                                $(document).find('#qts-mail-form-wizzard  #message-fieldset').removeAttr("style");
                                $(document).find('#qts-mail-form-wizzard  #message-fieldset').css({
                                    "display" : "none",
                                    "opacity" : 0,
                                    "position" : "relative"
                                });
                                $(document).find('#qts-mail-form-wizzard  #confirm-fieldset').css({
                                    "display" : "block",
                                    "opacity" : 1,
                                });
                                $(document).find('#qts-mail-form-wizzard #qts-mail-form-progressbar #confirm').addClass("active");

                            }

                        }
                    }
                },
                error: function(errorThrown){

                    var error_data = errorThrown.responseJSON;

                    if( error_data.success == false ) {

                        $button.val( "Submit" );

                        if( error_data.data["data"].nonce_valid == false ) {

                            console.log('nonce invalid');
                            $(document).find('#qts-mail-form-wizzard span#qts_mail_form_submit_error').addClass("qts_mail_form_submit_error qts_mail_form_submit_fail_alert").text(qts_user_mail_loc.submit_invalid_nonce_message);
                        }

                        if( error_data.data["data"].mail_status == false ) {

                            console.log('error in sending email');
                            $(document).find('#qts-mail-form-wizzard span#qts_mail_form_submit_error').addClass("qts_mail_form_submit_error qts_mail_form_submit_fail_alert").text(qts_user_mail_loc.submit_wp_mail_error_message);
                        }
                    }
                }
            }); 
        
        } );
        
        
        // $("#qts-mail-form-wizzard #qts-mail-form-submit").click(function(){

        //     var $button = $( this );

        //     $button.width( $button.width() ).text('...');
        //     $button.getElementById("#qts-mail-form-submit").value = "Liked";
        //     console.log('completed');
        // });

        // $('#qts-mail-form-wizzard').submit(function(e) {

        //     e.preventDefault();
        //     $('#qts-mail-form-submit').val('Processing ...');
            
        //      // set ajax data
        //     var data = {
        //         'action' : 'send_bug_report',
        //         'post_id': $button.data( 'post_id' ),
        //         'report' : $( '.report-a-bug-message' ).val()
        //     };

        //     $.post( settings.ajaxurl, data, function( response ) {

        //         console.log( 'ok' );

        //     } );
            
        // });

        $("#qts-mail-form-wizzard .resend").click(function(){

            //$('#qts-mail-form-wizzard').trigger("reset");
            //Remove class active
            $(document).find('#qts-mail-form-wizzard #qts-mail-form-progressbar #confirm').removeAttr("class");
            $(document).find('#qts-mail-form-wizzard #qts-mail-form-progressbar #message').removeAttr("class");
            $(document).find('#qts-mail-form-wizzard #qts-mail-form-progressbar #personal').removeAttr("class");
            $(document).find('#qts-mail-form-wizzard  #confirm-fieldset').removeAttr("style");
            $(document).find('#qts-mail-form-wizzard  #message-fieldset').removeAttr("style");
            $(document).find('#qts-mail-form-wizzard  #personal-fieldset').removeAttr("style");
            $(document).find('#qts-mail-form-wizzard  #support-type-fieldset').removeAttr("style");
        });
        
    });

})( jQuery );








