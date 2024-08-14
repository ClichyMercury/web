<?php 
include 'header.php';

if (!empty($_GET['id'])) {
   $client = getClients($_GET['id']);
}
?>

<div class="home-content">
     <div class="overview-boxes">
        <div class="box">
        <form action="<?= !empty($_GET['id']) ? "../model/modifClient.php" : "../model/addClient.php" ?>" method="post">

        <label for="nom">Nom du client</label>
        <input value="<?= !empty($_GET['id']) ? $client['nom'] : "" ?>" type="text" name="nom" id="nom" placeholder="Veuiller entrer le nom du client">
        <input value="<?= !empty($_GET['id']) ? $client['id'] : "" ?>" type="hidden" name="id" id="id"> 

        <label for="prenom">Prenom du client</label>
        <input value="<?= !empty($_GET['id']) ? $client['prenom'] : "" ?>" type="text" name="prenom" id="prenom" placeholder="Veuiller entrer le prenom du client">
        
        <label for="telephone">Telephone du client</label>
        <input value="<?= !empty($_GET['id']) ? $client['telephone'] : "" ?>" type="text" name="telephone" id="telephone" placeholder="Veuiller entrer le telephone">
        
        <label for="adresse">Adresse du client</label>
        <input value="<?= !empty($_GET['id']) ? $client['adresse'] : "" ?>" type="text" name="adresse" id="adresse" placeholder="Veuiller entrer l'adresse">
       
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
                    <th>Nom</th>
                    <th>Prenom</th>
                    <th>N° telephone</th>
                    <th>Adresse</th>
                    <th>Actions</th>
                </tr>
                <?php
                $clients = getClients();
                if (!empty($clients) && is_array($clients)) {
                    foreach ($clients as $key => $value) {
                        ?>
                        <tr>
                            <td><?= $value['nom'] ?></td>
                            <td><?= $value['prenom'] ?></td>
                            <td><?= $value['telephone'] ?></td>
                            <td><?= $value['adresse'] ?></td>
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
    