<!DOCTYPE html>
<html>
<head>
    <title>Permintaan Kantong Darah</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="shortcut icon" href="logo1.jpg" type="image/x-icon">
    
    <style>
        body {
            background-image: url("rsdure.jpg");
      }
    </style>
</head>
<body>
<div class="container">
    <?php
    //Include file koneksi, untuk koneksikan ke database
    include "koneksi.php";
    
    //Fungsi untuk mencegah inputan karakter yang tidak sesuai
    function input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    //Cek apakah ada kiriman form dari method post
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $nama_dokter=input($_POST["nama_dokter"]);
        $nip=input($_POST["nip"]);
        $nama_pasien=input($_POST["nama_pasien"]);
        $no_rm=input($_POST["no_rm"]);
        $ruangan=input($_POST["ruangan"]);
        $alasan_transfusi=input($_POST["alasan_transfusi"]);
        $golongan_darah=input($_POST["golongan_darah"]);
        $darah_diminta=input($_POST["darah_diminta"]);

        //Query input menginput data kedalam tabel anggota
        $sql="insert into anggota (nama_dokter,nip,nama_pasien,no_rm,ruangan,alasan_transfusi,golongan_darah,darah_diminta) values
		('$nama_dokter','$nip','$nama_pasien','$no_rm','$ruangan','$alasan_transfusi','$golongan_darah','$darah_diminta')";

        //Mengeksekusi/menjalankan query diatas
        $hasil=mysqli_query($kon,$sql);

        //Kondisi apakah berhasil atau tidak dalam mengeksekusi query diatas
        if ($hasil) {
            header("Location:index.php");
        }
        else {
            echo "<div class='alert alert-danger'> Data Gagal disimpan.</div>";

        }

    }
    ?>
    <center>
        <h2>Hasil Pemeriksaan</h2>
    </center>

    <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">
        <div class="form-group">
            <label>Nama Dokter :</label>
            <input type="text" name="nama_dokter" class="form-control" placeholder="Masukan Nama Dokter" required />
        </div>

        <div class="form-group">
            <label>NIP :</label>
            <input type="text" name="nip" class="form-control" placeholder="Masukan NIP" required/>
        </div>

        <div class="form-group">
            <label>Nama Pasien :</label>
            <input type="text" name="nama_pasien" class="form-control" placeholder="Masukan Nama Pasien" required/>
        </div>

        <div class="form-group">
            <label>No RM :</label>
            <input type="text" name="no_rm" class="form-control" placeholder="Masukan Rekam Medis" required/>
        </div>

        <div class="form-group">
            <label>Ruangan :</label>
            <input type="text" name="ruangan" class="form-control" placeholder="Masukan Ruangan" required/>
        </div>

        <div class="form-group">
            <label>Alasan Transfusi :</label>
            <textarea name="alasan_transfusi" class="form-control" placeholder="Masukan Kronologis" required></textarea>
        </div>

        <div class="form-group">
            <label>Golongan Darah :</label>
            <input type="text" name="golongan_darah" class="form-control" placeholder="Masukan Golongan Darah" required/>
        </div>

        <div class="form-group">
            <label>Darah Diminta :</label>
            <input type="text" name="darah_diminta" class="form-control" placeholder="Masukan Jumlah Darah Yang Diminta" required/>
        </div>
            
        <button type="submit" name="submit" class="btn btn-success">Submit</button>
    </form>
</div>

</body>
</html>
