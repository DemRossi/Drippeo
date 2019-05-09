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

  $data = User::info($_SESSION['user']['email']);

 if (isset($_POST['contactBtn'])) {
     try {
         $user = new User();
         $user->setEmail($_POST['email']);

         // verrifie password
         if (password_verify($data['password'], $_POST['oldPassword'])) {
             echo 'veranderd passwoord';
         //$user->setPassword($_POST['newPassword']);
         } else {
             echo 'oeps';
         }

         $user->setFirstname($_POST['firstName']);
         $user->setLastname($_POST['lastName']);
         $user->setStreet($_POST['street']);
         $user->setNumber($_POST['number']);
         $user->setCity($_POST['city']);
         $user->setPostalCode($_POST['postalCode']);
         $user->setPhone($_POST['phone']);

         $user->updateAccount();
     } catch (Trowable $t) {
         echo $t;
     }
 } elseif (isset($_POST['houseBtn'])) {
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
  

        <div class="item__settings info">
            <img src="images/header.jpg" alt="profile--image">
            <p><?php echo $_SESSION['user']['firstname'].' '.$_SESSION['user']['lastname']; ?></p>
            <p>Actief sinds ... </p>
        </div>

    <div class="column__settings">  
        <div class="item__settings">
            <form action="" method="post">
                <h3>Contact</h3>
                    <!---<div class="form--input__settings">
                        <input type="file" name="profileImg" capture="camera" required/><br>
						<input type="submit" value="upload" name="upload"/>  
                    </div>-->

                    <div class="form--input__settings">
                        <label for="firstName">First name: </label>
						<input class="input__settings" type="text" name="firstName" placeholder="First Name" value="<?php echo $_SESSION['user']['firstname']; ?>">
                    </div>
                    <div class="form--input__settings">
                        <label for="lastName">Last name: </label>
						<input class="input__settings" type="text" name="lastName" placeholder="Last Name" value="<?php echo $_SESSION['user']['lastname']; ?>">
                    </div>
                    <div class="form--input__settings">
                        <label for="email">Email: </label>
				        <input class="input__settings" type="email" name="email" placeholder="Email" value="<?php echo $_SESSION['user']['email']; ?>">
                    </div>
                    <div class="form--input__settings">
                        <label for="street">Street: </label>
				        <input class="input__settings" type="text" name="street" placeholder="Street" value="<?php echo $data['street']; ?>">
                    </div>
                    <div class="form--input__settings">
                        <label for="number">Number: </label>
				        <input class="input__settings" type="text" name="number" placeholder="Street number" value="<?php echo $data['number']; ?>">
                    </div>
                    <div class="form--input__settings">
                        <label for="city">City: </label>
				        <input class="input__settings" type="text" name="city" placeholder="City" value="<?php echo $data['city']; ?>">
                    </div>
                    <div class="form--input__settings">
                        <label for="postalCode">Postal code: </label>
				        <input class="input__settings" type="text" name="postalCode" placeholder="postal Code" value="<?php echo $data['postalCode']; ?>">
                    </div>
                    <div class="form--input__settings">
                        <label for="phone">Phone: </label>
				        <input class="input__settings" type="text" name="phone" placeholder="Phone" value="<?php echo $data['phone']; ?>">
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
                    <div class="form--btn">
                          <button type="submit" name="contactBtn">Update</button>
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
                    <div class="form--btn">
                          <button type="submit" name="houseBtn">Update</button>
                    </div>
            </form>
        </div>
    </div>

    


</div>
<?php include_once 'includes/footer.inc.php'; ?>
<script src="js/webNavigation.js"></script>
</body>
</html>