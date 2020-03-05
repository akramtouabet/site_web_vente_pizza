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
	.herobtn{
		display:block;
		margin-top:50px;
		margin-left:auto;
		margin-right:auto;
		text-decoration:none;
		border-radius:20px;
	}
	.hero{
		/* width:100%;
		height:100%; */		
		display: flex;
   		justify-content: center;
    	align-items: center;
    	text-align:center;
    	margin-top:4%;
	}
	.hero h1{
		margin-top:0em;
		margin-bottom:0.5em;
		font-size: 4em;
	}
	@media only screen and (max-width: 575px) {

	   .hero h1{ 
	      font-size: 300%; 
	   }

	}

</style>
</head>
<body>

	<?php
	$active="home";
		if ($idm->getRole() == 'user'){ 
			?>
			<section class="hero">
	     		<div class="hero-inner">
					<h1>
						<span class='changedFont'>Welcome to</span><br>
						<span class='changedFontTitle'> PizzaDELICIOUS</span><br>
						<span class='changedFont'>official website !</span>
					</h1>
					<h2 class='changedFont' style='font-size:1.5em;'>
						The right place where you can eat THE PIZZA !
					</h2>
				</div>
			</section>
			<a href="menu.php" style="color: inherit; text-decoration:none;"><button type="button" class="btn btn-outline-warning herobtn">Let's check the menu</button></a>
				<?php
			}
			else if ($idm->getRole() == 'admin'){
				echo "ADMINS !!! NO FUCKING ADMINS !!!";
			}

			include("footer.php");
			?>
</body>
