<?php
require_once 'C:/wamp64/www/monprojet/config.php';
function creationPanier(){
   if (!isset($_SESSION))
      {
         session_start();
      }
   if (!isset($_SESSION['panier'])){
      $_SESSION['panier']=array();
      $_SESSION['panier']['idProduit'] = array();
      $_SESSION['panier']['quantite'] = array();
      $_SESSION['panier']['prix'] = array();
      $_SESSION['panier']['nomProduit'] = array();
      $_SESSION['panier']['verrou'] = false;
   }
   return true;
}
function ajouterArticle($idProduit,$quantite,$prix,$nomProduit){

   //Si le panier existe
   if (creationPanier() && !isVerrouille())
   {
      //Si le produit existe déjà on ajoute seulement la quantité
      $positionProduit = array_search($idProduit,  $_SESSION['panier']['idProduit']);

      if ($positionProduit !== false)
      {  
            $_SESSION['panier']['quantite'][$positionProduit]+= $quantite ;
      }
      else
      {
         //Sinon on ajoute le produit
         array_push( $_SESSION['panier']['idProduit'],$idProduit);
         array_push( $_SESSION['panier']['quantite'],$quantite);
         array_push( $_SESSION['panier']['prix'],$prix);
          array_push( $_SESSION['panier']['nomProduit'],$nomProduit);
      }
   }
   else
   echo "Un problème est survenu veuillez contacter l'administrateur du site.";
}


function isVerrouille(){
   if (isset($_SESSION['panier']) && $_SESSION['panier']['verrou'])
   return true;
   else
   return false;
}

function supprimerArticle($idProduit){
   //Si le panier existe
   if (creationPanier() && !isVerrouille())
   {
      //Nous allons passer par un panier temporaire
      $tmp=array();
      $tmp['idProduit'] = array();
      $tmp['quantite'] = array();
      $tmp['prix'] = array();
      $tmp['nomProduit'] = array();
      $tmp['verrou'] = $_SESSION['panier']['verrou'];

      for($i=0; $i < count($_SESSION['panier']['idProduit']); $i++)
      {
         if ($_SESSION['panier']['idProduit'][$i] !== $idProduit)
         {
            array_push( $tmp['idProduit'],$_SESSION['panier']['idProduit'][$i]);
            array_push( $tmp['quantite'],$_SESSION['panier']['quantite'][$i]);
            array_push( $tmp['prix'],$_SESSION['panier']['prix'][$i]);
            array_push( $tmp['nomProduit'],$_SESSION['panier']['nomProduit'][$i]);
         }

      }
      //On remplace le panier en session par notre panier temporaire à jour
      $_SESSION['panier'] = $tmp;
      //On efface notre panier temporaire
      unset($tmp);
   }
   else
   echo "Un problème est survenu veuillez contacter l'administrateur du site.";
}

function recupererProduit($id){
      $sql="SELECT * from produit where idproduit=$id";
      $db = config::getConnexion();
      try{
      $req=$db->prepare($sql);
       $req->execute();
      $produit= $req->fetchALL(PDO::FETCH_OBJ);
      return $produit;
      }
        catch (Exception $e){
            die('Erreur: '.$e->getMessage());
        }
     }
function recupererProduitduPannier(){
      
       $idproduits=array_values($_SESSION['panier']['idProduit']);

      $ids = join("','",$idproduits);   
      $sql="SELECT * from produit where idProduit IN ('$ids') ";
      $db = config::getConnexion();
      try{
      $req=$db->prepare($sql);
       $req->execute();
      $Listproduit= $req->fetchALL(PDO::FETCH_OBJ);
      return $Listproduit;
      }
        catch (Exception $e){
            die('Erreur: '.$e->getMessage());
        }

}
function modifierQTeArticle($idProduit,$quantite){
   //Si le panier éxiste
   
   if (creationPanier() && !isVerrouille())
   { 
      //Si la quantité est positive on modifie sinon on supprime l'article
      if ($quantite > 0)
      {
         $positionProduit = array_search($idProduit,$_SESSION['panier']['idProduit']);
         if ($positionProduit !== false)
         {  
            $_SESSION['panier']['quantite'][$positionProduit] = $quantite ;
         }
      }
      else
      supprimerArticle($idProduit);
   }
   else
   echo "Un problème est survenu veuillez contacter l'administrateur du site.";
}
function MontantGlobal(){
   $total=0;
   for($i = 0; $i < count($_SESSION['panier']['idProduit']); $i++)
   {
      $total += $_SESSION['panier']['quantite'][$i] * $_SESSION['panier']['prix'][$i];
   }
   return $total;
}

function compterArticles()
{
   if (isset($_SESSION['panier']))
   return count($_SESSION['panier']['idProduit']);
   else
   return 0;

}
function supprimePanier(){
   unset($_SESSION['panier']);
}










?>