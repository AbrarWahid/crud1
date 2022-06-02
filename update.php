<!DOCTYPE html>
<html>
<head>
    <title>Update Permintaan Kantong Darah </title>
    <!-- Load file CSS Bootstrap offline -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">

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
    //Cek apakah ada nilai yang dikirim menggunakan methos GET dengan nama id_anggota
    if (isset($_GET['id_anggota'])) {
        $id_anggota=input($_GET["id_anggota"]);

        $sql="select * from anggota where id_anggota=$id_anggota";
        $hasil=mysqli_query($kon,$sql);
        $data = mysqli_fetch_assoc($hasil);
    }

    //Cek apakah ada kiriman form dari method post
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $id_anggota=htmlspecialchars($_POST["id_anggota"]);
        $nama_dokter=input($_POST["nama_dokter"]);  
        $nip=input($_POST["nip"]);
        $nama_pasien=input($_POST["nama_pasien"]);
        $no_rm=input($_POST["no_rm"]);
        $ruangan=input($_POST["ruangan"]);
        $alasan_transfusi=input($_POST["alasan_transfusi"]);
        $golongan_darah=input($_POST["golongan_darah"]);
        $darah_diminta=input($_POST["darah_diminta"]);

        //Query update data pada tabel anggota
        $sql="update anggota set nama_pasien='$nama_dokter', 
        nip='$nip', 
        nama_pasien='$nama_pasien',
        no_rm='$no_rm',
        ruangan='$ruangan',
        alasan_transfusi='$alasan_transfusi',
        golongan_darah='$golongan_darah',
        darah_diminta='$darah_diminta' 
        where id_anggota=$id_anggota";
        // echo $sql;
        // die;
        //Mengeksekusi atau menjalankan query diatas
        $hasil=mysqli_query($kon,$sql);

        //Kondisi apakah berhasil atau tidak dalam mengeksekusi query diatas
        if ($hasil) {
            echo "<div class='alert alert-success'> Data Berhasil diupdate.</div>";
            header("Location:index.php");
        }
        else {
            echo "<div class='alert alert-danger'> Data Gagal diupdate.</div>";

        }

    }

    ?>
    <center>
    <h2>Update Data</h2>
    </center>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
        <div class="form-group">
            <label>Nama Dokter :</label>
            <input type="text" name="nama_dokter" class="form-control" value="<?php echo $data['nama_dokter']; ?>" placeholder="Masukan Nama Dokter" required />

        </div>
        <div class="form-group">
            <label>No RM :</label>
            <input type="text" name="no_rm" class="form-control" value="<?php echo $data['no_rm']; ?>" placeholder="Masukan Rekam Medis" required/>

        </div>
        <div class="form-group">
            <label>Ruangan:</label>
            <input type="text" name="ruangan" class="form-control" value="<?php echo $data['ruangan']; ?>" placeholder="Masukan Ruangan" required/>
        </div>

        <div class="form-group">
            <label>Alasan Transfusi :</label>
            <textarea name="alasan_transfusi" class="form-control" value="<?php echo $data['alasan_transfusi']; ?>" placeholder="Masukan Alasan" required></textarea>
        </div>

        <div class="form-group">
            <label>Golongan Darah :</label>
            <input type="text" name="golongan_darah" class="form-control" value="<?php echo $data['golongan_darah']; ?>" placeholder="Masukan Golongan Darah" required/>
        </div>

        <div class="form-group">
            <label>Darah Diminta :</label>
            <input type="text" name="darah_diminta" class="form-control" value="<?php echo $data['darah_diminta']; ?>" placeholder="Masukan Darah Diminta" required/>
        </div>

        <input type="hidden" name="id_anggota" value="<?php echo $data['id_anggota']; ?>" />

        <button type="submit" name="submit" class="btn btn-success">Submit</button>
    </form>
</div>
</body>
</html>
