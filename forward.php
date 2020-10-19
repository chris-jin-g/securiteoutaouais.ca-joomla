<?php 
/** 
* This section ensures that Twilio gets a response. 
*/ 
header('Content-type: text/xml');
echo '<?xml version="1.0" encoding="UTF-8"?>';
echo '<Response></Response>'; //Place the desired response (if any) here

/** 
* This section actually sends the email. 
*/ 

/* Your email address */
$to = "info@webaction.ca";
$subject = "Message de {$_REQUEST['From']} at {$_REQUEST['To']}"; 
$message = "Vous avez reçu un message de {$_REQUEST['From']}. Body: {$_REQUEST['Body']}"; 
$headers = "De: info@webaction.ca"; // Who should it come from?

mail($to, $subject, $message, $headers); 