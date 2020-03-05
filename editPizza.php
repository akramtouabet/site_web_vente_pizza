<?php

	require("auth/EtreAuthentifie.php");
	if ($idm->getRole() == 'admin')
	{
		include("editPizza_form.php");
		require ("db_config.php");
		try
		{
			//echo $_SESSION['uid']=$idm->getUid();
			//$hashed_password = password_hash("admin", PASSWORD_DEFAULT);
			$db = new PDO($dsn, $username, $password);
			$db-> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "Select * FROM recettes";
			$res=$db->query($sql);
			if ($res->rowCount()==0)
			{
				echo "Nothing found !";
			}
			else{
				echo '<center><table id="paginationTable" style="width: 90%; margin-top: 2%;" class="table editable_table table-striped table-dark">';
				echo "<thead>";
				echo "<tr>";
				echo '<th scope="col">RID</th>';
				echo '<th scope="col">Nom</th>';
				echo '<th scope="col">Prix</th>';
				echo '<th scope="col">Actions</th>';
				echo "</tr>";
				echo "</thead>";
				echo "<tbody>";
				foreach($res as $row)
				{
					echo "<tr>";
					echo '<td scope="row">'.$row["rid"]."</td>";
					echo "<td>".$row["nom"]."</td>";
					echo "<td>".$row["prix"]."</td>";
					echo "<td><a class='btn btn-info btn-sm' role='button' href=\"updatePizza.php?rid=".$row['rid']."\">Edit</a> <a class='btn btn-danger btn-sm' role='button' href=\"deletePizza.php?rid=".$row['rid']."\">Delete</a></td>";
					echo "</tr>";	
				}
				$res->closeCursor();
				echo "</tbody>";
				echo "</table></center>";
				
				?>
				<center>
					<form action="editPizza.php" method="post"> 
						<input style="margin-bottom:10px;" class="btn btn-outline-warning" type="submit" name="addNewPizza" value="Add Pizza"> <br>
					</form>
				<?php
					
				if (isset($_POST['addNewPizza'])){
				?>
					<div align="left" class="formulaire">
						<center><form action="editPizza.php" method="post">
							<div class="form-group">
								<input class="form-control" style = "width:30%;" type="text" name="nom" placeholder="Nom">
							</div>
							<div class="form-group">
								<input type="number" step="0.01" style = "width:30%;" name="prix" placeholder="Prix">
							</div>
							<div class="form-group">
								<input type="submit" class="btn btn-outline-primary" name="addNewPizza" value="Add !">
							</div>
						</form></center>
					</div>
					<?php
					}
					
			if (isset($_POST['addNewPizza']) && isset($_POST['nom']) && isset($_POST['prix']) && !empty($_POST['nom']) && !empty($_POST['prix'])) 
			{
		 		$requete = $db->prepare('INSERT INTO recettes(nom, prix) VALUES(:name, :price)');
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