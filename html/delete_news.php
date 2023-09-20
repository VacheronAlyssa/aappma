<?php
session_start();

// Vérifier si l'administrateur est connecté
if (!isset($_SESSION['admin']) || $_SESSION['admin'] !== true) {
    header('Location: login.php');
    exit;
}

// Vérifier si l'ID de l'actualité est spécifié dans l'URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Inclure le code de connexion à la base de données
    include 'db_connection.php';

    // Supprimer l'actualité de la base de données
    $sql = "DELETE FROM actualites WHERE id = ?";
    $stmt = $pdo->prepare($sql);

    if ($stmt->execute([$id])) {
        header('Location: admin.php'); // Rediriger vers la page d'administration
        exit;
    }
}

// Si l'ID n'est pas spécifié ou s'il y a une erreur, rediriger vers la page d'administration
header('Location: admin.php');
exit;
?>
