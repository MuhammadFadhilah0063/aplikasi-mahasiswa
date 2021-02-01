<?php

$conn = mysqli_connect("localhost", "root", "", "mahasiswa");

function query($query) {
	global $conn;
	$result = mysqli_query($conn, $query);
	$rows = [];

	while( $row = mysqli_fetch_assoc($result) ) {
		$rows[] = $row;
	}
	return $rows;
}


function tambah($data) {
	global $conn;

	$npm = htmlspecialchars($data["npm"]);
	$nama = htmlspecialchars($data["nama"]);
	$tempat_lahir = htmlspecialchars($data["tempat_lahir"]);
	$tanggal_lahir = htmlspecialchars($data["tanggal_lahir"]);
	$jenis_kelamin = htmlspecialchars($data["jenis_kelamin"]);
	$alamat = htmlspecialchars($data["alamat"]);
	$kode_pos = htmlspecialchars($data["kode_pos"]);

	$query = "INSERT INTO  mahasiswa
				VALUES 
				('$npm', '$nama', '$tempat_lahir', '$tanggal_lahir', '$jenis_kelamin', '$alamat', '$kode_pos')
			";

	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}


function hapus($npm) {
    global $conn;

    mysqli_query($conn, "DELETE FROM mahasiswa WHERE npm = $npm");
    return mysqli_affected_rows($conn);
}


function ubah($data) {
    global $conn;

    $npm = htmlspecialchars($data["npm"]);
	$nama = htmlspecialchars($data["nama"]);
	$tempat_lahir = htmlspecialchars($data["tempat_lahir"]);
	$tanggal_lahir = htmlspecialchars($data["tanggal_lahir"]);
	$jenis_kelamin = htmlspecialchars($data["jenis_kelamin"]);
	$alamat = htmlspecialchars($data["alamat"]);
    $kode_pos = htmlspecialchars($data["kode_pos"]);
    
	$query = "UPDATE mahasiswa SET 
                npm = '$npm',
                nama = '$nama',
                tempat_lahir = '$tempat_lahir',
                tanggal_lahir = '$tanggal_lahir',
                jenis_kelamin = '$jenis_kelamin',
                alamat = '$alamat',
                kode_pos = '$kode_pos'
            WHERE npm = $npm
            ";

mysqli_query($conn, $query);

return mysqli_affected_rows($conn);
}


function registrasi($data) {
	global $conn;

	$username = strtolower(stripslashes($data["username"]));

	$password = mysqli_real_escape_string($conn, $data["password"]);

	$password2 = mysqli_real_escape_string($conn, $data["password2"]);

	$result = mysqli_query($conn, "SELECT username FROM user WHERE 	
				username = '$username'");

	if ( mysqli_fetch_assoc($result) ) {
		echo "<script>
				alert('Username sudah ada!')
			</script>";

			return false;
	}

	if ( $password !== $password2 ) {
		echo "<script>
				alert('Konfirmasi password tidak sesuai!');
			</script>";
			return false;
	}

	$password = password_hash($password, PASSWORD_DEFAULT);

	mysqli_query($conn, "INSERT INTO user VALUES
				('', '$username', '$password')"
				);

	return mysqli_affected_rows($conn);
}

?>