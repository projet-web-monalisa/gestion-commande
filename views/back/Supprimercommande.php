<?php

require 'C:/wamp64/www/monprojet/core/commandeC.php';
$id=$_GET['id'];
$cc=new commandeC();
$cc->SupprimerCommande($id);
header('Location: commande.php');  
?>