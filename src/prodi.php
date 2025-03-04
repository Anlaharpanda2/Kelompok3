<?php
require "koneksi.php";
$aksi = isset($_GET['aksi']) ? $_GET['aksi'] : 'read';

switch($aksi) {
    case 'read':
?>

<h1>Data Prodi</h1>
<a href='index.php?page=prodi&aksi=create' class="btn btn-primary">Tambah Data</a>
<table class="table table-bordered" id="prodi">
    <thead>
        <tr>
            <th scope="col">ID Prodi</th> <!-- Tambahkan kolom ID Prodi -->
            <th scope="col">Nama Prodi</th>
            <th scope="col">Jenjang</th>
            <th scope="col">Keterangan</th>
            <th scope="col">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php
            $queryMhs = mysqli_query($db, "SELECT * FROM Prodi");
            $no = 1;
            while($data = mysqli_fetch_array($queryMhs)){
        ?>
        <tr>
            <td scope="row"><?= $data['id_p'] ?></td> <!-- Tampilkan ID Prodi -->
            <td><?= $data['nama_prodi'] ?></td>
            <td><?= $data['jenjang']?></td>
            <td><?= $data['keterangan'] ?></td>
            <td>
                <a href="index.php?page=prodi&aksi=edit&id_p=<?= $data['id_p']?>" class="btn btn-warning">Edit</a>
                <a href="proses_prodi.php?proses=hapus&id_p=<?= $data['id_p']?>" onclick="return confirm('Apakah Anda yakin menghapus data ini?')" class="btn btn-danger">Hapus</a>
            </td>
        </tr>
        <?php } ?>
    </tbody>
</table>

<?php
        break;
        case 'create':
?>

<h1>Input Data</h1>
<form action="proses_prodi.php?proses=simpan" method="POST">
    <div class="mb-3">
        <label for="nama_prodi" class="form-label">Nama Prodi</label>
        <input type="text" class="form-control" id="nama_prodi" name="nama_prodi" required>
    </div>

    <div class="mb-3">
        <label for="jenjang" class="form-label">Jenjang</label>
        <select name="jenjang" id="jenjang" class="form-select" required>
            <option value="">Pilih Jenjang</option>
            <option value="D2">D2</option>
            <option value="D3">D3</option>
            <option value="D4">D4</option>
            <option value="S1">S1</option>
            <option value="S2">S2</option>
        </select> 
    </div>

    <div class="mb-3">
        <label for="keterangan" class="form-label">Keterangan</label>
        <textarea name="keterangan" class="form-control" id="keterangan" required></textarea>
    </div>
    <button type="submit" name="submit" value="simpan" class="btn btn-primary">Submit</button>
</form>

<?php
        break;
        case 'edit':
?>
<h1>Update Data</h1>
<?php
    $id_p = $_GET['id_p'];
    $query = mysqli_query($db, "SELECT * FROM prodi WHERE id_p = '$id_p'");
    $row = mysqli_fetch_array($query);
?>
    <form action="proses_prodi.php?proses=edit" method="POST">
        <input type="hidden" name="prodi_id" value="<?= $row['id_p'] ?>"> <!-- Tambahkan input hidden untuk id_p -->
        <div class="mb-3">