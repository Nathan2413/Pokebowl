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

function function_alert()
{ 
    echo "<script>alert('Thank you. Your Order has been placed!');</script>"; 
    echo "<script>window.location.replace('your_orders.php');</script>"; 
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
			$success = "Thank you. Your order has been placed!";
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
    <title>Checkout</title>
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
                            <li class="nav-item"> <a class="nav-link active" href="index.php">Accueil <span class="sr-only">(current)</span></a> </li>
                            <li class="nav-item"> <a class="nav-link active" href="restaurants.php"><font color="#059e24" class="than">Restaurants </font> <span class="sr-only"></span></a> </li>
                            
							<?php
						if(empty($_SESSION["user_id"]))
							{
								echo '<li class="nav-item"><a href="login.php" class="nav-link active">Connexion</a> </li>
							  <li class="nav-item"><a href="registration.php" class="nav-link active">Inscrire</a> </li>';
							}
						else
							{
									
									
								    echo  '<li class="nav-item"><a href="your_orders.php" class="nav-link active">Mes commandes</a> </li>';
                                    echo  '<li ><a href="information.php" class="nav-link  "> <font color="white">Mes informations</font></a> </li>';
									echo  '<li class="nav-item"><a href="logout.php" class="nav-link active">Se déconnecter</a> </li>';
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
                        <form method="post" action="#">
                            <div class="row">
                                
                                <div class="col-sm-12">
                                    <div class="cart-totals margin-b-20">
                                        <div class="cart-totals-title">
                                            <h4>Résumé du panier</h4> </div>
                                        <div class="cart-totals-fields">
										
                                            <table class="table">
											<tbody>
                                          
												 
											   
                                                    <tr>
                                                        <td>Sous-total du panier</td>
                                                        <td> <?php echo "RS ".$item_total; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Frais de livraison</td>
                                                        <td>Gratuit</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-color"><strong>Total</strong></td>
                                                        <td class="text-color"><strong> <?php echo "RS ".$item_total; ?></strong></td>
                                                    </tr>
                                                </tbody>
												
												
												
												
                                            </table>
                                        </div>
                                    </div>
                                    <div class="payment-option">
                                        <ul class=" list-unstyled">
                                            <li>
                                                <select id="payment_type" name="payment_type">
									<option value="Wallet" selected>Porte-feuille</option>
									<option value="Cash On Delivery" >Paiement à la livraison</option>							
							                     </select>
                                                
                                            </li>
                                            <li>
                    <div class="row">
                        <div class="input-field col s12">
                          <i class="mdi-action-credit-card prefix"></i>
							<input name="cc_number" id="cc_number" type="text" data-error=".errorTxt2" required>
							<label for="cc_number" class="">Numéro de carte</label>
							<div class="errorTxt2"></div>
                        </div>
                      </div>
                       <div class="row">
                        <div class="input-field col s12">
                          <i class="mdi-action-credit-card prefix"></i>
							<input name="date_number" id="date_number" type="text" data-error=".errorTxt2" required>
							<label for="date_number" class="">Date fin</label>
							<div class="errorTxt2"></div>
                        </div>
                      </div>                         
                      <div class="row">
                        <div class="input-field col s12">
                          <i class="mdi-communication-vpn-key prefix"></i>	
							<input name="cvv_number" id="cvv_number" type="text" data-error=".errorTxt3" required>
							<label for="cvv_number" class="">Numéro CVV</label>								
							<div class="errorTxt3"></div>
                        </div>
                                            </li>
                                        </ul>
                                        <p class="text-xs-center"> <input type="submit" onclick="return confirm('Voulez-vous confirmer la commande ?');" name="submit"  class="btn btn-purple btn-block mt-3" value="Commandez maintenant"> </p>
                                    </div>
									</form>
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
    <script type="text/javascript">
    $("#formValidate").validate({
        rules: {
            
            cc_number: {
                required: true,
                minlength: 16,
            },
            cvv_number: {
                required: true,
                minlength: 3,
			},
		},
        messages: {
           	
           cc_number:{
                required: "Please provide card number",
                minlength: "Enter at least 16 digits",
            },	
           cvv_number:{
                required: "Please provide CVV number",
                minlength: "Enter at least 3 digits",		
            },				
		},
        errorElement : 'div',
        errorPlacement: function(error, element) {
          var placement = $(element).data('error');
          if (placement) {
            $(placement).append(error)
          } else {
            error.insertAfter(element);
          }
        }
     });
        $('#date_number').formatter({
          'pattern': '{{99}}/{{99}}',
          'persistent': true
      });
	  $('#cc_number').formatter({
          'pattern': '{{9999}} {{9999}} {{9999}} {{9999}}',
          'persistent': true
      });
	  $('#cvv_number').formatter({
          'pattern': '{{9}}{{9}}{{9}}',
          'persistent': true
      });
		$('#payment_type').change(function() {
		if ($(this).val() === 'Cash On Delivery') {
		  $("#cc_number").prop('disabled', true);
		  $("#cvv_number").prop('disabled', true);
          $("#date_number").prop('disabled', true);
		}
		if ($(this).val() === 'Wallet'){
		  $("#cc_number").prop('disabled', false);
		  $("#cvv_number").prop('disabled', false);	
          $("#date_number").prop('disabled', false);
		}
		});
    </script>
</body>

</html>

<?php

?>
