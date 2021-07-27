<?php
  //set headers to NOT cache a page
  header("Cache-Control: no-cache, must-revalidate"); //HTTP 1.1
  header("Pragma: no-cache"); //HTTP 1.0
  header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past
  session_save_path('/data-ext/sessions');
  ini_set('session.gc_probability', 1);
  session_start();

require("tools.php");
require_once "mobile-detect/Mobile_Detect.php";

$detect = new Mobile_Detect;
if (!$detect->isMobile()) $device = "Computer";
else if ($detect->isiPhone()) $device = "iPhone";
else if ($detect->isSamsung()) $device = "Samsung";
else if ($detect->isAndroidOS()) $device = "Android";

$_SESSION["device"] = $device;

//CONTEXT
if (!empty($_GET['id']))
	{
		$data = readApi($store, $_GET['id']);
		if ($data)
			{
				$_SESSION['buyer'] = $data["name"];
				$_SESSION['logo'] = $data["logo"];
				$_SESSION['background'] = $data["background"];
				$_SESSION['link'] = $data["link"];
				//echo "DEBUG:";
				//echo "result[".$data["name"]."]";
				//print_r($data);
			}
	}
//
//echo "DEBUG";
//echo print_r($customerstore->findall());
//DEFAULT
if (!isset($_SESSION["link"]) || empty($_SESSION["link"])) $_SESSION["link"] = "https://harness.io/";
if (!isset($_SESSION["logo"]) || empty($_SESSION["logo"])) $_SESSION["logo"] = "img/harness-logo.png";
if (!isset($_SESSION["background"]) || empty($_SESSION["background"])) $_SESSION["background"] = "http://avante.biz/wp-content/uploads/Background-Pics-HD/Background-Pics-HD-001.jpg";
if (!isset($_SESSION['buyer']))
{
    $_SESSION['buyer'] = readable_random_string();
}
?>
	<!DOCTYPE html>
	<html lang="zxx" class="no-js">
	<head>
		<base href="/<?php echo $_ENV["GITHUB_LOGIN"]; ?>/"/>
		<meta http-equiv="Cache-control" content="no-cache, must-revalidate">
		<!-- Mobile Specific Meta -->
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<!-- Favicon-->
		<link rel="shortcut icon" href="img/fav.png">
		<!-- Author Meta -->
		<meta name="author" content="codepixer">
		<!-- Meta Description -->
		<meta name="description" content="">
		<!-- Meta Keyword -->
		<meta name="keywords" content="">
		<!-- meta character set -->
		<meta charset="UTF-8">
		<!-- Site Title -->
		<title>WebApp - <?php echo $_ENV["GITHUB_LOGIN"]?></title>

		<link href="https://fonts.googleapis.com/css?family=Poppins:100,200,400,300,500,600,700" rel="stylesheet"> 

		

<script>
var interval = null;
var target = "<? echo $_ENV["GITHUB_LOGIN"]; ?>"
</script>
<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>

<script>
window.githublogin = "<? echo $_ENV["GITHUB_LOGIN"]; ?>";
// GET GITHUBLOGIN variable
//$.get("data/githublogin.txt", function( my_var ) {
//	githublogin = my_var;
//});
</script>


<!-- Harness Feature Flag Module -->
<script type="module">
      import { initialize, Event } from 'https://unpkg.com/@harnessio/ff-javascript-client-sdk@1.4.4/dist/sdk.client.js'

      const log = msg => {
        document.querySelector('#log').innerHTML += `${msg}\n`
      }
//c8451467-ea97-44cb-8f34-f8275bde03fa //platform-demo
//61aee676-f45e-4b92-ad6d-3cdb38679f4d //uat
      const cf = initialize('c8451467-ea97-44cb-8f34-f8275bde03fa', {
    identifier: window.githublogin,
	attributes: {
            lastUpdated: Date(),
            host: location.href
          }     // Target identifier
  });

  cf.on(Event.READY, flags => {
        console.log(JSON.stringify(flags, null, 2))
		console.log("identifier: ["+window.githublogin+"]")
      })

      cf.on(Event.CHANGED, flagInfo => {
        if (flagInfo.deleted) {
          console.log('Flag is deleted')
          console.log(JSON.stringify(flagInfo, null, 2))
        } else {
          console.log('Flag is changed')
          console.log(JSON.stringify(flagInfo, null, 2))
		
		  flagSelector(flagInfo);
        }
      })

	  function flagSelector(flagInfo)
	  {
		  	//Custom Background
			if (flagInfo["flag"] == "Custom_Background")
				{
					if (flagInfo["value"] == true)
						var imageUrl = "https://wallpaper.dog/large/17248916.jpg";
					else
						var imageUrl = $( "#background" ).val();
					
					console.log(imageUrl);
					$(".banner-area").css("background", "url(" + imageUrl + ")");
				}
			//Custom Main Page Image
			if (flagInfo["flag"] == "Landing_Page_logo")
			{
				clearInterval(window.interval);

				if (flagInfo["value"] == true)
					var image = "img/canary-french.png";
				else
					var image = "img/captain-america.png";
				
				console.log(image);	
				$('#vaccin').html('<a href="'+$( "#link" ).val()+'"><img src="'+image+'" width="200px" /></a>');
			}

			//Redirect To the Custom Link
			if (flagInfo["flag"] == "Redirect_People_to_the_Survey")
			{
				clearInterval(window.interval);

				if (flagInfo["value"] == true)
					window.location.replace($( "#link" ).val());
			}

	  }
</script>



<!--===============================================================================================-->	
<link rel="icon" type="image/png" href="login/images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="login/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="login/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="login/fonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="login/vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="login/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="login/vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="login/vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="login/vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="login/css/util.css">
	<link rel="stylesheet" type="text/css" href="login/css/main.css">
<!--===============================================================================================-->



			<!--
			CSS
			============================================= -->
			<link rel="stylesheet" href="css/linearicons.css">
			<link rel="stylesheet" href="css/font-awesome.min.css">
			<link rel="stylesheet" href="css/bootstrap.css">
			<link rel="stylesheet" href="css/magnific-popup.css">
			<link rel="stylesheet" href="css/nice-select.css">					
			<link rel="stylesheet" href="css/animate.min.css">
			<link rel="stylesheet" href="css/owl.carousel.css">
			<link rel="stylesheet" href="css/main.css">

		</head>
		<body>
		<script>

function loadvaccin(){
	window.interval = setInterval(function(){
      $('#vaccin').load('result.php');
 },2000);
}

function goto($hashtag){
	 //document.getElementById($hashtag).style.visibility = "visible";
	 if ($hashtag == "home")
	 	$("#error").hide();
	 if ($hashtag == "error")
	 	$("#"+$hashtag).show();

     document.location = "index.php#" + $hashtag;
}

function DoAction(v_action, v_value)
{
	console.log("Updating customer to :"+v_value);
	$.ajax({
		type: "GET",
		url: 'tools.php',
		data: {action: v_action, value: v_value},
		success: function(data){
			console.log(data);
		}
	});
			
}

	
		


			
		</script>
		<style type="text/css">
.shoppingcart {
    background-image: url("img/bag.png");
    background-repeat: no-repeat, no-repeat;
	background-color: transparent;
	width:80px;
	height:80px;
	background-size: 80px;
	color:white;
	display:none;
}
.shoppingcart p{
   
	vertical-align: baseline;
    text-align: center;
    padding-top: 40px;
    font-size: 30px;

}
.banner-area {
    /* BACKGROUND */
    background: url(<? echo $_SESSION["background"]; ?>) center;
    background-size: cover;
}
</style>
			  <header id="header" id="home">
			    <div class="container">
			    	<div class="row align-items-center justify-content-between d-flex">
				      <div id="logo">
				        <a href="/"><img src="<? echo $_SESSION["logo"]; ?>" alt="" title="" height="50px"/></a>
				      </div>
				      <nav id="nav-menu-container">
				        <ul class="nav-menu">
				          <li class="menu-active"><a href="#home">Home</a></li>
				          <li><a href="#service">share with people</a></li>
						  <li class="menu-has-children"><a href="">CONFIG</a>
				            <ul>
				              <li>Customer: <form><input type="text" id="customer" value="<?php echo $_SESSION['buyer']; ?>"></form></li>
							  <li>Logo: <form><input type="text" id="customer-logo" value="<?php echo $_SESSION['logo']; ?>"></form></li>
							  <li>Background: <form><input type="text" id="background" value="<?php echo $_SESSION['background']; ?>"></form></li>
							  <li>Link: <form><input type="text" id="link" value="<?php echo $_SESSION['link']; ?>"></form></li>
				            </ul>
				          </li>
				        </ul>
				      </nav><!-- #nav-menu-container -->		    		
			    	</div>
			    </div>
			  </header><!-- #header -->


			<!-- start banner Area -->
			<section class="banner-area" id="home">	
				<div class="container">
					<div class="row fullscreen d-flex align-items-center justify-content-center">
						<div class="banner-content col-lg-10">
							<div style="margin:0 auto; margin-bottom:10px" id="SV Fintechn Corp.shoppingcart" name="shoppingcart" class="shoppingcart"><p>0</p></div>
							<h5 class="text-white text-uppercase"></h5>
							<h1>
												
							</h1>
							<div id="vaccin" name="vaccin" id="vaccin" align="center"><a href="#login"><div align="center"><img src="img/captain-america.png" width="200px" /></div></a></div>
						</div>											
					</div>
				</div>
			</section>
			<!-- End banner Area -->	

					

			<!-- Start service Area -->
			<section class="service-area section-gap" id="service">
				<div class="container">
					<div class="row d-flex justify-content-center">
						<div class="col-md-8 pb-40 header-text">
							<h1>
							<?php 
							$url = $_SERVER['HTTP_HOST']."/".$_ENV["GITHUB_LOGIN"]."?id=".$_SESSION['buyer'];
							//echo $url
							?></h1>
							<p>
								<div style="align:center;font-size:15px">Get the App!</div>
								<?php echo '<img src="https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=http%3A%2F%2F'.$url.'"%2F&choe=UTF-8" width="100%">'; ?>
							</p>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-4 col-md-6">
							<div class="single-service">
								<h4><span class="lnr lnr-user"></span>Expert Technicians</h4>
								<p>
									Usage of the Internet is becoming more common due to rapid advancement of technology and power.
								</p>
							</div>
						</div>
						<div class="col-lg-4 col-md-6">
							<div class="single-service">
								<h4><span class="lnr lnr-license"></span>Professional Service</h4>
								<p>
									Usage of the Internet is becoming more common due to rapid advancement of technology and power.
								</p>								
							</div>
						</div>
						<div class="col-lg-4 col-md-6">
							<div class="single-service">
								<h4><span class="lnr lnr-phone"></span>Great Support</h4>
								<p>
									Usage of the Internet is becoming more common due to rapid advancement of technology and power.
								</p>								
							</div>
						</div>
						<div class="col-lg-4 col-md-6">
							<div class="single-service">
								<h4><span class="lnr lnr-rocket"></span>Technical Skills</h4>
								<p>
									Usage of the Internet is becoming more common due to rapid advancement of technology and power.
								</p>				
							</div>
						</div>
						<div class="col-lg-4 col-md-6">
							<div class="single-service">
								<h4><span class="lnr lnr-diamond"></span>Highly Recomended</h4>
								<p>
									Usage of the Internet is becoming more common due to rapid advancement of technology and power.
								</p>								
							</div>
						</div>
						<div class="col-lg-4 col-md-6">
							<div class="single-service">
								<h4><span class="lnr lnr-bubble"></span>Positive Reviews</h4>
								<p>
									Usage of the Internet is becoming more common due to rapid advancement of technology and power.
								</p>									
							</div>
						</div>						
					</div>
				</div>	
			</section>
			<!-- End service Area -->

		

			<!-- Start ERROR Area -->
			<section class="service-area section-gap" id="error" name="error" style="display: none;">
				<div class="container">
					<div class="row d-flex justify-content-center">
						<div class="col-md-8 pb-40 header-text">
							<h1>
							Error  503
							</h1>
							<h2>
							Service Unavailable :(
</h2>

							<p>
								<div style="align:center;font-size:15px">our team is working on it...</div>
						
							</p>

							<p>
							<a onclick="goto('home')"><div style="align:center;font-size:30px"><div align="center" style="float"><img src="img/close.png" width="80px"></div>Back to home</div>
							</a></p>
						</div>
					</div>
										
					</div>
				</div>	
			</section>
			<!-- End service Area -->

			
			<!-- start footer Area -->		
			<footer class="footer-area section-gap">
				<div class="container">
					<div class="row">
						<div class="col-lg-5 col-md-6 col-sm-6">
							<div class="single-footer-widget">
								<h6>About Us</h6>
								<p>
									Powered by <a href="https://twitter.com/ecointet">Etienne Cointet</a> for Harness.io - 2021.
								</p>
								<p class="footer-text">
									<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
								</p>								
							</div>
						</div>
						<div class="col-lg-5  col-md-6 col-sm-6">
							<div class="single-footer-widget">
								<h6>Newsletter</h6>
								<p>Stay update with our latest</p>
								<div class="" id="mc_embed_signup">
									<form target="_blank" novalidate="true" action="https://spondonit.us12.list-manage.com/subscribe/post?u=1462626880ade1ac87bd9c93a&amp;id=92a4423d01" method="get" class="form-inline">
										<input class="form-control" name="EMAIL" placeholder="Enter Email" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Email '" required="" type="email">
			                            	<button class="click-btn btn btn-default"><i class="fa fa-long-arrow-right" aria-hidden="true"></i></button>
			                            	<div style="position: absolute; left: -5000px;">
												<input name="b_36c4fd991d266f23781ded980_aefe40901a" tabindex="-1" value="" type="text">
											</div>

										<div class="info"></div>
									</form>
								</div>
							</div>
						</div>						
						<div class="col-lg-2 col-md-6 col-sm-6 social-widget">
							<div class="single-footer-widget">
								<h6>Follow Us</h6>
								<p>Let us be social</p>
								<div class="footer-social d-flex align-items-center">xs
									<a href="https://twitter.com/signalfx"><i class="fa fa-twitter"></i></a>
									<a href="https://www.signalfx.com/"><i class="fa fa-dribbble"></i></a>
									<a href="#"><i class="fa fa-behance"></i></a>
								</div>
							</div>
						</div>							
					</div>
				</div>
			</footer>	
			<!-- End footer Area -->	

			<script src="js/vendor/jquery-2.2.4.min.js"></script>
			<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>		
			<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBhOdIF3Y9382fqJYt5I_sswSrEw5eihAA"></script>
  			<script src="js/easing.min.js"></script>			
			<script src="js/hoverIntent.js"></script>
			<script src="js/superfish.min.js"></script>	
			<script src="js/jquery.ajaxchimp.min.js"></script>
			<script src="js/jquery.magnific-popup.min.js"></script>	
			<script src="js/owl.carousel.min.js"></script>			
			<script src="js/jquery.sticky.js"></script>
			<script src="js/jquery.nice-select.min.js"></script>			
			<script src="js/parallax.min.js"></script>	
			<script src="js/mail-script.js"></script>	
			<script src="js/main.js"></script>	

			<script>
//Customerchange
$( "#customer" ).change(function() {
	console.log($( "#customer" ).val());
	DoAction("update-customer", $( "#customer" ).val());
			});
//End

//Logochange
$( "#customer-logo" ).change(function() {
	console.log($( "#customer-logo" ).val());
	DoAction("update-logo", $( "#customer-logo" ).val());
			});
//End

//Backgroundchange
$( "#background" ).change(function() {
	console.log($( "#background" ).val());
	DoAction("update-background", $( "#background" ).val());
			});
//End

//LinkChange
$( "#link" ).change(function() {
	console.log($( "#link" ).val());
	DoAction("update-link", $( "#link" ).val());
			});
//End

function GetName()
{
var person = prompt("What's your name?", "<?php echo $_SESSION["buyer"]; ?>");

if (person == null || person == "") {
  console.log("user is the default one");
} else {
	//console.log("user updated:"+person);
	DoAction("update-customer", person);
		}
}

loadvaccin(); // This will run on page load


//GetName();
			</script>
		</body>
	</html>
