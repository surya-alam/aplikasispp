<?php include 'config.php';

if(isset($_POST['id_siswa'])) {
$id_siswa = $_POST['id_siswa'];
$exec = mysqli_query($db,"SELECT * FROM siswa WHERE id_siswa = '$id_siswa' ");
$res = mysqli_fetch_assoc($exec);
?>
<form action="editdatasiswa.php" method="POST">
    <div class="form-group">
        <input type="hidden" class="form-control" name="id_siswa" value="<?=$res['id_siswa'] ?>">
    </div>
    <div class="form-group">
        <label>id angkatan</label>    
        <input type="text" class="form-control" name="id_angkatan" value="<?=$res['id_angkatan'] ?>">
    </div>
    <div class="form-group">
        <label>id jurusan</label>
        <input type="text" class="form-control" name="id_jurusan" value="<?=$res['id_jurusan'] ?>">
    </div>
    <div class="form-group">
        <label>id kelas</label>    
        <input type="text" class="form-control" name="id_kelas" value="<?=$res['id_kelas'] ?>">
    </div>
    <div class="form-group">
        <label>NISN</label>    
        <input type="text" class="form-control" name="nisn" value="<?=$res['nisn'] ?>">
    </div>
    <div class="form-group">
        <label>NAMA</label>    
        <input type="text" class="form-control" name="nama" value="<?=$res['nama'] ?>">
    </div>
    <div class="form-group">
        <label>Alamat</label>    
        <input type="text" class="form-control" name="alamat" value="<?=$res['alamat'] ?>">
    </div>
    <div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>   
    <button type="Submit" name="update" class="btn btn-warning">Update</button>
    </div>
</form>

<?php } ?>