<?php

    //Connectie klasses
    require_once 'bootstrap/bootstrap.php';

  // Controleren of we al ingelogd zijn
  if (isset($_SESSION['user'])) {
      //logged in user
      //echo "😎";
  } else {
      //no logged in user
      header('Location: login.php');
  }

?><!DOCTYPE html>
<html lang="en">
<head>
<?php include_once 'includes/head.inc.php'; ?>
    <title>settings</title>
</head>
<body>
<?php include_once 'includes/nav.inc.php'; ?>

<div class="dashboard">
    <div class="column__settings">
        <div class="item__settings">
            <form action="" method="post">
                <h3>Contact</h3>
                    <div class="form--input__settings">
                        <label for="firstName">First name: </label>
						<input class="input__settings" type="text" name="firstName" placeholder="First Name" value="<?php echo $_SESSION['user']['firstname']; ?>">
                    </div>
                    <div class="form--input__settings">
                        <label for="lastName">Last name: </label>
						<input class="input__settings" type="text" name="lastName" placeholder="Last Name" value="<?php echo $_SESSION['user']['lastname']; ?>">
                    </div>
                    <div class="form--input__settings">
                        <label for="email">Last name: </label>
				        <input class="input__settings" type="text" name="email" placeholder="Email" value="<?php echo $_SESSION['user']['email']; ?>">
                    </div>
                    <!--Oud passwoord-->
                    <div class="form--input__settings">
                        <label for="email">Old password: </label>
				        <input class="input__settings" type="password" name="oldPassword" placeholder="Old password" >
                    </div>
                    <!--Nieuw passwoord-->
                    <div class="form--input__settings">
                        <label for="email">New password: </label>
				        <input class="input__settings" type="password" name="newPassword" placeholder="New password" >
                    </div>
            </form>
        </div>
    </div>

    <div class="column__settings">
        <div class="item__settings">
            <form action="" method="post">
                <h3>Product</h3>
                    <div class="form--input__settings">
                        <label for="email">Residents: </label>
						<input class="input__settings" type="number" name="residents"  min="1" max="10">
                    </div>
                    <div class="form--input__settings">
                         <label for="email">Showers: </label>
						<input class="input__settings" type="number" name="showers"  min="1" max="10">
                    </div>
                    <div class="form--input__settings">
                        <label for="email">Baths: </label>
				        <input class="input__settings" type="number" name="baths"  min="1" max="10">
                    </div>
                    <div class="form--input__settings">
                        <label for="email">Toilets: </label>
				        <input class="input__settings" type="number" name="toilets"  min="1" max="10">
                    </div>
                    <div class="form--input__settings">
                        <label for="email">Sink: </label>
				        <input class="input__settings" type="number" name="sink"  min="1" max="10">
                    </div>
                    <div class="form--input__settings">
                        <label for="email">Outside tap: </label>
				        <input class="input__settings" type="number" name="outsideTap"  min="1" max="10">
                    </div>
            </form>
        </div>
    </div>


</div>
<?php include_once 'includes/footer.inc.php'; ?>
<script src="js/webNavigation.js"></script>
</body>
</html>