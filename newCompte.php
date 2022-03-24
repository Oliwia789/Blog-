<?php
require "db/database.php";

if (!empty($_POST)) {
    $error = array();
    $regexEmail = '/^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/';
    $regexMdp = '/^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$/';

    if (is_numeric($_POST["nom"])) {
        $error["nom"] = "Votre nom ne peut pas être une valeur numérique";
    } elseif (strlen($_POST["nom"]) < 3) {
        $error["nom"] = "Votre nom doit faire plus de 4 caractères";
    } elseif (is_numeric($_POST["prenom"])) {
        $error["prenom"] = "Votre message ne peut pas contenir uniquement des valeurs numériques";
    } elseif (strlen($_POST["prenom"]) < 3) {
        $error["prenom"] = "Votre prénom doit faire plus de 4 caractères";
    } elseif (!preg_match($regexEmail, $_POST["email"])) {
        $error["email"] = "Le format de votre email est invalide";
    } elseif (getUser(htmlspecialchars($_POST["email"])) != null) {
        $error["email"] = "Un compte correspondant  à cette adresse email existe déjà";
    } elseif (!preg_match($regexMdp, $_POST["mdp"])) {
        $error["mdp"] = "Votre mot de passe doit faire plus de 8 caractères, 1 nombre, une majuscule et une minuscule";
    } elseif ($_POST["mdp"] != $_POST["mdp-confirm"]) {
        $error["mdp"] = "Votre mot de passe et sa confirmation ne correspondent pas";
    } elseif (empty($error)) {
        addUser($_POST["nom"], $_POST["prenom"], $_POST["email"], password_hash($_POST["mdp"], PASSWORD_DEFAULT));
        header("Location: compte.php");
    }
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles/style.css">
    <title>Mon blog</title>
</head>

<body>
    <?php
    require "includes/header.php";
    ?>

    <h1 class="connect-title">Création compte</h1>

    <?php
    if (!empty($error)) {
        foreach ($error as $key => $value) {
            echo "<p class='error'>$value</p>";
        }
    }
    ?>

    <form class="com-form" action="" method="post" enctype="multipart/form-data">
        <label for="nom">Votre nom* : </label>
        <input class="com-input" type="text" name="nom" id="nom" placeholder="Nom" required>
        <label for="prenom">Votre prénom* : </label>
        <input class="com-input" type="text" name="prenom" id="prenom" placeholder="Prénom" required>
        <label for="email">Votre e-mail* : </label>
        <input class="com-input" type="email" name="email" id="email" placeholder="E-mail" required>
        <label for="mdp">Votre mot de passe* : </label>
        <input class="com-input" type="password" name="mdp" id="mdp" placeholder="Mot de passe" required>
        <label for="mdp-confirm">Confirmer votre mot de passe* : </label>
        <input class="com-input" type="password" name="mdp-confirm" id="mdp-confirm" placeholder="Confirmer mot de passe" required>
        <button class="com-btn">Valider</button>
    </form>
    <?php
    require "includes/footer.php";
    ?>
    <script src="./index.js"></script>
</body>

</html>