<?php
include("auth/EtreInvite.php");
if ($idm->hasIdentity()) {
    http_response_code(403);
    header("Location: home.php\n\n");
};
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Pizza DELICIOUS</title>
        <?php
        $active='';
    include("header.php");
    ?>
       	<style>body{
			    background-image:  url("images/bg.jpg");
			    height: 100%;
				background-position: center;
			  	background-repeat: no-repeat;
			  	background-size: cover;

			}
		</style>
    </head>
    <body onselectstart="return false" oncontextmenu="return false" ondragstart="return false" ; return true;" >

<div class="hero-background">
  <div class="hero-text">
    <h1 style="font-family: 'Antic Didone', serif;">Pizza DELICIOUS</h1>
    <p style="font-family: 'Exo', serif;">Designed by : Akram TOUABET</p>
    <a href="adduser.php"><button type="button" class="btn btn-outline-danger btn-lg">Signup</button></a>
    <a href="login.php"><button type="button" class="btn btn-outline-info btn-lg">Login</button></a>
  </div>
</div> 
<?php
    include("footer.php");
    ?>
    </body>
</html>
