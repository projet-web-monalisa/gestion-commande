<?php
require 'C:/wamp64/www/monprojet/core/classpanier.php';

$idProduit=$_GET['idProduit'];
supprimerArticle($idProduit);
header('Location: cart.php');  
?>