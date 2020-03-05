			<link rel="stylesheet" href="css/formAlign.css">
			<?php
			require("auth/EtreAuthentifie.php");
			if ($idm->getRole() == 'admin')
			{
				if (isset($_POST['goback'])) header("Location: editSupplement.php");
				$active="editSupplement";
				include("header.php");
				include("footer.php");
				require ("db_config.php");
				try
				{
				if (isset($_GET['sid'])){
					$sid = htmlspecialchars($_GET['sid']);
					$db = new PDO($dsn, $username, $password);
					$db-> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					$sql = "Select * FROM supplements WHERE sid = $sid";
					$res=$db->query($sql);
					if ($res->rowCount()==0)
					{
						echo "Nothing found !";
					}
					else{
						foreach($res as $row)
						$name_b=htmlspecialchars($row['nom']);
						$price_b=htmlspecialchars($row['prix']);
					}
					$res->closeCursor();
					?>
					<div align="left" class="formulaire">
						<center><form action="" method="POST" style="margin-top: 11%;">
							<div class="form-group">
							SID : <br><input type="text" name="sid" readonly value="<?php echo $sid ?>">
						</div>
						<div class="form-group">
							Name : <br><input type="text" name="name" placeholder="Enter name" value="<?php echo $name_b ?>">
						</div>
						<div class="form-group">
							Price : <br><input type="number" step="0.01" name="price" placeholder="Enter price" value="<?php echo $price_b ?>">
							</div>
							<div class="form-group">						
								<input style="margin-bottom:10px;" class="btn btn-outline-warning" type="submit" name="updateOldSupplement" value="Apply !">
								<input style="margin-bottom:10px;" class="btn btn-outline-success" type="submit" name="goback" value="Go back">
							</div>
						</form></center>
					</div>

					<?php
					if (isset($_POST['updateOldSupplement']) && isset($_POST['name']) && isset($_POST['price']) && isset($_POST['sid'])){
						$s = htmlspecialchars($_POST['sid']);
						$n = htmlspecialchars($_POST['name']);
						$p = htmlspecialchars($_POST['price']);
						$req = $db->prepare('UPDATE supplements SET prix = :nvprix, nom = :nvnom WHERE sid = :sid');
						$req->execute(array(
							'nvnom' => $n,
							'nvprix' => $p,
							'sid' => $s
						));
						$req->closecursor();
						echo "<meta http-equiv='refresh' content='2'>";
						echo "UPDATED ";
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