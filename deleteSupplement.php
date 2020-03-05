<?php
	require("auth/EtreAuthentifie.php");
	if ($idm->getRole() == 'admin')
	{
		require ("db_config.php");
		$sid = htmlspecialchars($_GET['sid']);
			$requete = $db->prepare("DELETE FROM supplements WHERE sid=:sid");
			$requete->execute(array("sid"=>$sid));
			$requete->closecursor();
			header("Location: editSupplement.php");
	}
?>

