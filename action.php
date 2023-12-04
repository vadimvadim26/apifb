<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);

if (empty($_GET['action']))
{
    echo "No action specified";
}
else
{
    $action = $_GET['action'];
}




if (empty($_GET['name']))
{
    $name = "";

    if (empty($_GET['firstname'])){
        $firstname = "";
    }else{
        $firstname = hash('sha256', mb_strtolower($_GET['firstname']));
    }

    if (empty($_GET['lastname'])){
        $lastname = "";
    }else{
        $lastname = hash('sha256', mb_strtolower($_GET['lastname']));
    }
}
else
{
    $name = mb_strtolower($_GET['name']);
    $nameArr = explode(" ", $name);

    if (count($nameArr) == 1)
    {
        array_push($nameArr, "");
    }

    $firstname = hash('sha256', $nameArr[0]);
    $lastname = hash('sha256', $nameArr[1]);
}

if (empty($_GET['phone']))
{
    $phone = "";
}
else
{
    $phone = str_replace(" ", '', $_GET['phone']);
    $phone = str_replace("+", '', $phone);
    $phone = intval($phone);
    $phone = hash('sha256', $phone);
}

if (empty($_GET['dob']))
{
    $db = "";
}
else 
{
	$db = $_GET['db']; //Format: 19970216 = February, 16th 1997
    $db = hash('sha256', $db);
}

if (empty($_GET['sid'])){
        $subscription_id = "";
}
else
{
        $subscription_id = $_GET['sid'];
}

if (empty($_GET['email'])) {
    $em = "";
} else {
    $em = mb_strtolower($_GET['email']);
    $em = hash('sha256', $em);
}

$ct = mb_strtolower($_GET['ct']);
$ct = hash('sha256', $ct);

$country = mb_strtolower($_GET['country']);
$country = hash('sha256', $country);

$st = mb_strtolower($_GET['st']);
$new_st = explode('_', $st);
$st = hash('sha256', $new_st[1]);

$client_user_agent = $_GET['client_user_agent'];
if(strpos($client_user_agent,"iPhone") !== FALSE){
        $client_user_agent = "Mozilla/5.0 (iPhone; CPU iPhone OS 13_3_1 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Mobile/15E148 [FBAN/FBIOS;FBDV/iPhone11,2;FBMD/iPhone;FBSN/iOS;FBSV/13.3.1;FBSS/3;FBID/phone;FBLC/en_US;FBOP/5;FBCR/]";
}

$client_ip_address = $_GET['client_ip_address'];

$external_id = $_GET['external_id'];
$external_id = hash('sha256', $external_id);

if(empty($_GET['date'])){
    $data = time();
} else{
    $data = $_GET['date'];
}

if (empty($_GET['sub_id_10']) || $_GET['sub_id_10'] === "null" || $_GET['sub_id_10'] === "{fbclid}"){
    $fbclid = null;
} else {
    $fbclid = "fb.1." . $data . "." . $_GET['sub_id_10'];
}

$pixel_id = $_GET['sub_id_11'];
$access_token = $_GET['sub_id_12'];
$event_source_url = $_GET['sub_id_13'];

$rand = rand(1, 9999);

if(empty($_GET['revenue'])){
    $revenue = 0;
}else{
    $revenue = $_GET['revenue'];
}

if(empty($_GET['fbp'])){
    $fbp = "fb.1." . $data . "." . $rand;
}else{
    $fbp = $_GET['fbp'];
}

if(empty($_GET['eventid'])){
    $eventid = null;
}else{
    $eventid = $_GET['eventid'];
}

$url = "https://graph.facebook.com/v15.0/" . $pixel_id . "/events?access_token=" . $access_token;

$data_to_fb = ["action_source" => "website", "event_id" => $eventid, "event_name" => $action, "event_time" => $data, "custom_data" => '{"currency":"USD", "value":' . $revenue . '}', "event_source_url" => urlencode($event_source_url) , "user_data" => ["external_id" => $external_id, "client_ip_address" => $client_ip_address, "client_user_agent" => $client_user_agent, "fbc" => $fbclid, "subscription_id" => $subscription_id, "fbp" => $fbp, "fn" => $firstname, "ln" => $lastname, "ph" => $phone, "ct" => $ct, "db" => $db, "st" => $st, "country" => $country, "em" => $em]];

$filename_cache = 'action_cache.txt';
$text_cache = file_get_contents($filename_cache);

if ($text_cache == $data)
{
    echo "Postback already sent.";
}
else
{
    file_put_contents($filename_cache, $data);
//    $ch = curl_init($url . "&data=%5B" . urlencode(json_encode($data_to_fb)) . "%5D");
    $ch = curl_init($url);
    curl_setopt( $ch, CURLOPT_POSTFIELDS,"data=[".json_encode($data_to_fb)."]");
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
//    curl_setopt($ch, CURLOPT_HEADER, false);
    $html = curl_exec($ch);
    echo $html;
    curl_close($ch);

    $filename = 'action_facebook_log.txt';
    $text = file_get_contents($filename);
    $text .= "\n\n-------------------------------";
    $text .= "\n\nDate: " . date('m/d/Y H:i:s', time());
    $text .= "\n\nAction: " . $action;
    $text .= "\n\nFB Click ID Empty? " . empty($fbclid);
    $text .= "\n\nFBP: " . $_GET['fbp'];
    $text .= "\n\nURL: " . $url;
    $text .= "\n\nData: " . json_encode($data_to_fb);
    $text .= "\n\nResponse: " . $html;
    file_put_contents($filename, $text);

}
?>