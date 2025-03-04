<?php
require 'koneksi.php';
session_start();

// Proses simpan data
if (isset($_GET['proses']) && $_GET['proses'] === 'simpan') {
    if (isset($_POST['submit'])) {
        $nama_prodi = mysqli_real_escape_string($db, $_POST['nama_prodi']);
        $jenjang = mysqli_real_escape_string($db, $_POST['jenjang']);
        $keterangan = mysqli_real_escape_string($db, $_POST['keterangan']);

        // Jika id_p adalah auto-increment, Anda tidak perlu menyertakannya di sini
        $query = mysqli_query($db, "INSERT INTO prodi (nama_prodi, jenjang, keterangan) VALUES ('$nama_prodi', '$jenjang', '$keterangan')");

        if ($query) {
            echo "<script>alert('Data berhasil disimpan');window.location='index.php?page=prodi'</script>";
        } else {
            echo "<script>alert('Data gagal disimpan!!!');window.location='index.php?page=prodi&aksi=create'</script>";
        }
    }
}

// Proses edit data
if (isset($_GET['proses']) && $_GET['proses'] === 'edit') {
    if (isset($_POST['submit'])) {
        $prodi_id = intval($_POST['prodi_id']); // Ambil id_p dari input form
        $nama_prodi = mysqli_real_escape_string($db, $_POST['nama_prodi']);
        $jenjang = mysqli_real_escape_string($db, $_POST['jenjang']);
        $keterangan = mysqli_real_escape_string($db, $_POST['keterangan']);

        $query = mysqli_query($db, "UPDATE prodi SET nama_prodi = '$nama_prodi', jenjang = '$jenjang', keterangan = '$keterangan' WHERE id_p = $prodi_id");

        if ($query) {
            echo "<script>alert('Data berhasil disimpan');window.location='index.php?page=prodi'</script>";
        } else {
            echo "<script>alert('Data gagal disimpan!!!');window.location='index.php?page=prodi&aksi=create'</script>";
        }
    }
}

// Proses hapus data
if (isset($_GET['proses']) && $_GET['proses'] === 'hapus') {
    if ($_SESSION['level'] == 'admin') {
        $id = intval($_GET['id_p']); // Pastikan id_p adalah integer
        $query = mysqli_query($db, "DELETE FROM prodi WHERE id_p = $id");
        if ($query) {
            echo "<script>alert('Data berhasil dihapus');window.location='index.php?page=prodi'</script>";
        } else {
            echo "<script>alert('Data gagal dihapus');window.location='index.php?page=prodi'</script>";
        }
    } else {
        echo "<script>alert('Anda Tidak punya akses');window.location='index.php?page=prodi'</script>";
    }
}
?>