<style>body{
                background-image:  url("images/bg_4.jpg");
                        height: 100%;
                        background-position: center;
                        background-repeat: no-repeat;
                        background-size: cover;
                        background-attachment: fixed;
                        color:white;

            }
            h2, h1{
                color:#fac564;
            }
            label{
                color:white;
            }
        </style>
<?php
$title="Ajout de l'utilisateur";
include("header.php");
?>
<link rel="stylesheet" href="css/style.css" />
<p class="error"><?= $error??""?></p>
<div class="center">
    <h1 style="padding-bottom:2%; padding-top: 12%; font-family: 'Antic Didone', serif;">Inscription</h1>
    <form method="post">
                    <!--legend>Inscription</legend-->
        <table>
                    <tr>
                        <td><label for="inputNom" class="control-label">Nom</label></td>
                         <td><input type="text" name="nom" class="form-control" id="inputNom" placeholder="Nom" required value="<?= $data['nom']??""?>">
                         </td>
                    </tr>
                    <tr>
                       <td> <label for="inputPrenom" class="control-label">Prénom</label></td>
                          <td>  <input type="text" name="prenom" class="form-control" id="inputPrenom" placeholder="Prénom" required aria-required="true" value="<?= $data['prenom']??""?>"></td>
                    </tr>
                    <tr>
                        <td><label for="inputLogin" class="control-label">Login</label></td>
                            <td><input type="text" name="login" class="form-control" id="inputLogin" placeholder="login" required value="<?= $data['login']??""?>"></td>
                    </tr>
                    <tr>
                        <td><label for="inputMDP" class="control-label">MDP</label></td>
                            <td><input type="password" name="mdp" class="form-control" id="inputMDP" placeholder="Mot de passe" required value=""></td>
                    </tr>
                    <tr>
                        <td><label for="inputMDP2" class="control-label">Répéter MDP</label></td>
                            <td><input type="password" name="mdp2" class="form-control" id="inputMDP" placeholder="Répéter le mot de passe" required value=""></td>
                    </tr>
        </table>
                    <div class="form-group">
                        <br>
                            <button type="submit" class="btn btn-primary">S'enregistrer</button>
                            <button type="reset" class="btn btn-secondary">Réinitialiser</button>
                    </div>
    </form>
    </div>
<?php

include("footer.php");