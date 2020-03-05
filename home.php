<?php
$active='home';
require("auth/EtreAuthentifie.php");

$title = 'Accueil';
?>

<!-- 
<a href="<?= $pathFor['logout'] ?>" title="Logout">Logout</a>
-->

<?php

//echo "Hello " . $idm->getIdentity().". Your uid is: ". $idm->getUid() .". Your role is: ".$idm->getRole() . "\n";

if ($idm->getRole() == 'admin')
	include("admin.php");
else if ($idm->getRole() == 'user')
	include("user.php");

//echo "Escaped values: ".$e_($ci->idm->getIdentity());


include("footer.php");