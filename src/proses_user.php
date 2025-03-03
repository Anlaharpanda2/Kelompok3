<?php
    require 'koneksi.php';
    if(isset($_GET['proses']) == 'simpan') {
        if (isset($_POST['submit'])) {
            $email = $_POST['email'];
            $password = md5($_POST['password']);
            $nama = $_POST['nama'];
            $level = $_POST['level'];
    
            $query = mysqli_query($db, "INSERT INTO user (email,password,nama_lengkap,level) VALUES ('$email','$password','$nama','$level')"); 
            
            if ($query){
                echo "<script>alert('Data berhasil disimpan');window.location='index.php?page=user'</script>";
            } else{
                echo "<script>alert('Data gagal disimpan!!!');window.location='index.php?page=user&aksi=create'</script>";
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
        $id_u = $_GET['id_u'];
        $query = mysqli_query($db, "DELETE FROM user WHERE id_u=$id_u");
        if ($query){
            echo "<script>alert('Data berhasil dihapus');window.location='index.php?page=user'</script>";
        } else{
            echo "<script>alert('Data gagal dihapus');window.location='index.php?page=user'</script>";
        }
    }

    
?>