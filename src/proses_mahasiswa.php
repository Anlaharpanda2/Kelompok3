<?php
require 'koneksi.php';

if (isset($_GET['proses']) && $_GET['proses'] == 'simpan') {
    if (isset($_POST['submit'])) {
        $nama = $_POST['nama'];
        $email = $_POST['email'];
        $nim = $_POST['nim'];
        $gender = $_POST['gender'];
        $hobi = implode(", ", $_POST['hobi']);
        $alamat = $_POST['alamat'];

        // Cek NIM sudah ada atau belum
        $cekNIM = mysqli_query($db, "SELECT nim FROM mahasiswa WHERE nim = '$nim'");
        if (mysqli_num_rows($cekNIM) > 0) {
            echo "<script>alert('Data gagal disimpan! NIM sudah terdaftar.'); window.location = 'index.php?page=mahasiswa&action=create';</script>";
            exit();
        }

        $query = mysqli_query($db, "INSERT INTO mahasiswa (nama, email, nim, gender, hobi, alamat) VALUES ('$nama', '$email', '$nim', '$gender', '$hobi', '$alamat')");
        
        if ($query) {
            echo "<script>alert('Data berhasil disimpan.'); window.location = 'index.php?page=mahasiswa';</script>";
        } else {
            echo "<script>alert('Data gagal disimpan.'); window.location = 'index.php?page=mahasiswa&action=create';</script>";
        }
    }
}

if (isset($_GET['proses']) && $_GET['proses'] == 'edit') {
    if (isset($_POST['edit'])) {
        $id = $_POST['id'];
        $nama = $_POST['nama'];
        $email = $_POST['email'];
        $nim = $_POST['nim'];
        $gender = $_POST['gender'];
        $hobi = implode(", ", $_POST['hobi']);
        $alamat = $_POST['alamat'];

        $query = mysqli_query($db, "UPDATE mahasiswa SET nama = '$nama', email = '$email', nim = '$nim', gender = '$gender', hobi = '$hobi', alamat = '$alamat' WHERE id = '$id'");
        
        if ($query) {
            echo "<script>alert('Data berhasil diperbarui.'); window.location = 'index.php?page=mahasiswa';</script>";
        } else {
            echo "<script>alert('Data gagal diperbarui.'); window.location = 'index.php?page=mahasiswa&action=update&id=$id';</script>";
        }
    }
}

if (isset($_GET['proses']) && $_GET['proses'] == 'hapus') {
    $id = $_GET['id'];
    $query = mysqli_query($db, "DELETE FROM mahasiswa WHERE id = '$id'");
    
    if ($query) {
        echo "<script>alert('Data berhasil dihapus.'); window.location = 'index.php?page=mahasiswa';</script>";
    } else {
        echo "<script>alert('Data gagal dihapus.'); window.location = 'index.php?page=mahasiswa';</script>";
    }
}
?>