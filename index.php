<?php
include('db.php');
?>
<?php
session_start();

if(isset($_SESSION["user"]))  
{  
    // Assuming $_SESSION["user"] contains the role information ('Customer' or 'Staff')
    $role = $_SESSION["user"]["role"];

    // Redirect based on the role
    if ($role == 'Customer') {
        header("location: customer/index.php");
    } elseif ($role == 'Staff') {
        header("location: staff/index.php");
    } 
    exit; // Make sure to stop script execution after redirection
}  
?>
<?php
// Database connection
$servername = "localhost";
$username = "root"; // replace with your database username
$password = ""; // replace with your database password
$dbname = "test"; // replace with your database name

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to generate a 9-digit loyalty number
function generateLoyaltyNumber() {
    return str_pad(rand(0, 999999999), 9, '0', STR_PAD_LEFT);
}

// Staff data to be added
$staff = [
    ['FullName' => 'Leshvin', 'Username' => 'leshsk', 'Password' => hash('sha256', 'leshsk123'), 'Email' => 'leshvinsk@gmail.com', 'LoyaltyNumber' => generateLoyaltyNumber(), 'Role' => 'Staff'],
    ['FullName' => 'Sukesh', 'Username' => 'keshz', 'Password' => hash('sha256', 'keshz123'), 'Email' => 'keshz@gmail.com', 'LoyaltyNumber' => generateLoyaltyNumber(), 'Role' => 'Staff'],
    ['FullName' => 'Hwang Eurjin', 'Username' => 'eurjin', 'Password' => hash('sha256', 'eurjin123'), 'Email' => 'eurjin@gmail.com', 'LoyaltyNumber' => generateLoyaltyNumber(), 'Role' => 'Staff']
];

// Check and insert each staff
foreach ($staff as $s) {
    $Username = $s['Username'];
    $Email = $s['Email'];

    // Check if user already exists
    $sql = "SELECT UserID FROM users WHERE Username='$Username' OR Email='$Email'";
    $result = $conn->query($sql);

    if ($result->num_rows == 0) {
        // User does not exist, insert new user
        $FullName = $s['FullName'];
        $Password = $s['Password'];
        $LoyaltyNumber = $s['LoyaltyNumber'];
        $Role = $s['Role'];

        $sql = "INSERT INTO users (FullName, Username, Password, Email, LoyaltyNumber, Role) VALUES ('$FullName', '$Username', '$Password', '$Email', '$LoyaltyNumber', '$Role')";
        if ($conn->query($sql) === TRUE) {
    
        } 
    } 
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Salad Atelier</title>
<link rel="icon" href="images/title_logo.png" type="image/icon type">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Resort Inn Responsive , Smartphone Compatible web template , Samsung, LG, Sony Ericsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
<link href="css/font-awesome.css" rel="stylesheet"> 
<link rel="stylesheet" href="css/chocolat.css" type="text/css" media="screen">
<link href="css/easy-responsive-tabs.css" rel='stylesheet' type='text/css'/>
<link rel="stylesheet" href="css/flexslider.css" type="text/css" media="screen" property="" />
<link rel="stylesheet" href="css/jquery-ui.css" />
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
<script type="text/javascript" src="js/modernizr-2.6.2.min.js"></script>
<link href="//fonts.googleapis.com/css?family=Oswald:300,400,700" rel="stylesheet">
<link href="//fonts.googleapis.com/css?family=Federo" rel="stylesheet">
<link href="//fonts.googleapis.com/css?family=Lato:300,400,700,900" rel="stylesheet">
</head>
<body>
	<div class="w3_navigation">
		<div class="container">
			<nav class="navbar navbar-default">
				<div class="navbar-header navbar-left">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<h1><a class="navbar-brand" href="index.php"><img style = "width: 200px;" src="images/header_logo.png" alt=""></a></h1>
				</div>
				<div class="collapse navbar-collapse navbar-right" id="bs-example-navbar-collapse-1">
					<nav class="menu menu--iris">
						<ul class="nav navbar-nav menu__list">
							<li class="menu__item menu__item--current"><a href="index.php" class="menu__link">Home</a></li>
							<li class="menu__item"><a href="#about" class="menu__link scroll">About</a></li>
							<li class="menu__item"><a href="#contact" class="menu__link scroll">Locate Us</a></li>
							<li class="menu__item"><a href= "login.php" class="menu__link" >Login</a></li>
						</ul>
					</nav>
				</div>
			</nav>

		</div>
	</div>
	<div id="home" class="w3ls-banner">
		<div class="slider">
			<div class="callbacks_container">
				<ul class="rslides callbacks callbacks1" id="slider4">
					<li>
						<div class="w3layouts-banner-top">

							<div class="container">
								<div class="agileits-banner-info">
									<div class="agileits_w3layouts_more menu__item">
			                          </div>
								</div>	
							</div>
						</div>
					</li>
					<li>
						<div class="w3layouts-banner-top w3layouts-banner-top1">
							<div class="container">
								<div class="agileits-banner-info">
									<div class="agileits_w3layouts_more menu__item">
			</div>
								</div>	
							</div>
						</div>
					</li>
				</ul>
			</div>
			<div class="clearfix"> </div>
		</div>
		    <div class="thim-click-to-bottom">
				<a href="#about" class="scroll">
					<i class="fa fa-long-arrow-down" aria-hidden="true"></i>
				</a>
			</div>
	</div>	
<div class="modal fade" id="myModal" tabindex="-1" role="dialog"></div>
<div id="availability-agileits">
<div class="col-md-12 book-form-left-w3layouts">
	<a href="login.php"><h2>ORDER NOW</h2></a>
</div>

			<div class="clearfix"> </div>
</div>
	<div class="banner-bottom">
		<div class="container">	
			<div class="agileits_banner_bottom">
				<h3><span>SAVOR FRESH FLAVORS, ENJOY DELICIOUS DEALS </span>DISCOVER OUR FRIENDLY WELCOMING ATMOSPHERE</h3>
			</div>
			<div class="w3ls_banner_bottom_grids">
				<ul class="cbp-ig-grid">
					<li>
						<div class="w3_grid_effect">
							<span class="cbp-ig-icon w3_road"></span>
							<h4 class="cbp-ig-title">KID-FRIENDLY</h4>
							<span class="cbp-ig-category">Salad Atelier</span>
						</div>
					</li>
					<li>
						<div class="w3_grid_effect">
							<span class="cbp-ig-icon w3_cube"></span>
							<h4 class="cbp-ig-title">PIER VIEW</h4>
							<span class="cbp-ig-category">Salad Atelier</span>
						</div>
					</li>
					<li>
						<div class="w3_grid_effect">
							<span class="cbp-ig-icon w3_users"></span>
							<h4 class="cbp-ig-title">LARGE CAFE</h4>
							<span class="cbp-ig-category">Salad Atelier</span>
						</div>
					</li>
					<li>
						<div class="w3_grid_effect">
							<span class="cbp-ig-icon w3_ticket"></span>
							<h4 class="cbp-ig-title">HIGH-SPEED WIFI</h4>
							<span class="cbp-ig-category">Salad Atelier</span>
						</div>
					</li>
				</ul>
			</div>
		</div>
	</div>
 	<div class="about-wthree" id="about">
		  <div class="container">
				   <div class="ab-w3l-spa">
                            <h3 class="title-w3-agileits title-black-wthree">About Salad Atelier</h3> 
						   <p class="about-para-w3ls">Salad Atelier began with a passion for healthy eating and fresh ingredients. Founded in 2014, it aims to offer nutritious and customizable salad options, promoting a balanced lifestyle. The restaurant prides itself on using the finest ingredients to create delicious, wholesome meals for everyone.</p>
						   <img src="images/about.jpeg" class="img-responsive" style = "border: 10px solid rgba(255, 255, 255, 0.4);">
										<div class="w3l-slider-img">
											<img src="images/restaurant.jpg" class="img-responsive">
										</div>
                                       <div class="w3ls-info-about">
										    <h4>You'll Love Our Fresh Ingredients!</h4>
											<p> Experience the Perfect Flavor and Nutrition.</p>
										</div>
		          </div>
		   	<div class="clearfix"> </div>
    </div>
</div>
<section class="contact-w3ls" id="contact">
	<div class="container">
		<div class="col-lg-6 col-md-6 col-sm-6 contact-w3-agile1" data-aos="flip-right">
			<h4>Locate Us</h4>
			<p class="contact-agile1"><strong>Phone :</strong> <a href="tel:+60102853920">Reach us Via Tel Here</a></p>
			<p class="contact-agile1"><strong>Email :</strong> <a href="mailto:bbx457@gmail.com">Reach us Via Email Here</a></p>
			<p class="contact-agile1"><strong>Address :</strong> Mall 1, 1 Mont' Kiara, LG-19 & LG-20, Jalan Kiara, Mont Kiara, 50480 Kuala Lumpur</p>
																
			<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3983.729861826974!2d101.65058047497119!3d3.1657016968096445!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31cc4909750807e3%3A0x20a716f685565775!2sSalad%20Atelier%20(1%20Mont%20Kiara)!5e0!3m2!1sen!2smy!4v1718727527186!5m2!1sen!2smy"></iframe>
		</div>
		<div class="clearfix"></div>
	</div>
</section>
			<div class="copy">
		        <p>© 2014-2024 Salad Atelier | All Rights Reserved | Designed by <a href="index.php">Salad Atelier</a> </p>
		    </div>
<script type="text/javascript" src="js/jquery-2.1.4.min.js"></script>
<link rel="stylesheet" href="css/swipebox.css">
				<script src="js/jquery.swipebox.min.js"></script> 
					<script type="text/javascript">
						jQuery(function($) {
							$(".swipebox").swipebox();
						});
					</script>
<script type="text/javascript" src="js/move-top.js"></script>
<script type="text/javascript" src="js/easing.js"></script>
<script type="text/javascript">
	jQuery(document).ready(function($) {
		$(".scroll").click(function(event){		
			event.preventDefault();
			$('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
		});
	});
</script>
				<script defer src="js/jquery.flexslider.js"></script>
				<script type="text/javascript">
				$(window).load(function(){
				  $('.flexslider').flexslider({
					animation: "slide",
					start: function(slider){
					  $('body').removeClass('loading');
					}
				  });
				});
			  </script>
<script src="js/responsiveslides.min.js"></script>
			<script>
						$(function () {
						  $("#slider4").responsiveSlides({
							auto: true,
							pager:true,
							nav:false,
							speed: 500,
							namespace: "callbacks",
							before: function () {
							  $('.events').append("<li>before event fired.</li>");
							},
							after: function () {
							  $('.events').append("<li>after event fired.</li>");
							}
						  });
					
						});
			</script>
<script src="js/easy-responsive-tabs.js"></script>
<script>
$(document).ready(function () {
$('#horizontalTab').easyResponsiveTabs({
type: 'default',           
width: 'auto', 
fit: true,   
closed: 'accordion', 
activate: function(event) { 
var $tab = $(this);
var $info = $('#tabInfo');
var $name = $('span', $info);
$name.text($tab.text());
$info.show();
}
});
$('#verticalTab').easyResponsiveTabs({
type: 'vertical',
width: 'auto',
fit: true
});
});
</script>
<script type="text/javascript" src="js/bootstrap-3.1.1.min.js"></script>
</body>
</html>


