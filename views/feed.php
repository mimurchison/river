<li><div class="dot"></div></li>
<?php

include '../pass.php';

include '../data/fetch.php';

$db = new mysqli($dbhost,$dbuser,$dbpass,$dbname);

if($db->connect_errno > 0){
    die('Unable to connect to database [' . $db->connect_error . ']');
}

$sql = "SELECT *
    FROM `tbl_posts`
    ORDER BY datetime Desc
    LIMIT 1000"; //This should be high enough for most, but change it if you want more items appearing in the list

if(!$result = $db->query($sql)){
    die('There was an error running the query [' . $db->error . ']');
}

while($row = $result->fetch_assoc()){

    $date = date("l, F jS Y", strtotime($row['datetime']));
    $service_id = $row['service_id'];
    $category = $row['category'];
    $service = $row['service'];
    $data = $row['data'];
    $attachment = $row['attachment'];
    $link = $row['permalink'];

?>
<li class="post" id="<?php echo $service_id ?>">
	<?php if( $category == 'link' ) { ?>
		<a target="_blank" href="<?php echo $attachment ?>">
	<?php } else if( strlen($attachment) > 0 ) { ?>
		<a target="_blank" href="<?php echo $link ?>">
	<?php } ?>
	<div class="icons">
		<span class="logo <?php echo $service ?>">
			<?php
			switch ($service) {
				case 'twitter':
	        		echo "&#xe086;";
	        		break;
			    case 'dribbble':
			        echo "&#xe021;";
			        break;
			    case 'instagram':
			        echo "&#xe100;";
			        break;
			    case 'github':
			    	echo "&#xe037;";
			    	break;
				}
			?>
		</span><br>
		<span class="logo category <?php echo $service ?>">
			<?php
			switch ($category) {
				case 'link':
	        		echo "&#128279;";
	        		break;
			    case 'photo':
			        echo "";
			        break;
			    case 'thought':
			        echo "";
			        break;
			    case 'retweet':
			    	echo "&#128227;";
			    	break;
				}
			?>
		</span>
	</div>
	<?php if( substr($attachment, -3) == 'jpg' || substr($attachment, -4) == 'jpeg' || substr($attachment, -3) == 'png' || substr($attachment, -3) == 'png' ) { ?>
	<div class="attachment" style="background-image: url('<?php echo $attachment ?>')"></div>
	<?php } ?>
	<div class="content <?php echo $service ?>">
		<span class="date"><?php echo $date ?></span><br>
		<span class="text"><?php echo $data ?></span>
	</div>
	<?php if( strlen($attachment) > 0 || $category == 'link' ) { ?>
		</a>
	<?php } ?>
</li>
<?php } ?> 
