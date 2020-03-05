<style>body{
                background-image:  url("images/bg_4.jpg");
                height: 100%;
                background-position: center;
                background-repeat: no-repeat;
                background-size: cover;

            }
            h2{
                color:#fac564;
            }
            label{
                color:white;
            }
        </style>
<?php
$title="Authentification";
include("header.php");

echo "<p class=\"error\">".($error??"")."</p>";
?>
<link rel="stylesheet" href="css/style.css" />
    <div class='center'>
        <h2 style="padding-bottom:2%; padding-top: 12%; font-family: 'Antic Didone', serif;">Login</h2>
                    <form method="post">
                        <!--legend>Authentifiez-vous</legend-->
                        <table class="center">
                            <tr>
                            <td><label for="inputNom" class="control-label">Login </label></td>
                            <td><input type="text" name="login" size="20" class="form-control" id="inputLogin" required placeholder="login"
                                   required value="<?= $data['login']??"" ?>"></td>
                            </tr>
                            <tr>
                            <td><label for="inputMDP" class="control-label">MDP </label> </td>
                            <td><input type="password" name="password" size="20" class="form-control" required id="inputMDP"
                                   placeholder="Mot de passe"></td>
                            </tr>
                        </table>
                        <div class="form-group">
                            <br>
                            <button type="submit" class="btn btn-primary">Connexion</button>
                            <span class="pull-right"><a style="font-family: 'Dosis', sans-serif; font-size: 20px;" href="<?= $pathFor['adduser'] ?>">Inscription</a></span>
                        </div>
                    </form>
    </div>
<?php

include("footer.php");