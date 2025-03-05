<?php
require 'koneksi.php';

// Pastikan folder uploads ada
$upload_dir = "uploads/";
if (!is_dir($upload_dir)) {
    mkdir($upload_dir, 0777, true);
}

// Fungsi untuk mengupload foto
function uploadFoto($file) {
    global $upload_dir;

    $target_file = $upload_dir . basename($file["name"]);
    $file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Cek ekstensi file
    $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];
    if (!in_array($file_type, $allowed_types)) {
        echo "<script>alert('Format file tidak didukung! Silakan upload file dengan format JPG, JPEG, PNG, atau GIF.'); window.history.back();</script>";
        exit;
    }

    // Cek ukuran file (maks 2MB)
    if ($file["size"] > 2097152) {
        echo "<script>alert('Ukuran file terlalu besar! (Maksimal 2MB)'); window.history.back();</script>";
        exit;
    }

    // Pindahkan file ke folder uploads
    if (move_uploaded_file($file["tmp_name"], $target_file)) {
        return $target_file;
    } else {
        echo "<script>alert('Gagal mengupload foto!'); window.history.back();</script>";
        exit;
    }
}

// Proses Simpan Data
if (isset($_GET['proses']) && $_GET['proses'] == 'simpan') {
    if (isset($_POST['submit'])) {
        $nip = mysqli_real_escape_string($db, $_POST['nip']);
        $prodi_id = mysqli_real_escape_string($db, $_POST['prodi_id']);
        $nama_dosen = mysqli_real_escape_string($db, $_POST['nama_dosen']);

        $foto = "";
        if ($_FILES['fileToUpload']['error'] == 0) {
            $foto = uploadFoto($_FILES['fileToUpload']);
        }

        if ($foto) {
            $query = mysqli_query($db, "INSERT INTO dosen (nip, nama_dosen, prodi_id, foto) VALUES ('$nip', '$nama_dosen', '$prodi_id', '$foto')");

            if ($query) {
                echo "<script>alert('Data berhasil disimpan');window.location='index.php?page=dosen'</script>";
            }
        }
    }
}

// Proses Edit Data
if (isset($_GET['proses']) && $_GET['proses'] == 'edit') {
    if (isset($_POST['submit'])) {
        $nip = mysqli_real_escape_string($db, $_POST['nip']);
        $prodi_id = mysqli_real_escape_string($db, $_POST['prodi_id']);
        $nama_dosen = mysqli_real_escape_string($db, $_POST['nama_dosen']);

        $queryFoto = mysqli_query($db, "SELECT foto FROM dosen WHERE nip='$nip'");
        $dataFoto = mysqli_fetch_assoc($queryFoto);
        $fotoLama = $dataFoto['foto'];

        $foto = $fotoLama;
        if ($_FILES['fileToUpload']['error'] == 0) {
            $fotoBaru = uploadFoto($_FILES['fileToUpload']);
            if ($fotoBaru) {
                // Hapus foto lama jika ada
                if (file_exists($fotoLama) && $fotoLama != "") {
                    unlink($fotoLama);
                }
                $foto = $fotoBaru;
            }
        }

        $query = mysqli_query($db, "UPDATE dosen SET nama_dosen='$nama_dosen', prodi_id='$prodi_id', foto='$foto' WHERE nip='$nip'");

        if ($query) {
            echo "<script>alert('Data berhasil diperbarui');window.location='index.php?page=dosen'</script>";
        }
    }
}

// Proses Hapus Data
if (isset($_GET['proses']) && $_GET['proses'] == 'hapus') {
    $nip = mysqli_real_escape_string($db, $_GET['nip']);

    // Ambil data foto sebelum menghapus
    $queryFoto = mysqli_query($db, "SELECT foto FROM dosen WHERE nip='$nip'");
    $dataFoto = mysqli_fetch_assoc($queryFoto);
    $fotoLama = $dataFoto['foto'];

    // Hapus data dari database
    $query = mysqli_query($db, "DELETE FROM dosen WHERE nip='$nip'");

    if ($query) {
        // Hapus file foto jika ada
        if (file_exists($fotoLama) && $fotoLama != "") {
            unlink($fotoLama);
        }
        echo "<script>alert('Data berhasil dihapus');window.location='index.php?page=dosen'</script>";
    } else {
        echo "<script>alert('Data gagal dihapus!');window.location='index.php?page=dosen'</script>";
    }
}
?>