<?php
require 'koneksi.php';
$action = isset($_GET['action']) ? $_GET['action'] : 'read';

switch ($action) {
    case 'read':
?>
    <h1 class="text-center mb-4 text-primary" style="background-color: #f8f9fa; padding: 10px; border-radius: 5px;">Data Mahasiswa</h1>
    <a href="index.php?page=mahasiswa&action=create" class="btn btn-success mb-3">Tambah Data</a>
    <table class="table table-bordered table-striped" id="mahasiswa">
        <thead style="background-color: #007bff; color: white;">
            <tr>
                <th scope="col" style="background-color: #0069d9;">No</th>
                <th scope="col" style="background-color: #0069d9;">Nama</th>
                <th scope="col" style="background-color: #0069d9;">Email</th>
                <th scope="col" style="background-color: #0069d9;">NIM</th>
                <th scope="col" style="background-color: #0069d9;">Gender</th>
                <th scope="col" style="background-color: #0069d9;">Hobi</th>
                <th scope="col" style="background-color: #0069d9;">Alamat</th>
                <th scope="col" style="background-color: #0069d9;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $queryMhs = mysqli_query($db, "SELECT * FROM mahasiswa");
            $no = 1;
            while ($data = mysqli_fetch_array($queryMhs)) {
            ?>
                <tr style="background-color: #f1f1f1;">
                    <td scope="row" style="background-color: #e9ecef;"><?= $no++ ?></td>
                    <td style="background-color: #e9ecef;"><?= $data['nama'] ?></td>
                    <td style="background-color: #e9ecef;"><?= $data['email'] ?></td>
                    <td style="background-color: #e9ecef;"><?= $data['nim'] ?></td>
                    <td style="background-color: #e9ecef;"><?= $data['gender'] == 'L' ? 'Laki-Laki' : 'Perempuan' ?></td>
                    <td style="background-color: #e9ecef;"><?= $data['hobi'] ?></td>
                    <td style="background-color: #e9ecef;"><?= $data['alamat'] ?></td>
                    <td>
                        <a href="index.php?page=mahasiswa&action=update&id=<?= $data['id']?>" class="btn btn-warning">Edit</a>
                        <a href="proses_mahasiswa.php?proses=hapus&id=<?= $data['id']?>" onclick="return confirm('Apakah Anda yakin menghapus data ini?')" class="btn btn-danger">Hapus</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
<?php
    break;

    case 'create':
?>
    <h1 class="text-center mb-4 text-primary" style="background-color: #f8f9fa; padding: 10px; border-radius: 5px;">Input Data Mahasiswa</h1>
    <form action="proses_mahasiswa.php?proses=simpan" method="POST">
        <div class="mb-3">
            <label for="nama" class="form-label">Nama</label>
            <input type="text" class="form-control" id="nama" name="nama" required>
        </div>
        
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        
        <div class="mb-3">
            <label for="nim" class="form-label">NIM</label>
            <input type="number" class="form-control" id="nim" name="nim" required>
        </div>

        <div class="mb-3">
            <label for="gender" class="form-label">Jenis Kelamin</label><br>
            <input type="radio" class="form-check-input" id="gender" name="gender" value="L"> Laki-Laki<br>
            <input type="radio" class="form-check-input" id="gender" name="gender" value="P"> Perempuan
        </div>

        <div class="mb-3">
            <label for="hobi" class="form-label">Hobi</label><br>
            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="hobi" name="hobi[]" value="Berenang">
                <label class="form-check-label" for="hobi">Berenang</label>
            </div>
            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="hobi" name="hobi[]" value="Sepak Bola">
                <label class="form-check-label" for="hobi">Sepak Bola</label>
            </div>
            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="hobi" name="hobi[]" value="Voli">
                <label class="form-check-label" for="hobi">Voli</label>
            </div>
        </div>
        
        <div class="mb-3">
            <label for="alamat" class="form-label">Alamat</label>
            <textarea name="alamat" class="form-control" id="alamat" required></textarea>
        </div>
        <button type="submit" name="submit" value="simpan" class="btn btn-primary">Submit</button>
    </form>
<?php
    break;

    case 'update':
?>
    <h1 class="text-center mb-4 text-primary" style="background-color: #f8f9fa; padding: 10px; border-radius: 5px;">Edit Data Mahasiswa</h1>

    <?php
    $id = $_GET['id'];
    $query = mysqli_query($db, "SELECT * FROM mahasiswa WHERE id = '$id'");
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
            <input type="radio" class="form-check-input" id="gender" name="gender" value="L" <?= $row['gender'] == 'L' ? 'checked' : '' ?>> Laki-Laki<br>
            <input type="radio" class="form-check-input" id="gender" name="gender" value="P" <?= $row['gender'] == 'P' ? 'checked' : '' ?>> Perempuan
        </div>

        <div class="mb-3">
            <label for="hobi" class="form-label">Hobi</label><br>
            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="hobi" name="hobi[]" value="Berenang" <?= in_array("Berenang", $hobbies) ? 'checked' : '' ?>>
                <label class="form-check-label" for="hobi">Berenang</label>
            </div>
            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="hobi" name="hobi[]" value="Sepak Bola" <?= in_array("Sepak Bola", $hobbies) ? 'checked' : '' ?>>
                <label class="form-check-label" for="hobi">Sepak Bola</label>
            </div>
            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="hobi" name="hobi[]" value="Voli" <?= in_array("Voli", $hobbies) ? 'checked' : '' ?>>
                <label class="form-check-label" for="hobi">Voli</label>
            </div>
        </div>

        <div class="mb-3">
            <label for="alamat" class="form-label">Alamat</label>
            <textarea name="alamat" class="form-control" id="alamat" required><?= $row['alamat'] ?></textarea>
        </div>
        <button type="submit" name="edit" value="edit" class="btn btn-primary">Submit</button>
    </form>
<?php
    break;
}
?>