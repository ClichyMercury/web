<?php
$action = null;
$notes = [];
while ($action !== 'fin') {
    $action = readline('Entrez une note svp (Tapez fin pour terminer ) : ');
    if ($action !== 'fin') {
        $notes[] = (int)$action;
    }
}

foreach ($notes as $note) {
   echo " - $note \n";
}
