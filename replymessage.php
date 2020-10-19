<?php
require __DIR__ . '/administrator/components/com_timeworked/lib/twilio-php-master/src/Twilio/autoload.php';
use Twilio\Twiml\MessagingResponse;

$response = new MessagingResponse();
$response->message("Thanks for your mesage. Please contact with webstie admin.");
?>