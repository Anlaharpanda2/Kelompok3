<?php
require 'koneksi.php';

// Proses Simpan Data
if(isset($_GET['proses']) && $_GET['proses'] == 'simpan') {
    if (isset($_POST['submit'])) {
        $nip = mysqli_real_escape_string($db, $_POST['nip']);
        $prodi_id = mysqli_real_escape_string($db, $_POST['prodi_id']);
        $nama_dosen = mysqli_real_escape_string($db, $_POST['nama_dosen']);
        $foto = mysqli_real_escape_string($db, $_POST['foto']);

        // Cek apakah NIP sudah ada
        $cekNIP = mysqli_query($db, "SELECT nip FROM dosen WHERE nip ='$nip'");
        if (mysqli_num_rows($cekNIP) > 0) {
            echo "<script>alert('Data gagal disimpan! NIP sudah terdaftar');window.location='index.php?page=dosen&aksi=create'</script>";
            exit();
        }

        // Insert data
        $query = mysqli_query($db, "INSERT INTO dosen (nip, nama_dosen, prodi_id, foto) VALUES ('$nip','$nama_dosen','$prodi_id','$foto')"); 
        
        if ($query) {
            echo "<script>alert('Data berhasil disimpan');window.location='index.php?page=dosen'</script>";
        } else {
            echo "<script>alert('Data gagal disimpan!');window.location='index.php?page=dosen&aksi=create'</script>";
        }
    }
}

// Proses Edit Data
if(isset($_GET['proses']) && $_GET['proses'] == 'edit') {
    if (isset($_POST['submit'])) {
        $nip = mysqli_real_escape_string($db, $_POST['nip']);
        $prodi_id = mysqli_real_escape_string($db, $_POST['prodi_id']);
        $nama_dosen = mysqli_real_escape_string($db, $_POST['nama_dosen']);
        $foto = mysqli_real_escape_string($db, $_POST['foto']);

        // Update data
        $query = mysqli_query($db, "UPDATE dosen SET nama_dosen='$nama_dosen', prodi_id='$prodi_id', foto='$foto' WHERE nip='$nip'");
        
        if ($query) {
            echo "<script>alert('Data berhasil diperbarui');window.location='index.php?page=dosen'</script>";
        } else {
            echo "<script>alert('Data gagal diperbarui!');window.location='index.php?page=dosen&aksi=edit&nip=$nip'</script>";
        }
    }
}

// Proses Hapus Data
if(isset($_GET['proses']) && $_GET['proses'] == 'hapus') {
    $nip = mysqli_real_escape_string($db, $_GET['nip']);
    $query = mysqli_query($db, "DELETE FROM dosen WHERE nip='$nip'");

    if ($query) {
        echo "<script>alert('Data berhasil dihapus');window.location='index.php?page=dosen'</script>";
    } else {
        echo "<script>alert('Data gagal dihapus!');window.location='index.php?page=dosen'</script>";
    }
}
?>
