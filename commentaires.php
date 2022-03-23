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



    <?php
    require "includes/footer.php";
    ?>
    <script src="./index.js"></script>
</body>

</html>