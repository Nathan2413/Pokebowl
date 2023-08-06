<!DOCTYPE html>
<html lang="en">
    <style type="text/css">
  .input-field div.error{
    position: relative;
    top: -1rem;
    left: 0rem;
    font-size: 0.8rem;
    color:#FF4081;
    -webkit-transform: translateY(0%);
    -ms-transform: translateY(0%);
    -o-transform: translateY(0%);
    transform: translateY(0%);
  }
  .input-field label.active{
      width:100%;
  }
  .left-alert input[type=text] + label:after, 
  .left-alert input[type=password] + label:after, 
  .left-alert input[type=email] + label:after, 
  .left-alert input[type=url] + label:after, 
  .left-alert input[type=time] + label:after,
  .left-alert input[type=date] + label:after, 
  .left-alert input[type=datetime-local] + label:after, 
  .left-alert input[type=tel] + label:after, 
  .left-alert input[type=number] + label:after, 
  .left-alert input[type=search] + label:after, 
  .left-alert textarea.materialize-textarea + label:after{
      left:0px;
  }
  .right-alert input[type=text] + label:after, 
  .right-alert input[type=password] + label:after, 
  .right-alert input[type=email] + label:after, 
  .right-alert input[type=url] + label:after, 
  .right-alert input[type=time] + label:after,
  .right-alert input[type=date] + label:after, 
  .right-alert input[type=datetime-local] + label:after, 
  .right-alert input[type=tel] + label:after, 
  .right-alert input[type=number] + label:after, 
  .right-alert input[type=search] + label:after, 
  .right-alert textarea.materialize-textarea + label:after{
      right:70px;
  }
  </style>
<?php
include("connection/connect.php");
include_once 'product-action.php';
error_reporting(0);
session_start();
$today_date = date('Y-m-d');

// Récupérer l'adresse e-mail de l'utilisateur à partir de la base de données
$user_id = $_SESSION["user_id"];
$query = "SELECT email, phone FROM users WHERE u_id = '$user_id'";
$result = mysqli_query($db, $query);
if ($result) {
    $user_data = mysqli_fetch_assoc($result);
    $user_email = $user_data['email'];
    $user_phone = $user_data['phone'];

    // Masquer l'adresse e-mail
    $at_position = strpos($user_email, '@');
    $dot_position = strrpos($user_email, '.');
    $hidden_email = substr($user_email, 0, 1) . str_repeat('*', $at_position - 1) . substr($user_email, $at_position, 1) . str_repeat('*', $dot_position - $at_position - 1) . substr($user_email, $dot_position);

    // Vérifier si le formulaire a été soumis
    if (isset($_POST['submit'])) {
        $entered_otp = $_POST['otp'];

        // Vérifier si le one-time password correspond aux 6 derniers chiffres du numéro de téléphone
        $otp_from_phone = substr($user_phone, -6);
        // Inverser les 6 derniers chiffres du numéro de téléphone
        $otp_from_phone = strrev($otp_from_phone);      
        if (isset($_POST['submit']) && $entered_otp !== $otp_from_phone) {
                
            } elseif (isset($_POST['submit']) && $entered_otp === $otp_from_phone) {
                // Le one-time password est correct, procéder au paiement et à la redirection
                foreach ($_SESSION["cart_item"] as $item) {
                    $SQL = "INSERT INTO users_orders(u_id, title, quantity, price) VALUES ('".$_SESSION["user_id"]."','".$item["title"]."','".$item["quantity"]."','".$item["price"]."')";
                    mysqli_query($db, $SQL);
                }
                unset($_SESSION["cart_item"]);
                $success = "Merci. Votre commande a bien été reçue!";
                function_alert();
            }
    }
}
    
function generateRandomLetters() {
        $letters = '';
        for ($i = 0; $i < 3; $i++) {
            $randomAscii = rand(65, 90); // ASCII codes for uppercase letters (A=65, Z=90)
            $letters .= chr($randomAscii);
        }
        return $letters;
    }

    $reference_code = generateRandomLetters();    

function function_alert()
{ 
    echo "<script>alert('Merci. Votre commande a bien été reçue');</script>"; 
    echo "<script>window.location.replace('your_orders.php');</script>"; 
} 

function generateOTPFromPhone($phone)
{
    $digits = substr($phone, -6);
    $otp = strrev($digits);
    return $otp;
}


if(empty($_SESSION["user_id"]))
{
	header('location:login.php');
}
else{
	$item_total = 0;
	foreach ($_SESSION["cart_item"] as $item)
	{
		$item_total += ($item["price"] * $item["quantity"]);
	}

	if(isset($_POST['submit']))
	{
		$payment_type = $_POST['payment_type'];

		if ($payment_type === 'Cash On Delivery')
		{
			foreach ($_SESSION["cart_item"] as $item)
			{
				$SQL = "INSERT INTO users_orders(u_id, title, quantity, price) VALUES ('".$_SESSION["user_id"]."','".$item["title"]."','".$item["quantity"]."','".$item["price"]."')";
				mysqli_query($db, $SQL);
			}
			unset($_SESSION["cart_item"]);
			$success = "Thank you. Your order has been placed";
			function_alert();
		}
		elseif ($payment_type === 'Wallet')
		{
			// Redirect to purchase.php for wallet payment
			header('location: purchase.php');
			exit();
		}
	}
}
?>


<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="#">
    <title>identification du titulaire de la carte</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/animsition.min.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet"> 
    <link href="../Pokebowl2/css/materialize.min.css" type="text/css" rel="stylesheet" media="screen,projection">
  <link href="../Pokebowl2/css/style.min.css" type="text/css" rel="stylesheet" media="screen,projection">
  <!-- Custome CSS-->    
  <link href="../Pokebowl2/css/custom/custom.min.css" type="text/css" rel="stylesheet" media="screen,projection">

  <!-- INCLUDED PLUGIN CSS ON THIS PAGE -->
  <link href="../Pokebowl2/js/plugins/perfect-scrollbar/perfect-scrollbar.css" type="text/css" rel="stylesheet" media="screen,projection">
</head>
    
<style type="text/css" rel="stylesheet">

    header{
        background: url("images/plats/rest.png");
        width:1000px;
        height:100px;
    }
    
    .btn-purple {
        background-color: #551fbc;
        color: #fff;
    }

    .btn-purple:hover {
        background-color: #de840a;
        color: #070707;
    }
</style>
<body>
    
    <div class="site-wrapper">
        <header id="header" class="header-scroll top-header headrom">
            <nav class="navbar navbar-dark">
                <div class="container">
                    <button class="navbar-toggler hidden-lg-up" type="button" data-toggle="collapse" data-target="#mainNavbarCollapse">&#9776;</button>
                    <a class="navbar-brand" href="index.php"> Pokebowl </a>
                    <div class="collapse navbar-toggleable-md  float-lg-right" id="mainNavbarCollapse">
                        <ul class="nav navbar-nav">
                            <li > <a class="nav-link active" href="index.php">Accueil <span class="sr-only">(current)</span></a> </li>
                            <li > <a class="nav-link active" href="restaurants.php"><font color="#059e24" class="than">Restaurants </font> <span class="sr-only"></span></a> </li>
                            
							<?php
						if(empty($_SESSION["user_id"]))
							{
								echo '<li class="nav-item"><a href="login.php" class="nav-link active">Connexion</a> </li>
							  <li class="nav-item"><a href="registration.php" class="nav-link active">Inscrire</a> </li>';
							}
						else
							{
									
									
								    echo  '<li ><a href="your_orders.php" class="nav-link active">Mes commandes</a> </li>';
                                    echo  '<li ><a href="information.php" class="nav-link  "> <font color="white">Mes informations</font></a> </li>';
									echo  '<li ><a href="logout.php" class="nav-link active">Se déconnecter</a> </li>';
							}

						?>
							 
                        </ul>
                    </div>
                </div>
            </nav>
            <br> 
            
        </header>
        <div class="page-wrapper">
            <div class="top-links"><br>
                <center>
                <div class="container">
                    <ul class="row links">
                      
                        <li class="col-xs-12 col-sm-4 link-item"><span>1</span><a href="restaurants.php">Choisissez un restaurant</a></li>
                        <li class="col-xs-12 col-sm-4 link-item "><span>2</span><a href="#">Choisissez votre plat préféré</a></li>
                        <li class="col-xs-12 col-sm-4 link-item active" ><span>3</span><a href="checkout.php">Commandez et payez</a></li>
                    </ul>
                </div></center>
            </div>
			
                <div class="container">
                 
					   <span style="color:green;">
								<?php echo $success; ?>
										</span>
					
                </div>
            
			
			
				  
            <div class="container m-t-30">
			<form action="" method="post">
    <div class="widget clearfix">
        <div class="widget-body">
            <?php
                    if (isset($_POST['submit']) && $entered_otp !== $otp_from_phone) {
                        echo '<p style="color: red; text-align: center;">Votre ID utilisateur est invalide. Veuillez réessayer.</p>';
                    }
                    ?>
            <div class="row">
                <div class="col-sm-12">
                    <div class="cart-totals margin-b-20">
                        <div class="cart-totals-title">
                            <h4>Résumé du panier</h4>
                        </div>
                        <div class="cart-totals-fields">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td>Sous-total du panier</td>
                                        <td><?php echo "RS ".$item_total; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Frais de livraison</td>
                                        <td>Gratuit</td>
                                    </tr>
                                    <tr>
                                        <td class="text-color"><strong>Total</strong></td>
                                        <td class="text-color"><strong><?php echo "RS ".$item_total; ?></strong></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <h1>Identification du titulaire de la carte</h1>
                        
                        <p>Pour authentifier cette transaction, des informations supplémentaires vous sont demandées</p>
                        <label for="otp">Entrez votre ID utilisateur</label>
                            <input type="text" id="otp" name="otp" pattern="[0-9]{6}" inputmode="numeric" maxlength="6" required>
                            
                        
                            <button type="submit" name="submit" class="btn btn-purple btn-block mt-3">Validation</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
            </div>
            
            
        </div>
         </div>

    <script src="js/jquery.min.js"></script>
    <script src="js/tether.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/animsition.min.js"></script>
    <script src="js/bootstrap-slider.min.js"></script>
    <script src="js/jquery.isotope.min.js"></script>
    <script src="js/headroom.js"></script>
    <script src="js/foodpicky.min.js"></script>
    <!-- jQuery Library -->
    <script type="text/javascript" src="../Pokebowl2/js/plugins/jquery-1.11.2.min.js"></script>    
    <!--angularjs-->
    <script type="text/javascript" src="../Pokebowl2/js/plugins/angular.min.js"></script>
    <!--materialize js-->
    <script type="text/javascript" src="../Pokebowl2/js/materialize.min.js"></script>
    <!--scrollbar-->
    <script type="text/javascript" src="../Pokebowl2/js/plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script type="text/javascript" src="../Pokebowl2/js/plugins/jquery-validation/jquery.validate.min.js"></script>
    <script type="text/javascript" src="../Pokebowl2/js/plugins/jquery-validation/additional-methods.min.js"></script>	
	<script type="text/javascript" src="../Pokebowl2/js/plugins/formatter/jquery.formatter.min.js"></script>   
    <!--plugins.js - Some Specific JS codes for Plugin Settings-->
    <script type="text/javascript" src="../Pokebowl2/js/plugins.min.js"></script>
    <!--custom-script.js - Add your own theme custom JS-->
    <script type="text/javascript" src="../Pokebowl2/js/custom-script.js"></script>
    
    
</body>

</html>

<?php

?>
