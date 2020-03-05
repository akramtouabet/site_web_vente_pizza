<link href="https://fonts.googleapis.com/css?family=Arapey" rel="stylesheet">
<?php
require("auth/EtreAuthentifie.php");
$active="myOrders";


?>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://fonts.googleapis.com/css?family=Alegreya+Sans+SC" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet">
<?php
include("header.php");
?>
<head>
<style>
	body{
			    background-image: linear-gradient(rgba(0, 0, 0, 0.5),rgba(0, 0, 0, 0.5)), url('images/bg_1.jpg');
			    height: 100%;
                        background-position: center;
                        background-repeat: no-repeat;
                        background-size: cover;
                        background-attachment: fixed;
                        color:white;
	}

	.changedFont{
    	font-family: 'Alegreya Sans SC', sans-serif;
    	font-size:20px;
	}
	.changedFontTitle{
   		font-family: 'Alegreya Sans SC', sans-serif;
		color:#fac564;
		margin-bottom:30px;
	}
	.hero{
		/* width:100%;
		height:100%; */		
		display: flex;
   		justify-content: center;
    	align-items: center;
    	margin-top:4%;
    	margin-bottom:5%;
	}
	.hero2 {
		  background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5));
		  border:1px solid black;
		  width:auto;
		  padding-top:2%;
		  padding-bottom:5%;
	}

	}

</style>
</head>
<body>
	<?php
		if ($idm->getRole() == 'user'){ 
			$prixTotal=0;
			?>
			<section class="hero">
	     		<div class="hero2 changedFont">
	     			<center>
	     			<h1 class="changedFontTitle">My orders list !</h1>
					<?php
					require ("db_config.php");
					try{
						$db = new PDO($dsn, $username, $password);
						$db-> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
						$sql = "SELECT commandes.ref as commandeRef, recettes.nom as pizzaName, commandes.cid as cCid, recettes.prix as pizzaPrice, commandes.date as commandeDate, commandes.statut as commandeStatut FROM commandes INNER JOIN recettes ON commandes.rid = recettes.rid WHERE commandes.uid = :uid ORDER BY commandeDate";
						$res=$db->prepare($sql);
						$res->execute(array(
							'uid' => $idm->getUid()
						));
						if ($res->rowCount()==0)
							echo "No orders found !";
						else{
							?>
							<table class="table table-striped table-dark" style='width:99%'>
								<tr>
									<td>Réf</td>
									<td>Pizza</td>
									<td>Supplements</td>
									<td>Prix</td>
									<td>Date</td>
									<td>Statut</td>
									<td>Actions</td>
								</tr>
							<?php
							foreach ($res as $row){
								$prixTotal=$row['pizzaPrice'];
								?>
								<tr>
									<td><?php echo htmlspecialchars($row['commandeRef']); ?></td>
									<td><?php echo htmlspecialchars($row['pizzaName']); ?></td>
									<td><ul>
									<?php 
											$sql2="SELECT supplements.nom as supName, supplements.prix as supPrice FROM supplements INNER JOIN extras ON supplements.sid=extras.sid INNER JOIN commandes ON commandes.cid = extras.cid WHERE commandes.cid= :cid2";
											$res2=$db->prepare($sql2);
											$res2->execute(array(
												'cid2' => htmlspecialchars($row['cCid'])
											));
											foreach ($res2 as $row2){
										?>
										<li><?php echo htmlspecialchars($row2["supName"]);
										$prixTotal+=htmlspecialchars($row2['supPrice']); ?></li>

										<?php
									}
									?>
									</ul></td>
									<td><?php echo $prixTotal."€"; ?></td>
									<td><?php echo htmlspecialchars($row['commandeDate']); ?></td>
									<td><?php echo htmlspecialchars($row['commandeStatut']); ?></td>
									<?php
									echo "<td>";
									echo "<a class='btn btn-danger btn-sm' role='button' href=\"userDeleteOrder.php?cid=".$row['cCid']."\">Delete</a>";
									echo "</td>";
								echo "</tr>";
							}
							echo "</table>";
							?>
								<center>
									<a href="index.php"><button type="button" class="btn btn-outline-warning btn-lg">Home</button></a>
									<a href="menu.php"><button type="button" class="btn btn-outline-info btn-lg">Menu</button></a>
									<a href="order.php"><button type="button" class="btn btn-outline-primary btn-lg">Order</button></a>
								</center>

							<?php
						}

						}
						catch(Exception $e){
							die('Erreur : '.$e->getMessage());
						}
						?>
				</div>
			</section>
				

			</div>
				<?php
		}
		else if ($idm->getRole() == 'admin'){
			echo "ADMINS !!! NO FUCKING ADMINS !!!";
		}
		include("footer.php");
	?>
</body>