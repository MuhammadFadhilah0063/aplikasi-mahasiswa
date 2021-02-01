<?php

session_start();

require 'fungsi.php';

if ( isset($_SESSION["login"]) ) {
	header("Location: index.php");
	exit;
} 

if ( isset($_POST["login"]) ) {

	$username = $_POST["username"];
	$password = $_POST["password"];

	$result = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");

	if ( mysqli_num_rows($result) === 1 ) {

		$row = mysqli_fetch_assoc($result);

	}

	if ( password_verify($password, $row["password"]) ) {

		$_SESSION["login"] = true;

		header("Location: index.php");
		exit;
	}

	$error = true;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
</head>
<body class="text-center">

    <section class="login">	
		<form class="form-signin" action="" method="post">
			<img class="mb-4" src="img/a.png" alt="" width="72" height="72">
			<h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
			<input type="text" id="username" name="username" class="form-control" placeholder="Username" required="" autofocus="">
			<input type="password" id="password" name="password" class="form-control" placeholder="Password" required="">
			<br>

				<!-- Pesan Kesalahan -->
				<?php 
					if( isset($error) ) {
						echo "
							<script>
								alert('Username / Password Salah!');
							</script>
						";
					}
				?>

			<button class="btn btn-lg btn-primary btn-block" type="submit" name="login">Sign in</button>
			<br>
			<a href="registrasi.php">Registrasi</a>
		</form>
	</section>
    
</body>
</html>