<?php

//Connectie klasses
require_once 'bootstrap/bootstrap.php';

if (!empty($_POST)) {
    if (!empty($_POST['email']) || !empty($_POST['password']) || !empty($_POST['productCode']) || !empty($_POST['firstname']) || !empty($_POST['lastname'])
        || !empty($_POST['street']) || !empty($_POST['number']) || !empty($_POST['city']) || !empty($_POST['postalCode'])) {
        try {
            $user = new User();
            $user->setEmail($_POST['email']);
            $user->setPassword($_POST['password']);
            $user->setProductCode($_POST['productCode']);
            $user->setFirstname($_POST['firstName']);
            $user->setLastname($_POST['lastName']);
            $user->setStreet($_POST['street']);
            $user->setNumber($_POST['number']);
            $user->setCity($_POST['city']);
            $user->setPostalCode($_POST['postalCode']);
            $user->setPhone($_POST['phone']);

            if ($user->register()) {
                //$user->login();
                //echo '🤞';
                //session_start();
                //$_SESSION['User'] = true;
                // wss nog andere session gegevens toevoegen
                header('Location: dashboard.php');
            } else {
                //echo '😢';
            }
        } catch (Trowable $t) {
            echo $t;
        }
    } else {
        $error = 'Gelieve alle verplichte velden in te vullen.';
    }
    if (!empty($_SESSION['error']['message'])) {
        $error = $_SESSION['error']['message'];
        unset($_SESSION['error']);
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
						<input class="input" type="text" name="email" placeholder="Email" value="<?php if (isset($_POST['email'])) {
    echo $_POST['email'];
}?>">
						<span class="input--focus"></span>
					</div>
					
					
					<div class="form--input">
						<input class="input" type="password" name="password" placeholder="Password" value="<?php if (isset($_POST['password'])) {
    echo $_POST['password'];
}?>">
						<span class="input--focus"></span>
                    </div>

                    <div class="form--input">
						<input class="input" type="text" name="productCode" placeholder="Product Code" value="<?php if (isset($_POST['productCode'])) {
    echo $_POST['productCode'];
}?>">
						<span class="input--focus"></span>
                    </div>

                    <div class="form--input">
						<input class="input" type="text" name="firstName" placeholder="First Name" value="<?php if (isset($_POST['firstName'])) {
    echo $_POST['firstName'];
}?>">
						<span class="input--focus"></span>
                    </div>

                    <div class="form--input">
						<input class="input" type="text" name="lastName" placeholder="Last Name" value="<?php if (isset($_POST['lastName'])) {
    echo $_POST['lastName'];
}?>">
						<span class="input--focus"></span>
                    </div>

                    <div class="form--input">
						<input class="input" type="text" name="street" placeholder="Street" value="<?php if (isset($_POST['street'])) {
    echo $_POST['street'];
}?>">
						<span class="input--focus"></span>
                    </div>
                    
                    <div class="form--input">
						<input class="input" type="text" name="number" placeholder="Number" value="<?php if (isset($_POST['number'])) {
    echo $_POST['number'];
}?>">
						<span class="input--focus"></span>
                    </div>
                    
                    <div class="form--input">
						<input class="input" type="text" name="city" placeholder="City" value="<?php if (isset($_POST['city'])) {
    echo $_POST['city'];
}?>">
						<span class="input--focus"></span>
                    </div>
                    
                    <div class="form--input">
						<input class="input" type="text" name="postalCode" placeholder="Postal Code" value="<?php if (isset($_POST['postalCode'])) {
    echo $_POST['postalCode'];
}?>">
						<span class="input--focus"></span>
                    </div>
                    
                    <div class="form--input">
						<input class="input" type="text" name="phone" placeholder="Phone Number" value="<?php if (isset($_POST['phone'])) {
    echo $_POST['phone'];
}?>">
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