<?php
/*
 * Plugin Name: WooCommerce SmsGateway
 * Plugin URI: https://wordpress.org/plugins/woo-smsgateway/
 * Description: Send automatic sms notification on new order creation.
 * Author: Hamza Rauf
 * Author URI: http://fiverr.com/webdeveloper991
 * Version: 1.0.0
 * Requires at least: 4.4
 * Tested up to: 4.8
 * WC requires at least: 2.5
 * WC tested up to: 3.1
*/



include "smsGateway/autoload.php";
include "admin-page.php";

add_action('woocommerce_thankyou','woo_smsgateway_payment_complete');

function woo_smsgateway_payment_complete($order_id)
{

$order=new Wc_order($order_id);
$order_meta = get_post_meta($order_id);
$shipping_first_name = $order_meta['_shipping_first_name'][0];
$phone=$order_meta['_billing_phone'][0];
$first_name=$order->billing_first_name;
$last_name=$order->billing_last_name;
$name=$first_name."".$last_name;
$mobile=$order->billing_mobile;
$items = $order->get_items();
$total = $order->get_total();
$currency = $order->get_currency();

$message = 'Thank you , Your order has been recieved. Order #'.$order_id;
foreach ( $items as $item ) {
	$product_name = $item['name'];
	$product_id = $item['product_id'];
	$product_variation_id = $item['variation_id'];
	$qty= $item['qty'];
	$message .= ' '.$product_name. ' x '.$qty;
}
$message .= '
Total Price = '.$currency.$total;

$device_id =esc_attr( get_option('device_id'));
$api_key =esc_attr( get_option('api_key'));

if(!empty($device_id) && !empty($api_key)){
	woo_smsgateway_sendMessage($phone,$message,$device_id,$api_key);
}



}



function woo_smsgateway_sendMessage($phone,$message,$device_id,$api_key){

	$clients = new SMSGatewayMe\Client\ClientProvider($api_key);

    $sendMessageRequest = new SMSGatewayMe\Client\Model\SendMessageRequest([
        'phoneNumber' => $phone, 'message' => $message, 'deviceId' => $device_id
    ]);

    $sentMessages = $clients->getMessageClient()->sendMessages([$sendMessageRequest]);

}


?>