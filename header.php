        <!DOCTYPE html>
        <html>
        <head>
          
          <meta charset="utf-8"/>
          <meta http-equiv="X-UA-Compatible" content="IE=edge">
          <meta name="viewport" content="width=device-width, initial-scale=1">
          
        <title><?= $title??"" ?></title>

            <style>
                .center { text-align: center }
                .center table {margin-left:auto; margin-right:auto;}
                .left {text-align: right}
                .right {text-align: left}
                .error {color: red;}
                .active a{color: #fac564 !important;}
            </style>

        	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
            <link href="https://fonts.googleapis.com/css?family=Antic+Didone" rel="stylesheet">
        	<link href="https://fonts.googleapis.com/css?family=Exo" rel="stylesheet">
            <link rel="stylesheet" href="css/flaticon.css">
            <link rel="stylesheet" href="css/icomoon.css">	<link href="https://fonts.googleapis.com/css?family=Dosis" rel="stylesheet">
        	<link rel="stylesheet" href="css/style.css">
            <link rel="stylesheet" href="css/numberArrows.css">
        </head>

        <body>
            <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-dark footer-size" id="ftco-navbar">
            <div class="container">
                <a class="navbar-brand" href="index.php">Pizza<br><small>Delicous</small></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="oi oi-menu"></span>Menu</button>
               	  <div class="collapse navbar-collapse" id="ftco-nav">
                  	<ul class="navbar-nav ml-auto">
        	            <li <?php if($active == 'home'){echo 'class="active"';} ?> class="nav-item"><a href="home.php" class="nav-link">Home</a></li>
        	            <?php
        	            	if (!$idm->hasIdentity()) {
        				?>
        				<li <?php if($active == 'login'){echo 'class="active"';} ?> class="nav-item "><a href="login.php" class="nav-link">Login</a></li>
        	            <li <?php if($active == 'signup'){echo 'class="active"';} ?> class="nav-item "><a href="adduser.php" class="nav-link">Signup</a></li>
        				<?php
        					}
        	            ?>
        	            <?php
        	              if ($idm->hasIdentity()) {
        				?>
        				<?php
        					if ($idm->getRole() == 'admin'){
        				?>
        				<li <?php if($active == 'editPizza'){echo 'class="active"';} ?> class="nav-item"><a href="editPizza.php" class="nav-link">Pizza list</a></li>
        				<li <?php if($active == 'editSupplement'){echo 'class="active"';} ?> class="nav-item"><a href="editSupplement.php" class="nav-link">Supplement list</a></li>
        				<li <?php if($active == 'editOrders'){echo 'class="active"';} ?> class="nav-item"><a href="editOrders.php" class="nav-link">Orders list</a></li>
        				<li <?php if($active == 'editUsers'){echo 'class="active"';} ?> class="nav-item"><a href="editUsers.php" class="nav-link">Users list</a></li>
        				<?php
        					}
                            if ($idm->getRole() == 'user'){
                        ?>
                        <li <?php if($active == 'menuList'){echo 'class="active"';} ?> class="nav-item"><a href="menu.php" class="nav-link">Menu</a></li>
                        <li <?php if($active == 'orderMeal'){echo 'class="active"';} ?> class="nav-item"><a href="order.php" class="nav-link">Order</a></li>
                        <li <?php if($active == 'myOrders'){echo 'class="active"';} ?> class="nav-item"><a href="myOrders.php" class="nav-link">My orders</a></li>
                        <?php
                            }
                        ?>
                        <li <?php if($active == 'editProfile'){echo 'class="active"';} ?> class="nav-item"><a href="editProfile.php" class="nav-link">Edit profile</a></li>
                        
        				<li class="nav-item"><a href="<?= $pathFor['logout'] ?>" title="Logout" class="nav-link">Logout</a></li>
        				<?php
        					}
        				?>
                  </ul>
                </div>
              </div>
            </nav>


                <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
                <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<!--
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
-->