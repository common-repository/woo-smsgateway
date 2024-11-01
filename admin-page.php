<?php

/* @Author: Hamza */
// Admin Menu Page


function woo_smsgateway_options_page()
{
     add_menu_page(
        'Woo SMS Gateway',
        'Woo SMS Gateway',
        'manage_options',
        'woo-smsgateway-admin',
        'woo_smsgateway_page_html',
        'dashicons-megaphone',
        20
    );

add_action( 'admin_init', 'woo_smsgateway_setting' );
	  
	 add_submenu_page(
		'woo-smsgateway-admin',
		'Help',
		'Help',
		'manage_options',
		'woo-smsgateway-help',
		'woo_smsgateway_pg_settings'
		);


}
add_action('admin_menu', 'woo_smsgateway_options_page');

function woo_smsgateway_setting() {
    register_setting( 'woo_smsgateway_options_group', 'api_key'); 
     register_setting( 'woo_smsgateway_options_group', 'device_id'); 
    
    add_settings_section( 'woo_smsgateway_settings_section', 'Settings', 'woo_smsgateway_general_options', 'woo_smsgateway_settings' ); 

    add_settings_field('hr_news_status','Smsgateway.me Api Key','woo_smsgateway_settings_key','woo_smsgateway_settings','woo_smsgateway_settings_section');

    add_settings_field('deviceId','Device ID','woo_smsgateway_settings_deviceid','woo_smsgateway_settings','woo_smsgateway_settings_section');
   
} 


// Callback Function - Status Field
function woo_smsgateway_settings_deviceid(){
    $device_id =esc_attr( get_option('device_id'));?>

    <input type="text" class="regular-text" name="device_id" value="<?php echo $device_id;?>"/>
    <?php
    
 
}

// Callback Function - Status Field
function woo_smsgateway_settings_key(){
    $api_key =esc_attr( get_option('api_key'));?>

    <input type="text" class="regular-text" name="api_key" value="<?php echo $api_key;?>"/>
    <?php
    
 
}
function woo_smsgateway_general_options(){
	if (!current_user_can('manage_options')) {
        return;
    }
}

function woo_smsgateway_page_html(){

	if (!current_user_can('manage_options')) {
        return;
    }

    ?>
    <div id="woo-sms-help" style="padding: 20px;background: #fff;margin-top: 10px;border: 1px dashed #333;width: 50%;font-size: 16px;">
    <h2>How it works?</h2>
    <ol>
    <li>Go to website <a href="http://smsgateway.me/" target="_blank">SMSGATEWAY</a> and register / login.</li>
    <li> Install <a href="https://play.google.com/store/apps/details?id=networked.solutions.sms.gateway.api" target="_blank"> SMSGATEWAY APP </a>from Google Play Store on your Android device.</li>
    <li> Login on your account (Andriod App)</li>
    <li> Copy the device id and paste it below in device id field. </li>
    <li> Login on your account (Website). Go to account->settings and copy the API key and paste it below in Api key field.</li>
    <li> Save Changes </li>
    </ol>
    </div>
    <?php

	settings_errors();?>
	<form method="post" action="options.php">

	        <?php settings_fields('woo_smsgateway_options_group');?>

	        <?php do_settings_sections('woo_smsgateway_settings');?>

	        <?php submit_button();?>
	</form>
     

<?php
}


function woo_smsgateway_pg_settings(){

	if (!current_user_can('manage_options')) {
        return;
    }

    ?>
    <div id="woo-sms-help" style="padding: 20px;background: #fff;margin-top: 10px;border: 1px dashed #333;width: 50%;font-size: 16px;">
    <h2>How it works?</h2>
    <ol>
    <li>Go to website <a href="http://smsgateway.me/" target="_blank">SMSGATEWAY</a> and register / login.</li>
    <li> Install <a href="https://play.google.com/store/apps/details?id=networked.solutions.sms.gateway.api" target="_blank"> SMSGATEWAY APP </a>from Google Play Store on your Android device.</li>
    <li> Login on your account (Andriod App)</li>
    <li> Copy the device id and paste it below in device id field. </li>
    <li> Login on your account (Website). Go to account->settings and copy the API key and paste it below in Api key field.</li>
    <li> Save Changes </li>
    </ol>
    </div>

    <?php

settings_errors();?>
<form method="post" action="options.php">

        <?php settings_fields('woo_smsgateway_options_group');?>

        <?php do_settings_sections('woo_smsgateway_settings');?>

        <?php submit_button();?>
</form>
     

<?php
}