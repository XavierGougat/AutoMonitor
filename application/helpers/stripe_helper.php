<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
function stripe()
{
    require_once("stripe/init.php");

    $stripe = array(
      "secret_key"      => "sk_test_Ze8mATJOumf3yxkTE3FiC14D",
      "publishable_key" => "pk_test_fs8tzZ7R0LPh5mvNOgdlk0Zu"
    );

    \Stripe\Stripe::setApiKey($stripe['secret_key']);
}