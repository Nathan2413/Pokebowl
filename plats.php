<!DOCTYPE html>
<html lang="en">
<?php
include("connection/connect.php"); 
error_reporting(0);
session_start();

include_once 'product-action.php'; 

?>


<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="#">
    <title>Créer mon plats </title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/animsition.min.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/plats.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet"> 
</head>
<style type="text/css" rel="stylesheet">

    header{
        background: url("images/plats/rest.png");
        width:1000px;
        height:90px;
    }
    
    .nomber{
        border-radius:5px;
        text-align: center;
    }
</style>
<body>
    
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
							  <li class="nav-item"><a href="registration.php" class="nav-link active">S inscrire</a> </li>';
							}
						else
							{
									
									
								    echo  '<li class="nav-item"><a href="your_orders.php" class="nav-link active">Mes commandes</a> </li>';
                                    echo  '<li class="nav-item"><a href="information.php" class="nav-link  "> <font color="white">Mes informations</font></a> </li>';
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
            
			<?php $ress= mysqli_query($db,"select * from restaurant where rs_id='$_GET[res_id]'");
									     $rows=mysqli_fetch_array($ress);
										  
										  ?>
            <section class="inner-page-hero bg-image" data-image-src="images/img/restrrr.png">
                <div class="profile">
                    <div class="container">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12  col-md-4 col-lg-4 profile-img">
                                <div class="image-wrap">
                                    <figure><?php echo '<img src="admin/Res_img/'.$rows['image'].'" alt="Restaurant logo">'; ?></figure>
                                </div>
                            </div>
							
                            <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 profile-desc">
                                <div class="pull-left right-text white-txt">
                                    <h6><a href="#"><?php echo $rows['title']; ?></a></h6>
                                    <p><?php echo $rows['address']; ?></p>   
                                </div>
                            </div>
							
							
                        </div>
                    </div>
                </div>
            </section>
            <div class="top-links">
                <div class="container">
                    <ul class="row links">
                      
                        <li class="col-xs-12 col-sm-4 link-item"><span>1</span><a href="restaurants.php">Choisissez un restaurant</a></li>
                        <li class="col-xs-12 col-sm-4 link-item active"><span>2</span><a href="plats.php?res_id=<?php echo $_GET['res_id']; ?>">Choisissez votre plat préféré</a></li>
                        <li class="col-xs-12 col-sm-4 link-item"><span>3</span><a href="#">Commandez et payez</a></li>
                        
                    </ul>
                </div>
            </div>
            <div class="breadcrumb">
                <div class="row">
								<?php $ress= mysqli_query($db,"select * from restaurant");
									      while($rows=mysqli_fetch_array($ress))
										  {
													
						
													 echo' 
														
														 <div class="col-sm-12 col-md-12 col-lg-4 text-xs-center">
																<div class="right-content bg-white">
																	<div class="right-review">
																		
																		<a href="dishes.php?res_id='.$rows['rs_id'].'" class="btn btn-purple">Voir les plats existants</a>
                                                                        </div>
																</div>
																<!-- end:right info -->
															</div>';
										  }
						
						
						?>
                                    
                    </div>
                
            </div>
            <div class="container m-t-30">
                <div class="row">
                    <div class="col-md-8"> 
                        
                            <form>
		                          <h2>Les ingrédients</h2>
		                              <label><input type="checkbox" name="ingredients[]" value="poulet"> Poulet&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="ingredients[]" value="boeuf"> Boeuf&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="ingredients[]" value="saumon"> Saumon&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="ingredients[]" value="avocat"> Avocat&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="ingredients[]" value="fromage"> Fromage</label>

		                              <label><input type="checkbox" name="ingredients[]" value="oeuf"> Oeuf</label>
		                              <button type="submit">Rechercher</button>
	                       </form>
                            <center><div id="resultats"></div></center>
                       
                    </div>
                    
                    
                    <div class="col-xs-12 col-sm-4 col-md-4 col-lg-3">
                        
                         <div class="widget widget-cart">
                                <div class="widget-heading">
                                    <h3 class="widget-title text-dark text-xs-center">
                                 Votre panier
                              </h3>
							  				  
							  
                                    <div class="clearfix"></div>
                                </div>
                                <div class="order-row bg-white">
                                    <div class="widget-body">
									
									
	<?php

$item_total = 0;

foreach ($_SESSION["cart_item"] as $item)  
{
?>									
									
                                        <div class="title-row">
										<?php echo $item["title"]; ?><a href="dishes.php?res_id=<?php echo $_GET['res_id']; ?>&action=remove&id=<?php echo $item["d_id"]; ?>" >
										<i class="fa fa-trash pull-right"></i></a>
										</div>
										
                                        <div class="form-group row no-gutter">
                                            <div class="col-xs-8">
                                                 <input type="text" class="form-control b-r-0" value=<?php echo "RS_".$item["price"]; ?> readonly id="exampleSelect1">
                                                   
                                            </div>
                                            <div class="col-xs-4">
                                               <input class="form-control" type="text" readonly value='<?php echo $item["quantity"]; ?>' id="example-number-input"> </div>
                                        
									  </div>
									  
	<?php
$item_total += ($item["price"]*$item["quantity"]); 
}
?>								  
									  
									  
									  
                                    </div>
                                </div>
                               
                         
                             
                                <div class="widget-body">
                                    <div class="price-wrap text-xs-center">
                                        <p>TOTAL</p>
                                        <h3 class="value"><strong><?php echo "RS ".$item_total; ?></strong></h3>
                                        <p>Livraison gratuite!</p>
                                        <?php
                                        if($item_total==0){
                                        ?>

                                        
                                        <a href="checkout.php?res_id=<?php echo $_GET['res_id'];?>&action=check"  class="btn btn-danger btn-lg disabled">Vérifier</a>

                                        <?php
                                        }
                                        else{   
                                        ?>
                                        <a href="checkout.php?res_id=<?php echo $_GET['res_id'];?>&action=check"  class="btn btn-success btn-lg active">
Vérifier</a>
                                        <?php   
                                        }
                                        ?>

                                    </div>
                                </div>
								
						
								
								
                            </div>
                    </div>

                    
                    
                </div>
     
            </div>
            
            <div class="breadcrumb">
            </div>
        
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
                                       <li> <a class="nav-link active" href="restaurants.php"><font color="#059e24" class="than">Restaurants <span class="sr-only"></span></font></a> </li>
                            
							<?php
						if(empty($_SESSION["user_id"]))
							{
								echo '<li><a href="login.php" class="nav-link active"><font color="white">Connexion</a> </li>
							  <li><a href="registration.php" class="nav-link active">
<font color="white">Inscrire</a> </li>';
							}
						else
							{
									
									
								    echo  '<li><a href="your_orders.php" class="nav-link active"><font color="white">Mes commandes</font></a> </li>';
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
  
    </div>

 
    
 
    <script src="js/jquery.min.js"></script>
    <script src="js/tether.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/animsition.min.js"></script>
    <script src="js/bootstrap-slider.min.js"></script>
    <script src="js/jquery.isotope.min.js"></script>
    <script src="js/headroom.js"></script>
    <script src="js/script.js"></script>
    <center><div id="resultats"></div></center>
    <script src="js/foodpicky.min.js"></script>
</body>

</html>
