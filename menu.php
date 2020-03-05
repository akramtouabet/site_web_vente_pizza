<?php
require("auth/EtreAuthentifie.php");
$active="menuList";
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
		  width:600px;
		  padding-top:5%;
		  padding-bottom:5%;
		  margin-bottom:5%;
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
						include("menu_form.php");
					?>
					<center><a href="order.php"><button type="button" class="btn btn-outline-light btn-lg">Go ahead !</button></a></center>
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