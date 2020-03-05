			<link rel="stylesheet" href="css/formAlign.css">
			<?php
			require("auth/EtreAuthentifie.php");
			if ($idm->getRole() == 'admin')
			{
				if (isset($_POST['goback'])){
						header("Location: editPizza.php");
					}
				$active="editPizza";
				include("header.php");
				include("footer.php");
				require ("db_config.php");
				try
				{
				if (isset($_GET['rid'])){
					$rid = htmlspecialchars($_GET['rid']);
					$db = new PDO($dsn, $username, $password);
					$db-> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					$sql = "Select * FROM recettes WHERE rid = $rid";
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
							RID : <br><input type="text" name="rid" readonly value="<?php echo $rid ?>">
						</div>
						<div class="form-group">
							Name : <br><input type="text" name="name" placeholder="Enter name" value="<?php echo $name_b ?>">
						</div>
						<div class="form-group">
							Price : <br><input type="number" step="0.01" name="price" placeholder="Enter price" value="<?php echo $price_b ?>">
							</div>
							<div class="form-group">						
								<input style="margin-bottom:10px;" class="btn btn-outline-warning" type="submit" name="updateOldPizza" value="Apply !">
								<input style="margin-bottom:10px;" class="btn btn-outline-success" type="submit" name="goback" value="Go back">
							</div>
						</form></center>
					</div>
					<?php
					
					if (isset($_POST['updateOldPizza']) && isset($_POST['name']) && isset($_POST['price']) && isset($_POST['rid'])){
						$r = htmlspecialchars($_POST['rid']);
						$n = htmlspecialchars($_POST['name']);
						$p = htmlspecialchars($_POST['price']);
						$req = $db->prepare('UPDATE recettes SET prix = :nvprix, nom = :nvnom WHERE rid = :rid');
						$req->execute(array(
							'nvnom' => $n,
							'nvprix' => $p,
							'rid' => $r
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