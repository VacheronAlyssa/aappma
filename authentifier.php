<?php
// Vérifiez les identifiants de l'administrateur (à personnaliser)
$admin_username = "admin";
$admin_password = "admin";

// Récupérez les données du formulaire
$username = $_POST["username"];
$password = $_POST["password"];

// Vérifiez si les identifiants sont corrects
if ($username === $admin_username && $password === $admin_password) {
    // Démarrez une session
    session_start();
    $_SESSION["logged_in"] = true;
    header("Location: admin.php"); // Redirigez vers la page d'administration
} else {
    echo "Identifiants incorrects. Veuillez réessayer.";
}
?>
