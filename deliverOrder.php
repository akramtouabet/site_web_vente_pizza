<?php
	require("auth/EtreAuthentifie.php");
	if ($idm->getRole() == 'admin')
	{
		require ("db_config.php");
		$cid = htmlspecialchars($_GET['cid']);
			$requete = $db->prepare("UPDATE commandes SET statut = 'livraison' WHERE cid=:cid");
			$requete->execute(array("cid"=>$cid));
			$requete->closecursor();
			header("Location: editOrders.php");
	}
?>
