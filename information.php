<?php
session_start();
include("connection/connect.php");

$message = "";

if (isset($_SESSION["user_id"])) {
    $user_id = $_SESSION["user_id"];
    $query = "SELECT * FROM users WHERE u_id = '$user_id'";
    $result = mysqli_query($db, $query);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $password = $row['password'];
        $password_display = ($password === '') ? '' : str_repeat('*', strlen($password));
    } else {
        $message = "Aucune information trouvée pour cet utilisateur.";
    }

    if (isset($_POST['update'])) {
        $username = $_POST['username'];
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];
        $password = $_POST['password'];

        if (strlen($phone) > 10) {
            if (!empty($password)) {
                $hashed_password = md5($password);
                if ($hashed_password !== $row['password']) {
                    $updateQuery = "UPDATE users SET username='$username', f_name='$firstname', l_name='$lastname', email='$email', phone='$phone', address='$address', password='$hashed_password' WHERE u_id='$user_id'";
                    mysqli_query($db, $updateQuery);
                    $message = "Informations mises à jour avec succès !";
                } else {
                    $message = "Le nouveau mot de passe est identique à l'ancien mot de passe. Veuillez en choisir un nouveau.";
                }
            } else {
                $updateQuery = "UPDATE users SET username='$username', f_name='$firstname', l_name='$lastname', email='$email', phone='$phone', address='$address' WHERE u_id='$user_id'";
                mysqli_query($db, $updateQuery);
                $message = "Informations mises à jour avec succès !";
            }

            // Mettre à jour les informations de l'utilisateur dans la variable $row après la mise à jour
            $row['username'] = $username;
            $row['f_name'] = $firstname;
            $row['l_name'] = $lastname;
            $row['email'] = $email;
            $row['phone'] = $phone;
            $row['address'] = $address;
            $password_display = ($hashed_password === '') ? '' : str_repeat('*', strlen($hashed_password));
        } else {
            $message = "Le numéro de téléphone doit contenir plus de 10 chiffres.";
        }
    }
} else {
    $message = "Veuillez vous connecter pour accéder à cette page.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Informations utilisateur</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/animsition.min.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <style>
        /* CSS professionnel et responsive */
         body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 90%;
            margin: 50px auto;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
            padding: 20px;
        }

        h2 {
            color: #f57c00;
            font-weight: bold;
            text-align: center;
            font-size: 400%;
        }

        /* Reste du code CSS inchangé */

        form {
            /* Ajoutez ici le style pour le formulaire */
        }

        input[type="submit"] {
            background-color: #ff8f00;
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
            background-color: #ff9d3f;
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
            justify-content: space-between;
            margin-top: 20px;
        }

        .cta a {
            text-decoration: none;
            color: #ff8f00;
        }

        /* Style pour les boutons avec la classe "btn-orange" */
        .btn-orange {
            background-color: #ff8f00;
            color: #fff;
            border-radius: 4px;
            padding: 12px 24px;
            font-size: 16px;
            cursor: pointer;
            margin-right: 10px; /* Pour espacer les boutons */
        }

        /* Au survol, le fond devient un peu plus clair */
        .btn-orange:hover {
            background-color: #ff9d3f;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Mes informations</h2>
        <?php if (!empty($message)) { ?>
            <div class="alert alert-info"><?php echo $message; ?></div>
        <?php } ?>
        <form action="" method="post">
            <div class="form-group">
                <label for="username">Nom d'utilisateur :</label>
                <input type="text" class="form-control" id="username" name="username" value="<?php echo $row['username']; ?>" required>
            </div>
            <div class="form-group">
                <label for="firstname">Prénom :</label>
                <input type="text" class="form-control" id="firstname" name="firstname" value="<?php echo $row['f_name']; ?>" required>
            </div>
            <div class="form-group">
                <label for="lastname">Nom de famille :</label>
                <input type="text" class="form-control" id="lastname" name="lastname" value="<?php echo $row['l_name']; ?>" required>
            </div>
            <div class="form-group">
                <label for="email">Adresse e-mail :</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo $row['email']; ?>" required>
            </div>
            <div class="form-group">
                <label for="phone">Numéro de téléphone :</label>
                <input type="text" class="form-control" id="phone" name="phone" value="<?php echo $row['phone']; ?>" required>
            </div>
            <div class="form-group">
                <label for="address">Adresse de livraison :</label>
                <textarea class="form-control" id="address" name="address" rows="3" required><?php echo $row['address']; ?></textarea>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Mot de passe</label>
                <input type="text" class="form-control" name="password" id="exampleInputPassword1" value="<?php echo $password_display; ?>">
            </div>
            <div class="form-group">
                <!-- Bouton Sauvegarder -->
                <button type="submit" class="btn btn-primary btn-orange" name="update">Sauvegarder</button>
                <!-- Bouton Annuler -->
                <a href="index.php" class="btn btn-primary btn-orange">Annuler</a>
            </div>
        </form>
        
    </div>

    <!-- Reste du code JavaScript inchangé -->

    <script src="js/jquery.min.js"></script>
    <script src="js/tether.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/animsition.min.js"></script>
    <script src="js/bootstrap-slider.min.js"></script>
    <script src="js/jquery.isotope.min.js"></script>
    <script src="js/headroom.js"></script>
    <script src="js/foodpicky.min.js"></script>
</body>
</html>
