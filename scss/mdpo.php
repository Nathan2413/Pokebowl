<!DOCTYPE html>
<html lang="en" >

<head>
  <meta charset="UTF-8">
  <title>Mot de passe oublié</title>
  
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">

  <link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900|RobotoDraft:400,100,300,500,700,900'>
<link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>

      <link rel="stylesheet" href="css/login.css">
  <link href="../Pokebowl/css/materialize.min.css" type="text/css" rel="stylesheet" media="screen,projection">
  <link href="../Pokebowl/css/style.min.css" type="text/css" rel="stylesheet" media="screen,projection">
    <!-- Custome CSS-->    
    <link href="../Pokebowl/css/custom/custom.min.css" type="text/css" rel="stylesheet" media="screen,projection">
  

  <!-- INCLUDED PLUGIN CSS ON THIS PAGE -->
  <link href="../Pokebowl/js/plugins/perfect-scrollbar/perfect-scrollbar.css" type="text/css" rel="stylesheet" media="screen,projection">
	  <style type="text/css">
          body{
              ;
          }
	  #buttn{
		  color:#fff;
		  background-color:orangered;
          border-radius: 10px;
          cursor: pointer;
	  }
      #buttn:hover{
		  color:#fff;
		  background-color: #e55718;
          border-radius: 10px;
          cursor: pointer;
	  }
	  </style>


    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/animsition.min.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/im.css" rel="stylesheet">
    
</head>

<body>

<div style="background-image: url('images/plats/poke.jpg'); ">

<?php
include("connection/connect.php"); 
error_reporting(0); 
session_start(); 
if(isset($_POST['submit']))  
{
	$email = $_POST['email'];  
	$phone = $_POST['phone'];
	
	if(!empty($_POST["submit"]))   
     {
	$verifquery ="SELECT * FROM users WHERE email='$email' && phone='$phone'"; 
	$result=mysqli_query($db, $verifquery); //executing
	$row=mysqli_fetch_array($result);
	
	                        if(is_array($row)) 
								{
                                    	$_SESSION["user_id"] = $row['u_id']; 
										 header("refresh:1;url=mdpv.php"); 
	                            } 
							else
							    {
                                      	$message = "Mail utilisateur ou numéro télephone invalide !"; 
                                }
	 }
	
	
}
?>
  

<div class="pen-title"> </div>
<div class="pen-title">  </div>

<div class="module form-module">
  <div class="toggle">
   
  </div>
  <div class="form">
    <h2>P<img src="../poke/images/Cocktail_margarita.png" width="40">KEB<img src="../poke/images/pineapple.png" width="50">WL</h2>
    <form action="" method="post">
      <div class="row margin">
          <div class="input-field col s12">
            <i class="mdi-communication-email prefix"></i>
            <input name="email" id="email" type="text" required>
            <label for="email" class="center-align" >Mail d'utilisateur</label>
          </div>
        </div>
      <div class="row margin">
          <div class="input-field col s12">
            <i class="mdi-communication-phone prefix"></i>
            <input name="phone" id="phone" type="text" required>
            <label for="phone">Numéro télephone</label>
          </div>
        </div>
        <span style="color:red;"><?php echo $message; ?></span> 
        <span style="color:green;"><?php echo $success; ?></span>
      <input type="submit" id="buttn" name="submit" value="Rechercher" />
    </form>
  </div>
  
  <div class="cta"><a href="registration.php" style="color:#fc5700;"> Créer un compte</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="login.php" style="color:#fc5700;"> Se connecter </a></div>
  
</div>
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

  

   
  <div class="container-fluid pt-3"></div>
    <div class="container-fluid pt-3"></div>
  <div class="container-fluid pt-3"></div>
  <div class="container-fluid pt-3"></div>



    </div>   
        
<script type="text/javascript" src="../Pokebowl/js/plugins/jquery-1.11.2.min.js"></script>
  <!--materialize js-->
  <script type="text/javascript" src="../Pokebowl/js/materialize.min.js"></script>
  <!--scrollbar-->
  <script type="text/javascript" src="../Pokebowl/js/plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>
 <script type="text/javascript" src="../Pokebowl/js/plugins.min.js"></script>
    <!--custom-script.js - Add your own theme custom JS-->
    <script type="text/javascript" src="../Pokebowl/js/custom-script.js"></script>
       


</body>

</html>
