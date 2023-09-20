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

// Vérifier si l'ID de l'actualité est spécifié dans l'URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Récupérer les données de l'actualité depuis la base de données
    $sql = "SELECT * FROM actualites WHERE id = ?";
    $stmt = $pdo->prepare($sql);

    if ($stmt->execute([$id])) {
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            $titre = $row['titre'];
            $contenu = $row['contenu'];
        } else {
            header('Location: admin.php');
            exit;
        }
    } else {
        header('Location: admin.php');
        exit;
    }
} else {
    header('Location: admin.php');
    exit;
}

// Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données du formulaire
    $titre = $_POST['titre'];
    $contenu = $_POST['contenu'];

    // Valider les données (vous pouvez ajouter plus de validations ici)

    // Mettre à jour les données dans la base de données
    $sql = "UPDATE actualites SET titre = ?, contenu = ? WHERE id = ?";
    $stmt = $pdo->prepare($sql);

    if ($stmt->execute([$titre, $contenu, $id])) {
        header('Location: admin.php'); // Rediriger vers la page d'administration
        exit;
    } else {
        $error_message = 'Erreur lors de la modification de l\'actualité.';
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Modifier une Actualité</title>
</head>
<body>
    <h1>Modifier une Actualité</h1>
    <p>Bienvenue, <?php echo $_SESSION['username']; ?> | <a href="logout.php">Déconnexion</a></p>
    
    <form method="post">
        <label for="titre">Titre :</label>
        <input type="text" id="titre" name="titre" value="<?php echo $titre; ?>" required><br><br>
        
        <label for="contenu">Contenu :</label><br>
        <textarea id="contenu" name="contenu" rows="4" required><?php echo $contenu; ?></textarea><br><br>
        
        <input type="submit" value="Modifier">
    </form>
    
    <?php if (!empty($error_message)) : ?>
        <p style="color: red;"><?php echo $error_message; ?></p>
    <?php endif; ?>
</body>
</html>
