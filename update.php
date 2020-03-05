<?php
	require("auth/EtreAuthentifie.php");
	if ($idm->getRole() == 'admin')
	{
		require ("db_config.php");
		$uid = htmlspecialchars($_GET['uid']);
		if ($uid==1) header("Location: editUsers.php");
		else{
			$requete = $db->prepare("UPDATE users SET nom=:lname, prenom=fname, login=:login, mdp=:password, role=:role WHERE uid=:uid");
			$requete->execute(array(
				'lname' => $_POST['nom'],
				'fname' => $_POST['prenom'],
				'login' => $_POST['login'],
				'password' => password_hash($_POST['motdepasse'], PASSWORD_DEFAULT),
				'role' => $_POST['role'],
				'uid' => $uid
			));
			$requete->closecursor();
			header("Location: editUsers.php");
		}
	}
?>