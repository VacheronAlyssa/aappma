<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - Page d'Administration</title>
</head>
<body>
    <h1>Connexion - Page d'Administration</h1>
    
    <form action="authentifier.php" method="post">
        <label for="username">Nom d'utilisateur :</label>
        <input type="text" id="username" name="username" required><br>
        <label for="password">Mot de passe :</label>
        <input type="password" id="password" name="password" required><br>
        <input type="submit" value="Se Connecter">
    </form>
</body>
</html>
