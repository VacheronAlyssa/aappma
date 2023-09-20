<!DOCTYPE html>
<html>
<head>
    <title>Ajouter une Actualité</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
    <h1>Ajouter une Actualité</h1>

    <?php
    // Traitement du formulaire lorsqu'il est soumis
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Récupération des données du formulaire
        $titre = $_POST["titre"];
        $contenu = $_POST["contenu"];
        $date = $_POST["date"];

        // Validation des données (vous pouvez ajouter des vérifications supplémentaires ici)

        // Connexion à la base de données (à personnaliser avec vos informations)
        $servername = "localhost";
        $username = "votre_nom_utilisateur";
        $password = "votre_mot_de_passe";
        $dbname = "votre_base_de_donnees";

        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            // Définir le mode d'erreur PDO à exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Préparation de la requête SQL d'insertion
            $sql = "INSERT INTO actualites (titre, contenu, date) VALUES (:titre, :contenu, :date)";
            $stmt = $conn->prepare($sql);

            // Liaison des paramètres
            $stmt->bindParam(':titre', $titre);
            $stmt->bindParam(':contenu', $contenu);
            $stmt->bindParam(':date', $date);

            // Exécution de la requête
            $stmt->execute();

            echo "L'actualité a été ajoutée avec succès.";
        } catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage();
        }

        // Fermeture de la connexion
        $conn = null;
    }
    ?>

    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label for="titre">Titre :</label>
        <input type="text" name="titre" required><br><br>

        <label for="contenu">Contenu :</label>
        <textarea name="contenu" required></textarea><br><br>

        <label for="date">Date :</label>
        <input type="date" name="date" required><br><br>

        <input type="submit" value="Ajouter">
    </form>

    <a href="index.php">Retour à la liste des actualités</a>
</body>
</html>
