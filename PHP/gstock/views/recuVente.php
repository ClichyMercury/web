<?php 
include 'header.php';

if (!empty($_GET['id'])) {
   $article = getVentes($_GET['id']);
}
?>

<div class="home-content">
     <div class="overview-boxes">
     <div class="box">
            <table class="mtable">
                <tr>
                    <th>Article</th>
                    <th>Client</th>
                    <th>Qté</th>
                    <th>Prix U</th>
                    <th>D. Vente</th>
                    <th>Actions</th>
                </tr>
                <?php
                $ventes = getVentes();
                if (!empty($ventes) && is_array($ventes)) {
                    foreach ($ventes as $key => $value) {
                        ?>
                        <tr>
                            <td><?= $value['nom_article'] ?></td>
                            <td><?= $value['nom']. " " .$value['prenom'] ?></td>
                            <td><?= $value['quantite'] ?></td>
                            <td><?= $value['prix'] ?></td>
                            <td>
                                <?php
                                if (!empty($value['date_vente'])) {
                                    echo date('d/m/Y H:i:s', strtotime($value['date_vente']));
                                } else {
                                    echo "Date non disponible";
                                }
                                ?>
                            </td>
                            <!-- <td><a href="?id=<?= $value['id'] ?>"><i class="bx bx-recipe"></i></a></td> -->
                            <td><a href="recuVente.php?id=<?= $value['id'] ?>"><i class="bx bx-recipe"></i></a></td>
                        </tr>
                       <?php
                    }
                }
                ?>
            </table>
         </div>
      </div>
    </section>


<?php 
include 'footer.php';
?>

<script>
    function setPrix() {
        var article = document.querySelector('#id_article');
        var quantite = document.querySelector('#quantite');
        var prix = document.querySelector('#prix');

        var prixUnitaire = article.options(article.selectedIndex).getAttribute('data-prix');

        prix.value = Number(quantite.value) * Number(prixUnitaire);

    }
</script>
    