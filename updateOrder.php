<?php
	require("auth/EtreAuthentifie.php");
	if ($idm->getRole() == 'admin')
	{
		require ("db_config.php");
		$cid = htmlspecialchars($_GET['cid']);
			$requete = $db->prepare("UPDATE commandes SET statut = 'terminee' WHERE cid='".$cid."'");
			$requete->execute();
			$requete->closecursor();
			header("Location: editOrders.php");
	}
?>

