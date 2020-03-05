<?php
	require("auth/EtreAuthentifie.php");
	if ($idm->getRole() == 'admin')
	{
		include("editSupplement_form.php");
		require ("db_config.php");
		try
		{
			//echo $_SESSION['uid']=$idm->getUid();
			//$hashed_password = password_hash("admin", PASSWORD_DEFAULT);
			$db = new PDO($dsn, $username, $password);
			$db-> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "Select * FROM supplements";
			$res=$db->query($sql);
			if ($res->rowCount()==0)
			{
				echo "Nothing found !";
			}
			else{
				echo '<center><table id="paginationTable" style="width: 90%; margin-top: 2%;" class="table editable_table table-striped table-dark">';
				echo "<thead>";
				echo "<tr>";
				echo '<th scope="col">SID</th>';
				echo '<th scope="col">Nom</th>';
				echo '<th scope="col">Prix</th>';
				echo '<th scope="col">Actions</th>';
				echo "</tr>";
				echo "</thead>";
				echo "<tbody>";
				foreach($res as $row)
				{
					echo "<tr>";
					echo '<td scope="row">'.$row["sid"]."</td>";
					echo "<td>".$row["nom"]."</td>";
					echo "<td>".$row["prix"]."</td>";
					echo "<td><a class='btn btn-info btn-sm' role='button' href=\"updateSupplement.php?sid=".$row['sid']."\">Edit</a> <a class='btn btn-danger btn-sm' role='button' href=\"deleteSupplement.php?sid=".$row['sid']."\">Delete</a></td>";
					echo "</tr>";	
				}
				$res->closeCursor();
				echo "</tbody>";
				echo "</table></center>";
				
				?>
				<center>
					<form action="editSupplement.php" method="post"> 
						<input style="margin-bottom:10px;" class="btn btn-outline-warning" type="submit" name="addNewSupplement" value="Add Supplement"> <br>
					</form>
				<?php
					
				if (isset($_POST['addNewSupplement'])){
				?>
					<form action="editSupplement.php" method="post">
						<input type="text" name="nom" placeholder="Nom">
						<input type="number" step="0.01" name="prix" placeholder="Prix">
						<input type="submit" class="btn btn-outline-primary" name="addNewSupplement" value="Add !">
					</form>
					<?php
					}
					
			if (isset($_POST['addNewSupplement']) && isset($_POST['nom']) && isset($_POST['prix']) && !empty($_POST['nom']) && !empty($_POST['prix'])) 
			{
		 		$requete = $db->prepare('INSERT INTO supplements(nom, prix) VALUES(:name, :price)');
		 		$requete->execute(array(
					'name' => $_POST['nom'],
					'price' => $_POST['prix']
				));
				 echo "<meta http-equiv='refresh' content='0'>";
				$requete->closecursor();
			}
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
<style>body{
                        background-image:  url("images/bg_4.jpg");
                        height: 100%;
                        background-position: center;
                        background-repeat: no-repeat;
                        background-size: cover;
                        background-attachment: fixed;
                        color:white;
                    }
                </style>