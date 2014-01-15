<?php
header('Content-Type: application/json');

include("../pass.php");
//stats getter
function get_data($query, $dbhost, $dbuser, $dbpass, $dbname){
	$db = new mysqli($dbhost,$dbuser,$dbpass,$dbname);

	if($db->connect_errno > 0){
	    die('Unable to connect to database [' . $db->connect_error . ']');
	}

	if(!$result = $db->query($query)){
	    die('There was an error running the query [' . $db->error . ']');
	}

	$db->close();

	return $result;
}

$all_data = array();

//service data
$query = "SELECT service, COUNT(*) FROM tbl_posts GROUP BY service";
$service_stats = get_data($query, $dbhost, $dbuser, $dbpass, $dbname);

$service_data = [];

foreach ($service_stats as $key => $value) {
	$service_data[$value['service']] = $value['COUNT(*)'];
}
array_push($all_data, $service_data);


//category data
$query = "SELECT category, COUNT(*) FROM tbl_posts GROUP BY category";
$category_stats = get_data($query, $dbhost, $dbuser, $dbpass, $dbname);

$category_data = array();

foreach ($category_stats as $key => $value) {
	$category_data[$value['category']] = $value['COUNT(*)'];
}
array_push($all_data, $category_data);

//service data by day of week
$query = "SELECT DAYNAME(datetime) AS DayWeek, COUNT(service) AS Count FROM tbl_posts GROUP BY DAYNAME(datetime) ORDER BY DAYNAME(datetime) Desc";
$serviceWeekDay_stats = get_data($query, $dbhost, $dbuser, $dbpass, $dbname);

$serviceWeekDay_data = array();

foreach ($serviceWeekDay_stats as $key => $value) {
	$serviceWeekDay_data[$value['DayWeek']] = $value['Count'];
}

array_push($all_data, $serviceWeekDay_data);

//service data by day
$query = "SELECT DATE(datetime) AS Date, COUNT(service) AS Count FROM tbl_posts GROUP BY DATE(datetime) ORDER BY datetime Desc";
$serviceDay_stats = get_data($query, $dbhost, $dbuser, $dbpass, $dbname);

$serviceDay_data = array();

foreach ($serviceDay_stats as $key => $value) {
	$serviceDay_data[$value['Date']] = $value['Count'];
}

array_push($all_data, $serviceDay_data);

$all_data = preg_replace( "/\"(\d+)\"/", '$1', json_encode($all_data, true) );
echo $all_data;

?>