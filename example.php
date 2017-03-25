<?php
// Example sms send SmsWorldHub

$token = '2fnnKJfnjk2f.....';
$api = new SmsWorldHub($token);
$response = $api->send('+79000000000', 'Hi! test');
if ($response['code']==SmsWorldHub::CODE_OK) {
	// SUCCESS
} else {
	// ERROR
	echo $response['message'];
}
