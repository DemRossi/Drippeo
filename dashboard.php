<?php 

  //Connectie klasses
include_once("bootstrap.php");

// Controleren of we al ingelogd zijn
//User::checkLogin();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css?family=Lato:100,100i,300,300i,400,400i,700,700i,900,900i" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/reset.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/dashboard.css">
    <title>Dashboard</title>
</head>
<body>
<!---Navigatie--->

<div class="nav--container">
<div id="mySidenav" class="sidenav">
  <a  class="closebtn" onclick="closeNav()">&times;</a>
	<div class="mobile-menu-items">
		<a class="sub-nav"  onclick="closeNav()"href="#">
			Dashboard
		</a>
		<a class="sub-nav " onclick="closeNav()"href='#'>
			Annual consumption
        </a>
        <a class="sub-nav " onclick="closeNav()"href='#'>
			Consume less 
        </a>
        <a class="sub-nav " onclick="closeNav()"href='#'>
			Settings
		</a>
	</div>
</div>
<span class="hamburger-icon"onclick="openNav()">&#9776;</span>

<h1>Drippeo.</h1>
</div>









<!---Footer--->
<footer>
        <p>	&copy; 2019 Drippeo</p>
        <form>
            <input type="email" placeholder="Email" required>
            <button class="button">Sign up now</button>
        </form>
    </footer>

<script>

/*---Navigatie---*/
function openNav() {
  document.getElementById("mySidenav").style.width = "250px";
}

function closeNav() {
  document.getElementById("mySidenav").style.width = "0";
}
    </script>
    
</body>
</html>