<link href="https://fonts.googleapis.com/css?family=Arapey" rel="stylesheet">
<?php
require("auth/EtreAuthentifie.php");
$active="orderMeal";
$title = 'Accueil';
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
		  padding-top:2%;
	}
	.choixSup{
		/* border:2px solid white; */
		width:200px;
		margin-top:15px;
		text-align: left;
	}
	}

</style>
</head>
<body>
	<?php
		if ($idm->getRole() == 'user'){ 
			?>
			<section class="hero">
	     		<div class="hero2">
	     			<center><h1 class="changedFontTitle">Order THE Pizza</h1></center>
					<?php
					require ("db_config.php");
					try{
							//echo $_SESSION['uid']=$idm->getUid();
							//$hashed_password = password_hash("admin", PASSWORD_DEFAULT);
							$db = new PDO($dsn, $username, $password);
							$db-> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
							$sql = "Select * FROM recettes";
							$sql2= "Select * FROM supplements";
							$res=$db->query($sql);
							$res2=$db->query($sql2);
							if ($res->rowCount()==0 && $res2->rowCount()==0)
							{
								echo "Nothing found !";
							}
							else{
								echo '<center>';
								echo '<form action="orderConfirm.php" method="POST" class="changedFont">';
									echo '<div class="form-group">';
										echo 'Select pizza : <br>';
										echo '<SELECT name = "pizzaChoice">';
										foreach($res as $row){
											echo '<option value="'.htmlspecialchars($row['rid']).'">'.htmlspecialchars($row['nom']).' ('.htmlspecialchars($row['prix']).'€)</option>';
										}
										$res->closeCursor();
										echo '</SELECT>';
									echo '</div>';
									echo '<div class="form-group">';
										echo 'Check supplements you want on your pizza :<br>';
										echo '<div class="choixSup">';
											foreach($res2 as $row2){
											?>
												<input type="checkbox" name="orderedSup[]" value="<?php echo $row2['sid']; ?>">
												<label><?php echo htmlspecialchars($row2['nom'])." (".htmlspecialchars($row2['prix'])."€)"; ?> </label><br>
											<?php
											}
											$res2->closeCursor();
										echo '</div>';
									echo '</div>';
									echo '<input type="submit" value="Commander !" class="btn btn-outline-light btn-lg">';
								echo '</form>';
								echo '</center>';
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