<?php
    require "koneksi.php";
    $aksi = isset($_GET['aksi']) ? $_GET['aksi'] : 'read';
    
    switch($aksi) {
        case 'read':
?>


<h1>Data Prodi</h1>
<?php if($_SESSION['level'] == 'super_admin') : ?>
    <a href = 'index.php?page=user&aksi=create' class = "btn btn-primary ">tambah data</a>
<?php endif ?>
<table class="table table-bordered">
    <thead>
        <tr>
            <th scope="col">no</th>
            <th scope="col">email</th>
            <th scope="col">Nama lengkap</th>
            <th scope="col">Level</th>
            <?php if($_SESSION['level'] != 'user') : ?>
                <th scope="col">Aksi</th>
            <?php endif ?>
        </tr>
    </thead>
    <tbody>
        <?php
            $queryMhs = mysqli_query($db,"SELECT * FROM user");
            $no = 1;
            while($data = mysqli_fetch_array($queryMhs)){
        ?>
        <tr>
            <td scope="row"><?= $no++ ?></td>
            <td><?= $data['email'] ?></td>
            <td><?= $data['nama_lengkap']?></td>
            <td><?= $data['level'] ?></td>
            <?php if($_SESSION['level'] != 'user') : ?>
                <td>
                    <a href="index.php?page=prodi&aksi=edit&id_p=<?= $data['id_u']?>" class="btn btn-warning">edit</a>
                    <?php if($_SESSION['level'] != 'stuff') : ?>
                        <a href="proses_user.php?proses=hapus&id_u=<?= $data['id_u']?>" onclick="return confirm('Apakah Anda yakin menghapus data ini?')" class="btn btn-danger">hapus</a>
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
<form action="proses_user.php?proses=simpan" method="POST">
    <div class="mb-3">
        <label for="email" class="form-label">email</label>
        <input type="text" class="form-control" id="nama_prodi" name="email" required>
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">password</label>
        <input type="text" class="form-control" id="nama_prodi" name="password" required>
    </div>
    <div class="mb-3">
        <label for="nama" class="form-label">nama</label>
        <input type="text" class="form-control" id="nama_prodi" name="nama" required>
    </div>

    <div class = "mb-3">
        <label for = "level" class = "form-label">level</label>
        <select name = "level" id = "level" class = "form-select" required >
            <option value = "">pilih level</option>
            <option value = "user">user</option>
            <option value = "admin">admin</option>
            <option value = "superuser">superuser</option>
        </select> 
    </div>

    <button type="submit" name="submit" value="simpan" class="btn btn-primary">Submit</button>
</form>

<?php
        break;
        case 'edit':
?>
<h1>edit data</h1>
<form action="proses_user.php?proses=simpan" method="POST">
    <div class="mb-3">
        <input type="text" class="form-control" id="nama_prodi" name="email" required>
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">password</label>
        <input type="text" class="form-control" id="nama_prodi" name="password" required>
    </div>
    <div class="mb-3">
        <label for="nama" class="form-label">nama</label>
        <input type="text" class="form-control" id="nama_prodi" name="nama" required>
    </div>

    <div class = "mb-3">
        <label for = "level" class = "form-label">level</label>
        <select name = "level" id = "level" class = "form-select" required >
            <option value = "">pilih level</option>
            <option value = "user">user</option>
            <option value = "admin">admin</option>
            <option value = "superuser">superuser</option>
        </select> 
    </div>
    <button type="edit" name="edit" value="edit" class="btn btn-primary">Submit</button>
</form>
<?php
        break;
    }
?>