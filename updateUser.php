			    <link rel="stylesheet" href="css/formAlign.css">

			<?php
			require("auth/EtreAuthentifie.php");
			if ($idm->getRole() == 'admin')
			{
				if (isset($_POST['goback'])) header("Location: editUsers.php");
				$active = "editUsers";
				include("header.php");
				include("footer.php");
				require ("db_config.php");
				try
				{
				if (isset($_GET['uid'])){
					$uid = htmlspecialchars($_GET['uid']);

					$db = new PDO($dsn, $username, $password);
					$db-> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					$sql = "Select * FROM users WHERE uid = $uid";
					$res=$db->query($sql);
					if ($res->rowCount()==0)
					{
						echo "Nothing found !";
					}
					else{
						foreach($res as $row)
						$lname_b=htmlspecialchars($row['nom']);
						$fname_b=htmlspecialchars($row['prenom']);
						$login_b=htmlspecialchars($row['login']);
						$role_b=htmlspecialchars($row['role']);
					}
					$res->closeCursor();
					?><div align="left" class="formulaire">
						<center><form action="" method="POST" autocomplete="off">
						
							<div class="form-group">
								UID : <br><input type="text" name="uid" readonly value="<?php echo $uid ?>">
							</div>
							<div class="form-group">
								First name : <br><input type="text" name="fname" placeholder="Enter first name" value="<?php echo $fname_b ?>">
							</div>
							<div class="form-group">
								Last name : <br><input type="text"" name="lname" placeholder="Enter last name" value="<?php echo $lname_b ?>">	
							</div>
							<div class="form-group">
								login : <br><input type="text" name="login" placeholder="Enter login" value="<?php echo $login_b ?>">
							</div>
							<div class="form-group">
								Password : <br><input type="password" name="password" placeholder="Enter password" autocomplete="off" required><br>
								<small>Password must be changed !</small>
							</div>
							<div class="form-group">
								Role : 	<select name="role">
											<option value="user" <?php if ($role_b=="user") echo "selected" ?>>user</option>
											<option value="admin" <?php if ($role_b=="admin") echo "selected" ?>>admin</option>
										</select>
							</div>
							<div class="form-group">
								<input style="margin-bottom:10px;" class="btn btn-outline-warning" type="submit" name="updateOldUser" value="Apply !">
								<input style="margin-bottom:10px;" class="btn btn-outline-success" type="submit" name="goback" value="Go back" formnovalidate>
							</div>	
						</form></center>
					</div>


					<?php
					
					if (isset($_POST['updateOldUser']) && isset($_POST['fname']) && isset($_POST['lname']) && isset($_POST['uid']) && isset($_POST['login']) && isset($_POST['password']) && isset($_POST['role']) && !empty('password')){
						$uid = htmlspecialchars($_POST['uid']);
						$fname = htmlspecialchars($_POST['fname']);
						$lname = htmlspecialchars($_POST['lname']);
						$login = htmlspecialchars($_POST['login']);
						$password = htmlspecialchars(password_hash($_POST['password'], PASSWORD_DEFAULT));
						$role = htmlspecialchars($_POST['role']);
						$req = $db->prepare('UPDATE users SET nom = :fname, prenom=:lname, login=:login, mdp=:password, role=:role WHERE uid = :uid');
						$req->execute(array(
							'uid' => $uid,
							'fname' => $fname,
							'lname' => $lname,
							'login' => $login,
							'password' => $password,
							'role' => $role
						));
						$req->closecursor();
						echo "<meta http-equiv='refresh' content='1'>";
						echo "UPDATED !";
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

<style>body{
					

						background-image:  url("images/bg_4.jpg");
                        height: 100%;
                        background-position: center;
                        background-repeat: no-repeat;
                        background-size: cover;
                        background-attachment: fixed;
                        color:white;
                    }
                </style>