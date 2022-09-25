=== Quick Theme Support ===
Contributors: Niyankhadka
Tags: 
Requires at least: 4.7
Tested up to: 6.0
Requires PHP: 7.2
Stable tag: 1.0.0
License: GPLv3 or later
License URI: https://www.gnu.org/licenses/gpl-3.0.html
Donate link: #

== Description ==

function text_domain_qts_mode_setup(){

	add_filter( 'qts_mode_filter', 'text_domain_qts_mode_selection' );
	add_filter( 'qts_user_mail_feature_status_fitler', 'text_domain_qts_mail_feature_enable' );
	add_filter( 'qts_get_user_template_filter', 'text_domain_qts_template_selection' );

	add_filter( 'qts_user_mail_get_to_filter', 'text_domain_qts_mail_sent_to' );
	add_filter( 'qts_user_mail_get_header_filter', 'text_domain_qts_mail_header_set' );
	add_filter( 'qts_user_template_one_support_types_option_filter', 'text_domain_qts_tem_one_supp_options' );
	
}
add_action( 'qts_mode', 'text_domain_qts_mode_setup' );

//either user or developer mode || filter-> qts_mode_filter
function text_domain_qts_mode_selection(){
	return 'user';
}

// enable the mail feature || filter-> qts_user_mail_feature_status_fitler
function text_domain_qts_mail_feature_enable(){
	return true;
}

// template selection || filter-> qts_get_user_template_filter
function text_domain_qts_template_selection(){
	return 'one';
}

// set for cc or bcc || filter-> qts_user_mail_get_header_filter
function text_domain_qts_mail_header_set(){

	$value[] = "CC: ccc@example.com";
	$value[] = "BCC: eee@example.pro";
	
	return $value;
}

// support options for form || filter-> qts_user_template_one_support_types_option_filter
function text_domain_qts_tem_one_supp_options() {

	return array(
		'contact_support' => "contact support",
		'code_support' => "code support",
	);
}

// email sent to || filter-> qts_user_mail_get_to_filter
function text_domain_qts_mail_sent_to() {

	return "niyankhadka.nk@gmail.com";
}

= Requirements =

* WordPress 4.7 or later.

== Installation ==

will be added soon.

= Automatic installation =

will be added soon.

= Manual installation =

will be added soon.

= Updating =

Automatic updates should work like a charm; as always though, ensure you backup your site just in case.

== Frequently Asked Questions ==

== Changelog ==

= 1.0.0 (Released: September 18, 2022) =
* Initial version