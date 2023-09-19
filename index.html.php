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
<body>
    <header>
        <div id="logo-container">
            <img src="photos/logbroche.png" alt="Logo 1"><div id="slideshow">

            </div>
         <h1 id="appma-name">AAPPMA "Le Brochet de Basse et Vilaine"</h1>
            <img src="photos/logofede56.jpg" alt="Logo 2">
        </div>
        
    </div>
    <!-- Inclure le fichier de navigation -->
    <div id="navigation-container"></div>

    </header>

 
  


    <section id="news">
    <?php
// Établir une connexion à la base de données (à personnaliser avec vos informations de connexion)
$servername = "localhost";
$username = "admin";
$password = "admin";
$dbname = "aappma";

$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion à la base de données
if ($conn->connect_error) {
    die("Erreur de connexion à la base de données : " . $conn->connect_error);
}

// Requête SQL pour récupérer les actualités (à personnaliser avec votre structure de base de données)
$sql = "SELECT titre, contenu, date FROM actualites ORDER BY date DESC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Afficher les actualités dans votre page HTML
    while ($row = $result->fetch_assoc()) {
        echo "<h3>" . $row["titre"] . "</h3>";
        echo "<p>Date : " . $row["date"] . "</p>";
        echo "<p>" . $row["contenu"] . "</p>";
        echo "<hr>";
    }
} else {
    echo "Aucune actualité n'a été trouvée.";
}

// Fermer la connexion à la base de données
$conn->close();
?>


    <section id="manifestations">
<img src="photos/brochet23.jpg" alt="brocher">  
 </section>
 <div id="footer-container"></div>
 <script>
    $(document).ready(function() {
        $("#navigation-container").load("navigation.html");
    });
</script>
<!-- Charger le contenu du fichier de pied de page -->
<script>
    $(document).ready(function() {
        $("#footer-container").load("footer.html");
    });
</script>
</body>
</html>
