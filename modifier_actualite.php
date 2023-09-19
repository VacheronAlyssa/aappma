<?php
// Code de connexion à la base de données (à personnaliser)
$dsn = "pgsql:host=localhost;dbname=aapma";
$user = "admin";
$password = "admin";

try {
    $pdo = new PDO($dsn, $user, $password);
} catch (PDOException $e) {
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}

// Récupération des données du formulaire
$id_modification = $_POST["id_modification"];
$nouveau_titre = $_POST["nouveau_titre"];
$nouveau_contenu = $_POST["nouveau_contenu"];
