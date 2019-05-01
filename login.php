<?php
//Connectie klasses
include_once("bootstrap.php");

	if(!empty($_POST)){

		// email en password opvragen
		$email = $_POST['email'];
		$password = $_POST['password'];

		//connectie databank
		$conn = Db::getInstance();

		// check of rehash van password gelijk is aan hash uit db
		$statement = $conn->prepare("SELECT * from users where email = :email");
		$statement->bindParam(":email", $email);
		$result = $statement->execute();

		$user = $statement -> fetch(PDO::FETCH_ASSOC);

		if( password_verify($password, $user['password'])){
		// ja -> login
			session_start();
			$_SESSION['email'] = $email;
			header('Location:index.php');

		}else{
		// nee -> error
			$error = true;
		}

	}

?>

<!DOCTYPE html>
<html lang="en">
<head>
<?php include_once("includes/head.inc.php") ;?>
    <title>Login</title>
</head>
<body>

<div class="limiter">
		<div class="container">
			<div class="wrap">
				<form class="form">
					<span class="form--title">
						Login
					</span>

					
					<div class="form--input">
						<input class="input" type="text" name="email" placeholder="Email">
						<span class="input--focus"></span>
					</div>
					
					
					<div class="form--input">
						<input class="input" type="password" name="password" placeholder="Password">
						<span class="input--focus"></span>
					</div>
					
					<div class="form--check">
						<div class="form--checkbox">
							<input class="input--checkbox" id="ckb1" type="checkbox" name="remember-me">
							<label class="label--checkbox" for="ckb1">
								Remember me
							</label>
						</div>

						<div>
							<a href="#" class="txt1">
								Forgot?
							</a>
						</div>
					</div>
					<div class="form--btn">
						<button >
							Login
						</button>
					</div>

				</form>
			</div>
		</div>
	</div>
    
</body>
</html>