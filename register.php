<?php

//Connectie klasses
include_once 'bootstrap.php';

if (!empty($_POST)) {
    if (!empty($_POST['email']) || !empty($_POST['password']) || !empty($_POST['firstname']) || !empty($_POST['lastname'])
        || !empty($_POST['street']) || !empty($_POST['number']) || !empty($_POST['city']) || !empty($_POST['postalCode'])) {
        try {
            $user = new User();
            $user->setEmail($_POST['email']);
            $user->setPassword($_POST['password']);
            $user->setFirstname($_POST['firstName']);
            $user->setLastname($_POST['lastName']);
            $user->setStreet($_POST['street']);
            $user->setNumber($_POST['number']);
            $user->setCity($_POST['city']);
            $user->setPostalCode($_POST['postalCode']);
            $user->setPhone($_POST['phone']);

            if ($user->register()) {
                //$user->login();

                $_SESSION['User'] = true;
                // wss nog andere session gegevens toevoegen
                header('Location: dashboard.php');
            } else {
                //echo '😢';
            }
        } catch (Exception $e) {
            $error = $e->getMessage();
        }
    } else {
        $error = 'Gelieve alle verplichte velden in te vullen.';
    }
}

?><!DOCTYPE html>
<html lang="en">
<head>
<?php include_once 'includes/head.inc.php'; ?>
    <title>Register</title>
</head>
<body>
<div class="limiter">
		<div class="container">
			<div class="wrap">
				<form class="form" method="post" action="">
					<span class="form--title">
						Register
                    </span>
                    <?php if (isset($error)): ?>
				        <div class="form__error">
                            <p>
                                <?php echo $error; ?>
                            </p>
				</div>
                <?php endif; ?>
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