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
// Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données du formulaire
    $titre = $_POST['titre'];
    $contenu = $_POST['contenu'];

    // Récupérer le fichier image téléchargé
    $image = $_FILES['image'];

    // Vérifier si l'administrateur est connecté
    if ($admin_connected) {
        // Vérifier si l'upload du fichier s'est bien passé
        if ($image['error'] === UPLOAD_ERR_OK) {
            // Nom du fichier temporaire
            $tmp_name = $image['tmp_name'];

            // Nom du fichier sur le serveur (par exemple, timestamp + nom d'origine)
            $image_name = time() . '_' . $image['name'];

            // Emplacement de stockage des images (à adapter)
            $image_path = 'images/' . $image_name;

            // Déplacer le fichier téléchargé vers l'emplacement de stockage
            if (move_uploaded_file($tmp_name, $image_path)) {
                // Le fichier a été téléchargé avec succès
                // Insérer l'actualité dans la base de données avec le nom du fichier image
                // ...

                // Rediriger vers la page d'accueil ou afficher un message de succès
                // ...
            } else {
                // Une erreur s'est produite lors du téléchargement
                $error_message = 'Erreur lors du téléchargement de l\'image.';
            }
        } else {
            // Une erreur s'est produite lors de l'upload du fichier image
            $error_message = 'Erreur lors de l\'upload de l\'image.';
        }
    } else {
        // L'administrateur n'est pas connecté, afficher un message d'erreur
        $error_message = 'Vous devez être connecté en tant qu\'administrateur pour ajouter une actualité.';
    }
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
    
    <form method="post" enctype="multipart/form-data">
    <label for="titre">Titre :</label>
    <input type="text" id="titre" name="titre" required><br><br>
    <label for="contenu">Contenu :</label>
    <textarea id="contenu" name="contenu" required></textarea><br><br>
    <label for="image">Image :</label>
    <input type="file" id="image" name="image" accept="image/*" required><br><br>
    <input type="submit" value="Ajouter Actualité">
</form>

    
    <?php if (!empty($error_message)) : ?>
        <p style="color: red;"><?php echo $error_message; ?></p>
    <?php endif; ?>
</body>
</html>
