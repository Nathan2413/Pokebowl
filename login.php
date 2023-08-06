<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <style>
        /* CSS professionnel et responsive */
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            
            margin: 0;
            padding: 0;
        }

        .me {
        /* Ajoutez ici le code pour l'image de fond */
        
    }

    @keyframes scrollBackground {
        from {
            background-position: 0 0;
        }
        to {
            background-position: 100% 0;
        }
    }

        .container {
            max-width: 500px;
            margin: 100px auto;
            background-color: #fff;
            border-radius: 8px 60px 8px 60px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
            padding: 20px;
        }

        h2 {
            color: #f57c00;
            text-align: center;
            font-size: 300%;
        }

        form {
            /* Ajoutez ici le style pour le formulaire */
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #333;
        }

        input[type="text"],
        input[type="password"] {
            width: 95%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
        }

        input[type="submit"] {
            background-color: #f57c00;
            width: 80%;
            color: #fff;
            border: none;
            border-radius: 4px;
            padding: 12px 24px; /* Augmenter la taille du bouton */
            font-size: 16px;
            cursor: pointer;
            display: block; /* Centrer le bouton */
            margin: 0 auto; /* Centrer le bouton */
        }

        input[type="submit"]:hover {
            background-color: #ff9233;
        }

        .error {
            color: #c0392b;
            margin-bottom: 10px;
            padding: 5px;
            border: 1px solid #c0392b;
            border-radius: 4px;
            background-color: #f9dddd;
        }

        .error-message {
            font-size: 14px;
            margin-bottom: 5px;
        }

        .cta {
            display: flex;
            justify-content: center; /* Centrer les liens horizontalement */
            flex-wrap: wrap; /* Permettre aux liens de se mettre en ligne */
            margin-top: 20px; /* Augmenter l'espacement entre le formulaire et les liens */
        }

        .cta a {
            text-decoration: none;
            color: #f57c00;
            padding: 8px 12px; /* Ajuster la taille des liens */
            border: 1px solid #f57c00; /* Ajouter une bordure aux liens */
            border-radius: 4px;
            transition: background-color 0.3s ease-in-out; /* Ajouter une transition */
            margin: 5px; /* Ajouter une marge autour des liens */
        }

        .cta a:hover {
            background-color: #fc5700; /* Changer la couleur au survol */
            color: #fff; /* Changer la couleur du texte au survol */
        }

        .forgot-password-link {
            text-align: center; /* Centrer le lien "Mot de passe oublié" */
            margin-top: 15px; /* Ajouter une marge pour l'espacement */
        }
    </style>
</head>

<body>
    <div class="me">
        <div class="container">
            <h2>P<img src="images/Cocktail_margarita.png" width="40">KEB<img src="images/pineapple.png" width="50">WL</h2>
            <?php
            include("connection/connect.php");
            error_reporting(0);
            session_start();
            $message = ""; // Initialisez la variable $message ici
            if (isset($_POST['submit'])) {
                $username = $_POST['username'];
                $password = $_POST['password'];

                if (!empty($_POST["submit"])) {
                    $loginquery = "SELECT * FROM users WHERE username='$username' && password='" . md5($password) . "'";
                    $result = mysqli_query($db, $loginquery);
                    $row = mysqli_fetch_array($result);

                    if (is_array($row)) {
                        $_SESSION["user_id"] = $row['u_id'];
                        header("refresh:1;url=index.php");
                    } else {
                        $message = "Nom d'utilisateur ou mot de passe invalide !";
                    }
                }
            }
            ?>
            <form action="" method="post">
                <?php if (!empty($message)) : ?>
                    <div class="error">
                        <p class="error-message"><?php echo $message; ?></p>
                    </div>
                <?php endif; ?>
                <label for="username">Nom d'utilisateur:</label>
                <input type="text" id="username" name="username" required>

                <label for="password">Mot de passe:</label>
                <input type="password" id="password" name="password" required>

                <input type="submit" name="submit" value="Connexion">
            </form>
            <div class="cta">
                <a href="registration.php">Créer un compte</a>
                <a href="mdp_oub.php">Mot de passe oublié</a>
            </div>
            
        </div>
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
