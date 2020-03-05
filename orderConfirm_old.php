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
			  	margin:0;
	}

	.changedFont{
    font-family: 'Alegreya Sans SC', sans-serif;
	}
	.changedFontTitle{
		font-family: 'Lobster', cursive;
		color:#fac564;
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
							if (isset($_POST['pizzaChoice'])){
							$selectedPizza=htmlspecialchars($_POST['pizzaChoice']);
							echo $selectedPizza."<br>";
							}
							if (isset($_POST['orderedSup'])){
							foreach($_POST['orderedSup'] as $valeur){
								   echo "Le sid $valeur a été cochée<br>";
							}
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