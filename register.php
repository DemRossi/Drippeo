<?php 

//Connectie klasses
include_once("bootstrap.php");

if (!empty($_POST['submit'])){
	// checked of alle velden leeg zijn of niet,als er 1 leeg is kan men niet registreren
	if ( empty($_POST['email']) || empty($_POST['password']) || empty($_POST['firstname']) 
	|| empty($_POST['lastname'])|| empty($_POST['username'])){
		$error = true;
	}
	else {
		// Gegevens in de klasse user steken
		$user = new User ();
		$user->setEmail($_POST['email']);
		$user->setPassword($_POST['password']);
		$user->setFirstName($_POST['firstName']);
		$user->setLastName($_POST['lastName']);
        $user->setStreet($_POST['street']);
        $user->setNumber($_POST['number']);
        $user->setCity($_POST['city']);
        $user->setPostalCode($_POST['postalCode']);
        $user->setPhone($_POST['phone']);
		
		if ($user->register()){
			session_start();
			$_SESSION['email'] = $email;
			header('Location:index.php');
		}
		
		/*
Een session start met User, dit moet dan ook in de index controleren of
de sessie gestart is of niet (if rond de register zetten)*/ 
	
	}}

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
						<button >
							Registreer
						</button>
					</div>

				</form>
			</div>
		</div>
    </div>
    
    
</body>
</html>