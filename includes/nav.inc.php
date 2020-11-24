<!---Navigatie--->

<div class="nav--container">

<div id="mySidenav" class="sidenav">

  <a  class="closebtn" onclick="closeNav()">&times;</a>
	<div class="mobile-menu-items">
	<span class="sub-nav profile"  onclick="closeNav()"href="/ProductLab2/profile.php">
			<img src="images/profilePic.svg" alt="profile--image">
			<p><?php echo $_SESSION['user']['firstname'].' '.$_SESSION['user']['lastname']; ?></p>
			
		</span>
		<a class="sub-nav"  onclick="closeNav()"href="dashboard">
			Dashboard
		</a>
		<a class="sub-nav " onclick="closeNav()"href='consumption'>
			Consumption
        </a>
        <a class="sub-nav " onclick="closeNav()"href='saving'>
			Consume less 
        </a>
        <a class="sub-nav " onclick="closeNav()"href='settings'>
			Settings
		</a>
		<a class="sub-nav " onclick="closeNav()"href='logout'>
			Log out
		</a>
	</div>
</div>
<span class="hamburger-icon"onclick="openNav()">&#9776;</span>

<a href="dashboard.php"><h1>Drippeo.</h1></a>
</div>
