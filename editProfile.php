			    <link rel="stylesheet" href="css/formAlign.css">

			<?php
			require("auth/EtreAuthentifie.php");

				if (isset($_POST['goback'])) header("Location: home.php");
				$active = "editProfile";
				include("header.php");
				include("footer.php");
				require ("db_config.php");
				try
				{
					$uid=$idm->getUid();

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
						$hash = htmlspecialchars($row['mdp']);
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
								Old password : <br><input type="password" name="oldPassword" placeholder="Old password" autocomplete="off" required><br>
							</div>							
							<div class="form-group">
								New password : <br><input type="password" name="password" placeholder="Enter password" autocomplete="off" required><br>
								<small>Password must be changed !</small>
							</div>
							<div class="form-group">
								<input style="margin-bottom:10px;" class="btn btn-outline-warning" type="submit" name="updateOldUser" value="Apply !">
								<input style="margin-bottom:10px;" class="btn btn-outline-success" type="submit" name="goback" value="Go back" formnovalidate>
							</div>	
						</form></center>
					</div>


					<?php
					
					if (isset($_POST['updateOldUser']) && isset($_POST['fname']) && isset($_POST['lname']) && isset($_POST['uid']) && isset($_POST['login']) && isset($_POST['password']) && !empty('password') && isset($_POST['oldPassword']) && !empty('oldPassword')){
						$uid = htmlspecialchars($_POST['uid']);
						$fname = htmlspecialchars($_POST['fname']);
						$lname = htmlspecialchars($_POST['lname']);
						$login = htmlspecialchars($_POST['login']);
						$password = htmlspecialchars(password_hash($_POST['password'], PASSWORD_DEFAULT));
						
						if (password_verify($_POST['oldPassword'], $hash)){
							$req = $db->prepare('UPDATE users SET nom = :fname, prenom=:lname, login=:login, mdp=:password WHERE uid = :uid');
							$req->execute(array(
								'uid' => $uid,
								'fname' => $fname,
								'lname' => $lname,
								'login' => $login,
								'password' => $password
							));
							$req->closecursor();
							// header("Location: editSupplement.php");
							echo "<meta http-equiv='refresh' content='1'>";
							echo "UPDATED !";
							$auth->clear();
							$idm->clear();
						}
						else{
							echo "Old password doesnt match !";
						}
					}

			}
			catch(Exception $e)
			{
				die('Erreur : '.$e->getMessage());
			}

			?>
<style>body{
                        <?php
                        	if ($idm->getRole()=="admin"){
                        ?>
                        	background-image:  url("images/bg_4.jpg");
                    	<?php
                    		}
                    		else if ($idm->getRole()=="user"){
                    	?>
			   				 background-image: linear-gradient(rgba(0, 0, 0, 0.5),rgba(0, 0, 0, 0.5)), url('images/bg_1.jpg');
                    		<?php
                    	}
                    	?>

                        height: 100%;
                        background-position: center;
                        background-repeat: no-repeat;
                        background-size: cover;
                        background-attachment: fixed;
                        color:white;
                    }
                </style>