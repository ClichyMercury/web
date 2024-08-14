<?php 
include 'header.php';

if (!empty($_GET['id'])) {
   $article = getVentes($_GET['id']);
}
?>

<div class="home-content">
     <div class="overview-boxes">
        <div class="box">
        <form action="<?= !empty($_GET['id']) ? "../model/modifVente.php" : "../model/addVente.php" ?>" method="post">

        <input value="<?= !empty($_GET['id']) ? $article['id'] : "" ?>" type="hidden" name="id" id="id">

        <label for="id_article">Article</label>
        <select name="id_article" id="id_article">
            <?php 
            $articles = getArticles();
            if (!empty($articles) && is_array($articles)) {
                foreach ($articles as $key => $value) {
                   ?>
                   <option data-prix="<?= $value['prix_unitaire'] ?>" value="<?= $value['id'] ?>"><?= $value['nom_article'] . ' - ' . $value['quantite'] . " disponible" ?></option>
                   <?php
                }
            }
            ?>
        </select>  

        <label for="id_client">Client</label>
        <select name="id_client" id="id_client">
            <?php 
            $clients = getClients();
            if (!empty($clients) && is_array($clients)) {
                foreach ($clients as $key => $value) {
                   ?>
                   <option value="<?= $value['id'] ?>"><?= $value['nom'] . ' ' . $value['prenom'] ?></option>
                   <?php
                }
            }
            ?>
        </select>  

        <label for="quantite">Quantité de l'article</label>
        <input onkeyup="setPrix()" value="<?= !empty($_GET['id']) ? $article['quantite'] : "" ?>" type="number" name="quantite" id="quantite" placeholder="Veuiller entrer la quantité">
        
        <label for="prix">Prix de l'article</label>
        <input value="<?= !empty($_GET['id']) ? $article['prix'] : "" ?>" type="number" name="prix" id="prix" placeholder="Veuiller entrer le prix">

        <label for="date_vente">Date de Vente</label>
        <input value="<?= !empty($_GET['id']) ? date('Y-m-d\TH:i', strtotime($article['date_vente'])) : "" ?>" type="datetime-local" name="date_vente" id="date_vente">

        <button type="submit">Valider</button>
        <?php
        if (!empty($_SESSION['message']['text'])) {
        ?>
           <div class="alert <?= $_SESSION['message']['type'] ?>"><?= $_SESSION['message']['text'] ?></div>
        <?php
        }
        ?>
        </form>
     </div>   
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
                            <td><a href="?id=<?= $value['id'] ?>"><i class="bx bx-edit-alt"></i></a></td>
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
    