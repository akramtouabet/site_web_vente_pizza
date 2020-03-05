<link href="https://fonts.googleapis.com/css?family=Arapey" rel="stylesheet">
<?php
require("auth/EtreAuthentifie.php");
$active="orderMeal";
$title = 'Accueil';


function refGenerator($length = 6) {
	$ref = "";
	$char = array_merge(range('A','Z'), range('0','9'));
	$max = count($char) - 1;
	for ($i = 0; $i < $length; $i++) {
		$rand = mt_rand(0, $max);
		$ref .= $char[$rand];
	}
	return $ref;
}

?>
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
		  width:55%;
		  padding-top:5%;
		  padding-bottom:5%;
	}
	}

</style>
</head>
<body>
	<?php
		if ($idm->getRole() == 'user'){ 
			?>
			<section class="hero">
	     		<div class="hero2 changedFont">
	     			<center>
	     			<h1 class="changedFontTitle">My order !</h1>
					<?php
					require ("db_config.php");
					try{
						$prixPizza=0;
						$ridPizza=0;
						$prixSup=0;
						$sidSup=0;
						$prixTotal=0;
						$uniqueRef=false;

						do {
							$ref=refGenerator();
							$checkRef=$db->prepare("SELECT ref FROM commandes WHERE ref = :ref");
							$checkRef->execute(array(
								"ref" => $ref
							));
							if ($checkRef->rowCount()==0)
								$uniqueRef==true;
						} while($uniqueRef=false);
						$checkRef->closeCursor();
						$date = date('Y-m-d H:i:s');
							$db = new PDO($dsn, $username, $password);
							$db-> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
							if (isset($_POST['pizzaChoice'])){
							
								$ridPizza=htmlspecialchars($_POST['pizzaChoice']);
								$res=$db->prepare('SELECT * FROM recettes WHERE rid = :selectedPizza');
								$res->execute(array(
									'selectedPizza' => $ridPizza,
								));
								while($row = $res->fetch()){
									echo "Vous avez commandé un(e) ".$row['nom'];
									$prixPizza=$row['prix'];
								}
								$res->closeCursor();
								$sqlCommandes = "INSERT INTO commandes VALUES (NULL, :ref, :uid, :rid, :theDate, :statut)";
								$resCommandes=$db->prepare($sqlCommandes);
								$resCommandes->execute(array(
									"ref" => $ref,
									"uid" => $idm->getUid(),
									"rid" => $ridPizza,
									"theDate" => $date,
									"statut" => "preparation"
								));
								$resCommandes->closeCursor();
							}
							if (isset($_POST['orderedSup'])){
								echo " avec : <br>";
								foreach($_POST['orderedSup'] as $valeur){
									$res2=$db->prepare('SELECT * FROM supplements WHERE sid = :sid');
									$res2->execute(array(
										'sid' => $valeur
									));
									foreach ($res2 as $row2){
										echo $row2['nom']." (".$row2['prix']."€) , ";
										$prixSup+=$row2["prix"];
									}
									$res2->closeCursor();
									$resFind=$db->prepare("SELECT cid FROM commandes WHERE ref = :ref");
									$resFind->execute(array(
										'ref' => $ref
									));
									while($rowFind = $resFind->fetch()){
										$cidFind=$rowFind['cid'];
									}
									$resFind->closeCursor();
									$res3=$db->prepare("INSERT INTO extras VALUES (:cid, :sid)");
									$res3->execute(array(
										'cid' => $cidFind,
										'sid' => $valeur
									));
									$res3->closeCursor();
								}
							}

							echo "<br><-------------------------------------------------><br>";
							echo "PRIX de la Pizza = $prixPizza €<br>";
							echo "PRIX des supplements = $prixSup €<br>";
							$prixTotal=$prixSup+$prixPizza;
							echo "PRIX TOTAL = $prixTotal €";
							echo "<br>";
							if ($prixTotal!=0){
								echo "Réf : ".$ref."<br>";
								echo "Ordered at : ".$date;
							}
							?>
							<br>
							<a href="order.php"><button type="button" class="btn btn-outline-success btn-lg" style="margin-top:30px;">Order another pizza</button></a>
							<a href="myOrders.php"><button type="button" class="btn btn-outline-warning btn-lg" style="margin-top:30px;">Check my orders</button></a>

							<?php
							echo "</center>";
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