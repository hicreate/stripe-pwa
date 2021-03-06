<?php

// Exit if accessed directly

if( !defined( 'ABSPATH' ) ) exit;

class StripePWAMain
{
    //construct
    public $amount;

    //properties
    public $order_identity;
    private $secret;

    public function __construct($amount, $new_order)
    {

        $this->secret = '*********************************';
        $this->set_api_key();
        $this->amount = $amount;
        $this->order_identity = $new_order;

    }

    //methods
    private function set_api_key(){
        \Stripe\Stripe::setApiKey($this->secret);
    }

    public function create_intent(){
        $intent = \Stripe\PaymentIntent::create([
            'amount' => $this->amount,
            'currency' => 'gbp',
            'payment_method_types' => ['card'],

            // Verify your integration in this guide by including this parameter
            'metadata' => [
                'integration_check' => 'accept_a_payment',
                'order_id' => $this->order_identity,
                ],

        ]);

        $this->update_meta($this->order_identity, $intent->id);
        echo json_encode(array('client_secret' => $intent->client_secret));

    }

    public function update_meta($order_id, $intent_id) {
    update_post_meta( $order_id, '_stripe_intent_id', $intent_id);
}
}

