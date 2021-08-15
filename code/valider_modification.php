<?php

if (isset($_POST['textemodifie'])){
    $texte_nonfiable = $_POST['textemodifie'];

    require 'connexion.php';
    $pdo = creerPDO();

    $pdo_statement = $pdo->prepare('update article set contenu =:le_contenu where id =1');
    $pdo_statement->execute(['le_contenu' => $texte_nonfiable]);

}
header('Location: index.php');
die();