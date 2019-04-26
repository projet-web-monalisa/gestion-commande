<?php 
class commande
{
	private  $idclient;
	private  $dateCommande;
	private  $prixTotal;
	private  $etat;

public function __construct($idclient,$dateCommande,$prixTotal,$etat)
{
	$this->idclient=$idclient;
	$this->dateCommande=$dateCommande;
	$this->prixTotal=$prixTotal;
	$this->etat=$etat;
}
	public function get_idclient(){return $this->idclient;}
	public function get_dateCommande(){return $this->dateCommande;}
	public function get_prixTotal(){return $this->prixTotal;}
	public function get_etat(){return $this->etat;}
}

?>