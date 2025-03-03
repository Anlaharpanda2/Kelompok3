<?php
    require 'koneksi.php';
    $action = isset($_GET['action']) ? $_GET['action'] : 'read';

    switch ($action) {
        case 'read';
?>

<h1>Data mata_kuliah</h1>
<?php if($_SESSION['level'] == 'super_admin') : ?>
    <a href="index.php?page=mata_kuliah&action=create" class="btn btn-primary">Tambah Data</a>
<?php endif ?>
<table class="table table-bordered" id= "mata_kuliah">
    <thead>
        <tr>
            <th scope="col">No</th>
            <th scope="col">kode mata kuliah</th>
            <th scope="col">nama mata kuliah</th>
            <th scope="col">sks</th>
            <th scope="col">nama dosen</th>
            <th scope="col">semester</th>
            <?php if($_SESSION['level'] != 'user') : ?>
                <th scope="col">Aksi</th>
            <?php endif ?>
        </tr>
    </thead>
    <tbody>
        <?php
            $queryMhs = mysqli_query($db,"SELECT * FROM mata_kuliah m JOIN dosen p ON m.dosen_nip = p.nip ");
            $no = 1;
            while($data = mysqli_fetch_array($queryMhs)){
        ?>
        <tr>
            <td scope="row"><?= $no++ ?></td>
            <td><?= $data['kode_mk']  ?></td>
            <td><?= $data['nama_mk'] ?></td>
            <td><?= $data['sks'] ?></td>
            <td><?= $data['nama_dosen'] ?></td>
            <td><?= $data['semester'] ?></td>
            <?php if($_SESSION['level'] != 'user') : ?>
                <td>
                    <a href="index.php?page=mata_kuliah&action=update&kode_mk=<?= $data['kode_mk']?>" class="btn btn-warning">edit</a>
                    <?php if($_SESSION['level'] != 'stuff') : ?>
                        <a href="proses_mata_kuliah.php?proses=hapus&kode_mk=<?= $data['kode_mk']?>" onclick="return confirm('Apakah Anda yakin menghapus data ini?')" class="btn btn-danger">hapus</a>
                    <?php endif ?>
                </td>
            <?php endif ?>
        </tr>
            <?php } ?>
    </tbody>
</table>
<?php
break;
case 'create':
    ?>

<h1>Input Data mata_kuliah</h1>
<form action="proses_mata_kuliah.php?proses=simpan" method="POST">
    <div class="mb-3">
        <label for="kode_mk" class="form-label">kode_mk</label>
        <input type="number" class="form-control" id="kode_mk" name="kode_mk" required>
    </div>
    
    <div class="mb-3">
        <label for="nama_mk" class="form-label">nama_mk</label>
        <input type="text" class="form-control" id="nama_mk" name="nama_mk" required>
    </div>
    
    <div class="mb-3">
        <label for="sks" class="form-label">SKS</label>
        <input type="number" class="form-control" id="sks" name="sks" required>
    </div>

    <div class="mb-3">
        <label for="dosen_nip" class="form-label">dosen pengajar</label>
        <select name = "dosen_nip" id = "dosen_nip"  class = "form-select" required>
            <option value = "">pilih dosen</option>
            <?php
                $queryProdi = mysqli_query($db,"SELECT * FROM dosen");
                while($data_prodi = mysqli_fetch_array($queryProdi)){
            ?>
                <option value = "<?=$data_prodi['nip']?>"<?$data_prodi['nip'] == $row['dosen_nip'] ? : ''?>><?=$data_prodi['nama_dosen']?></option>
            <?php
                }
            ?>
        </select>
    </div>

    <div class="mb-3">
        <label for="semester" class="form-label">semester</label>
        <input type="number" class="form-control" id="semester" name="semester" required>
    </div>

    <button type="submit" name="submit" value="simpan" class="btn btn-primary">Submit</button>
</form>

<?php
break;
case 'update' :

?>

<h1>Edit Data mata_kuliah</h1>

<?php
    $kode_mk = $_GET['kode_mk'];
    $query = mysqli_query($db,"SELECT * FROM mata_kuliah WHERE kode_mk = '$kode_mk'");
    $row = mysqli_fetch_array($query);
?>
<form action="proses_mata_kuliah.php?proses=edit" method="POST">
<div class="mb-3">
        <label for="kode_mk" class="form-label">kode_mk</label>
        <input type="number" class="form-control" id="kode_mk" name="kode_mk" value="<?= $row['kode_mk']?>" required>
    </div>
    
    <div class="mb-3">
        <label for="nama_mk" class="form-label">nama_mk</label>
        <input type="text" class="form-control" id="nama_mk" name="nama_mk" value="<?= $row['nama_mk']?>" required>
    </div>
    
    <div class="mb-3">
        <label for="sks" class="form-label">SKS</label>
        <input type="number" class="form-control" id="sks" name="sks" value="<?= $row['sks']?>" required>
    </div>

    <div class="mb-3">
        <label for="dosen_nip" class="form-label">dosen NIP</label>
        <input type="number" class="form-control" id="dosen_nip" name="dosen_nip" value="<?= $row['dosen_nip']?>" required>
    </div>

    <div class="mb-3">
        <label for="semester" class="form-label">semester</label>
        <input type="number" class="form-control" id="semester" name="semester" value="<?= $row['semester']?>" required>
    </div>

    <button type="submit" name="edit" value="edit" class="btn btn-primary">Submit</button>
</form>

<?php
break;
}
?>