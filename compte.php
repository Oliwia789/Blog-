<?php
require "db/database.php";

if (!empty($_POST)) {
    if (getUser(htmlspecialchars($_POST["email"])) != null) {
        $user = getUser(htmlspecialchars($_POST["email"]));
        if (password_verify($_POST["mdp"], $user->MdpUser)) {
            session_start();
            $_SESSION["LOGGED_USER_NAME"] = $user->NomUser;
            $_SESSION["LOGGED_USER_SURNAME"] = $user->PrenomUser;
            $message = "<p class='connect'>Connexion</p>";
        } else {
            $message = "<p class='error'>Le mot de passe ne correspond pas</p>";
        }
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

    <?php if (!isset($_SESSION["LOGGED_USER_NAME"])) : ?>
        <h1 class="connect-title">Connexion</h1>

        <form class="com-form" action="" method="post" enctype="multipart/form-data">
            <label for="email">Votre e-mail* : </label>
            <input class="com-input" type="email" name="email" id="email" placeholder="E-mail" required>
            <label for="mdp">Votre mot de passe* : </label>
            <input class="com-input" type="password" name="mdp" id="mdp" placeholder="Mot de passe" required>
            <button class="com-btn">Valider</button>
            <?php if (isset($message)) {
                echo $message;
            }
            ?>
        </form>
        <p class="link-newUser"><a href="newCompte.php">Nouveau utilisateur ? Créez votre compte</a></p>
        <p class="link-newUser"><a href="#">Mot de passe oublié ?</a></p>
    <?php else : ?>
        <div class="logout">
            <h1 class="connect-title">Bonjour <?= $_SESSION["LOGGED_USER_SURNAME"] ?> !</h1>
            <a href="logout.php"><button class="com-btn logout-btn">Déconnexion</button></a>
        </div>
    <?php endif; ?>
    <?php
    require "includes/footer.php";
    ?>
    <script src="./index.js"></script>
</body>

</html>