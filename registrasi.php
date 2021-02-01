<?php 

require 'fungsi.php';

if ( isset($_POST["regis"]) ) {	
	if ( registrasi($_POST) > 0 ) {
		echo "<script>
				alert('user baru berhasil ditambahkan!');
				document.location.href = 'login.php';
			</script>";
	} else {
		echo mysqli_error($conn);
	}
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Registrasi</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="css/style.css">
</head>
<body class="text-center">

	<section class="regis">	
		<form class="form-signin" action="" method="post">
			<img class="mb-4" src="img/a.png" alt="" width="72" height="72">
			<h1 class="h3 mb-3 font-weight-normal">Please register first</h1>
			<input type="text" id="username" name="username" class="form-control" placeholder="Username" required="" autofocus="">
			<input type="password" id="password" name="password" class="form-control" placeholder="Password" required="">
			<input type="password" id="password2" name="password2" class="form-control" placeholder="Konfirmasi Password" required="">
			<br>
			<button class="btn btn-lg btn-primary btn-block" type="submit" name="regis">Sign up</button>
		</form>
	</section>

</body>
</html>
