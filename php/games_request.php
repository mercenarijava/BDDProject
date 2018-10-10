<?php
	include 'db_helper.php';
	$offset = $_GET['offset'];
	$size = $_GET['size'];
	$order_price = $_GET['order_price'];
	$order_name = $_GET['order_name'];
	$category = $_GET['category'];
	$console = $_GET['console'];
	$title = $_GET['title'];
	$g_filter = new game_filter(
		$offset,
		$size,
		empty($order_price)? null : $order_price === 'true',
		empty($order_name)? null : $order_name === 'true',
		empty($category)? null : $category,
		empty($console)? null : $console,
		empty($title)? null : $title
	);
	
	connect();
	$games = getGames($g_filter);
	$rows = array();
	$count = 0;
	while(($r = mysqli_fetch_assoc($games)) && $count < $g_filter->size) {
		$rows[] = $r;
		$count ++;
	}
	
	echo $games->num_rows;
	print json_encode($rows);
	disconnect();
?>