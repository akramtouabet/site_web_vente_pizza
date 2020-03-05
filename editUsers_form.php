<?php
$active='editUsers';

$title = $active;
include("header.php");
?>

<!-- 
<a href="<?= $pathFor['logout'] ?>" title="Logout">Logout</a>
-->
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
<?php

//echo "Hello " . $idm->getIdentity().". Your uid is: ". $idm->getUid() .". Your role is: ".$idm->getRole() . "\n";





//echo "Escaped values: ".$e_($ci->idm->getIdentity());


include("footer.php");