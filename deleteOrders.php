<?php
	require("auth/EtreAuthentifie.php");
	if ($idm->getRole() == 'admin')
	{
		require ("db_config.php");
		$cid = htmlspecialchars($_GET['cid']);
			$requete = $db->prepare("DELETE FROM commandes WHERE cid=:cid");
			$requete->execute();
			$requete->closecursor();
			header("Location: editOrders.php");
	}
?>

