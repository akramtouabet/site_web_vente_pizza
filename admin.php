
<?php
include("header.php");
?>
<style>body{
                        background-image:  url("images/bg_4.jpg");
                        height: 100%;
                        background-position: center;
                        background-repeat: no-repeat;
                        background-size: cover;
                        background-attachment: fixed;
                        color:white;
                    }
                </style>
<?php
if ($idm->getRole() == 'admin')
	echo "<br><br><br><br><h1><center>WELCOME TO THE<br>ADMIN PAGE, ". $idm->getIdentity() ."!</center></h1>";

else if ($idm->getRole() == 'user'){
	echo "RIGHTS !!! NO FUCKING RIGHTS !!!";


?>
<a href="<?= $pathFor['logout'] ?>" title="Logout">Logout</a>
<?php
}

include("footer.php");