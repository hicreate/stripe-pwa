# stripe-pwa
A small plugin for adding Payment Intent REST support to Stripe Gateway for Woocommerce, enabling PWA's and front end applications to make stripe payments using the Woocommerce REST api

This plugin is used alongside Woocommerce and Stripe Gateway by Automatic.

This plugin creates the server aspect of a Payment Intent process and it returns the payment intent as the response to a POST call to a custom REST endpoint, effectively allowing you to capture card payments using the Woocommerce REST api - ideal for front end applications.

I built this to work with Vue applications but any front end framework work do just fine. I capture the order details and card details using Vue and Stripe elements, respectively. I then submit the order to Woocommerce using the presribed endpoint/config in the REST api docs, I take the order_id and amount from the order creation and send these details back to the custom endpoint, where a Payment intent is created. The Payment intent is returned within the response object to the front end application, and then combined with the card details these details are all sent onwards to Stripe to process a charge and complete the payment.

The plugin updates the order details into the order and via webhooks the normal Woo processes kick in when Stripe successfully captures the payment.

STRIPPED BACK STRIPE
This plugin is really intended as a start point for front end developers to leverage REST api payments through Woo. It is not a complete commercial solution, and as such you will need to add your own custom sanitisation and validation to the plugin.
