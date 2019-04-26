<?php
require 'C:/wamp64/www/monprojet/core/classpanier.php';

$panier=creationPanier();
$id=$_GET['id'];
$result=recupererProduit($id);
foreach($result as $produit) {
          $id= $produit->idProduit; 
            $nom=$produit->nom;
            $prix=$produit->prix;
             $quantite=1;
          } 

ajouterArticle($id,$quantite,$prix,$nom);

  //$refes=array_keys($_SESSION['panier']['idProduit']);
     // var_dump($refes);
     // var_dump($_SESSION['panier']['idProduit']);
//var_dump($_SESSION);

die('le produit a bien ete ajouter dans le panier <a href="index.php"> retourner </a>');

?>