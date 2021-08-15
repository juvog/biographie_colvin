<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>TP2</title>
    <link href="style.css" rel="stylesheet" type="text/css" />
</head>
<body>
    <?php

    //Vérification de l'existence d'une variable de session

    session_start();
    session_regenerate_id();

    /// Vérification de la variable de session
    if (isset($_SESSION['Identifiant']) === false)
    {
    ?>

        <section>
            <div class = affichage>
                <?php require 'traitement_affichage.php' ?>
            </div>

            <div class = connexion>
                <form method="post" action="traitement_connexion.php" >
                    <p>
                        <label for="identifiant"> Identifiant : </label><br/>
                        <input type="text" name="identifiant" id="identifiant" />
                     </p>
                    <p>
                        <label for="mdp"> Mot de passe : </label><br/>
                        <input type="text" name="motdepasse" id="mdp" />
                    </p>
                    <p>
                    <input type="submit" value="Connexion"/>
                    </p>
                </form>
            </div>

        </section>

    <?php
    }
// Cas où il y a un utilisateur connecté  :
    else
    { ?>

        <section>
            <div class="affichage">
                <?php
                    require 'connexion.php';
                    $pdo = creerPDO();
                    $pdo_statement = $pdo->prepare('SELECT Entete, Contenu, Pied FROM tp2db.article where Id=1');
                    $pdo_statement->execute([]);
                    $ligne = $pdo_statement->fetch();

                    //Affichage de l'entête
                    echo '<p id="entete">' .$ligne['Entete'] .'</p>';  ?>

                    <!-- Formulaire de modification du contenu -->
                    <form method="post" action="valider_modification.php">
                        <p>
                            <textarea name="textemodifie" >
                                <?php echo $ligne['Contenu'] ?>
                            </textarea>
                        </p>
                        <input type="submit"  value="Soumettre les modifications"/>
                    </form>

                    <!-- Affichage de pied de page -->
                    <?php   echo '<p id="pied">'. $ligne['Pied']. '</p>'?>

            </div>

            <div class=connexion>
                <!-- Message à la personne connectée et bouton de déconnexion -->
                <p> Bonjour <?php echo $_SESSION['Identifiant'] ?> </p>
                <form method="post" action="deconnexion.php">
                    <input type="submit" value="Déconnexion" />
                </form>
            </div>
        </section>
<?php
    }
?>


</body>
</html>