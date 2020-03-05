<?php
	require("auth/EtreAuthentifie.php");
	if ($idm->getRole() == 'admin')
	{
		include("editOrders_form.php");
		require ("db_config.php");
		try
		{
			//echo $_SESSION['uid']=$idm->getUid();
			//$hashed_password = password_hash("admin", PASSWORD_DEFAULT);
			$db = new PDO($dsn, $username, $password);
			$db-> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "SELECT commandes.cid, commandes.ref, users.login as login, users.nom as lname, users.prenom as fname, recettes.nom as nom, recettes.prix as price, commandes.date, commandes.statut FROM commandes INNER JOIN users ON commandes.uid = users.uid INNER JOIN recettes ON commandes.rid = recettes.rid ORDER BY commandes.cid";
			$sommeTotal=0;
			$somme=0;
			$res=$db->query($sql);
			if ($res->rowCount()==0)
			{
				echo "Nothing found !";
			}
			else{
				echo '<center><table id="paginationTable" style="width: 90%; margin-top: 2%;" class="table editable_table table-striped table-dark">';
				echo "<thead>";
				echo "<tr>";
				echo '<th scope="col">CID</th>';
				echo '<th scope="col">Ref</th>';
				echo '<th scope="col">Login</th>';
				echo '<th scope="col">Name</th>';
				echo '<th scope="col">Pizza</th>';
				echo '<th scope="col">Supplement(s)</th>';
				echo '<th scope="col">Date</th>';
				echo '<th scope="col">Statut</th>';
				echo '<th scope="col">Prix</th>';
				echo '<th scope="col">Action</th>';
				echo "</tr>";
				echo "</thead>";
				echo "<tbody>";

				foreach($res as $row)
				{
					echo "<tr>";
					echo '<td scope="row">'.htmlspecialchars($row["cid"])."</td>";
					echo "<td>".htmlspecialchars($row["ref"])."</td>";
					echo "<td>".htmlspecialchars($row["login"])."</td>";
					echo "<td>".htmlspecialchars($row["lname"])." ".htmlspecialchars($row["fname"])."</td>";
					echo "<td>".htmlspecialchars($row["nom"])."</td>";
					$sommeTotal += htmlspecialchars($row["price"]);
					$somme += htmlspecialchars($row["price"]);

					echo "<td> <ul>";
					$sql2 = "SELECT supplements.nom as nomSupplement, supplements.prix as prixSup FROM supplements INNER JOIN extras ON supplements.sid = extras.sid INNER JOIN commandes ON commandes.cid = extras.cid WHERE extras.cid = :leCID";
					$res2=$db->prepare($sql2);
					$res2->execute(array(
						'leCID' => htmlspecialchars($row['cid']),
					));
					foreach($res2 as $row2){
						echo "<li>".htmlspecialchars($row2['nomSupplement'])."</li>";
						$sommeTotal += htmlspecialchars($row2["prixSup"]);
						$somme += htmlspecialchars($row2["prixSup"]);
					}
					echo "</ul></td>";
					echo "<td>".htmlspecialchars($row["date"])."</td>";
					echo "<td>".htmlspecialchars($row["statut"])."</td>";
					echo "<td>". $somme ."</td>";
					$somme = 0;

					echo "<td><a class='btn btn-danger btn-sm' role='button' href=\"deleteOrders.php?cid=".htmlspecialchars($row['cid'])."\">Delete</a>";
					echo " ";
					if ($row["statut"]=="preparation"){
						echo "<a class='btn btn-warning btn-sm' role='button' href=\"deliverOrder.php?cid=".htmlspecialchars($row['cid'])."\">Deliver !</a>";
						echo "<a class='btn btn-info btn-sm' role='button' href=\"updateOrder.php?cid=".htmlspecialchars($row['cid'])."\">Ready !</a>";
					}
					echo "</td>";
					echo "</tr>";	
				}
				$res->closeCursor();
				$res2->closeCursor();
				echo "</tbody>";
				echo "</table></center>";
				echo "<span style='float:right; margin-right:13%; margin-bottom:20px;'> TOTAL : ".$sommeTotal . "€</span>";
					
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
