<?php 
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;

// Create new payer and method
$payer = new Payer();
$payer->setPaymentMethod("paypal");

// Set redirect URLs
$redirectUrls = new RedirectUrls();
$redirectUrls->setReturnUrl('http://nissanfest:8888/success')
  ->setCancelUrl('http://nissanfest:8888/cancel');

// Set payment amount
$amount = new Amount();
$amount->setCurrency("USD")
  ->setTotal(10);

// Set transaction object
$transaction = new Transaction();
$transaction->setAmount($amount)
  ->setDescription("Payment description");

// Create the full payment object
$payment = new Payment();
$payment->setIntent('sale')
  ->setPayer($payer)
  ->setRedirectUrls($redirectUrls)
  ->setTransactions(array($transaction));
  ?>