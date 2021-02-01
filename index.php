<?php

session_start();

if ( !isset( $_SESSION["login"]) ) {
    header("Location: login.php");
    exit;
} 

require 'fungsi.php';

$mahasiswa = query("SELECT * FROM mahasiswa ORDER BY npm");


if ( isset($_POST["tambah"]) ) {
	
	if ( tambah($_POST) > 0 ) {
		echo "
			<script>
				alert('Data Berhasil Ditambahkan!');
				document.location.href = 'index.php';
			</script>
		";
	} else {
		echo "
			<script>
				alert('Data Gagal Ditambahkan!');
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
    <title>Home</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
</head>
<body>
    
    <!-- Div Jumbotron -->
    <div class="jumbotron">
        <div class="container">
            <div class="row">
                <div class="col-md-9">
                    <p>Aplikasi Mahasiswa</p>
                </div>
                <div class="col-md-3">
                    <ul class="nav nav-tabs">
                        <li role="presentation" class="active" id="home"><a href="#">Home</a></li>
                        <li role="presentation" id="tambah"><a href="#">Tambah</a></li>
                        <li role="presentation" ><a href="logout.php">Logout</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- Akhir Div Jumbotron -->


    <!-- section Tambah -->
    <section class="tambah">
        <div class="row">
            <div class="container">
                <h3 class="text-center">Tambah data mahasiswa baru</h3>
                <hr>
                <div class="col-sl-12">

                    <form action="" method="post">
                        <div class="form-group">
                            <input type="text" name="npm" class="form-control" id="npm" required placeholder="npm">
                        </div>
                        <div class="form-group">
                            <input type="text" name="nama" class="form-control" id="nama" required placeholder="nama">
                        </div>
                        <div class="form-group">
                            <input type="text" name="tempat_lahir" class="form-control" id="tempat_lahir" required placeholder="tempat_lahir">
                        </div>
                        <div class="form-group">
                            <input type="date" name="tanggal_lahir" class="form-control" id="tanggal_lahir" required placeholder="tanggal_lahir">
                        </div>
                        <div class="pilihan">
                            <select name="jenis_kelamin" class="form-control" id="jenis_kelamin">
                                <option value="L">Laki-laki</option>
                                <option value="P">Perempuan</option>
                            </select>
                        </div>

                        <br>

                        <div class="form-group">
                            <input type="text" name="alamat" class="form-control" id="alamat" required placeholder="alamat">
                        </div>
                        <div class="form-group">
                            <input type="text" name="kode_pos" class="form-control" id="kode_pos" required placeholder="kode_pos">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-info center-block btn-lg" name="tambah">TAMBAH</button>
                        </div>
                    </form>
                    
                </div>
            </div>
        </div>
    </section>
    <!-- Akhir section Tambah -->


    <!-- Section Data -->
    <section class="data">
            <div class="container">
                <h3 class="text-center">Data Mahasiswa</h3>
                <hr>

            <!-- Div Pencarian -->
            <div class="col-sl-12">
                <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">
                    <div class="form-group">
                        <label for="kolom">Pencarian pada kolom:</label>

                            <?php
                            $npm="";
                            $nama="";
                            $kode_pos="";

                            if (isset($_POST['kolom'])) {

                                if ($_POST['kolom']=="npm")
                                {
                                    $npm="selected";
                                }else if ($_POST['kolom']=="nama"){
                                    $nama="selected";
                                }else {
                                    $kode_pos="selected";
                                }
                            }
                            ?>

                        <select class="form-control" name="kolom" id="kolom" required>
                            <option value="" >Pilih kolom</option>
                            <option value="npm" <?php echo $npm; ?> >NPM</option>
                            <option value="nama" <?php echo $nama; ?> >Nama</option>
                            <option value="kode_pos" <?php echo $kode_pos; ?> >Kode Pos</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="kata_kunci">Kata Kunci:</label>

                            <?php
                            $kata_kunci="";

                            if (isset($_POST['kata_kunci'])) {
                                $kata_kunci=$_POST['kata_kunci'];
                            }
                            ?>

                        <input type="text" name="kata_kunci" id="kata_kunci" value="<?php echo $kata_kunci;?>" class="form-control" placeholder="Cari..."  required/>
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-info " value="Cari">
                    </div>
                </form>
            </div>
            <!-- Akhir Div Pencarian -->


            <!-- Div Tabel Mahasiswa -->
            <div class="col-sl-12 table-responsive">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr class="bg-info text-light">
                            <th>No</th>
                            <th>NPM</th>
                            <th>Nama</th>
                            <th>Tempat Lahir</th>
                            <th>Tanggal Lahir</th>
                            <th>Jenis Kelamin</th>
                            <th>Alamat</th>
                            <th>Kode Pos</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                        <?php

                        if (isset($_POST['kata_kunci'])) {
                            $kata_kunci=trim($_POST['kata_kunci']);

                            $kolom="";
                            
                            if ($_POST['kolom']=="npm")
                            {
                                $kolom="npm";
                            }else if ($_POST['kolom']=="nama"){
                                $kolom="nama";
                            }else {
                                $kolom="kode_pos";
                            }

                            $sql="select * from mahasiswa where $kolom like '%".$kata_kunci."%'  order by npm asc";

                        }else {
                            $sql="select * from mahasiswa order by npm asc";
                        }

                    $hasil=query($sql);
                    $no=0;

                    foreach( $hasil as $row ) {
                        $no++;

                    ?>
                        <tbody>
                            <tr class="bg-light text-center">
                                <td><?php echo $no;?></td>
                                <td><?php echo $row["npm"];?></td>
                                <td><?php echo $row["nama"];?></td>
                                <td><?php echo $row["tempat_lahir"];?></td>
                                <td><?php echo $row["tanggal_lahir"];?></td>
                                <td><?php echo $row["jenis_kelamin"];?></td>
                                <td><?php echo $row["alamat"];?></td>
                                <td><?php echo $row["kode_pos"];?></td>
                                <td>
                                    <!-- Button Hapus -->
                                    <a class="btn btn-danger btn-xs" name="button_hapus" href="hapus.php?npm=<?= $row["npm"]; ?>" onclick="return confirm('Yakin?');">Hapus</a></span>
                                    <!-- Button Ubah -->
                                    <a class="btn btn-success btn-xs" name="button_ubah" href="ubah.php?npm=<?= $row["npm"]; ?>">Ubah</a>
                                </td>
                            </tr>
                        </tbody>
                    <?php
                    }
                    ?>
                </table>
            </div>
            <!-- Akhir Div Tabel Mahasiswa -->

    </section>
    <!-- Akhir Section Data -->

<script src="javascript/script.js"></script>
</body>
</html>