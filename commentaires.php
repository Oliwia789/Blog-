<?php
require "db/database.php";
if (isset($_GET["id"]) && is_numeric($_GET["id"])) {
    $billet = getBilletById(htmlspecialchars($_GET["id"]));
    if ($billet == null) {
        header("Location: index.php");
    }
} else {
    header("Location: index.php");
}
$commentaires = getComments(htmlspecialchars($_GET["id"]));


if (!empty($_POST)) {
    $error = array();

    if (is_numeric($_POST["auteur"])) {
        $error["auteur"] = "Votre nom ne peut pas être une valeur numérique";
    }
    if (is_numeric($_POST["commentaire"])) {
        $error["synopsis"] = "Votre message ne peut pas contenir uniquement des valeurs numériques";
    }
    if (empty($errors)) {
        addComment($_POST["auteur"], $_POST["commentaire"], date("Y-m-d H:i:s"), intval($_GET["id"]));
        header("Location: index.php");
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
    <div class="single-container">
        <div class="single-img-container">
            <img src="<?= $billet->image ?>" alt="voyage">
        </div>
        <h1 class="single-title"><?= $billet->titre ?></h1>
        <p class="single-date"><?= $billet->date_creation ?></p>
        <p class="single-text"><?= $billet->contenu ?></p>
    </div>
    <div>
        <h2 class="com-title">Laissez un commentaire</h2>
        <form class="com-form" action="" method="post" enctype="multipart/form-data">
            <input class="com-input" type="text" name="auteur" id="auteur" placeholder="Votre nom*" required>
            <textarea class="com-input" name="commentaire" id="commentaire" cols="30" rows="10" placeholder="Votre message*" required></textarea>
            <button class="com-btn">Valider</button>
        </form>
    </div>
    <?php if (!empty($errors)) : ?>
        <div>
            <p>
                Vous n'avez pas rempli le formulaire correctement
            </p>
            <ul>
                <?php foreach ($errors as $error) : ?>
                    <li><?= $error ?></li>
                <?php endforeach ?>
            </ul>
        </div>

    <?php endif ?>
    <?php if ($commentaires) : ?>
        <div>
            <h2 class="com-title"><?= count($commentaires) ?> <?= count($commentaires) > 1 ? "Commentaires" : "Commentaire" ?></h2>
            <hr class="com-hr">
            <div class="com-container">
                <?php foreach ($commentaires as $commentaire) : ?>
                    <div class="single-com">
                        <div class="com-info">
                            <p class="com-auteur"><?= $commentaire->auteur ?></p>
                            <p class="com-date"><?= $commentaire->date_commentaire ?></p>
                        </div>
                        <p class="com-text"><?= $commentaire->commentaire ?></p>
                        <hr>
                    </div>
                <?php endforeach ?>
            </div>
        </div>
    <?php endif; ?>



    <?php
    require "includes/footer.php";
    ?>
    <script src="./index.js"></script>
</body>

</html>