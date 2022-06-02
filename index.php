<!DOCTYPE html>
<html>
<head>
    <title>Data Permintaan Kantong Darah</title>
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
    <center>
        <h2>Data Hasil Pemeriksaan Incompatible</h2>
    </center>
<?php

    include "koneksi.php";

    //Cek apakah ada nilai dari method GET dengan nama id_anggota
    if (isset($_GET['id_anggota'])) {
        $id_anggota=htmlspecialchars($_GET["id_anggota"]);

        $sql="delete from anggota where id_anggota='$id_anggota' ";
        $hasil=mysqli_query($kon,$sql);

        //Kondisi apakah berhasil atau tidak
            if ($hasil) {
                header("Location:index.php");

            }
            else {
                echo "<div class='alert alert-danger'> Data Gagal dihapus.</div>";

            }
        }
?>


    <table class="table table-bordered table-dark table-hover">

    <thead>
        <tr>
            <th>No</th>
            <th>Nama Dokter</th>
            <th>NIP</th>
            <th>Nama Pasien</th>
            <th>No RM</th>
            <th>Ruangan</th>
            <th>Alasan Transfusi</th>
            <th>Golongan Darah</th>
            <th>Darah Diminta</th>
            <th colspan='2'>Penghapusan</th>
        </tr>
        </thead>

        <?php
        include "koneksi.php";
        $sql="select * from anggota order by id_anggota desc";

        $hasil=mysqli_query($kon,$sql);
        $no=0;
        while ($data = mysqli_fetch_array($hasil)) {
            $no++;

            ?>
            <tbody>
            <tr>
                <td><?php echo $no;                      ?></td>
                <td><?php echo $data["nama_dokter"];     ?></td>
                <td><?php echo $data["nip"];           ?></td>
                <td><?php echo $data["nama_pasien"];   ?></td>
                <td><?php echo $data["no_rm"];         ?></td>
                <td><?php echo $data["ruangan"];       ?></td>
                <td><?php echo $data["alasan_transfusi"]; ?></td>
                <td><?php echo $data["golongan_darah"]; ?></td>
                <td><?php echo $data["darah_diminta"]; ?></td>
                <td>
                <a href="update.php?id_anggota=<?php echo htmlspecialchars($data['id_anggota']); ?>" class="btn btn-danger" role="button">Update</a>
                    <a href="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>?id_anggota=<?php echo $data['id_anggota']; ?>" class="btn btn-danger" role="button">Delete</a>
                </td>
            </tr>
            </tbody>
            <?php
        }
        ?>
    </table>
    <a href="create.php" class="btn btn-danger" role="button">Tambah Data</a>
</div>
</body>
</html>
