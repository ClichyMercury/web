<?php 
include 'header.php';

if (!empty($_GET['id'])) {
   $article = getArticles($_GET['id']);
}
?>

<div class="home-content">
     <div class="overview-boxes">
        <div class="box">
        <form action="<?= !empty($_GET['id']) ? "../model/modifArticle.php" : "../model/addArticle.php" ?>" method="post">

        <label for="nom_article">Nom de l'article</label>
        <input value="<?= !empty($_GET['id']) ? $article['nom_article'] : "" ?>" type="text" name="nom_article" id="nom_article" placeholder="Veuiller entrer le nom de l'article">
        <input value="<?= !empty($_GET['id']) ? $article['id'] : "" ?>" type="hidden" name="id" id="id">

        <label for="categorie">categorie de l'article</label>
        <select name="categorie" id="categorie">
            <option <?= !empty($_GET['id']) && $article['categorie'] == "ordinateur" ? "selected" : "" ?> value="ordinateur">ordinateur</option>
            <option <?= !empty($_GET['id']) && $article['categorie'] == "imprimante" ? "selected" : "" ?> value="imprimante">imprimante</option>
            <option <?= !empty($_GET['id']) && $article['categorie'] == "accessoire" ? "selected" : "" ?> value="accessoire">accessoire</option>
        </select>  

        <label for="quantite">Quantité de l'article</label>
        <input value="<?= !empty($_GET['id']) ? $article['quantite'] : "" ?>" type="number" name="quantite" id="quantite" placeholder="Veuiller entrer la quantité">
        
        <label for="prix_unitaire">Prix de l'article</label>
        <input value="<?= !empty($_GET['id']) ? $article['prix_unitaire'] : "" ?>" type="number" name="prix_unitaire" id="prix_unitaire" placeholder="Veuiller entrer le prix">
        
        <label for="date_fabrication">Date de fabrication</label>
        <input value="<?= !empty($_GET['id']) ? date('Y-m-d\TH:i', strtotime($article['date_fabrication'])) : "" ?>" type="datetime-local" name="date_fabrication" id="date_fabrication">

        <label for="date_expiration">Date d'expiration</label>
        <input value="<?= !empty($_GET['id']) ? date('Y-m-d\TH:i', strtotime($article['date_expiration'])) : "" ?>" type="datetime-local" name="date_expiration" id="date_expiration">

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
                    <th>Nom article</th>
                    <th>Categorie</th>
                    <th>Qté</th>
                    <th>Prix U</th>
                    <th>D. fabrication</th>
                    <th>D. expiration</th>
                    <th>Actions</th>
                </tr>
                <?php
                $articles = getArticles();
                if (!empty($articles) && is_array($articles)) {
                    foreach ($articles as $key => $value) {
                        ?>
                        <tr>
                            <td><?= $value['nom_article'] ?></td>
                            <td><?= $value['categorie'] ?></td>
                            <td><?= $value['quantite'] ?></td>
                            <td><?= $value['prix_unitaire'] ?></td>
                            <td><?= date('d/m/Y H:i:s', strtotime($value['date_fabrication'])) ?></td>
                            <td><?= date('d/m/Y H:i:s', strtotime($value['date_expiration']))?></td>
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
    