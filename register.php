<?php

//Connectie klasses
include_once 'bootstrap.php';

if (!empty($_POST['submit'])) {
    // checked of alle velden leeg zijn of niet,als er 1 leeg is kan men niet registreren
    if (empty($_POST['email']) || empty($_POST['password']) || empty($_POST['firstname'])
    || empty($_POST['lastname']) || empty($_POST['username'])) {
        $error = true;
    } else {
        // Gegevens in de klasse user steken
        $user = new User();
        $user->setEmail($_POST['email']);
        $user->setPassword($_POST['password']);
        $user->setFirstName($_POST['firstName']);
        $user->setLastName($_POST['lastName']);
        $user->setStreet($_POST['street']);
        $user->setNumber($_POST['number']);
        $user->setCity($_POST['city']);
        $user->setPostalCode($_POST['postalCode']);
        $user->setPhone($_POST['phone']);

        if ($user->register()) {
            session_start();
            $_SESSION['email'] = $email;
            header('Location:dashboard.php');
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
<?php include_once 'includes/head.inc.php'; ?>
    <title>Register</title>
</head>
<body>
<div class="limiter">
		<div class="container">
			<div class="wrap">
				<form class="form">
					<span class="form--title">
						Register
                    </span>
                    
					<div class="form--input">
						<input class="input" type="text" name="email" placeholder="Email">
						<span class="input--focus"></span>
					</div>
					
					
					<div class="form--input">
						<input class="input" type="password" name="password" placeholder="Password">
						<span class="input--focus"></span>
                    </div>

                    <div class="form--input">
						<input class="input" type="text" name="firstName" placeholder="First Name">
						<span class="input--focus"></span>
                    </div>

                    <div class="form--input">
						<input class="input" type="text" name="lastName" placeholder="Last Name">
						<span class="input--focus"></span>
                    </div>

                    <div class="form--input">
						<input class="input" type="text" name="street" placeholder="Street">
						<span class="input--focus"></span>
                    </div>
                    
                    <div class="form--input">
						<input class="input" type="text" name="number" placeholder="Number">
						<span class="input--focus"></span>
                    </div>
                    
                    <div class="form--input">
						<input class="input" type="text" name="city" placeholder="City">
						<span class="input--focus"></span>
                    </div>
                    
                    <div class="form--input">
						<input class="input" type="text" name="postalCode" placeholder="Postal Code">
						<span class="input--focus"></span>
                    </div>
                    
                    <div class="form--input">
						<input class="input" type="text" name="phone" placeholder="Phone Number">
						<span class="input--focus"></span>
					</div>
					
					
					<div class="form--btn">
					
							<input type="submit" name="submit" value="Sign me up!" >	
						
					</div>

				</form>
			</div>
		</div>
    </div>
    
    
</body>
</html>