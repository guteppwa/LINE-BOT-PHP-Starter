<?php
$access_token = '/NSAPdEL4qw4NIYQvP0zxZfwRvv8Cq331Z9GUO6stPjb3VqzwwxE3MVFARvEMtny8RJL0j+6h1xTIy3ifB9jP3cL5hYG8GQfSTRU2RK6EAq06hxOvbZs+HkBC9R/m4TFJ4eRLoXTAD9umrOhGOzffAdB04t89/1O/w1cDnyilFU=';

// Get POST body content
$content = file_get_contents('php://input');
// Parse JSON
$events = json_decode($content, true);
// Validate parsed JSON data
if (!is_null($events['events'])) {
	// Loop through each event
	foreach ($events['events'] as $event) {
		// Reply only when message sent is in 'text' format
		if ($event['type'] == 'message' && $event['message']['type'] == 'text') {
			// Get text sent
			$text = $event['message']['text'];
			// Get replyToken
			$replyToken = $event['replyToken'];

			//status_led

			// Build message to reply back
			if($text=='ON'){
				$messages = [
					'type' => 'text',
					'text' => 'LED1=ON'
				];
			}
			else if($text=='OFF'){
				$messages = [
					'type' => 'text',
					'text' =>'LED1=OFF'
				];
			}
			else {
				$messages = [
						'type' => 'text',
						'text' => 'Please ENTER "ON" or "OFF"'
				];
			}

			// Make a POST Request to Messaging API to reply to sender
			$url = 'https://api.line.me/v2/bot/message/reply';
			$data = [
				'replyToken' => $replyToken,
				'messages' => [$messages],
			];
			$post = json_encode($data);
			$headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token);

			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			$result = curl_exec($ch);
			curl_close($ch);

			echo $result . "\r\n";
		}
	}
}

echo "OK";
