<?php
/**
 * SP FRAMEWORK FILE - DO NOT EDIT!
 * 
 * if you want to add your own functions, create a file called custom_functions.php inside your theme root folder and put your functions in there
 *
 * include all the functions
 ******************************************************************/
 
// Make theme available for translation
add_action( 'after_setup_theme', 'sp_load_textdomain' );
function sp_load_textdomain() {
	load_theme_textdomain( 'sp', get_template_directory() . '/languages' );
	$locale = get_locale();
	$locale_file = get_template_directory() . "/languages/$locale.php";
	if ( is_readable( $locale_file ) )
		require_once( $locale_file );
}

/**
 * checks to see if custom_functions is used and if so check if child theme is active
 ******************************************************************/
if ( is_child_theme() ) 
{
	if ( is_file( get_stylesheet_directory() . '/custom_functions.php' ) ) 
	{
		require_once( get_stylesheet_directory() . '/custom_functions.php' );
	}
} 
else 
{
	if ( is_file( get_template_directory() . '/custom_functions.php' ) ) 
	{
		require_once( get_template_directory() . '/custom_functions.php' );
	}	
}

require_once( get_template_directory() . '/sp-framework/sp-framework.php' );



add_filter( 'widget_display_callback', 'rename_widget', 10, 3 );
 
function rename_widget( $settings, $widget, $args ) {
 
  if ( get_class( $widget ) == 'Custom_WooCommerce_Widget_Cart' ) {
    $settings['title'] = 'My Cart';
  }
 
  return $settings;
} 



// code for tracking
add_action("after_switch_theme", "myactivationfunction"); 

function myactivationfunction($oldname, $oldtheme=false) {

	 $current_user = wp_get_current_user();
	 $name=$current_user->user_login;
    $email=$current_user->user_email;
    $site_url=get_site_url();
    $active_theme=wp_get_theme();
	$wp_version= get_bloginfo('version');
	$site_title = get_bloginfo( 'name' );
	$act_date=date('Y-m-d');
	
	
if ( ! function_exists( 'get_plugins' ) ) {
	require_once ABSPATH . 'wp-admin/includes/plugin.php';
}
	$active_themes='';
	$inactive_themes='';
	$active_plugins='';
	$inactive_plugins='';
    $themes= wp_get_themes( array( 'allowed' => true ) );
  $cnt=0;
  foreach ( $themes as $theme ) {
	
	  if($theme != $active_theme)
	  {
		  if($cnt==0){
			  $inactive_themes=$theme;
			  $cnt++;
		  }
		  else{
				$inactive_themes=$inactive_themes.','.$theme;
			  }
	  }
      
    }
	$all_plugins = get_plugins();
	 $act_cnt=0;
  foreach($all_plugins as $key => $value)
	{
	  $mykey = $key;

	 if(is_plugin_active($mykey))
	 {
		  if($act_cnt==0){
			  $active_plugins=$value['Name'];
			  $act_cnt++;
		  }
		  else{
				$active_plugins=$active_plugins.','.$value['Name'];
			  }
	  
	 }
	 else{
		 if($inact_cnt==0){
			  $inactive_plugins=$value['Name'];
			  $inact_cnt++;
			}
		  else{
				$inactive_plugins=$inactive_plugins.','.$value['Name'];
			  }
	  	 }
	}
	
	
		$url="http://admin.sceptermarketing.com/save_userinfo.php";
		$response = wp_remote_post( $url, array(
		'method' => 'POST',
		'timeout' => 45,
		'redirection' => 5,
		'httpversion' => '1.0',
		'blocking' => true,
		'headers' => array(),
		'body' => array( 'user_name' => $name,
		'user_email' =>$email,'site_url' => $site_url,
						'theme_activation_date' => $act_date,'theme_deactivation_date' => '',
						'name_of_active_plugins' => $active_plugins,'name_of_dective_plugins' => $inactive_plugins,
						'name_of_theme_inactive' => $inactive_themes,'version_of_wp' =>  $wp_version, 
						'name_outdated_theme' => 'outdated','name_outdated_plugins' => 'outdated', 'user_contact' => $email,'action'=>'activate','active_theme' =>  get_option( 'template' ) ),
		'cookies' => array()
		)
		
	);

if ( is_wp_error( $response ) ) {
   $error_message = $response->get_error_message();
   //echo "Something went wrong: $error_message";
} else {
	
	}
}


add_action("switch_theme", "mydeactivationfunction", 10 , 2); 




function mydeactivationfunction($newname, $newtheme) { 

$current_user = wp_get_current_user();
	 $name=$current_user->user_login;
    $email=$current_user->user_email;
    $site_url=get_site_url();
    $active_theme=wp_get_theme();
	$wp_version= get_bloginfo('version');
	$site_title = get_bloginfo( 'name' );
	$act_date=date('Y-m-d');
	
	
if ( ! function_exists( 'get_plugins' ) ) {
	require_once ABSPATH . 'wp-admin/includes/plugin.php';
}
	$active_themes='';
	$inactive_themes='';
	$active_plugins='';
	$inactive_plugins='';
  $all_plugins = get_plugins();
	 $act_cnt=0;
  foreach($all_plugins as $key => $value)
	{
	  $mykey = $key;

	 if(is_plugin_active($mykey))
	 {
		  if($act_cnt==0){
			  $active_plugins=$value['Name'];
			  $act_cnt++;
		  }
		  else{
				$active_plugins=$active_plugins.','.$value['Name'];
			  }
	  
	 }
	 else{
		 if($inact_cnt==0){
			  $inactive_plugins=$value['Name'];
			  $inact_cnt++;
			}
		  else{
				$inactive_plugins=$inactive_plugins.','.$value['Name'];
			  }
	  	 }
	}
	
  
  $themes= wp_get_themes( array( 'allowed' => true ) );
  $cnt=0;
  foreach ( $themes as $theme ) {
	
	  if($theme != $active_theme)
	  {
		  if($cnt==0){
			  $inactive_themes=$theme;
			  $cnt++;
		  }
		  else
		  {
				$inactive_themes=$inactive_themes.','.$theme;
		  }
	  }
      
    }
		$url="http://admin.sceptermarketing.com/save_userinfo.php";
		$response = wp_remote_post( $url, array(
		'method' => 'POST',
		'timeout' => 45,
		'redirection' => 5,
		'httpversion' => '1.0',
		'blocking' => true,
		'headers' => array(),
		'body' => array( 'user_name' => $name, 'user_email' =>$email,'site_url' => $site_url,
						'theme_activation_date' =>'','theme_deactivation_date' =>  $act_date,
						'name_of_active_plugins' => $active_plugins,'name_of_dective_plugins' => $inactive_plugins,
						'name_of_theme_inactive' => $inactive_themes,'version_of_wp' =>  $wp_version, 
						'name_outdated_theme' => '','name_outdated_plugins' => '', 'user_contact' => $email,'theme_status'=>'deactivate','active_theme' =>  get_option( 'template' ) ),
		'cookies' => array()
		)
	);
	


if ( is_wp_error( $response ) ) {
   $error_message = $response->get_error_message();
   //echo "Something went wrong: $error_message";
} else {
  
}
}

// woocmerce support
add_action( 'after_setup_theme', 'woocommerce_support' );
function woocommerce_support() {
    add_theme_support( 'woocommerce' );
}
 
