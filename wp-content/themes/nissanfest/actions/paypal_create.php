<?php 
// Create payment with valid API context
try {
    $payment->create($apiContext);
  
    // Get PayPal redirect URL and redirect the customer
    $approvalUrl = $payment->getApprovalLink();
  
    // Redirect the customer to $approvalUrl
  } catch (PayPal\Exception\PayPalConnectionException $ex) {
    echo $ex->getCode();
    echo $ex->getData();
    die($ex);
  } catch (Exception $ex) {
    die($ex);
  }
  ?>