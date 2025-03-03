<?php
    require "koneksi.php";
    $aksi = isset($_GET['aksi']) ? $_GET['aksi'] : 'read';
    
    switch($aksi) {
        case 'read':
?>


<h1>Data Prodi</h1>
<?php if($_SESSION['level'] == 'super_admin') : ?>
    <a href = 'index.php?page=prodi&aksi=create' class = "btn btn-primary ">tambah data</a>
<?php endif ?>
<table class="table table-bordered" id="prodi">
    <thead>
        <tr>
            <th scope="col">no</th>
            <th scope="col">Nama Prodi</th>
            <th scope="col">Jenjang</th>
            <th scope="col">Keterangan</th>
            <?php if($_SESSION['level'] != 'user') : ?>
                <th scope="col">aksi</th>
            <?php endif ?>
        </tr>
    </thead>
    <tbody>
        <?php
            $queryMhs = mysqli_query($db,"SELECT * FROM Prodi");
            $no = 1;
            while($data = mysqli_fetch_array($queryMhs)){
        ?>
        <tr>
            <td scope="row"><?= $no++ ?></td>
            <td><?= $data['nama_prodi'] ?></td>
            <td><?= $data['jenjang']?></td>
            <td><?= $data['keterangan'] ?></td>
            <?php if($_SESSION['level'] != 'user') : ?>
                <td>
                    <a href="index.php?page=prodi&aksi=edit&id_p=<?= $data['id_p']?>" class="btn btn-warning">edit</a>
                    <?php if($_SESSION['level'] != 'stuff') : ?>
                        <a href="proses_prodi.php?proses=hapus&id_p=<?= $data['id_p']?>" onclick="return confirm('Apakah Anda yakin menghapus data ini?')" class="btn btn-danger">hapus</a>
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



<h1>input data</h1>
<form action="proses_prodi.php?proses=simpan" method="POST">
    <div class="mb-3">
        <label for="nama_prodi" class="form-label">Nama_prodi</label>
        <input type="text" class="form-control" id="nama_prodi" name="nama_prodi" required>
    </div>

    <div class = "mb-3">
        <label for = "jenjang" class = "form-label">jenjang</label>
        <select name = "jenjang" id = "jejang" class = "form-select" required >
            <option value = "">pilih jenjang</option>
            <option value = "D2">D2</option>
            <option value = "D3">D3</option>
            <option value = "D4">D4</option>
            <option value = "S1">S1</option>
            <option value = "S2">S2</option>
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
<h1>update data</h1>
<?php
    $id_p = $_GET['id_p'];
    $query = mysqli_query($db,"SELECT * FROM prodi WHERE id_p = '$id_p'");
    $row = mysqli_fetch_array($query);
?>
    <form action="proses_prodi.php?proses=edit" method="POST">
    <div class="mb-3">
        <label for="nama_prodi" class="form-label">Nama_prodi</label>
        <input type="text" class="form-control" id="nama_prodi" name="nama_prodi" value="<?= $row['nama_prodi']?>" required >
    </div>

    <div class = "mb-3">
        <label for = "jenjang" class = "form-label">jenjang</label>
        <select name = "jenjang" id = "jejang" class = "form-select" required >
            <option value = "">pilih jenjang</option>
            <option value = "D2">D2</option>
            <option value = "D3">D3</option>
            <option value = "D4">D4</option>
            <option value = "S1">S1</option>
            <option value = "S2">S2</option>
        </select> 
    </div>
    
    <div class="mb-3">
        <label for="keterangan" class="form-label">Keterangan</label>
        <textarea name="keterangan" class="form-control" id="keterangan" required><?= $row['keterangan']?></textarea>
    </div>
    <button type="submit" name="submit" value="edit" class="btn btn-primary">Submit</button>
</form>
<?php
        break;
    }
?>