<?php
session_start();

// Vérifier si l'administrateur est connecté
$admin_connected = (isset($_SESSION['admin']) && $_SESSION['admin'] === true);

// Fonction pour afficher le bouton de connexion
function displayLoginButton() {
    echo '<a href="login.php" style="margin-left: 10px;">Se connecter en tant qu\'administrateur</a>';
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Accueil</title>
</head>
<body>
    <h1>Page d'Accueil</h1>
<header>
    <?php
    // Afficher le bouton de connexion pour l'administrateur
    if (!$admin_connected) {
        displayLoginButton();
    }
    ?>
</header>
    
<?php
// Connexion à la base de données (à adapter avec vos informations de connexion)
$host = "localhost";
$dbname = "aappma";
$username = "admin";
$password = "admin";

try {
    $pdo = new PDO("pgsql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Erreur de connexion : " . $e->getMessage();
    exit();
}

// Requête SQL pour récupérer les actualités
$sql = "SELECT * FROM actualites ORDER BY date DESC";
$result = $pdo->query($sql);

if (!$result) {
    die("Erreur dans la requête SQL.");
}

// Affichage des actualités (même pour le public)
while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
    echo "<h2>" . htmlspecialchars($row['titre']) . "</h2>";
    echo "<p>" . htmlspecialchars($row['contenu']) . "</p>";
    echo "<p>Date : " . htmlspecialchars($row['date']) . "</p>";
    echo "<hr>"; // Ligne de séparation entre les actualités
}

// Fermeture de la connexion à la base de données
$pdo = null;
?>

    <?php

    
    // Afficher un lien vers la page d'administration si l'administrateur est connecté
    if ($admin_connected) {
        echo '<a href="admin.php">Accéder à la page d\'administration</a>';
    }
    ?>

    <!-- Autre contenu de la page d'accueil -->

</body>
</html>
