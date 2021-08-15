<?php

if (isset($_POST['identifiant']) && isset($_POST['motdepasse'])) {
    $identifiant_nonfiable = $_POST['identifiant'];
    $motdepasse_nonfiable = $_POST['motdepasse'];

    require 'connexion.php';
    $pdo = creerPDO();
    $requete_sql = "SELECT Identifiant, MotDePasse FROM tp2db.personne WHERE Identifiant=:identifiant";
    $pdo_statement = $pdo->prepare($requete_sql);
    $pdo_statement->execute(['identifiant'=>$identifiant_nonfiable]);

    if ($pdo_statement->rowCount() === 1) {
        $ligne = $pdo_statement->fetch();
        $hash = $ligne['MotDePasse'];
        if (password_verify($motdepasse_nonfiable, $hash)===true) {
            session_start();
            session_regenerate_id();

            $_SESSION['Identifiant'] = $ligne['Identifiant'];

            header('Location: index.php');
            die();
        }
        else {
            echo 'Identifiant et/ou mot de passe incorrects.';
            echo '<a href="index.php">Retour à la page principale </a>';
        }
    }
    else {
        echo 'Identifiant et/ou mot de passe incorrects.';
        echo '<a href="index.php">Retour à la page principale </a>';
    }
}
else {
    echo 'Veuillez rentrer les champs du formulaire.';
    echo '<a href="index.php">Retour à la page principale </a>';
}



?>
