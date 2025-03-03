<?php
    require 'koneksi.php';
    session_start();

    if(isset($_GET['proses']) == 'simpan') {
        if (isset($_POST['submit'])) {
            $nama_prodi = $_POST['nama_prodi'];
            $jenjang = $_POST['jenjang'];
            $keterangan = $_POST['keterangan'];
    
            $query = mysqli_query($db, "INSERT INTO prodi (id_p, nama_prodi, jenjang, keterangan) VALUES ('$id_p','$nama_prodi','$jenjang','$keterangan')"); 
            
            if ($query){
                echo "<script>alert('Data berhasil disimpan');window.location='index.php?page=prodi'</script>";
            } else{
                echo "<script>alert('Data gagal disimpan!!!');window.location='index.php?page=prodi&aksi=create'</script>";
            }
        }
    }

    if(isset($_GET['proses']) == 'edit') {
        if (isset($_POST['submit'])) {
            $nama_prodi = $_POST['nama_prodi'];
            $jenjang = $_POST['jenjang'];
            $keterangan = $_POST['keterangan'];
    
            $query = mysqli_query($db, "UPDATE prodi SET nama_prodi = '$nama_prodi', jenjang = '$jenjang', keterangan = '$keterangan' where id_p=$id_p");

            if ($query){
                echo "<script>alert('Data berhasil disimpan');window.location='index.php?page=prodi'</script>";
            } 
            else{
                echo "<script>alert('Data gagal disimpan!!!');window.location='index.php?page=prodi&aksi=create'</script>";
            }
        }
    }

    if(isset($_GET['proses']) == 'hapus') {
        if($_SESSION['level'] == 'admin'){
            $id = $_GET['id_p'];
            $query = mysqli_query($db, "DELETE FROM prodi WHERE id_p=$id");
            if ($query){
                echo "<script>alert('Data berhasil dihapus');window.location='index.php?page=prodi'</script>";
            } else{
                echo "<script>alert('Data gagal dihapus');window.location='index.php?page=prodi'</script>";
            }
        }
        else{
            echo "<script>alert('Anda Tidak punya akses');window.location='index.php?page=prodi'</script>";
        }
    }

    
?>