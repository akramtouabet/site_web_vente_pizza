<?php
	require("auth/EtreAuthentifie.php");
	if ($idm->getRole() == 'user')
	{
		require ("db_config.php");
		$cid = htmlspecialchars($_GET['cid']);
			$requete = $db->prepare("DELETE FROM commandes WHERE cid=:cid");
			$requete->execute(array("cid"=>$cid));
			$requete->closecursor();
			header("Location: myOrders.php");
	}
?>

