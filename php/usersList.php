<?php
	include 'db_helper.php';								/* IMPORTANT DON'T DELETE */
	
	
	function createList(){
		connect();
		
		$sql_list_of_users = "SELECT * FROM users ORDER BY username ASC";
		
		$sql = sprintf($sql_list_of_users);
		$result = $GLOBALS['connection']->prepare($sql);
		$result->execute();
		
		$count = 0;		//counter
		
		if ($result) {
			foreach($result->fetchAll(PDO::FETCH_ASSOC) as $row){
				$count++;
				echo "<tr>
					  <td>".$row['username']."</td>
					  <td>".$row['name']."</td>
					  <td>".$row['surname']."</td>
					  <td>".$row['address']."</td>
					  <td>".$row['phone']."</td>
					</tr>";
			}		
		}
		disconnect();
	}
?>