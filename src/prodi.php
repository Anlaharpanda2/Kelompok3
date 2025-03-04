<?php
require "koneksi.php";
$aksi = isset($_GET['aksi']) ? $_GET['aksi'] : 'read';

switch($aksi) {
    case 'read':
?>

<h1 class="text-center bg-primary text-white p-3 rounded">Data Prodi</h1>
<a href='index.php?page=prodi&aksi=create' class="btn btn-success mb-3">Tambah Data</a>

<table class="table table-bordered table-striped table-hover">
    <thead class="table-dark">
        <tr>
            <th scope="col">No</th>
            <th scope="col">Nama Prodi</th>
            <th scope="col">ID Prodi</th>
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
            <td scope="row"><?= $no++ ?></td>
            <td><?= $data['nama_prodi'] ?></td>
            <td><?= $data['id_p'] ?></td>
            <td><?= $data['jenjang']?></td>
            <td><?= $data['keterangan'] ?></td>
            <td>
                <a href="index.php?page=prodi&aksi=edit&id_p=<?= $data['id_p']?>" class="btn btn-info btn-sm">Edit</a>
                <a href="proses_prodi.php?proses=hapus&id_p=<?= $data['id_p']?>" onclick="return confirm('Apakah Anda yakin menghapus data ini?')" class="btn btn-danger btn-sm">Hapus</a>
            </td>
        </tr>
        <?php } ?>
    </tbody>
</table>

<?php
        break;
        case 'create':
?>

<h1 class="text-center bg-success text-white p-3 rounded">Input Data</h1>
<form action="proses_prodi.php?proses=simpan" method="POST" class="p-4 border rounded shadow">
    <div class="mb-3">
        <label for="nama_prodi" class="form-label fw-bold">Nama Prodi</label>
        <input type="text" class="form-control border-primary" id="nama_prodi" name="nama_prodi" required>
    </div>

    <div class="mb-3">
        <label for="jenjang" class="form-label fw-bold">Jenjang</label>
        <select name="jenjang" id="jenjang" class="form-select border-primary" required>
            <option value="">Pilih Jenjang</option>
            <option value="D2">D2</option>
            <option value="D3">D3</option>
            <option value="D4">D4</option>
            <option value="S1">S1</option>
            <option value="S2">S2</option>
        </select> 
    </div>

    <div class="mb-3">
        <label for="keterangan" class="form-label fw-bold">Keterangan</label>
        <textarea name="keterangan" class="form-control border-primary" id="keterangan" required></textarea>
    </div>
    <button type="submit" name="submit" value="simpan" class="btn btn-primary w-100">Submit</button>
</form>

<?php
        break;
        case 'edit':
?>
<h1 class="text-center bg-warning text-dark p-3 rounded">Update Data</h1>
<?php
    $id_p = $_GET['id_p'];
    $query = mysqli_query($db, "SELECT * FROM prodi WHERE id_p = '$id_p'");
    $row = mysqli_fetch_array($query);
?>
    <form action="proses_prodi.php?proses=edit" method="POST" class="p-4 border rounded shadow">
        <input type="hidden" name="prodi_id" value="<?= $row['id_p'] ?>"> 

        <div class="mb-3">
            <label for="nama_prodi" class="form-label fw-bold">Nama Prodi</label>
            <input type="text" class="form-control border-warning" id="nama_prodi" name="nama_prodi" value="<?= $row['nama_prodi']?>" required>
        </div>

        <div class="mb-3">
            <label for="jenjang" class="form-label fw-bold">Jenjang</label>
            <select name="jenjang" id="jenjang" class="form-select border-warning" required>
                <option value="">Pilih Jenjang</option>
                <option value="D2" <?= $row['jenjang'] == 'D2' ? 'selected' : '' ?>>D2</option>
                <option value="D3" <?= $row['jenjang'] == 'D3' ? 'selected' : '' ?>>D3</option>
                <option value="D4" <?= $row['jenjang'] == 'D4' ? 'selected' : '' ?>>D4</option>
                <option value="S1" <?= $row['jenjang'] == 'S1' ? 'selected' : '' ?>>S1</option>
                <option value="S2" <?= $row['jenjang'] == 'S2' ? 'selected' : '' ?>>S2</option>
            </select> 
        </div>
        
        <div class="mb-3">
            <label for="keterangan" class="form-label fw-bold">Keterangan</label>
            <textarea name="keterangan" class="form-control border-warning" id="keterangan" required><?= $row['keterangan']?></textarea>
        </div>
        <button type="submit" name="submit" value="edit" class="btn btn-warning w-100">Submit</button>
    </form>
<?php
        break;
    }
?>
