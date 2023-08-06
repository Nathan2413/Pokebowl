<!DOCTYPE html>
<html lang="en">
<?php
include("connection/connect.php");
error_reporting(0);
session_start();

if(empty($_SESSION['user_id']))  
{
	header('location:login.php');
}
else
{
?>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="#">
    <title>Mes commandes</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/animsition.min.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
<style type="text/css" rel="stylesheet">

    header{
        background: url("images/plats/res.jpg");
        width:1000px;
        height:230px;
    }
    .posi{
        text-align: center;
    }
.indent-small {
  margin-left: 5px;
}
.form-group.internal {
  margin-bottom: 0;
}
.dialog-panel {
  margin: 10px;
}
.datepicker-dropdown {
  z-index: 200 !important;
}
.panel-body {
  background: #e5e5e5;
  /* Old browsers */
  background: -moz-radial-gradient(center, ellipse cover, #e5e5e5 0%, #ffffff 100%);
  /* FF3.6+ */
  background: -webkit-gradient(radial, center center, 0px, center center, 100%, color-stop(0%, #e5e5e5), color-stop(100%, #ffffff));
  /* Chrome,Safari4+ */
  background: -webkit-radial-gradient(center, ellipse cover, #e5e5e5 0%, #ffffff 100%);
  /* Chrome10+,Safari5.1+ */
  background: -o-radial-gradient(center, ellipse cover, #e5e5e5 0%, #ffffff 100%);
  /* Opera 12+ */
  background: -ms-radial-gradient(center, ellipse cover, #e5e5e5 0%, #ffffff 100%);
  /* IE10+ */
  background: radial-gradient(ellipse at center, #e5e5e5 0%, #ffffff 100%);
  /* W3C */
  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#e5e5e5', endColorstr='#ffffff', GradientType=1);
  font: 600 15px "Open Sans", Arial, sans-serif;
}
label.control-label {
  font-weight: 600;
  color: #777;
}

/* 
table { 
	width: 750px; 
	border-collapse: collapse; 
	margin: auto;
	
	}

/* Zebra striping */
/* tr:nth-of-type(odd) { 
	background: #eee; 
	}

th { 
	background: #404040; 
	color: white; 
	font-weight: bold; 
	
	}

td, th { 
	padding: 10px; 
	border: 1px solid #ccc; 
	text-align: left; 
	font-size: 14px;
	
	} */ */


@media 
only screen and (max-width: 760px),
(min-device-width: 768px) and (max-device-width: 1024px)  {

	/* table { 
	  	width: 100%; 
	}

	
	table, thead, tbody, th, td, tr { 
		display: block; 
	} */
	
	
	/* thead tr { 
		position: absolute;
		top: -9999px;
		left: -9999px;
	}
	
	tr { border: 1px solid #ccc; } */
	
	/* td { 
		
		border: none;
		border-bottom: 1px solid #eee; 
		position: relative;
		padding-left: 50%; 
	}

	td:before { 
		
		position: absolute;
	
		top: 6px;
		left: 6px;
		width: 45%; 
		padding-right: 10px; 
		white-space: nowrap;
		
		content: attr(data-column);

		color: #000;
		font-weight: bold;
	} */

}







	</style>

	</head>

<body>
    
      
        <header id="header" class="header-scroll top-header headrom" data-image-src="images/img/pimg.jpg">
  
            <nav class="navbar navbar-dark">
                <div class="container">
                    <button class="navbar-toggler hidden-lg-up" type="button" data-toggle="collapse" data-target="#mainNavbarCollapse">&#9776;</button>
                    <a class="navbar-brand" href="index.php"> Pokebowl </a>
                    <div class="collapse navbar-toggleable-md  float-lg-right" id="mainNavbarCollapse">
                        <ul class="nav navbar-nav">
                            <li class="nav-item"> <a class="nav-link active" href="index.php">Accueil <span class="sr-only">(current)</span></a> </li>
                            <li class="nav-item"> <a class="nav-link active" href="restaurants.php">Restaurants <span class="sr-only"></span></a> </li>
                            
							<?php
						if(empty($_SESSION["user_id"]))
							{
								echo '<li class="nav-item"><a href="login.php" class="nav-link active">Connexion</a> </li>
							  <li class="nav-item"><a href="registration.php" class="nav-link active">S inscrire</a> </li>';
							}
						else
							{
									
									
									echo  '<li class="nav-item"><a href="your_orders.php" class="nav-link active"><font color="#059e24" class="than">Mes commandes </font></a> </li>';
                                    echo  '<li class="nav-item"><a href="information.php?user_upd='.rows['u_id'].'" class="nav-link active "> Mes informations</a> </li>';
									echo  '<li class="nav-item"><a href="logout.php" class="nav-link active">Se déconnecter</a> </li>';
							}

						?>
							 
                        </ul>
                    </div>
                </div>
            </nav>
  
        </header>
        <div class="page-wrapper">
       
           
    
            <div class="inner-page-hero bg-image" data-image-src="images/img/pimg.jpg">
                <div class="container"> </div>
        
            </div>
            <div class="result-show">
                <div class="container">
                    <div class="row">
                       
                       
                    </div>
                </div>
            </div>
    
            <section class="restaurants-page">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12">
                          </div>
                        <div class="col-xs-12">
                            <div class="bg-gray">
                                <div class="row">
								
							<table class="table table-bordered table-hover">
						  <thead style = "background: #404040; color:white;">
							<tr>
							
							  <th class="posi">Article</th>
							  <th class="posi">Quantité</th>
							  <th class="posi">Prix</th>
							  <th class="posi">Status</th>
							  <th class="posi">Date</th>
				              <th class="posi">Action</th>
							  
							</tr>
						  </thead>
						  <tbody>
						  
						  
							<?php 
				
						$query_res= mysqli_query($db,"select * from users_orders where u_id='".$_SESSION['user_id']."'");
												if(!mysqli_num_rows($query_res) > 0 )
														{
															echo '<td colspan="6"><center>Vous n avez pas encore passé de commande. </center></td>';
														}
													else
														{			      
										  
										  while($row=mysqli_fetch_array($query_res))
										  {
						
							?>
												<tr>	
														 <td data-column="Item"> <?php echo $row['title']; ?></td>
														  <td data-column="Quantity"> <center><?php echo $row['quantity']; ?></center></td>
														  <td data-column="price"><center>MUR <?php echo $row['price']; ?></center></td>
														   <td data-column="status"> 
														   <?php 
																			$status=$row['status'];
																			if($status=="" or $status=="NULL")
																			{
																			?>
																			<center><button type="button" class="btn btn-info"><span class="fa fa-bars"  aria-hidden="true" ></span> Expédition</button></center>
																		   <?php 
																			  }
																			   if($status=="in process")
																			 { ?>
																				<center><button type="button" class="btn btn-warning"><span class="fa fa-cog fa-spin"  aria-hidden="true" ></span> En chemin!</button></center>
																			<?php
																				}
																			if($status=="closed")
																				{
																			?>
																			 <center><button type="button" class="btn btn-success" ><span  class="fa fa-check-circle" aria-hidden="true"></span> Délivré</button> </center>
																			<?php 
																			} 
																			?>
																			<?php
																			if($status=="rejected")
																				{
																			?>
																			 <center><button type="button" class="btn btn-danger"> <i class="fa fa-close"></i> Annulé</button></center>
																			<?php 
																			} 
																			?>
														   
														   
														   
														   
														   
														   
														   </td>
														  <td data-column="Date"> <center><?php echo $row['date']; ?></center></td>
														   <td data-column="Action"> <center><a href="delete_orders.php?order_del=<?php echo $row['o_id'];?>" onclick="return confirm('Voulez-vous vraiment annuler votre commande ?');" class="btn btn-danger btn-flat btn-addon btn-xs m-b-10"><i class="fa fa-trash-o" style="font-size:16px"></i></a></center> 
															</td>
														 
												</tr>
												
											
														<?php }} ?>					
							
							
										
						
						  </tbody>
					</table>
						
					
                                    
                                </div>
                           
                            </div>
                         
                            
                                
                            </div>
                          
                          
                           
                        </div>
                    </div>
                </div>
            </section>

        <footer class="footer">
            <div class="container">
                
              
                <div class="bottom-footer">
                    <div class="row">
                        <div class="col-xs-12 col-sm-3 payment-options color-gray">
                            <h5>Paiement</h5>
                            <ul>
                                <li>
                                    <a href="#"> <img src="images/paypal.png" alt="Paypal"> </a>
                                </li>
                                <li>
                                    <a href="#"> <img src="images/mastercard.png" alt="Mastercard"> </a>
                                </li>
                                <li>
                                    <a href="#"> <img src="images/SBM.jpg" alt="SBM" height="25" width="25"> </a>
                                </li>
                                <li>
                                    <a href="#"> <img src="images/mcb.png" alt="Paypal" height="25" width="25"> </a>
                                </li>
                                <li>
                                    <a href="#"> <img src="images/bitcoin.png" alt="Bitcoin"> </a>
                                </li>
                            </ul>
                        </div> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <div class="col-xs-12 col-sm-4 address color-gray">
                                    <h5>Accès rapide</h5>
                                   <ul class="nav navbar-nav">
                            <li> <a class="nav-link active" href="index.php"><font color="white">Accueil</font> <span class="sr-only">(current)</span></a> </li>
                                       <li > <a class="nav-link active" href="restaurants.php"><font color="white">Restaurants</font> <span class="sr-only"></span></a> </li>
                            
							<?php
						if(empty($_SESSION["user_id"]))
							{
								echo '<li><a href="login.php" class="nav-link active">Connexion<font color="white"></a> </li>
							  <li><a href="registration.php" class="nav-link active">
Inscrire<font color="white"></a> </li>';
							}
						else
							{
									
									
								    echo  '<li ><a href="your_orders.php" class="nav-link active"><font color="#059e24" class="than">Mes commandes </font></a> </li>';
                                    echo  '<li ><a href="information.php?user_upd='.rows['u_id'].'" class="nav-link active "> <font color="white">Mes informations</font></a> </li>';
									echo  '<li ><a href="logout.php" class="nav-link active"><font color="white">Se déconnecter</font></a> </li>';
							}

						?>
							 
                        </ul>
                                    
                        </div>
                        
                        <div class="col-xs-12 col-sm-4 additional-info color-gray">
                                <h5>Sponsor officiel </h5>
                                <p><img src="images/masca.png" alt="Paypal" height="150" width="150">&nbsp;&nbsp;&nbsp;<img src="images/limoges.jpg" alt="Mastercard" height="150" width="150"></p>
                        </div>
                    </div>
                </div>
       
            </div>
        </footer>
           
        
        </div>
  
    
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
<?php
}
?>