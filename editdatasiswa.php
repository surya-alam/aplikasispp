<?php
include 'header.php';
include 'config.php';
?>
<!-- button triger -->
<button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#tambahSiswa">Tambah Siswa</button>
<!-- button triger -->
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Data Siswa</h6>
</div>
<div class="card-body">
    <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr class="text-center">
                    <th width="50">No</th>
                    <th>id_angkatan</th>
                    <th>id_jurusan</th>
                    <th>id_kelas</th>
                    <th>Nisn</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th width="150">Aksi</th>
</tr>
</thead>
<tbody>
    <!-- Query untuk membaca data dari tabel database (webspp) --> 
    <?php
     $no=1;
     $query = "SELECT * FROM siswa";
     $exec = mysqli_query($db,$query);
     while($res = mysqli_fetch_assoc($exec)) :
        ?>
        <tr>
            <!-- Fungsi untuk mengambil data yang ada pada tiap kolom tabel siswa -->
        <td class="text-center"><?= $no++ ?></td>
        <td><?= $res['id_angkatan'] ?></td>
        <td><?= $res['id_jurusan'] ?></td>
        <td><?= $res['id_kelas'] ?></td>
        <td><?= $res['nisn'] ?></td>
        <td><?= $res['nama'] ?></td>
        <td><?= $res['alamat'] ?></td>
        <td class="text-center">
            <div class="btn-group mr-2" role="group" aria-label="Action group button">
            <!-- Tombol edit data siswa -->
            <a href="#" class="view_data btn btn-sm btn-warning" data-toggle="modal" data-target="#editSiswa" id="<?php echo $res['id_siswa']; ?>">Update</a>
            <!-- Tombol hapus data siswa --> 
            <a href="editdatasiswa.php?id_siswa=<?= $res['id_siswa'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('apakah Yakin ingin menghapus data?')">Delete</a>
     </div>
     </td>
     </tr>
    <?php endwhile; ?>
     </tbody>
     </table>
     </div>
     </div>
     </div>

     <?php include 'footer.php'; ?>

     <!-- Modal --> 
     <div class="modal fade" id="tambahSiswa" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
     </button>
     </div>
     <div class="modal-body">
        <form action="editdatasiswa.php" method="POST">
            <input type="text" name="id_angkatan" placeholder="id angkatan" class="form-control mb-2">
            <input type="text" name="id_jurusan" placeholder="id jurusan" class="form-control mb-2">
            <input type="text" name="id_kelas" placeholder="id kelas" class="form-control mb-2">
            <input type="text" name="nisn" placeholder="NISN" class="form-control mb-2">
            <input type="text" name="nama" placeholder="NAMA" class="form-control mb-2">
            <input type="text" name="alamat" placeholder="Alamat" class="form-control mb-2">
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="Submit" name="simpan" class="btn btn-primary">Simpan</button>
     </div>
     </form>
     </div>
     </div>
     </div>
     </div>

    <div class="modal fade" id="editSiswa" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
    <div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">Update Data Siswa</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
    </div>
    <div class="modal-body" id="datasiswa">
    <!-- form edit data siswa dipisah ke dalam file view2.php -->
     </div>
     </div>
     </div>
     </div>
     <script type="text/javascript">
        $('.view_data').click(function(){
            var id_siswa = $(this).attr('id');
            $.ajax({
                url: 'view2.php',
                method: 'POST',
                data: {id_siswa:id_siswa},
                success:function(data){
                    $('#datasiswa').html(data)
                    $('#editSiswa').modal('show');
                }
            })
        })
        </script>

     <?php

     //proses tambah data ke dalam tabel database
     if(isset($_POST['simpan'])) {
        $id_angkatan = htmlentities(strip_tags(strtoupper($_POST['id_angkatan'])));
        $id_jurusan = htmlentities(strip_tags(strtoupper($_POST['id_jurusan'])));
        $id_kelas = htmlentities(strip_tags(strtoupper($_POST['id_kelas'])));
        $nisn = htmlentities(strip_tags(strtoupper($_POST['nisn'])));
        $nama = htmlentities(strip_tags(strtoupper($_POST['nama'])));
        $alamat = htmlentities(strip_tags(strtoupper($_POST['alamat'])));
        $query = "INSERT INTO siswa (id_angkatan,id_jurusan,id_kelas,nisn,nama,alamat) VALUES ('$id_angkatan','$id_jurusan','$id_kelas','$nisn','$nama','$alamat')";
        $exec = mysqli_query($db, $query);
        if($exec) {
            echo "<script>alert('data siswa berhasil disimpan')
            document.location = 'editdatasiswa.php';</script>";
        }else {
            echo "<script>alert('data siswa gagal disimpan')
            document.location = 'editdatasiswa.php';</script>";
        }
     }

     //proses hapus data pada tabel database
    if(isset($_GET['id_siswa'])) {
        $id_siswa = $_GET['id_siswa'];
        $exec = mysqli_query($db," DELETE FROM siswa WHERE id_siswa='$id_siswa' ");
        if($exec) {
            echo "<script>alert('data siswa berhasil dihapus')
            document.location = 'editdatasiswa.php';</script>";
        }else {
            echo "<script>alert('data siswa gagal dihapus')
            document.location = 'editdatasiswa.php';</script>";
        }
    }

    //proses hapus data pada tabel database
    //Proses update data pada tabel database

    if(isset($_POST['update'])) {
        $id_siswa = $_POST['id_siswa'];
        $id_angkatan = htmlentities(strip_tags(strtoupper($_POST['id_angkatan'])));
        $id_jurusan = htmlentities(strip_tags(strtoupper($_POST['id_jurusan'])));
        $id_kelas = htmlentities(strip_tags(strtoupper($_POST['id_kelas'])));
        $nisn = htmlentities(strip_tags(strtoupper($_POST['nisn'])));
        $nama = htmlentities(strip_tags(strtoupper($_POST['nama'])));
        $alamat = htmlentities(strip_tags(strtoupper($_POST['alamat'])));
        $query = "UPDATE siswa SET id_angkatan = '$id_angkatan', id_jurusan = '$id_jurusan', id_kelas = '$id_kelas', nisn = '$nisn', nama = '$nama', alamat = '$alamat' WHERE id_siswa= '$id_siswa'";
        $exec = mysqli_query($db,$query);
        if($exec) {
            echo " <script>alert('data siswa berhasil diedit')
            document.location = 'editdatasiswa.php'</script>; ";
        }else {
            echo " <script>alert('data siswa gagal diedit')
            document.location = 'editdatasiswa.php'</script>; ";
        }
    }

    ?>