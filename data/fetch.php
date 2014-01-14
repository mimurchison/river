<?php

function fetch_data($url){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_TIMEOUT, 20);
    $result = curl_exec($ch);
    curl_close($ch);
    return $result;
}

function send_data($query, $dbhost, $dbuser, $dbpass, $dbname){
	$query = substr($query, 0, -2);

	$db = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

	if($db->connect_errno > 0){
	    die('Unable to connect to database [' . $db->connect_error . ']');
	}

	if(!$result = $db->query($query)){
	    die('There was an error running the query [' . $db->error . ']');
	}

	$db->close();
}

//begin script
require_once('../vendor/TwitterAPIExchange.php');

//twitter
$APIurl = 'https://api.twitter.com/1.1/statuses/user_timeline/list.json';
$getfield = '?screen_name=davehariri&page=1&count=30'; //put your name here
$requestMethod = 'GET';
$twitter = new TwitterAPIExchange($settings);
$json = $twitter->setGetfield($getfield)
             ->buildOauth($APIurl, $requestMethod)
             ->performRequest();

$decoded = json_decode($json, true);

$query = "REPLACE INTO tbl_posts (id, service_id, datetime, category, service, data, attachment, permalink) VALUES ";

foreach ($decoded as $key => $value) {

	$service = 'twitter';
	$tweet = addslashes(utf8_decode(trim(preg_replace('/\b(https?|ftp|file):\/\/[-A-Z0-9+&@#\/%?=~_|$!:,.;]*[A-Z0-9+&@#\/%=~_|$]/i', '', $decoded[$key]['text']))));
	$date = date("Y-m-d H:i:s", strtotime($decoded[$key]['created_at']));
	$service_id = strval($decoded[$key]['id']);
	$attachment = $decoded[$key]['entities']['urls'][0]['expanded_url'];
	$photo = $decoded[$key]['entities']['media'][0]['media_url'];
	$permalink = "https://twitter.com/davehariri/status/".$service_id;

	if( strlen($attachment) > 1 ) {
		$category = 'link';
		$attachment = $attachment;
	} else if( strlen($photo) > 1 ) {
		$category = 'photo';
		$attachment = $photo;
	} else {
		$category = 'thought';
		$attachment = '';
	}

	if ( substr($tweet, 0, 3) == "RT ") {
		$tweet = substr($tweet, 3);
		$category = 'retweet';
	}

	$query .= "(DEFAULT, '$service_id', '$date', '$category', '$service', '$tweet', '$attachment', '$permalink'), ";
}

send_data($query, $dbhost, $dbuser, $dbpass, $dbname);
//end twitter

//instagram
$result = fetch_data("https://api.instagram.com/v1/users/381121150/media/recent/?client_id=".$instagram_client_id); //specify this in the pass file
$result = json_decode($result, true);

$query = "REPLACE INTO tbl_posts (id, service_id, datetime, category, service, data, attachment, permalink) VALUES ";

foreach ($result['data'] as $key => $value) {

	$service = 'instagram';
	$category = 'photo';
	$service_id = $result['data'][$key]['id'];
	$data = utf8_decode($result['data'][$key]['caption'][text]);
	$attachment = $result['data'][$key]['images']['standard_resolution']['url'];
	$datetime = date("Y-m-d H:i:s", $result['data'][$key]['created_time']);
	$permalink = $result['data'][$key]['link'];

	$query .= "(DEFAULT, '$service_id', '$datetime', '$category', '$service', '$data', '$attachment', '$permalink'), ";
}

send_data($query, $dbhost, $dbuser, $dbpass, $dbname);
//end instagram

//dribbble
$result = fetch_data("http://api.dribbble.com/players/davidhariri/shots"); //put your name here
$result = json_decode($result, true);

$query = "REPLACE INTO tbl_posts (id, service_id, datetime, category, service, data, attachment, permalink) VALUES ";

foreach ($result['shots'] as $key => $value) {

	$service = 'dribbble';
	$category = 'design';
	$service_id = $result['shots'][$key]['id'];
	$data = utf8_decode($result['shots'][$key]['title']);
	$attachment = $result['shots'][$key]['image_url'];
	$datetime = date("Y-m-d H:i:s", strtotime($result['shots'][$key]['created_at']));
	$permalink = $result['shots'][$key]['url'];

	$query .= "(DEFAULT, '$service_id', '$datetime', '$category', '$service', '$data', '$attachment', '$permalink'), ";
}

send_data($query, $dbhost, $dbuser, $dbpass, $dbname);
//end dribbble

//github
$result = fetch_data("https://github.com/users/davidhariri/contributions_calendar_data"); //put your name here
$result = json_decode($result, true);

$query = "REPLACE INTO tbl_posts (id, service_id, datetime, category, service, data, attachment, permalink) VALUES ";

foreach ($result as $key => $value) {
	$service = 'github';
	$category = 'contributions';
	$service_id = strtotime($result[$key][0]);
	$datetime = date("Y-m-d H:i:s", strtotime($result[$key][0]));

	if($result[$key][1] > 1) {
		$data = ($result[$key][1] . " Contributions");
	} else if ($result[$key][1] == 1){
		$data = ($result[$key][1] . " Contribution");
	} else {
		$data = ("No Contributions");
	}
	
	$attachment = '';
	$permalink = '';

	if($result[$key][1] > 0) {
		$query .= "(DEFAULT, '$service_id', '$datetime', '$category', '$service', '$data', '$attachment', '$permalink'), ";
	}
}
send_data($query, $dbhost, $dbuser, $dbpass, $dbname);
//end github




?>