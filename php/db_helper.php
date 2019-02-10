<?php
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
$sql_signin = "INSERT INTO `users`(`name`, `surname`, `address`, `phone`, `username`, `password`) VALUES ('%s','%s','%s',%s,'%s','%s')";
$sql_get_games = "SELECT vg.id AS game_id, g.title AS game_title, g.category AS game_category, vg.price AS game_price, vg.free_quantity AS game_quantity, g.logo AS game_logo, g.description AS game_description, c.id AS console_id, c.name AS console_name, c.model AS console_model FROM (games g INNER JOIN videogames vg ON g.id = vg.id_game) INNER JOIN console c ON vg.id_console = c.id %s %s LIMIT 999 OFFSET %d";
$slq_delete_orders = "DELETE FROM orders WHERE id = %d";
$sql_get_info_user = "SELECT * FROM users WHERE username = '%s'";
$sql_payment_type_of_user = "SELECT * FROM users WHERE username = '%s' AND payment_type IS NOT NULL";
$sql_get_payment_type = "SELECT * FROM payments_types WHERE id = %d";
$sql_delete_payment_type_of_user = "DELETE FROM payments_types WHERE id = %d";
$sql_add_payment_type_of_user = "INSERT INTO payments_types (id, key_payment, owner, cvv, expiration_date) VALUES (%d,'%s','%s','%s','%s')";
$sql_get_max_payment_type = "SELECT MAX(id) AS id FROM payments_types;";
$sql_modify_email = "UPDATE users SET username = '%s' WHERE username = '%s'";
$sql_modify_account = "UPDATE users SET username = '%s', password = '%s' WHERE username = '%s'";
$sql_modify_personal_info = "UPDATE users SET name = '%s', surname = '%s', address = '%s', phone = '%s' WHERE username = '%s'";
$sql_modify_payment_type = "UPDATE users SET payment_type = %d WHERE username = '%s'";
$sql_modify_payment_type_NULL = "UPDATE users SET payment_type = NULL WHERE username = '%s'";
$sql_modify_orders_payment_type = "UPDATE orders SET payment_type = %d WHERE payment_type = %d;";
$sql_modify_orders_payment_type_NULL = "UPDATE orders SET payment_type = NULL WHERE payment_type = %d;";
$sql_max_id_order = "SELECT max(id) AS max_id FROM orders";
$sql_insert_order = "INSERT INTO orders (id, username_user, payment_type) VALUES (%d, '%s', %d) ";
$sql_get_orders = "SELECT id, username_user, date FROM orders WHERE username_user = '%s' ORDER BY date DESC";
$sql_get_order_by_id = "SELECT * FROM orders WHERE id = %d";
$sql_get_all_orders = "SELECT id, username_user, date FROM orders ORDER BY date DESC";
$sql_insert_contents = "INSERT INTO contents (id_videogame, id_order, quantity) VALUES (%d, %d, %d) ";
$sql_get_contents = "SELECT v.id AS videogame_id, g.logo AS LOGO, g.title AS TITLE, k.name AS CONSOLE, c.quantity AS QUANTITY, c.quantity*v.price AS PRICE
FROM contents c INNER JOIN videogames v ON v.id = c.id_videogame INNER JOIN games g ON g.id = v.id_game INNER JOIN console k ON k.id = v.id_console WHERE c.id_order = '%s';";
$sql_delete_content = "DELETE FROM contents WHERE id_videogame = %d AND id_order = %d" ;
$sql_update_game_quantity = "UPDATE videogames SET free_quantity = %d WHERE id = %d ";
$sql_videogame_quantity = "SELECT free_quantity AS QUANTITY FROM videogames WHERE id = %d ";
$sql_get_videogames = "SELECT v.id AS videogame_id, g.logo AS LOGO, g.title AS TITLE, k.name AS CONSOLE, v.free_quantity AS QUANTITY, v.price AS PRICE
FROM videogames v INNER JOIN games g ON g.id = v.id_game INNER JOIN console k ON k.id = v.id_console ORDER BY g.title ASC";
$sql_get_max_id_videogames = "SELECT MAX(v.id) AS max_id FROM videogames v INNER JOIN games g ON g.id = v.id_game INNER JOIN console k ON k.id = v.id_console";
$sql_get_min_id_videogames = "SELECT MIN(v.id) AS min_id FROM videogames v INNER JOIN games g ON g.id = v.id_game INNER JOIN console k ON k.id = v.id_console";
$sql_modify_credit_card = "UPDATE payments_types SET owner = '%s', expiration_date = '%s' WHERE id = %d";


function connect(){
	try {
        $GLOBALS['connection'] = new PDO('mysql:host = localhost;dbname=blockgamev2','root','');
    } catch (PDOException $e) {
        print "Error!: " . $e->getMessage() . "<br/>";
		$GLOBALS['connection'] = null;
    }
}

function disconnect(){
	if($GLOBALS['connection']){
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
	$where = ' WHERE vg.free_quantity>0 ';
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
		$order .= 'vg.price ';
		$order .= $filterGet->order_price? 'ASC' : 'DESC';
	}
	$sql = sprintf($GLOBALS['sql_get_games'], $where, $order ,$filterGet->offset);
    $statement = $GLOBALS['connection']->prepare($sql);
    $statement->execute();
    $results = $statement->fetchAll(PDO::FETCH_ASSOC);
	return $results;
}

function getVideogames(){
	$sql = sprintf($GLOBALS['sql_get_videogames']);
	$result = $GLOBALS['connection']->query($sql);
	return $result;
}

function getMaxIdVideogame(){
	$sql = sprintf($GLOBALS['sql_get_max_id_videogames']);
	$result = $GLOBALS['connection']->query($sql);
	$max_id =  mysqli_fetch_assoc($result);
	return $max_id['max_id'];
}

function getMinIdVideogame(){
	$sql = sprintf($GLOBALS['sql_get_min_id_videogames']);
	$result = $GLOBALS['connection']->query($sql);
	$min_id =  mysqli_fetch_assoc($result);
	return $min_id['min_id'];
}

function getPaymentTypeOfUser($username){
	$sql = sprintf($GLOBALS['sql_payment_type_of_user'], $username);
    $statement = $GLOBALS['connection']->prepare($sql);
    $statement->execute();
    $results = $statement->fetchAll(PDO::FETCH_ASSOC);
	return $results;
}

function getQuantity($id_videogame){
	$sql = sprintf($GLOBALS['sql_videogame_quantity'], $id_videogame);
	$result = $GLOBALS['connection']->query($sql);
	$quantity =  mysqli_fetch_assoc($result);
	return $quantity['QUANTITY'];
}

function updateGameQuantity($gameId, $quantity){
	$sql = sprintf($GLOBALS['sql_update_game_quantity'], $quantity, $gameId);
    $statement = $GLOBALS['connection']->prepare($sql);
    $statement->execute();
    $results = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $results;
}

function insertContents($gameId, $order_id, $quantity){
	$sqlC = sprintf($GLOBALS['sql_insert_contents'], $gameId, $order_id, $quantity);
    $statement = $GLOBALS['connection']->prepare($sqlC);
    $statement->execute();
    $results = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $results;
}

function getContentsByOrderId($order_id){
	$sql_contets = sprintf($GLOBALS['sql_get_contents'], $order_id);
	$result_contents = $GLOBALS['connection']->query($sql_contets);
	return $result_contents;
}

function deleteContent($id_videogame, $id_order){
	$sql_contets = sprintf($GLOBALS['sql_delete_content'], $id_videogame, $id_order);
	$result_content = $GLOBALS['connection']->query($sql_contets);
}

function getOrders(){
	$get_orders = sprintf($GLOBALS['sql_get_all_orders']);
	$result = $GLOBALS['connection']->query($get_orders);
	return $result;
}

function insertOrder($username, $paymentTypeId){
	$sqlA = sprintf($GLOBALS['sql_max_id_order']);
    $statement = $GLOBALS['connection']->prepare($sqlA);
    $statement->execute();

    $max_id = $statement->fetchAll(PDO::FETCH_ASSOC);
	$next_id = $max_id['max_id']+1;

	$sqlB = sprintf($GLOBALS['sql_insert_order'], $next_id, $username, $paymentTypeId);
    $statement1 = $GLOBALS['connection']->prepare($sqlB);
    $statement1->execute();

	return $next_id;
}

function getOrdersByUsername($username){
	$get_orders = sprintf($GLOBALS['sql_get_orders'],$username);
	$result = $GLOBALS['connection']->query($get_orders);
	return $result;
}

function getOrdersById($id){
	$get_orders = sprintf($GLOBALS['sql_get_order_by_id'], $id);
	$res = $GLOBALS['connection']->query($get_orders);
	$result = mysqli_fetch_assoc($res);
	return $result;
}

function modifyOrdersPaymentType($payment_type, $oldPayment_type){
	if($payment_type == NULL){
		$sql = sprintf($GLOBALS['sql_modify_orders_payment_type_NULL'], $oldPayment_type);
		$result = $GLOBALS['connection']->query($sql);
	}
	else{
		$sql = sprintf($GLOBALS['sql_modify_orders_payment_type'],  $payment_type, $oldPayment_type);
		$result = $GLOBALS['connection']->query($sql);
	}
}

function deleteOrdersById($order_id){
	$sql = sprintf($GLOBALS['slq_delete_orders'], $order_id);
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

function getCreditCard($id){
	$sql = sprintf($GLOBALS['sql_get_payment_type'], $id);
	$result = $GLOBALS['connection']->query($sql);
	$row=mysqli_fetch_assoc($result);
	return $row;
}

function modifyCreditCard($id, $owner, $date){
	$sql = sprintf($GLOBALS['sql_modify_credit_card'], $owner, $date, $id);
	$result = $GLOBALS['connection']->query($sql);
}

function modifyCreditCardId($next_id, $username){
	//Associo l'utente alla nuova carta
	if($next_id == NULL){
		$sqlC = sprintf($GLOBALS['sql_modify_payment_type_NULL'], $username);
		$modifyAccount = $GLOBALS['connection']->query($sqlC);
	}
	else{
		$sqlC = sprintf($GLOBALS['sql_modify_payment_type'], $next_id, $username);
		$modifyAccount = $GLOBALS['connection']->query($sqlC);
	}
}

function deleteCreditCard($id){
	$sql = sprintf($GLOBALS['sql_delete_payment_type_of_user'], $id);
	$result = $GLOBALS['connection']->query($sql);
}

function addCreditCard($username, $cardNumber, $owner, $cvv, $date){
	$credit_card = getPaymentTypeOfUser($username);
	$card = mysqli_fetch_assoc($credit_card);

	echo $card['payment_type'];

	//Ricavo il max id e il next_id
	$sqlB= sprintf($GLOBALS['sql_get_max_payment_type']);
	$payment_type = $GLOBALS['connection']->query($sqlB);
	$max_id = mysqli_fetch_assoc($payment_type);
	$next_id = $max_id['id']+1;

	echo $next_id;

	//Creo un payment_type
	$sqlA = sprintf($GLOBALS['sql_add_payment_type_of_user'], $next_id, $cardNumber, $owner, $cvv, $date);
	$result = $GLOBALS['connection']->query($sqlA);

	//Sostituisco il vecchio id con il nuovo sugli orders
	modifyOrdersPaymentType($next_id, $card['payment_type']);

	modifyCreditCardId($next_id, $username);

	//Se esisteva gia un payment_type associato lo elimino
	$exists = mysqli_num_rows($credit_card) > 0;
	if($exists > 0){
		deleteCreditCard($card['payment_type']);
	}

	return $result;
}


// COSE PER TEST
?>
