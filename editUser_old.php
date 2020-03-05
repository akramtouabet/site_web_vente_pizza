<?php

	require("auth/EtreAuthentifie.php");
	if ($idm->getRole() == 'admin')
	{
		include("editUsers_form.php");
		require ("db_config.php");
		try
		{
			$db = new PDO($dsn, $username, $password);
			$db-> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "Select * FROM users";
			$res=$db->query($sql);
			if ($res->rowCount()==0)
			{
				echo "Nothing found !";
			}
			else{
				echo '<center><table style="width: 80%; margin-top: 5%;" class="table table-striped table-dark">';
				echo "<thead>";
				echo "<tr>";
				echo '<th scope="col">UID</th>';
				echo '<th scope="col">Nom</th>';
				echo '<th scope="col">Prenom</th>';
				echo '<th scope="col">Login</th>';
				echo '<th scope="col">Actions</th>';
				echo "</tr>";
				echo "</thead>";
				echo "<tbody>";
				foreach($res as $row)
				{
					echo "<tr>";
					echo '<td scope="row">'.$row["uid"]."</td>";
					echo "<td>".$row["nom"]."</td>";
					echo "<td>".$row["prenom"]."</td>";
					echo "<td>".$row["login"]."</td>";
					echo '<td> Edit - Delete </td>';
					echo "</tr>";
				}
				$res->closeCursor();
				echo "</tbody>";
				echo "</table></center>";
				echo "<center>Add user</center>";
			}
		}
		catch(Exception $e)
		{
			die('Erreur : '.$e->getMessage());
		}
	}
	else{
		echo "FUCK OFF";
	}
?>