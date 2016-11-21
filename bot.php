<?php
$access_token = 'wBHvjHovGYM4KifyfM5PLgD6ypWoYU/lqofs92u2IF8zCkif9FidQseU88yTHs8cUG0egfLAS+zxGN4zOzl7yr764Z/KMq7Lch2KCT/hDRt2v6Uq/z5WLkw+DHqxluY1VKbBZw01xmmA6ohCESM6vAdB04t89/1O/w1cDnyilFU=';

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
			$status_led = 0;

			// Build message to reply back
			if($text=='ON'){
				$status_led = 1;
				$messages = [
					'type' => 'text',
					'text' => 'LED1=ON'
				];
			}
			else if($text=='OFF'){
				$status_led = 0;
				$messages = [
					'type' => 'text',
					'text' => 'LED1=OFF'
				];
			}
			else if($text=='STATUS'){
				/*if ($status_led=='1'){
					$messages = [
						'type' => 'text',
						'text' => 'LED1=ON'
				];
				}
				else {
					$messages = [
						'type' => 'text',
						'text' => 'LED1=OFF'
				];
				}	*/
				$messages = [
					'type' => 'text',
					'text' => 'STATUS LED ='.$status_led
				];
			}
			else {
				$messages = [
						'type' => 'text',
						'text' => 'Please ENTER "ON" or "OFF" or "STATUS"'
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
