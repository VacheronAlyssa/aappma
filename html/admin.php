<?php
session_start();

// Vérifier si l'administrateur est connecté
if (!isset($_SESSION['admin']) || $_SESSION['admin'] !== true) {
    header('Location: login.php');
    exit;
}

// Inclure le code de connexion à la base de données
include 'db_connection.php';

// Récupérer la liste des actualités depuis la base de données
$sql = "SELECT * FROM actualites";
$result = $pdo->query($sql);

// ...

?>

<!DOCTYPE html>
<html>
<head>
    <title>Administration des Actualités</title>
</head>
<body>
    <h1>Administration des Actualités</h1>
    <p>Bienvenue, <?php echo $_SESSION['username']; ?> | <a href="logout.php">Déconnexion</a></p>
    
    <h2>Liste des Actualités</h2>
    <ul>
        <?php while ($row = $result->fetch(PDO::FETCH_ASSOC)) : ?>
            <li>
                <?php echo htmlspecialchars($row['titre']); ?>
                (<a href="edit_news.php?id=<?php echo $row['id']; ?>">Modifier</a>
                | <a href="delete_news.php?id=<?php echo $row['id']; ?>">Supprimer</a>)
            </li>
        <?php endwhile; ?>
    </ul>
    
    <h2>Actions</h2>
    <ul>
        <li><a href="add_news.php">Ajouter une Actualité</a></li>
    </ul>
</body>
</html>
