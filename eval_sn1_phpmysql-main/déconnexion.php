<?php
    require 'config.php';
    require 'header.php';
  
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Connexion · Agenda</title>
    <link rel="icon" href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 128 128%22><text y=%221.2em%22 font-size=%2296%22>📅</text></svg>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
<main class="container">
    <div class="narrow">
        <div class="card">
            <h1>Connexion</h1>

            <!-- Exemple de message d'erreur :
            <div class="flash flash-error">Identifiants invalides.</div>
            -->

            <form class="form" method="post">
                <div>
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" autocomplete="email" required autofocus>
                </div>

                <div>
                    <label for="password">Mot de passe</label>
                    <input type="password" id="password" name="password" autocomplete="current-password" required>
                </div>

                <button type="submit" name="register">Se connecter</button>
            </form>

            <p class="form-footer">Pas encore de compte ? <a href="inscription.php">Créer un compte</a></p>
        </div>
        <?php
                    
                if (isset($_POST['register'])){
                    $email = $_POST['email'];
                    $mdp = $_POST['password'];           
                    $request = $pdo->prepare("SELECT * FROM user WHERE email = ?");
                    $request->execute(array($email));
                    $user = $request->fetch(PDO::FETCH_ASSOC);               
                    if($user){    
                    if ($user && password_verify($mdp, $user['password'])){
                            $_SESSION['user'] = [
                                'id'    => $user['id'],
                                'email' => $user['email']
                            ];                     
                            header('Location: index.php');
                            exit();
                        } else {
                            $erreur = "Email ou mot de passe incorrect.";
                        }
                        
                        
                 ?>
                 
                 <?php
                } else {
                    echo "<p>Aucun compte associé à cet email.</p>";
                }
            }
        ?>
    </div>

    <!-- ===== Début du pied de page (à mettre dans un fichier footer.php) ===== -->
    </main>

<?php
    require 'footer.php';
    ?>
</body>
</html>