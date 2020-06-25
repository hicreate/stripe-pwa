<?php

// Exit if accessed directly

if (!defined('ABSPATH')) exit;


class StripePwaEndpoint
{
    public function __construct()
    {
        $this->stripe_pwa_hooks();
    }

 
//setup payment endpoint
    public function stripe_pwa_hooks()
    {
        add_action('rest_api_init', array($this, 'wc_rest_payment_endpoints'));
    }

//endpoint for hitting to generate initial payment intent
    public function wc_rest_payment_endpoints()
    {
        register_rest_route('wc/v3', 'stripe-payment', array(
            'methods' => 'POST',
            'callback' => array($this, 'stripe_pwa_endpoint_handler')));
    }

    public function stripe_pwa_endpoint_handler(WP_REST_Request $request)
    {
        $params     = $request->get_params();
        $new_order  = filter_var($params['order_id'], FILTER_SANITIZE_NUMBER_INT);
        $amount     = (int)$params['amount'];

        //var_dump($params);
        //echo "order ID is" . $new_order;
        //echo "amount is " . $amount;

        $intent = new StripePWAMain($amount, $new_order);
        $result = $intent->create_intent();

    }
}

