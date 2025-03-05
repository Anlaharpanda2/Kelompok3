<?php
require 'koneksi.php';

// Proses Simpan Data
if (isset($_GET['proses']) && $_GET['proses'] == 'simpan') {
    if (isset($_POST['submit'])) {
        $nip = mysqli_real_escape_string($db, $_POST['nip']);
        $prodi_id = mysqli_real_escape_string($db, $_POST['prodi_id']);
        $nama_dosen = mysqli_real_escape_string($db, $_POST['nama_dosen']);

        // Upload Foto
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);

        // Insert data
        $query = mysqli_query($db, "INSERT INTO dosen (nip, nama_dosen, prodi_id, foto) VALUES ('$nip', '$nama_dosen', '$prodi_id', '$target_file')");

        if ($query) {
            echo "<script>alert('Data berhasil disimpan');window.location='index.php?page=dosen'</script>";
        }
    }
}

// Proses Edit Data
if (isset($_GET['proses']) && $_GET['proses'] == 'edit') {
    if (isset($_POST['submit'])) {
        $nip = mysqli_real_escape_string($db, $_POST['nip']);
        $prodi_id = mysqli_real_escape_string($db, $_POST['prodi_id']);
        $nama_dosen = mysqli_real_escape_string($db, $_POST['nama_dosen']);

        // Cek apakah user upload foto baru
        if ($_FILES['fileToUpload']['name'] != "") {
            $target_dir = "uploads/";
            $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
            move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
            $query = mysqli_query($db, "UPDATE dosen SET nama_dosen='$nama_dosen', prodi_id='$prodi_id', foto='$target_file' WHERE nip='$nip'");
        } else {
            $query = mysqli_query($db, "UPDATE dosen SET nama_dosen='$nama_dosen', prodi_id='$prodi_id' WHERE nip='$nip'");
        }

        if ($query) {
            echo "<script>alert('Data berhasil diperbarui');window.location='index.php?page=dosen'</script>";
        }
    }
}
?>
