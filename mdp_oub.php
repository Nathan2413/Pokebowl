<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réinitialisation du mot de passe - Restaurant Hawaïen</title>
    <style>
        /* Styles CSS ici */
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 500px;
            margin: 50px auto;
            background-color: #fff;
            border-radius: 8px 60px 8px 60px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
            padding: 20px;
        }

        h1 {
            color: #f57c00;
            text-align: center;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #333;
        }

        input[type="email"],
        input[type="tel"],
        input[type="password"] {
            width: 95%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
        }

        .btn-container {
        text-align: center;
        }
        input[type="submit"],
        .btn-cancel {
            background-color: #f57c00;
            color: #fff;
            border: none;
            border-radius: 4px;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
        }

        input[type="submit"]:hover,
        .btn-cancel:hover {
            background-color: #ff9233;
        }
        
        .btn-cancel {
            text-decoration: none;
        }

        .error {
            color: #c0392b;
            margin-bottom: 10px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Réinitialisation du mot de passe</h1>
        <?php
        // Fonction pour se connecter à la base de données Pokebwol
        function connectToDatabase()
        {
            $host = "localhost"; // Remplacez par l'hôte de votre base de données
            $username = "root"; // Remplacez par le nom d'utilisateur de votre base de données
            $password = ""; // Remplacez par le mot de passe de votre base de données
            $database = "Pokebowl"; // Remplacez par le nom de votre base de données

            try {
                $pdo = new PDO("mysql:host=$host;dbname=$database", $username, $password, array(
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
                ));
                return $pdo;
            } catch (PDOException $e) {
                die("Erreur de connexion à la base de données: " . $e->getMessage());
            }
        }

        // Variable pour suivre si le formulaire a été soumis et si les données sont valides
        $formSubmitted = false;
        $dataValid = false;
        $errorMsg = "";

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $formSubmitted = true;

            // Récupérer les données du formulaire
            $email = $_POST["email"];
            $phone = $_POST["phone"];
            $newPassword = $_POST["new_password"];
            $confirmPassword = $_POST["confirm_password"];

            // Vérifier si le mot de passe est supérieur à 6 caractères
            if (strlen($newPassword) > 6) {
                // Vérifier si l'email et le numéro de téléphone existent déjà dans la base de données
                $pdo = connectToDatabase();
                if ($pdo) {
                    $checkQuery = "SELECT * FROM users WHERE email = :email AND phone = :phone";
                    $stmt = $pdo->prepare($checkQuery);
                    $stmt->execute(array(':email' => $email, ':phone' => $phone));
                    $existingUser = $stmt->fetch();

                    if ($existingUser) {
                        // Vérifier si le mot de passe et le nouveau mot de passe sont égaux
                        if ($newPassword === $confirmPassword) {
                            $dataValid = true;

                            // Si tout est conforme, vous pouvez mettre à jour le mot de passe dans la base de données en utilisant MD5.
                            $hashedPassword = md5($newPassword);

                            // Maintenant, nous pouvons effectuer l'insertion dans la base de données.
                            try {
                                $updateQuery = "UPDATE users SET password = :password WHERE email = :email";
                                $stmt = $pdo->prepare($updateQuery);
                                $stmt->execute(array(':password' => $hashedPassword, ':email' => $email));

                                // Rediriger vers la page login.php
                                header("Location: login.php");
                                exit; // Assurez-vous de mettre "exit" après la redirection pour terminer le script
                            } catch (PDOException $e) {
                                $errorMsg = "Erreur lors de l'exécution de la requête: " . $e->getMessage();
                            }
                        } else {
                            $errorMsg = "Le nouveau mot de passe et la confirmation ne correspondent pas.";
                        }
                    } else {
                        $errorMsg = "L'e-mail et le numéro de téléphone ne correspondent pas aux enregistrements existants dans la base de données. Veuillez vérifier vos informations.";
                    }
                }
            } else {
                $errorMsg = "Le mot de passe doit contenir au moins 6 caractères.";
            }
        }
        ?>

        <form method="POST" action="">
            <label for="email">E-mail:</label>
            <input type="email" id="email" name="email" required>

            <label for="phone">Numéro de téléphone:</label>
            <input type="tel" id="phone" name="phone" required>

            <label for="new_password">Nouveau mot de passe:</label>
            <input type="password" id="new_password" name="new_password" required>

            <label for="confirm_password">Confirmer le mot de passe:</label>
            <input type="password" id="confirm_password" name="confirm_password" required>

            <div class="btn-container">
                <input type="submit" value="Réinitialiser le mot de passe">
                <a href="login.php" class="btn-cancel">Annuler</a>
            </div>
        </form>

        <?php
        // Afficher l'erreur uniquement si le formulaire a été soumis et si les données sont invalides
        if ($formSubmitted && !$dataValid) {
            echo '<div class="error">' . $errorMsg . '</div>';
        }
        ?>
    </div>
    <script>
        // Afficher l'erreur s'il y en a après la soumission du formulaire
        window.onload = function() {
            var errorDiv = document.querySelector('.error');
            if (errorDiv.innerHTML.trim() !== '') {
                errorDiv.style.display = 'block';
            }
        };
    </script>
</body>
</html>
