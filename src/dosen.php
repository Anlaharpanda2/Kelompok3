<?php
    require 'koneksi.php';
    $action = isset($_GET['action']) ? $_GET['action'] : 'read';

    switch ($action) {
        case 'read';
?>

<h1>Data Dosen</h1>
<a href="index.php?page=dosen&action=create" class="btn btn-primary">Tambah Data</a>
<table class="table table-bordered" id="dosen">
    <thead>
        <tr>
            <th scope="col">No</th>
            <th scope="col">NIP</th>
            <th scope="col">Nama dosen</th>
            <th scope="col">prodi_id</th>
            <th scope="col">Foto</th>
            <th scope="col">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php
            $queryMhs = mysqli_query($db,"SELECT * FROM dosen m JOIN prodi p ON m.prodi_id = p.id_p ");
            $no = 1;
            while($data = mysqli_fetch_array($queryMhs)){
        ?>
        <tr>
            <td scope="row"><?= $no++ ?></td>
            <td><?= $data['nip']  ?></td>
            <td><?= $data['nama_dosen'] ?></td>
            <td><?= $data['prodi_id'] ?></td>
            <td>
                <img src = "<?= $data['foto']?>" style = "width : 100px">
            </td>
            <td>
                <a href="index.php?page=prodi&aksi=edit&id_p=<?= $data['id_p']?>" class="btn btn-warning">edit</a>
                <a href="proses_prodi.php?proses=hapus&id=<?= $data['id_p']?>" onclick="return confirm('Apakah Anda yakin menghapus data ini?')" class="btn btn-danger">hapus</a>
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
<form action="proses_dosen.php?proses=simpan" method="POST">
    <div class="mb-3">
        <label for="nama" class="form-label">NIP</label>
        <input type="text" class="form-control" id="nip" name="nip" required>
    </div>
    
    <div class="mb-3">
        <label class="form-label">Nama Dosen</label>
        <input type = "text" class="form-control" name="nama_dosen" required>
    </div>

    <div class="mb-3">
        <label for="prodi_id" class="form-label">prodi</label>
        <select name = "prodi_id" id = "prodi_id"  class = "form-select" required>
            <option value = "">pilih prodi</option>
            <?php
                $queryProdi = mysqli_query($db,"SELECT * FROM prodi");
                while($data_prodi = mysqli_fetch_array($queryProdi)){
            ?>
                <option value = "<?=$data_prodi['id_p']?>"<?$data_prodi['id_p'] == $row['prodi_id'] ? : ''?>><?=$data_prodi['nama_prodi']?></option>
            <?php
                }
            ?>
        </select>
    </div>
    
    <div class="mb-3">
        <form action="upload.php" method="post" enctype="multipart/form-data">
            Select image to upload:
        <input type="file" name="fileToUpload" id="fileToUpload">
        <input type="submit" value="Upload Image" name="submit">
        </form>
    </div>

    <button type="submit" name="submit" value="simpan" class="btn btn-primary">Submit</button>
<?php
break;
case 'update' :

?>

<h1>Edit Data Mahasiswa</h1>

<?php
    $id = $_GET['id'];
    $query = mysqli_query($db,"SELECT * FROM mahasiswa WHERE id = '$id'");
    $row = mysqli_fetch_array($query);
    $hobbies = explode(", ", $row['hobi']);
?>
<form action="proses_mahasiswa.php?proses=edit" method="POST">
    <input type="hidden" value="<?= $id ?>" name="id">
    <div class="mb-3">
        <label for="nama" class="form-label">Nama</label>
        <input type="text" class="form-control" id="nama" name="nama" value="<?= $row['nama']?>" required>
    </div>
    
    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" name="email" value="<?= $row['email'] ?>" required>
    </div>
    
    <div class="mb-3">
        <label for="nim" class="form-label">NIM</label>
        <input type="number" class="form-control" id="nim" name="nim" value="<?= $row['nim'] ?>" >
    </div>
    
    <div class="mb-3">
        <label for="gender" class="form-label">Jenis Kelamin</label><br>
        <input type = "radio" class="form-check-input" id="gender" name="gender" value ="L" <?=$row['gender'] == 'L' ? 'checked' : ''?>> Laki Laki<br>
        <input type = "radio" class="form-check-input" id="gender" name="gender" value ="P" <?=$row['gender'] == 'P' ? 'checked' : ''?>> Perempuan
    </div>

    <div class="mb-3">
        <label for="hobi" class="form-label">Hobi</label><br>
        <div class="form-check">
            <input type="checkbox" class="form-check-input" id="hobi" name="hobi[]" value="Berenang" <?=in_array("Berenang",$hobbies) ? 'checked' : '' ?>>
            <label class="form-check-label" for="hobi">Berenang</label>
        </div>
        
        <div class="form-check">
            <input type="checkbox" class="form-check-input" id="hobi" name="hobi[]" value="Sepak Bola" <?=in_array("Sepak Bola",$hobbies) ? 'checked' : '' ?> >
            <label class="form-check-label" for="hobi">Sepak Bola</label>
        </div>
        
        <div class="form-check">
            <input type="checkbox" class="form-check-input" id="hobi" name="hobi[]" value="Voli" <?=in_array("Voli",$hobbies) ? 'checked' : '' ?> >
            <label class="form-check-label" for="hobi">Voli</label>
        </div>
    </div>
    <div class="mb-3">
        <label for="alamat" class="form-label">Alamat</label>
        <textarea name="alamat" class="form-control" id="alamat" value="<?= $row['alamat'] ?>" required></textarea>
    </div>
    <button type="submit" name="submit" value="edit" class="btn btn-primary">Submit</button>
</form>

<?php
break;
}
?>