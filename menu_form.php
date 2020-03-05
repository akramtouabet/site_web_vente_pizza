<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://fonts.googleapis.com/css?family=Arapey" rel="stylesheet">
		<style>
			.fontEffect{
				font-family: "Arapey", serif;
			}
			.menu {
				margin-bottom: 15px;
				max-width: 500px;
    			margin: 0 auto;
			}
			.menu_restName {
				text-align: center;
    			font-size: 70px;
    			margin-top: 0;
			}
			.menu_title {
				text-align: center;
			}
			.menu_section {
				margin-bottom: 30px;
			}
			.menu_section h3 {
				font-style: italic;
			}
			.menu_item {
				margin: 0 15px;
				position: relative;
			}
			.menu_item h4 {
				margin-bottom: 0px;
			}
			.price {
				display: block;
				float: right;
				position: absolute;
				bottom: 0px;
				right: 0;
				/*background-color: white;*/
				font-weight: bold;
			}
			.description {
				margin-top: 5px;
				font-style: italic;
				/*background-color: white;*/
				display: inline-block;
				max-width: 50%;
			}
			hr {
				border: none;
    			border-top: 1px dotted white;
    			margin-top: -20px;
			}
			footer:not(.app-footer) {
				text-align: center;
    			font-size: 11px;
				font-style: italic;
			}
			@media (max-width: 575px) {
				.menu_title {
					text-align: center;
					font-size: 30px;
				}
				.menu_section h3 {
					text-align: center;
    				font-size: 30px;
				}
				.menu_item {
					text-align: center;
				}
				.price {
					float: none;
					position: static;
					margin-top: 15px;
				}
				hr {
					display: none;
				}
			}
		</style>
<section class="menu fontEffect">
	<h1 class="menu_restName">Welcome !</h1>
	<h2 class="menu_title">Notre menu</h2>
	<div class="menu_section ">
		<h3>Nos Pizzas</h3>

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
				foreach($res as $row){
					echo '<div class="menu_item ">';
					echo '<h4 class="name">'.htmlspecialchars($row["nom"]).'</h4>';
					echo '<span class="price">'.htmlspecialchars($row["prix"]).'€</span>';
					// Si on avait "DESCRIPTION DE LA PIZZA" dans la base de données
					// echo '<p class="description">'.$row["description"].'</p>';
					echo '<p class="description">Description de : '.htmlspecialchars($row["nom"]).'</p>';
					echo '<hr>';
					echo '</div>';
				}
				$res->closeCursor();
				echo '</div>';
				echo '<div class="menu_section ">';
				echo '<h3>Supplements</h3>';
				foreach($res2 as $row2){
					echo '<div class="menu_item ">';
					echo '<h4 class="name">'.htmlspecialchars($row2["nom"]).'</h4>';
					echo '<span class="price">'.htmlspecialchars($row2["prix"]).'€</span>';
					// Si on avait "DESCRIPTION du SUPPLEMENT" dans la base de données
					// echo '<p class="description">'.$row["description"].'</p>';
					echo '<p class="description">Description de : '.htmlspecialchars($row2["nom"]).'</p>';
					echo '<hr>';
					echo '</div>';
				}
				$res2->closeCursor();
				echo '</div>';
				echo '</section>';
			}
	}
		catch(Exception $e){
			die('Erreur : '.$e->getMessage());
		}
?>
