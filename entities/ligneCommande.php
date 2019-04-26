<?php 
 class ligneCommande
 {
 	private $quantite;
 	private $prix;
 	private $idCommande;
 	private $idProduit;

 	public function __construct($quantite,$prix,$idCommande,$idProduit)
{   
	$this->quantite=$quantite;
	$this->prix=$prix;
	$this->idCommande=$idCommande;
	$this->idProduit=$idProduit;
}
	public function get_quantite(){return $this->quantite;}
	public function get_prix(){return $this->prix;}
	public function get_idCommande(){return $this->idCommande;}
	public function get_idProduit(){return $this->idProduit;}
 }
?>