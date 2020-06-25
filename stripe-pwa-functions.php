<?php
// Exit if accessed directly
if( !defined( 'ABSPATH' ) ) exit;

//setup payment endpoint
function stripe_pwa_hooks() {
    add_action('rest_api_init', 'wc_rest_payment_endpoints');
}

//endpoint for hitting to generate initial payment intent
function wc_rest_payment_endpoints() {
    register_rest_route( 'wc/v3', 'stripe-payment', array(
        'methods'  => 'POST',
        'callback' => 'wc_rest_payment_endpoint_handler',
    ) );
}

function wc_rest_payment_endpoint_handler ($request = null){
    $parameters = $request->get_params();
    $amount     = sanitize_text_field($parameters['amount']);
    new StripePWAMain($amount);
}
