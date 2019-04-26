<?php 
    include '../../entities/commande.php';
    include '../../core/commandeC.php';
    include '../../entities/ligneCommande.php';
    include '../../core/ligneCommandeC.php';
    include_once("../../core/classpanier.php");
    $panier=creationPanier();

    if(isset($_POST['ajouterCommande']))
    {   //$idUtilisateur=$_SESSION['idUtilisateur'];
        $idclient=5;
        $dateCommande= date("Y-m-d");
        $prixTotal=MontantGlobal();
        $etat='en cours';
        $nbArticles=count($_SESSION['panier']['idProduit']);
        $test=true;
        //controle stock
  /*       for ($i=0; $i < $nbArticles ; $i++) 
      { 
         $pc=new produitC();
         $liste=$pc->rechercherProduit($_SESSION['panier']['idProduit'][$i],$db);
        foreach ($liste as $row)
        {
        $stock=$row['quantite'];          
        }
        $qteProduit=$_SESSION['panier']['qteProduit'][$i];
        if($stock>=$qteProduit)
         {$newqtite=$stock-$_SESSION['panier']['qteProduit'][$i];
         $pc->modifierQuantite($_SESSION['panier']['idProduit'][$i],$newqtite,$db);}
         else
            { $test=false;
                
        header("Location: panier.php?erreurC=n&l=".$_SESSION['panier']['libelleProduit'][$i]."&stock=".$stock);
        
            }
      } //controle stock bitte*/
      if($test==true)
     
        
        {$commande =new Commande($idclient,$dateCommande,$prixTotal,$etat);
                $cc= new CommandeC();
                
                 
                $cc->ajouterCommande($commande);
                $result=$cc->recupererDernierCmd();
                foreach ($result as $value) 
                {
                    /*var_dump($value);
                    die();*/
                     $idCommande=$value['idCommande'];
                }
        
              $ldcc=new LigneCommandeC();
              
              for($i=0; $i<$nbArticles;$i++)
              { $quantite=$_SESSION['panier']['quantite'][$i];
                $prix=$_SESSION['panier']['prix'][$i];
                $idProduit=$_SESSION['panier']['idProduit'][$i];
        
                $ldc=new LigneCommande($quantite,$prix,$idCommande,$idProduit);
                $ldcc->ajouterLigneCommande($ldc);
              }
        
            
            supprimePanier();
             header('Location: cart.php');
        }
    }

?>

   
   
