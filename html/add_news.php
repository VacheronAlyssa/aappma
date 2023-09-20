<?php
session_start();

// Vérifier si l'administrateur est connecté
if (!isset($_SESSION['admin']) || $_SESSION['admin'] !== true) {
    header('Location: login.php');
    exit;
}

// Inclure le code de connexion à la base de données
include 'db_connection.php';

// Initialiser les variables pour le formulaire
$titre = $contenu = '';
$error_message = '';

// Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données du formulaire
    $titre = $_POST['titre'];
    $contenu = $_POST['contenu'];
    $date = date('Y-m-d'); // Date actuelle

    // Valider les données (vous pouvez ajouter plus de validations ici)

    // Insérer les données dans la base de données
    $sql = "INSERT INTO actualites (titre, contenu, date) VALUES (?, ?, ?)";
    $stmt = $pdo->prepare($sql);

    if ($stmt->execute([$titre, $contenu, $date])) {
        header('Location: admin.php'); // Rediriger vers la page d'administration
        exit;
    } else {
        $error_message = 'Erreur lors de l\'ajout de l\'actualité.';
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Ajouter une Actualité</title>
</head>
<body>
    <h1>Ajouter une Actualité</h1>
    <p>Bienvenue, <?php echo $_SESSION['username']; ?> | <a href="logout.php">Déconnexion</a></p>
    
    <form method="post">
        <label for="titre">Titre :</label>
        <input type="text" id="titre" name="titre" required><br><br>
        
        <label for="contenu">Contenu :</label><br>
        <textarea id="contenu" name="contenu" rows="4" required></textarea><br><br>
        
        <input type="submit" value="Ajouter">
    </form>
    
    <?php if (!empty($error_message)) : ?>
        <p style="color: red;"><?php echo $error_message; ?></p>
    <?php endif; ?>
</body>
</html>
