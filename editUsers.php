<?php
	require("auth/EtreAuthentifie.php");
	if ($idm->getRole() == 'admin')
	{
		include("editUsers_form.php");
		require ("db_config.php");
		try
		{
			//echo $_SESSION['uid']=$idm->getUid();
			//$hashed_password = password_hash("admin", PASSWORD_DEFAULT);
			$db = new PDO($dsn, $username, $password);
			$db-> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "Select * FROM users";
			$res=$db->query($sql);
			if ($res->rowCount()==0)
			{
				echo "Nothing found !";
			}
			else{
				echo '<center><table id="paginationTable" style="width: 90%; margin-top: 2%;" class="table editable_table table-striped table-dark">';
				echo "<thead>";
				echo "<tr>";
				echo '<th scope="col">UID</th>';
				echo '<th scope="col">Nom</th>';
				echo '<th scope="col">Prenom</th>';
				echo '<th scope="col">Login</th>';
				echo '<th scope="col">Password</th>';
				echo '<th scope="col">Role</th>';
				echo '<th scope="col">Actions</th>';
				echo "</tr>";
				echo "</thead>";
				echo "<tbody>";
				foreach($res as $row)
				{
					echo "<tr>";
					echo '<td scope="row">'.htmlspecialchars($row["uid"])."</td>";
					echo "<td>".htmlspecialchars($row["nom"])."</td>";
					echo "<td>".htmlspecialchars($row["prenom"])."</td>";
					echo "<td>".htmlspecialchars($row["login"])."</td>";
					echo "<td> ************ </td>";
					echo "<td data-target='role'>".htmlspecialchars($row["role"])."</td>";
					echo "<td><a class='btn btn-danger btn-sm' role='button' href=\"deleteUser.php?uid=".htmlspecialchars($row['uid'])."\">Delete</a> <a style=' margin-left:10px;'class='btn btn-info btn-sm' role='button' name='updateOldUser' href=\"updateUser.php?uid=".htmlspecialchars($row['uid'])."\">Update</a></td>";
					echo "</tr>";	
					
				}
				$res->closeCursor();
				echo "</tbody>";
				echo "</table></center>";
				
				?>
				<center>
					<form action="editUsers.php" method="post"> 
						<input style="margin-bottom:10px;" class="btn btn-outline-warning" type="submit" name="addNewUser" value="Add user"> <br>
					</form>
				<?php
					
				if (isset($_POST['addNewUser'])){
				?>
					<div align="left" class="formulaire">
						<center><form action="editUsers.php" method="post">
							<div class="form-group">
								<input type="text" name="nom" placeholder="Last name">
							</div>
							<div class="form-group">
								<input type="text" name="prenom" placeholder="First name">
							</div>
							<div class="form-group">
								<input type="text" name="login" placeholder="Login">
							</div>
							<div class="form-group">
								<input type="password" name="motdepasse" placeholder="Password">
							</div>
							<div class="form-group">
								<select name="role">
									<option value="user">user</option>
									<option value="admin">admin</option>
								</select>
							</div>
							<div class="form-group">
								<input type="submit" class="btn btn-outline-primary" name="addNewUser" value="Add !">
							</div>
						</form></center>
					</div>
				<?php
					}
					
			if (isset($_POST['addNewUser']) && isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['login']) && isset($_POST['motdepasse']) && !empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['login']) && !empty($_POST['motdepasse'])) 
			{
		 		$requete = $db->prepare('INSERT INTO users(nom, prenom, login, mdp, role) VALUES(:lname, :fname, :login, :password, :role)');
		 		$requete->execute(array(
					'lname' => $_POST['nom'],
					'fname' => $_POST['prenom'],
					'login' => $_POST['login'],
					'password' => password_hash($_POST['motdepasse'], PASSWORD_DEFAULT),
					'role' => $_POST['role']
				));
				$requete->closecursor();
				echo "<meta http-equiv='refresh' content='0'>";
			}
			}
		}
		catch(Exception $e)
		{
			die('Erreur : '.$e->getMessage());
		}
	}
	else{
		echo "FUCK OFF";
	}
?>
