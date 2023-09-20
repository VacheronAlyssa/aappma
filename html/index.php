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
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="script.js"></script>
    <title>Accueil - Association de Pêche</title>

    
    
</head>
<header>
        
        <div id="logo-container">
            <img src="../photos/logbroche.png" alt="Logo 1"><div id="slideshow">

            </div>
            <h1 id="appma-name">AAPPMA Brochet de basse et vilaine</h1>
            <img src="../photos/logofede56.jpg" alt="Logo 2">
        </div>

        <div id="navigation-container"></div>

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

// Requête SQL pour récupérer les actualités (triées par date décroissante)
// Requête SQL pour récupérer les actualités (triées par date croissante)
$sql = "SELECT * FROM actualites ORDER BY date ASC";
$result = $pdo->query($sql);

// Récupérer les données de l'actualité (y compris le nom du fichier image)
$sql = "SELECT * FROM actualites ORDER BY date ASC";
$result = $pdo->query($sql);

if (!$result) {
    die("Erreur dans la requête SQL.");
}

// Affichage des actualités (même pour le public)
while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
    echo "<h2>" . htmlspecialchars($row['titre']) . "</h2>";
    echo "<p>" . htmlspecialchars($row['contenu']) . "</p>";

    // Afficher l'image (chemin de l'image à adapter)
    $image_path = 'images/' . $row['nom_image'];
    echo '<img src="' . $image_path . '" alt="Image d\'actualité">';

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
