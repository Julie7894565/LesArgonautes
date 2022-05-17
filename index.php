<?php

// Connexion à la bdd
function connexion()
{
    //Préparation de la connexion à une base MySQL avec l'invocation de pilote 
    $dsn = 'mysql:dbname=lesargonautes;host=localhost:3306 ';
    $user = 'root';
    $password = 'root';

    //tente la connexion
    try {
        $dbh = new PDO($dsn, $user, $password);
        // echo "connexion réussie";
        return $dbh;

        // si la connexion échoue
    } catch (Exception $erreurs) {
        echo "la connexion a échouée";
    }
}

/**
 * Créer membre
 * crée un membre en base de données 
 * */
function creerMembre($name)
{
    $dbh = connexion();
    $stmt = $dbh->prepare("INSERT INTO membres ( nom ) VALUES ( :name)");
    $stmt->bindParam(':name', $name);
    $stmt->execute();
}

/**
 * recuperer les membres
 * recupere les membres en base de données 
 * renvoie les données
 * */
function getMembres()
{
    $dbh = connexion();
    $stmt = $dbh->prepare("SELECT * FROM membres");
    $stmt->execute();
    $resultats = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $resultats;
}


if (isset($_POST['name']) && !empty($_POST['name'])) {
    var_dump($_POST['name']);
    creerMembre($_POST['name']);
}

?>

<!DOCTYPE html>
<html lang="fr-FR">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Les Argonautes</title>
    <meta name="author" content="Julie" />
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta name="Content-Language" content="fr" />
    <meta name="Subject" content="" />
    <meta name="Copyright" content="copyright Julie MIDON" />
    <meta name="Publisher" content="Julie MIDON" />
    <meta name="Identifier-Url" content="" />
    <link rel="stylesheet" href="./assets/styles.css">
    <!-- Header section -->
    <header>
        <h1>
            <img src="https://www.wildcodeschool.com/assets/logo_main-e4f3f744c8e717f1b7df3858dce55a86c63d4766d5d9a7f454250145f097c2fe.png" alt="Wild Code School logo" />
            Les Argonautes
        </h1>
    </header>

    <!-- Main section -->
    <main>

        <!-- New member form -->
        <h2>Ajouter un(e) Argonaute</h2>
        <form action="#" method="POST" class="new-member-form">
            <label for="name">Nom de l&apos;Argonaute</label>
            <input id="name" name="name" type="text" placeholder="Charalampos" />
            <button type="submit">Envoyer</button>
        </form>

        <!-- Member list -->
        <h2>Membres de l'équipage</h2>
        <section class="member-list">
            <?php
            $membres = getMembres();
            foreach ($membres as $membre) : ?>
                <div class="member-item">
                    <?php echo $membre["nom"]; ?>
                </div>
            <?php endforeach; ?>

        </section>
    </main>

    <footer>
        <p>Réalisé par Jason en Anthestérion de l'an 515 avant JC</p>
    </footer>