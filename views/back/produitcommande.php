<table class="table">
                <thead>
                  <tr>
                    <th>Id commande</th>
                    <th>Id produit </th>
                    <th>Nom</th>
                    <th>Prix Produit</th>
                    <th>Quantite</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach($listeProduit as $produit): ?>
                  <tr>
                            <td> <?= $produit->idCommande; ?> </td>
                              <td> <?= $produit->idProduit; ?></td>
                              <td> <?= $produit->nom; ?> </td>
                              <td> <?= $produit->prix; ?> </td>
                              <td> <?= $produit->quantiteCommandee ; ?> </td>
                  </tr>
                 <?php endforeach; ?>
                </tbody>
              </table>