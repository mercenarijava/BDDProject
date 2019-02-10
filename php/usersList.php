<?php
	include 'db_helper.php';								/* IMPORTANT DON'T DELETE */
	
	
	function createList(){
		connect();
		
		$sql_list_of_users = "SELECT * FROM users ORDER BY username ASC";
		
		$sql = sprintf($sql_list_of_users);
		$result = $GLOBALS['connection']->query($sql);
		
		$count = 0;		//counter
		
		if ($result) {
			while($row = mysqli_fetch_assoc($result)){
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