<?php
$access_token = 'URw2lqQ/3WOSnKjaeshjmPKaebXyUpXyenAH3oCjzfrhLiqpYdEJCjmTkeLrw0g9pw+SMfGTH8DoFkk4yaHrs8j5aiYjsTXuinktjKgFOzPvKr5eXr1lldg0O7RT2OBOjnRRNb+1teHEbdTgyOOyYQdB04t89/1O/w1cDnyilFU=';


$url = 'https://api.line.me/v1/oauth/verify';

$headers = array('Authorization: Bearer ' . $access_token);

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
$result = curl_exec($ch);
curl_close($ch);

echo $result;