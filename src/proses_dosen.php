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

            // Hapus foto lama sebelum update
            $queryFoto = mysqli_query($db, "SELECT foto FROM dosen WHERE nip='$nip'");
            $dataFoto = mysqli_fetch_assoc($queryFoto);
            if (file_exists($dataFoto['foto']) && $dataFoto['foto'] != "") {
                unlink($dataFoto['foto']);
            }

            $query = mysqli_query($db, "UPDATE dosen SET nama_dosen='$nama_dosen', prodi_id='$prodi_id', foto='$target_file' WHERE nip='$nip'");
        } else {
            $query = mysqli_query($db, "UPDATE dosen SET nama_dosen='$nama_dosen', prodi_id='$prodi_id' WHERE nip='$nip'");
        }

        if ($query) {
            echo "<script>alert('Data berhasil diperbarui');window.location='index.php?page=dosen'</script>";
        }
    }
}

// ✅ Perbaikan Aksi Hapus Data
if (isset($_GET['proses']) && $_GET['proses'] == 'hapus') {
    $nip = mysqli_real_escape_string($db, $_GET['nip']);

    // Ambil data foto sebelum menghapus
    $queryFoto = mysqli_query($db, "SELECT foto FROM dosen WHERE nip='$nip'");
    $dataFoto = mysqli_fetch_assoc($queryFoto);
    
    // Hapus data dari database
    $query = mysqli_query($db, "DELETE FROM dosen WHERE nip='$nip'");

    if ($query) {
        // Hapus file foto jika ada
        if (file_exists($dataFoto['foto']) && $dataFoto['foto'] != "") {
            unlink($dataFoto['foto']);
        }

        echo "<script>alert('Data berhasil dihapus');window.location='index.php?page=dosen'</script>";
    } else {
        echo "<script>alert('Data gagal dihapus!');window.location='index.php?page=dosen'</script>";
    }
}
?>
