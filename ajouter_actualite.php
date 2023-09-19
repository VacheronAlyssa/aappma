<?php
// Code de connexion à la base de données (à personnaliser)
$dsn = "pgsql:host=localhost;dbname=aappma";
$user = "admin";
$password = "admin";

try {
    $pdo = new PDO($dsn, $user, $password);
} catch (PDOException $e) {
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}

// Récupération des données du formulaire
$titre = $_POST["titre"];
$contenu = $_POST["contenu"];
$date = $_POST["date"];

// Requête d'insertion dans la table actualites
$query = "INSERT INTO actualites (titre, contenu, date) VALUES (?, ?, ?)";
$stmt = $pdo->prepare($query);

if ($stmt->execute([$titre, $contenu, $date])) {
    echo "Actualité ajoutée avec succès.";
} else {
    echo "Erreur lors de l'ajout de l'actualité.";
}

// Fermeture de la connexion
$pdo = null;
?>
