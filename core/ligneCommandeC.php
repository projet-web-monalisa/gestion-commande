<?php
  
  class LigneCommandeC
  {
  	public function ajouterLigneCommande($ligneCommande)
{   
	$sql="INSERT INTO `lignecommande` (`quantiteCommandee`,`prixUnitaire`,`idCommande`,`idProduit`) VALUES (:QUANTITE,:PRIX,:IDCOMMANDE,:idProduit);";
	
          $db = Config::getConnexion();

          $req=$db->prepare($sql);
          $req->bindValue(':QUANTITE',$ligneCommande->get_quantite());
          $req->bindValue(':PRIX',$ligneCommande->get_prix());
          $req->bindValue(':IDCOMMANDE',$ligneCommande->get_idCommande());
          $req->bindValue(':idProduit',$ligneCommande->get_idproduit());
          $req->execute();
	}
 
  	
  }
?>