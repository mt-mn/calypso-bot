<?php // callback.php

require "vendor/autoload.php";
require_once('vendor/linecorp/line-bot-sdk/line-bot-sdk-tiny/LINEBotTiny.php');
$f_source='http://api.openweathermap.org/data/2.5/weather?q=Bangkok,th&appid=74d9a85d60ef463664f0ebf88db6381e';
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
					case "Event":
					case "event":
						$myfile = fopen("https://07jovtb5la5gcima2zspnq-on.drv.tw/Monitor/Event", "r") or die("Unable to open file!");
						$myfile1 = fopen("https://07jovtb5la5gcima2zspnq-on.drv.tw/Monitor/date", "r") or die("Unable to open file!");
						$text=fgets($myfile1);
						while(! feof($myfile))
						  {
							  if($i == 0) {
									
							  }else {
								  
								  $text.= fgets($myfile);
									
									
									}
							  $i++;
						  }
						fclose($myfile);
						fclose($myfile1);
						break;
					case "Check":
					case "check":
						$myfile = fopen("https://07jovtb5la5gcima2zspnq-on.drv.tw/Monitor/deployedcount", "r") or die("Unable to open file!");
						$myfile1 = fopen("https://07jovtb5la5gcima2zspnq-on.drv.tw/Monitor/date", "r") or die("Unable to open file!");
						$text=fgets($myfile1);
						$count_deploy=fgets($myfile);
						if (date('Hi') >= 0600 and date('Hi') < 1800) {
								if ($count_deploy >= 28) {
								$text .= "All Services are OK.(" . $count_deploy . "/29)";
							} else {
								$text .= "Some Service are Down.(" . $count_deploy . "/29)";
							}
						}
						elseif (date('Hi') >= 1800 and date('Hi') < 2130) {
								if ($count_deploy >= 24) {
								$text .= "All Services are OK,OOTB downtime.(" . $count_deploy . "/29)";
							} else {
								$text .= "Some Service are Down.(" . $count_deploy . "/29)";
							}
						}
						elseif (date('Hi') >= 2130 and date('Hi') < 0500) {
								if ($count_deploy >= 27) {
								$text .= "All Service is OK, Swift or Custody downtime.(" . $count_deploy . "/29)";
							} else {
								$text .= "Some Service is are Down.(" . $count_deploy . "/29)";
							}
						}
						else {
							$text .= "Urgent : Some Services are Down.(" . $count_deploy . "/29),Please contact CAA";
						}
						fclose($myfile);
						fclose($myfile1);
						break;
					case "Weather":
					case "weather":
						$json_f = file_get_contents($f_source);
						$f_get_list = json_decode($json_f);
						 foreach ($f_get_list as $fgetlist ) {
						$cityname=$fgetlist->name;
						  }
						 foreach ($f_get_list->weather as $weatherlist ) {
						$weatherstatus=$weatherlist->main;
						  }
						 $temp=$f_get_list->main->temp;
						 $windspeed=$f_get_list->wind->speed;
						 $cloud=$f_get_list->clouds->all;
						 $celsius = ceil($temp - 273.15);
						 $text ="Bangkok\nTemp : ";
						 $text .=$celsius."°C\n";
						 $text .="Cloud : ".$cloud."%\n";
						 $text .="Windspeed : ".$windspeed." m/s";
						 
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
					case "สิวะ":
					case "กาย":
						$text = "สนใจน้ำขม ไหมครับ";
						break;
					case "ตั้ม":
						$text = "หล่อมาก";
						break;
					case "เอ๋ย":
						$text = "อีเรือง ! น้ำขม";
						break;
					case "พี่จอน":
					case "จอน":
						$text = "หล่อที่สุด";
						break;
					case "Happy Birthday":
					case "HBD":
						$text = "Happy Birthday. Happy birthday to you, Happy birthday to you. Happy birthday Happy birthday., Happy birthday to you.";
						break;
					case "EOD เป็นไงบ้าง":
						$text = "ค่อนข้าง OK";
						break;
					case "ไอโง่":
						$text = "มึงสิไอโง่ ไอ Buffalo";
						break;
					case "พี่ก้อง":
					case "ก้อง":
						$text = "พี่หนุ่มเรียก !";
						break;
					case "555":
						$text = "หัวเราะหา พ่อง !";
						break;
					case "I am Groot":
						$text = "มึงไม่ใช้ Groot คนคือคนบ้าคนนึง";
						break;
					case "I am star lord":
					case "I am Star lord":
						$text = "มึงไปตบหน้าทานอสทำไม จักรวาลแตกเลยสาส";
						break;
					case "วันนี้กินไรดี":
					case "กินไรดี":
					case "แดกไรดี":
						$text = "แบบไหนล่ะเว้ยเฮ้ย เลือกด้วย 'แพงใกล้'  'แพงไกล' 'ถูกไกล' 'ถูกใกล้' 'พิเศษ' ";
						break;
					case "แพงใกล้":
						$myfile = fopen("https://07jovtb5la5gcima2zspnq-on.drv.tw/Monitor/แพงใกล้.txt", "r") or die("Unable to open file!");
						$ran = mt_rand(0,5) ;
						while ( !feof($myfile) ) {
						$content = fgets($myfile) ;
						if ( $ran == $i ) {
							$text="ไปกิน " . $content ."แพงๆดีกว่า ขี้เกียจเดิน" ;
						}
							$i++ ;
						}
						fclose($myfile);
						break;
					case "แพงไกล":
						$myfile = fopen("https://07jovtb5la5gcima2zspnq-on.drv.tw/Monitor/แพงไกล.txt", "r") or die("Unable to open file!");
						$ran = mt_rand(0,5) ;
						while ( !feof($myfile) ) {
						$content = fgets($myfile) ;
						if ( $ran == $i ) {
							$text="ไปกิน " . $content ."ราคาแรงๆ แล้วกลับมาทำงานทันมั๊ย" ;
						}
							$i++ ;
						}
						fclose($myfile);
						break;
					case "ถูกใกล้":
						$myfile = fopen("https://07jovtb5la5gcima2zspnq-on.drv.tw/Monitor/ถูกใกล้.txt", "r") or die("Unable to open file!");
						$ran = mt_rand(0,8) ;
						while ( !feof($myfile) ) {
						$content = fgets($myfile) ;
						if ( $ran == $i ) {
							$text="ไปกิน " . $content ."จนสิท่า" ;
						}
							$i++ ;
						}
						fclose($myfile);
						break;
					case "ถูกไกล":
						$myfile = fopen("https://07jovtb5la5gcima2zspnq-on.drv.tw/Monitor/ถูกไกล.txt", "r") or die("Unable to open file!");
						$ran = mt_rand(0,5) ;
						while ( !feof($myfile) ) {
						$content = fgets($myfile) ;
						if ( $ran == $i ) {
							$text="ไปกิน " . $content ."จนและยังขี้เกียจทำงานอีกนะ" ;
						}
							$i++ ;
						}
						fclose($myfile);
						break;
					case "พิเศษ":
						$myfile = fopen("https://07jovtb5la5gcima2zspnq-on.drv.tw/Monitor/พิเศษ.txt", "r") or die("Unable to open file!");
						$ran = mt_rand(0,3) ;
						while ( !feof($myfile) ) {
						$content = fgets($myfile) ;
						if ( $ran == $i ) {
							$text="ไปกิน " . $content ." มีตังเยอะจังเลยนะ เอามาแบ่งบ้าง" ;
						}
							$i++ ;
						}
						fclose($myfile);
						break;
					default:
						$ran = mt_rand(0,4) ;
						if ( $ran == 0 ) {
							$text = "เห้ย พิมพ์ให้ถูกต้องด้วยตอนนี้แค่มี  Disk, Task ,Event หรือ Check เว้ย";
						}
						elseif ( $ran == 1 ) {
							$text = "ใจเย็นๆ หนูไม่เข้าใจ";
						
						}
						elseif ( $ran == 2 ) {
							$text = "พักผ่อนบ้างนะ ทำงานเยอะเกินแล้ว";
						
						}
						elseif ( $ran == 3 ) {
							$text = "It's who we are from the star.";
						
						} else {
							$text = "เหงาหรอ วางถุงกาวลงซะ";
						}
						break;                                      
				}
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