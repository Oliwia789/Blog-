<?php
require "db/database.php";
$billets = getBillets();
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

    <div class="title">
        <h2 class="main-title">Mon Blog</h2>
    </div>

    <h3 class="title-articles">Derniers articles</h3>
    <p class="date"><?= date("m/d/Y") ?></p>
    <div class="articles-container">
        <?php foreach ($billets as $billet) : ?>
            <div class="article">
                <div class="img-container">
                    <a href="commentaires.php?id=<?= $billet->IdBillet ?>"><img src="<?= $billet->image ?>" alt="voyage"></a>
                </div>
                <div>
                    <a href="commentaires.php?id=<?= $billet->IdBillet ?>">
                        <h4 class="article-title"><?= $billet->titre ?></h4>
                    </a>
                    <p class="article-text">
                        <?= substr($billet->contenu, 0, 150) ?>
                        ...
                        <br>
                        <a href="commentaires.php?id=<?= $billet->IdBillet ?>" class="article-link">Lire la suite</a>
                    </p>
                </div>
            </div>
        <?php endforeach ?>
    </div>


    <?php
    require "includes/footer.php";
    ?>
    <script src="./index.js"></script>
</body>

</html>