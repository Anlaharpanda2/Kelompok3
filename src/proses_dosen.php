<?php
require 'koneksi.php';
if(isset($_GET['proses']) == 'simpan') {
    if (isset($_POST['submit'])) {
        $nip = $_POST['nip'];
        $prodi_id = $_POST['prodi_id'];
        $nama_dosen = $_POST['nama_dosen'];
        $foto = $_POST['foto'];

        //Cek NIM sudah ada atau belum
        $cekNIP = mysqli_query($db,"SELECT nip FROM dosen WHERE nip ='$nip' ");
        if (mysqli_num_rows($cekNIP) > 0) {
            echo "<script>alert('Data gagal disimpan!!! NIP sudah terdaftar');window.location='index.php?page=dosen&aksi=create'</script>";
            exit();
        }

        $query = mysqli_query($db, "INSERT INTO dosen (nip, nama_dosen, prodi_id, foto) VALUES ('$nip','$nama_dosen','$prodi_id','$foto')"); 
        
        if ($query){
            echo "<script>alert('Data berhasil disimpan');window.location='index.php?page=dosen'</script>";
        } else{
            echo "<script>alert('Data gagal disimpan!!!');window.location='index.php?page=dosen&aksi=create'</script>";
        }
    }
}
if(isset($_GET['proses']) == 'edit') {
    if (isset($_POST['submit'])) {
        $nip = $_POST['nip'];
        $prodi_id = $_POST['prodi_id'];
        $nama_dosen = $_POST['nama_dosen'];
        $foto = $_POST['foto'];

        //Cek NIM sudah ada atau belum
        $cekNIM = mysqli_query($db,"SELECT nim FROM dosen WHERE nip ='$nip' ");
        if (mysqli_num_rows($cekNIM) > 0) {
            echo "<script>alert('Data gagal disimpan!!! NIM sudah terdaftar');window.location='index.php?page=mahasiswa&aksi=create'</script>";
            exit();
        }

        $query = mysqli_query($db, "INSERT INTO dosen (nip, nama_dosen, prodi_id, foto) VALUES ('$nip','$nama_dosen','$prodi_id','$foto')"); 
        
        if ($query){
            echo "<script>alert('Data berhasil disimpan');window.location='index.php?page=mahasiswa'</script>";
        } else{
            echo "<script>alert('Data gagal disimpan!!!');window.location='index.php?page=mahasiswa&aksi=create'</script>";
        }
    }
}
if(isset($_GET['proses']) == 'hapus') {
    $nip = $_GET['nip'];
    $query = mysqli_query($db, "DELETE FROM dosen WHERE nip=$nip");
    if ($query){
        echo "<script>alert('Data berhasil dihapus');window.location='index.php?page=mahasiswa'</script>";
    } else{
        echo "<script>alert('Data gagal dihapus');window.location='index.php?page=mahasiswa'</script>";
    }
}

?>