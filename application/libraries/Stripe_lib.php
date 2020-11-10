<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Stripe Library for CodeIgniter 3.x
 *
 * Library for Stripe payment gateway. It helps to integrate Stripe payment gateway
 * in CodeIgniter application.
 *
 * This library requires the Stripe PHP bindings and it should be placed in the third_party folder.
 * It also requires Stripe API configuration file and it should be placed in the config directory.
 *
 * @package     CodeIgniter
 * @category    Libraries
 * @author      CodexWorld
 * @license     http://www.codexworld.com/license/
 * @link        http://www.codexworld.com
 * @version     2.0
 */

class Stripe_lib{
    var $CI;
    var $api_error;

    function __construct(){
        $this->api_error = '';
        $this->CI =& get_instance();
        $this->CI->load->config('stripe');

        // Include the Stripe PHP bindings library
        require APPPATH .'third_party/stripe-php/init.php';

        // Set API key
        \Stripe\Stripe::setApiKey($this->CI->config->item('stripe_api_key'));
    }

    function addCustomer($email, $token){
        try {
            // Add customer to stripe
            $customer = \Stripe\Customer::create(array(
                'email' => $email,
                'source'  => $token
            ));
            return $customer;
        }catch(Exception $e) {
            $this->api_error = $e->getMessage();
            return false;
        }
    }

    function createCharge($customerId, $itemName, $itemPrice, $orderID){
        // Convert price to cents
        $itemPriceCents = ($itemPrice*100);
        $currency = $this->CI->config->item('stripe_currency');

        try {
            // Charge a credit or a debit card
            $charge = \Stripe\Charge::create(array(
                'customer' => $customerId,
                'amount'   => $itemPriceCents,
                'currency' => $currency,
                'description' => $itemName,
                'metadata' => array(
                    'order_id' => $orderID
                )
            ));

            // Retrieve charge details
            $chargeJson = $charge->jsonSerialize();
            return $chargeJson;
        }catch(Exception $e) {
            $this->api_error = $e->getMessage();
            return false;
        }
    }
}