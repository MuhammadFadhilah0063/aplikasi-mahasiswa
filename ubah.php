<?php

session_start();

if ( !isset( $_SESSION["login"]) ) {
    header("Location: login.php");
    exit;
} 

require 'fungsi.php';

$npm = $_GET["npm"];

$mahasiswa = query("SELECT * FROM mahasiswa WHERE npm = $npm")[0];

if ( isset($_POST["submit"]) ) {

	if ( ubah($_POST) > 0 ) {
		echo "
			<script>
				alert('Data Berhasil Diubah!');
				document.location.href = 'index.php';
			</script>
		";
	} else {
		echo "
			<script>
				alert('Data Gagal Diubah!');
				document.location.href = 'index.php';
			</script>
		";
	}
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
</head>
<body>
    
    <!-- Div Jumbotron -->
    <div class="jumbotron">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <h3 class="text-info">Aplikasi Mahasiswa</h3>
                </div>
                <div class="col-md-4">
                <ul class="nav nav-tabs">
                    <li role="presentation" id="home"><a href="index.php">Home</a></li>
                    <li role="presentation" class="active" id="ubah"><a href="#">Ubah</a></li>
                    <li role="presentation"><a href="logout.php">Logout</a></li>
                </ul>
                </div>
            </div>
            
        </div>
    </div>
    <!-- Ahir Div Jumbotron -->


    <!-- Section Ubah -->
    <section class="ubah">
        <div class="row">
            <div class="container">
                <h3 class="text-center">Ubah data mahasiswa</h3>
                <hr>
                <div class="col-sl-12">

                    <form action="" method="post">
                        <div class="form-group">
                            <input type="hidden" name="npm" value="<?= $mahasiswa["npm"]; ?>">
                            <input type="text" name="npm" class="form-control" disabled="disabled" id="npm" required placeholder="NPM" value="<?= $mahasiswa["npm"]; ?>">
                        </div>
                        <div class="form-group">
                            <input type="text" name="nama" class="form-control" id="nama" required placeholder="Nama" value="<?= $mahasiswa["nama"]; ?>">
                        </div>
                        <div class="form-group">
                            <input type="text" name="tempat_lahir" class="form-control" id="tempat_lahir" required placeholder="Tempat Lahir" value="<?= $mahasiswa["tempat_lahir"]; ?>">
                        </div>
                        <div class="form-group">
                            <input type="date" name="tanggal_lahir" class="form-control" id="tanggal_lahir" required placeholder="Tanggal Lahir" value="<?= $mahasiswa["tanggal_lahir"]; ?>">
                        </div>
                        <div class="pilihan">
                            <select name="jenis_kelamin" class="form-control" id="jenis_kelamin" value="<?= $mahasiswa["jenis_kelamin"]; ?>">
                                <option value="L">Laki-laki</option>
                                <option value="P">Perempuan</option>
                            </select>
                        </div>

                        <br>

                        <div class="form-group">
                            <input type="text" name="alamat" class="form-control" id="alamat" required placeholder="Alamat" value="<?= $mahasiswa["alamat"]; ?>">
                        </div>
                        <div class="form-group">
                            <input type="text" name="kode_pos" class="form-control" id="kode_pos" required placeholder="Kode Pos" value="<?= $mahasiswa["kode_pos"]; ?>">
                        </div>
                        <div class="form-group">
                            <button type="submit" name="submit" class="btn btn-info center-block btn-lg">UBAH</button>
                        </div>
                    </form>
                    
                </div>
            </div>
        </div>
    </section>
    <!-- Akhir Section Ubah -->

</body>
</html>