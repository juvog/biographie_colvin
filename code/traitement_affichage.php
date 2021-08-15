<?php

require 'connexion.php';
$pdo = creerPDO();


$pdo_statement = $pdo->prepare('SELECT Entete, Contenu, Pied FROM article where Id=1');
$pdo_statement->execute([]);
$ligne = $pdo_statement->fetch();
    echo '<p id="entete">' .$ligne['Entete'] .'</p>';
    //Nettoyage avant affichage du contenu qui est suscrptibe d'avoir été modifié :
    echo '<p id="contenu">'. htmlspecialchars($ligne['Contenu']).'</p>' ;
    echo '<p id="pied">'. $ligne['Pied']. '</p>';

