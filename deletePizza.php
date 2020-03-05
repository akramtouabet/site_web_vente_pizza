<?php
	require("auth/EtreAuthentifie.php");
	if ($idm->getRole() == 'admin')
	{
		require ("db_config.php");
		$rid = htmlspecialchars($_GET['rid']);
			$requete = $db->prepare("DELETE FROM recettes WHERE rid=:rid");
			$requete->execute();
			$requete->closecursor();
			header("Location: editPizza.php");
	}
?>

