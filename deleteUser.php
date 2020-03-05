<?php
	require("auth/EtreAuthentifie.php");
	if ($idm->getRole() == 'admin')
	{
		require ("db_config.php");
		$uid = htmlspecialchars($_GET['uid']);
		if ($uid==1 || $uid==$idm->getUid()) header("Location: editUsers.php");
		else{
			$requete = $db->prepare("DELETE FROM users WHERE uid=:uid");
			$requete->execute(array("uid"=>$uid));
			$requete->closecursor();
			header("Location: editUsers.php");
		}
	}
?>

