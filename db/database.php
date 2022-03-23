<?php

function getConnexion()
{
    $pdo = null;

    try {

        $pdo = new PDO(
            "mysql:host=localhost;dbname=blog;charset=utf8",
            "root",
            "root"
        );
        $pdo->setAttribute(
            PDO::ATTR_ERRMODE,
            PDO::ERRMODE_EXCEPTION
        );
        $pdo->setAttribute(
            PDO::ATTR_DEFAULT_FETCH_MODE,
            PDO::FETCH_OBJ
        );
    } catch (PDOException $exception) {
        die("Erreur : " . $exception->getMessage());
    }

    return $pdo;
}

function getBillets(): array
{
    $pdo = getConnexion();

    $query = $pdo->query("SELECT * FROM billets");

    $billets = $query->fetchAll();

    return $billets;
}

function getBilletById($id)
{
    $pdo = getConnexion();
    $query = $pdo->prepare("SELECT * FROM billets WHERE IdBillet = ?");
    $query->execute([$id]);
    $billet = $query->fetch();

    if (!$billet) {
        return null;
    }

    return $billet;
}

function getComments($id)
{
    $pdo = getConnexion();
    $query = $pdo->prepare("SELECT * FROM commentaires WHERE billet_id = ?");
    $query->execute([$id]);
    $commentaire = $query->fetchAll();

    if (!$commentaire) {
        return null;
    }

    return $commentaire;
}

function addComment(string $auteur, string $commentaire, $date_commentaire, $billet_id)
{
    $pdo = getConnexion();

    $query = $pdo->prepare("INSERT INTO commentaires SET auteur = ?, commentaire = ?, date_commentaire = ?, billet_id = ?");

    $query->execute([$auteur, $commentaire, $date_commentaire, $billet_id]);
}
