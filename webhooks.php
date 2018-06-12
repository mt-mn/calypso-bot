<?php // callback.php

require "vendor/autoload.php";
require_once('vendor/linecorp/line-bot-sdk/line-bot-sdk-tiny/LINEBotTiny.php');

$access_token = 'URw2lqQ/3WOSnKjaeshjmPKaebXyUpXyenAH3oCjzfrhLiqpYdEJCjmTkeLrw0g9pw+SMfGTH8DoFkk4yaHrs8j5aiYjsTXuinktjKgFOzPvKr5eXr1lldg0O7RT2OBOjnRRNb+1teHEbdTgyOOyYQdB04t89/1O/w1cDnyilFU=';

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
			$replyToken = $events['events'][0]['replyToken'];
			$typeMessage = $events['events'][0]['message']['type'];
			$userMessage = $events['events'][0]['message']['text'];
			$text = $event['source']['userId'];
			
			switch ($typeMessage){
				case 'text':
				switch ($userMessage) {
					case "token":
						$text = $event['source']['userId'];
						break;
					case "Disk":
						$myfile = fopen("https://07jovtb5la5gcima2zspnq-on.drv.tw/Monitor/Disk_App", "r") or die("Unable to open file!");
						$myfile1 = fopen("https://07jovtb5la5gcima2zspnq-on.drv.tw/Monitor/date", "r") or die("Unable to open file!");
						$text=fgets($myfile1);
						while(! feof($myfile))
						  {
						  $text .= fgets($myfile);
						  }
						fclose($myfile);
						fclose($myfile1);
						break;
					case "disk":
						$myfile = fopen("https://07jovtb5la5gcima2zspnq-on.drv.tw/Monitor/Disk_App", "r") or die("Unable to open file!");
						$myfile1 = fopen("https://07jovtb5la5gcima2zspnq-on.drv.tw/Monitor/date", "r") or die("Unable to open file!");
						$text=fgets($myfile1);
						while(! feof($myfile))
						  {
						  $text .= fgets($myfile);
						  }
						fclose($myfile);
						fclose($myfile1);
						break;
					case "Task":
						$myfile = fopen("https://07jovtb5la5gcima2zspnq-on.drv.tw/Monitor/Task", "r") or die("Unable to open file!");
						$myfile1 = fopen("https://07jovtb5la5gcima2zspnq-on.drv.tw/Monitor/date", "r") or die("Unable to open file!");
						$text=fgets($myfile1);
						while(! feof($myfile))
						  {
						  $text .= fgets($myfile);
						  }
						fclose($myfile);
						fclose($myfile1);
						break;
					case "task":
						$myfile = fopen("https://07jovtb5la5gcima2zspnq-on.drv.tw/Monitor/Task", "r") or die("Unable to open file!");
						$myfile1 = fopen("https://07jovtb5la5gcima2zspnq-on.drv.tw/Monitor/date", "r") or die("Unable to open file!");
						$text=fgets($myfile1);
						while(! feof($myfile))
						  {
						  $text .= fgets($myfile);
						  }
						fclose($myfile);
						fclose($myfile1);
						break;
					case "Check":
						$myfile = fopen("https://07jovtb5la5gcima2zspnq-on.drv.tw/Monitor/deployedcount", "r") or die("Unable to open file!");
						$myfile1 = fopen("https://07jovtb5la5gcima2zspnq-on.drv.tw/Monitor/date", "r") or die("Unable to open file!");
						$text=fgets($myfile1);
						$count_deploy=fgets($myfile);
						if (strcasecmp($count_deploy,"29") == 0) {
							$text .= "All Service is OK.";
						} else {
							$text .= "Some Service is Down.(" . $count_deploy . "/29)";
						}
						fclose($myfile);
						fclose($myfile1);
						break;
					case "check":
						$myfile = fopen("https://07jovtb5la5gcima2zspnq-on.drv.tw/Monitor/deployedcount", "r") or die("Unable to open file!");
						$myfile1 = fopen("https://07jovtb5la5gcima2zspnq-on.drv.tw/Monitor/date", "r") or die("Unable to open file!");
						$text=fgets($myfile1);
						$count_deploy=fgets($myfile);
						if (strcasecmp($count_deploy,"29") == 0) {
							$text .= "All Service is OK.";
						} else {
							$text .= "Some Service is Down.(" . $count_deploy . "/29)";
						}
						fclose($myfile);
						fclose($myfile1);
						break;
					case "Room":
						$text = $event['source']['roomId'];
						break;
					case "Group":
						$text = $event['source']['groupId'];
						break;
					case "สวัสดี":
						$text = "สวัสดีเว้ยเฮ้ย !!!!";
						break;
					case "ตั้ม":
						$text = "หล่อมาก";
						break;
					case "เอ๋ย":
						$text = "อีเรือง ! น้ำขม";
						break;
					case "พี่จอน":
						$text = "หล่อที่สุด";
						break;
					default:
						$text = "เห้ย พิมพ์ให้ถูกต้องด้วยตอนนี้แค่มี  Disk, Task หรือ Check เว้ย";
						break;                                      
				}
				break;
			default:
				$textReplyMessage = json_encode($events);
				break;  
			}
			// Get replyToken
			$replyToken = $event['replyToken'];

			// Build message to reply back
			$messages = [
				'type' => 'text',
				'text' => $text
			];

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
