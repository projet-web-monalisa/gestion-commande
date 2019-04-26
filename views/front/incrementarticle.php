<?php
require 'C:/wamp64/www/monprojet/core/classpanier.php';
$panier=creationPanier();
$idProduit=$_GET['idProduit'];
$pos=array_search($idProduit,$_SESSION['panier']['idProduit']);
$quantite=$_SESSION['panier']['quantite'][$pos];
//echo ":".$quantite;
$quantite++;
//echo ":".$quantite;
modifierQTeArticle($idProduit,$quantite);
header('Location: cart.php');  
?>