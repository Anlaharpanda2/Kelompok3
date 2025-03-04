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
            <th scope="col">No</th>
            <th scope="col">NIP</th>
            <th scope="col">Nama Dosen</th>
            <th scope="col">Prodi ID</th>
            <th scope="col">Nama Prodi</th>
            <th scope="col">Foto</th>
            <th scope="col">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php
            $queryDosen = mysqli_query($db, "SELECT m.*, p.nama_prodi FROM dosen m JOIN prodi p ON m.prodi_id = p.id_p");
            $no = 1;
            while ($data = mysqli_fetch_array($queryDosen)) {
        ?>
        <tr>
            <td scope="row"><?= $no++ ?></td>
            <td><?= $data['nip'] ?></td>
            <td><?= $data['nama_dosen'] ?></td>
            <td><?= $data['prodi_id'] ?></td>
            <td><?= $data['nama_prodi'] ?></td>
            <td>
                <img src="<?= $data['foto'] ?>" style="width: 100px;">
            </td>
            <td>
                <!-- Perbaikan Link Edit dan Hapus -->
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
<style>
    body {
        background-color: #e3f2fd;
    }
    h1 {
        color: #0d6efd;
    }
</style>

<h1>Input Data Dosen</h1>
<form action="proses_dosen.php?proses=simpan" method="POST" enctype="multipart/form-data">
    <div class="mb-3">
        <label for="nip" class="form-label">NIP</label>
        <input type="text" class="form-control border-primary" id="nip" name="nip" required>
    </div>
    
    <div class="mb-3">
        <label class="form-label">Nama Dosen</label>
        <input type="text" class="form-control border-primary" name="nama_dosen" required>
    </div>

    <div class="mb-3">
        <label for="prodi_id" class="form-label">Prodi</label>
        <select name="prodi_id" id="prodi_id" class="form-select border-primary" required>
            <option value="">Pilih Prodi</option>
            <?php
                $queryProdi = mysqli_query($db, "SELECT * FROM prodi");
                while ($data_prodi = mysqli_fetch_array($queryProdi)) {
            ?>
                <option value="<?= $data_prodi['id_p'] ?>"><?= $data_prodi['nama_prodi'] ?></option>
            <?php
                }
            ?>
        </select>
    </div>
    
    <div class="mb-3">
        <label>Upload Foto</label>
        <input type="file" name="fileToUpload" id="fileToUpload" class="form-control border-primary">
    </div>

    <button type="submit" name="submit" value="simpan" class="btn btn-success">Submit</button>
</form>

<?php
break;
}
?>
