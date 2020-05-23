<?php 
	# Stop Hacking attempt
	define('__APP__', TRUE);
	
	# Start session
    session_start();
	
	# Database connection
	include ("dbconn.php");
	
	# Variables MUST BE INTEGERS
    if(isset($_GET['menu'])) { $menu   = (int)$_GET['menu']; }
	if(isset($_GET['action'])) { $action   = (int)$_GET['action']; }
	
	# Variables MUST BE STRINGS A-Z
    if(!isset($_POST['_action_']))  { $_POST['_action_'] = FALSE;  }
	
	if (!isset($menu)) { $menu = 1; }
	
	# Classes & Functions
    include_once("functions.php");
	
print '
<!DOCTYPE html>
<html>
	<head>
		<title>Covid19</title>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<meta name="description" content="PHP Web programiranje">
		<meta name="keywords" content="PHP, HTML, CSS">
		<meta name="author" content="Ivan Šimunović">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="shortcut icon" type="img" href="img/icon.png">
		<link rel="stylesheet" href="stilovi.css">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans|Poppins|Roboto|Roboto+Slab" rel="stylesheet">
		<meta name="google-signin-client_id" content="YOUR_CLIENT_ID.apps.googleusercontent.com">
	</head>
<body>
	<header>
		<div'; if ($menu > 1) { print ' class="slika_pocetna"'; } else { print ' class="slika_pocetna"'; }  print '></div>
		<nav>';
			include("menu.php");
		print '</nav>
	</header>
	<main>';
  
		if (isset($_SESSION['message'])) {
			print $_SESSION['message'];
			unset($_SESSION['message']);
		}
	# Homepage
	if (!isset($menu) || $menu == 1) { include("home.php"); }
	
	# News
	else if ($menu == 2) { include("news.php"); }
	
	# Contact
	else if ($menu == 3) { include("contact.php"); }
	
	# About us
	else if ($menu == 4) { include("about-us.php"); }
	
	# Galery
	else if ($menu == 5) { include("galery.php"); }
	
	# Signin
	else if ($menu == 6) { include("signin.php"); }
	
	# Admin webpage
	else if ($menu == 7) { include("admin.php"); }
	
    # Editor webpage
	else if ($menu == 8) { include("editor.php"); }
	
	#Register
	else if ($menu == 9) { include("register.php"); }
	
	# JSON
	else if ($menu == 10) { include("JSON.php"); }
	# Change password
	else if ($menu == 11) { include("change_pass.php"); }
	
	print '
	</main>
	<footer style ="margin-top:30px;">
		<p>Copyright &copy; ' . date("Y") . ' Ivan Šimunović. <a href="https://github.com/isimuno?tab=repositories"><img src="img/github.png" title="Github" alt="Github"></a></p>
	</footer>
</body>
</html>';
?>