<?php
$servername = "localhost";
$username = "admin1";
$password = "admin1";
$db_name = "blockgamefinal";
$connection = null;

// GENERIC CLASS FILTER USED TO SELECT OPERATIONS ON DATABASE
class game_filter{
	var $offset;
	var $size;
	var $order_price; // if true is ASC
	var $order_name; // if true is A - Z
	var $category;
	var $console;
	var $title;
	function __construct($offset = 0,
							$size = 20,
							$order_price = null,
							$order_name = null,
							$category = null,
							$console = null,
							$title = null){
		$this->offset = $offset;
		$this->size = $size;
		$this->order_price = $order_price;
		$this->order_name = $order_name;
		$this->category = $category;
		$this->console = $console;
		$this->title = $title;
    }
	function hasPriceOrder(){
		return !is_null($this->order_price);
	}
	function hasNameOrder(){
		return !is_null($this->order_name);
	}
	function hasCategorySelected(){
		return !is_null($this->category);
	}
	function hasConsoleSelected(){
		return !is_null($this->console);
	}
	function hasTitle(){
		return !is_null($this->title);
	}
}

// SQL OPERATIONS
$sql_login = "SELECT * FROM users WHERE username = '%s' AND password = '%s'";
$sql_signin = "INSERT INTO `users`(`name`, `surname`, `address`, `phone`, `username`, `password`) VALUES ('%s','%s','%s',%d,'%s','%s')";
$sql_get_games = "SELECT g.id AS game_id, g.title AS game_title, g.category AS game_category, g.price AS game_price, g.free_quantity AS game_quantity, g.logo AS game_logo, g.description AS game_description, c.id AS console_id, c.name AS console_name, c.model AS console_model FROM (games g INNER JOIN games_console gc ON g.id = id_game) INNER JOIN console c ON gc.id_console = c.id %s %s LIMIT 999 OFFSET %d";
$slq_delete_orders = "DELETE FROM `orders` WHERE id_game = %d AND username_user = '%s' AND payment_type = %d ";
$sql_get_info_user = "SELECT * FROM users WHERE username = '%s'";
$sql_modify_email = "UPDATE users SET username = '%s' WHERE username = '%s'";
$sql_modify_account = "UPDATE users SET username = '%s', password = '%s' WHERE username = '%s'";
$sql_modify_personal_info = "UPDATE users SET name = '%s', surname = '%s', address = '%s', phone = '%s' WHERE username = '%s'";

function connect(){
	// Create connection
	$GLOBALS['connection'] = new mysqli(
								$GLOBALS['servername'],
								$GLOBALS['username'],
								$GLOBALS['password'],
								$GLOBALS['db_name']
							);

	// Check connection
	if ($GLOBALS['connection'] -> connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
}

function disconnect(){
	if($GLOBALS['connection']){
		$GLOBALS['connection'] -> close();
		$GLOBALS['connection'] = null;
	}
}

function login($username, $pass){
	$password= crypt($pass,'$6$rounds=5000$blockgame$');//crypt
	$sql = sprintf($GLOBALS['sql_login'], $username, $password);
	$result = $GLOBALS['connection']->query($sql);
	return $result;
}

function signin($name, $surname, $address, $phone, $username, $pass){
	$user = login($username, $password);
	$exists = mysqli_num_rows($user) > 0;
	if($exists > 0){
		return false;
	}
	$password= crypt($pass,'$6$rounds=5000$blockgame$');//crypt
	$sql = sprintf($GLOBALS['sql_signin'], $name, $surname, $address, $phone, $username, $password);
	$GLOBALS['connection']->query($sql);
	$user = login($username, $password);
	$exists = mysqli_num_rows($user) > 0;
	return $exists > 0;
}

function getGames($filterGet){
	$where = ' WHERE g.free_quantity>0 ';
	if($filterGet->hasCategorySelected()){
		$where .= ' AND ';
		$where .= "g.category = '";
		$where .= $filterGet->category;
		$where .= "'";
	}
	if($filterGet->hasConsoleSelected()){
		$where .= ' AND ';
		$where .= "c.model = '";
		$where .= $filterGet->console;
		$where .= "'";
	}
	if($filterGet->hasTitle()){
		$where .= ' AND ';
		$where .= "g.title LIKE '%";
		$where .= $filterGet->title;
		$where .= "%'";
	}

	$order = $filterGet->hasNameOrder() || $filterGet->hasPriceOrder()? 'ORDER BY ' : '';
	if($filterGet->hasNameOrder()){
		$order .= 'g.title ';
		$order .= $filterGet->order_name? 'ASC' : 'DESC';
	}
	if($filterGet->hasPriceOrder()){
		if($filterGet->hasNameOrder()){
			$order .= ', ';
		}
		$order .= 'g.price ';
		$order .= $filterGet->order_price? 'ASC' : 'DESC';
	}
	$sql = sprintf($GLOBALS['sql_get_games'], $where, $order ,$filterGet->offset);
	$result = $GLOBALS['connection']->query($sql);
	return $result;
}

function deleteOrder($username, $id_game, $payment_type){
	$sql = sprintf($GLOBALS['slq_delete_orders'], $id_game, $username, $payment_type);
	$result = $GLOBALS['connection']->query($sql);
}

function getInfoUser($username){
	$sql = sprintf($GLOBALS['sql_get_info_user'], $username);
	$result = $GLOBALS['connection']->query($sql);
	$row=mysqli_fetch_assoc($result);
	return $row;
}

function modifyEmail($username,$newUsername){
	$sql = sprintf($GLOBALS['sql_modify_email'], $newUsername ,$username);
	$result = $GLOBALS['connection']->query($sql);
	return $result;
}

function modifyAccount($username, $newUsername, $newPassword){
	$sql = sprintf($GLOBALS['sql_modify_account'], $newUsername, $newPassword ,$username);
	$result = $GLOBALS['connection']->query($sql);
	return $result;
}

function modifyPersonalInfo($username, $name, $surname, $address, $phone){
	$sql = sprintf($GLOBALS['sql_modify_personal_info'], $name, $surname, $address, $phone ,$username);
	$result = $GLOBALS['connection']->query($sql);
	return $result;
}

// COSE PER TEST
?>
