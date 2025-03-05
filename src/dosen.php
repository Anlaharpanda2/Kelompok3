<?php
require 'koneksi.php';
$action = isset($_GET['action']) ? $_GET['action'] : 'read';

switch ($action) {
    case 'read';
?>
<style>
    body {
        background-color: #f8f9fa;
    }
    h1 {
        color: #007bff;
    }
</style>

<h1>Data Dosen</h1>
<a href="index.php?page=dosen&action=create" class="btn btn-primary">Tambah Data</a>
<table class="table table-bordered table-striped" id="dosen">
    <thead class="table-dark">
        <tr>
            <th>No</th>
            <th>NIP</th>
            <th>Nama Dosen</th>
            <th>Prodi ID</th>
            <th>Nama Prodi</th>
            <th>Foto</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php
            $queryDosen = mysqli_query($db, "SELECT m.*, p.nama_prodi FROM dosen m JOIN prodi p ON m.prodi_id = p.id_p");
            $no = 1;
            while ($data = mysqli_fetch_array($queryDosen)) {
        ?>
        <tr>
            <td><?= $no++ ?></td>
            <td><?= $data['nip'] ?></td>
            <td><?= $data['nama_dosen'] ?></td>
            <td><?= $data['prodi_id'] ?></td>
            <td><?= $data['nama_prodi'] ?></td>
            <td><img src="<?= $data['foto'] ?>" style="width: 100px;"></td>
            <td>
                <a href="index.php?page=dosen&action=edit&nip=<?= $data['nip'] ?>" class="btn btn-warning">Edit</a>
                <a href="proses_dosen.php?proses=hapus&nip=<?= $data['nip'] ?>" 
                   onclick="return confirm('Apakah Anda yakin menghapus data ini?')" 
                   class="btn btn-danger">Hapus</a>
            </td>
        </tr>
        <?php } ?>
    </tbody>
</table>

<?php
break;
case 'create':
?>
<h1>Input Data Dosen</h1>
<form action="proses_dosen.php?proses=simpan" method="POST" enctype="multipart/form-data">
    <label>NIP</label>
    <input type="text" name="nip" required class="form-control">

    <label>Nama Dosen</label>
    <input type="text" name="nama_dosen" required class="form-control">

    <label>Prodi</label>
    <select name="prodi_id" required class="form-control">
        <option value="">Pilih Prodi</option>
        <?php
            $queryProdi = mysqli_query($db, "SELECT * FROM prodi");
            while ($data_prodi = mysqli_fetch_array($queryProdi)) {
        ?>
            <option value="<?= $data_prodi['id_p'] ?>"><?= $data_prodi['nama_prodi'] ?></option>
        <?php } ?>
    </select>

    <label>Upload Foto</label>
    <input type="file" name="fileToUpload" class="form-control">

    <button type="submit" name="submit" class="btn btn-success">Submit</button>
</form>

<?php
break;

// Menampilkan form Edit Data
case 'edit':
    $nip = $_GET['nip'];
    $query = mysqli_query($db, "SELECT * FROM dosen WHERE nip='$nip'");
    $data = mysqli_fetch_array($query);
?>
<h1>Edit Data Dosen</h1>
<form action="proses_dosen.php?proses=edit" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="nip" value="<?= $data['nip'] ?>">
    
    <label>Nama Dosen</label>
    <input type="text" name="nama_dosen" value="<?= $data['nama_dosen'] ?>" required class="form-control">

    <label>Prodi</label>
    <select name="prodi_id" required class="form-control">
        <option value="">Pilih Prodi</option>
        <?php
            $queryProdi = mysqli_query($db, "SELECT * FROM prodi");
            while ($data_prodi = mysqli_fetch_array($queryProdi)) {
                $selected = ($data_prodi['id_p'] == $data['prodi_id']) ? "selected" : "";
        ?>
            <option value="<?= $data_prodi['id_p'] ?>" <?= $selected ?>><?= $data_prodi['nama_prodi'] ?></option>
        <?php } ?>
    </select>

    <label>Upload Foto</label>
    <input type="file" name="fileToUpload" class="form-control">
    
    <button type="submit" name="submit" class="btn btn-primary">Update</button>
</form>

<?php
break;
}
?>
