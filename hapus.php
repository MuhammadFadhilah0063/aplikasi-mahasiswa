<?php

require 'fungsi.php';

$npm = $_GET["npm"];

if ( hapus($npm) > 0 ) {
	echo "
			<script>
				alert('Data Berhasil Dihapus!');
				document.location.href = 'index.php';
			</script>
		";
	} else {
		echo "
			<script>
				alert('Data Gagal Dihapus!');
				document.location.href = 'index.php';
			</script>
		";
}

?>