<?php
require 'koneksi.php';
if(isset($_GET['proses']) == 'simpan') {
    if (isset($_POST['submit'])) {
        $kode_mk = $_POST['kode_mk'];
        $nama_mk = $_POST['nama_mk'];
        $sks = $_POST['sks'];
        $dosen_nip = $_POST['dosen_nip'];
        $semester = $_POST['semester'];

        //Cek kode mata kuliah sudah ada atau belum
        $cek_kode_mk = mysqli_query($db,"SELECT kode_mk FROM mata_kuliah WHERE kode_mk ='$kode_mk' ");
        if (mysqli_num_rows($cek_kode_mk) > 0) {
            echo "<script>alert('Data gagal disimpan!!! kode mata kuliah sudah terdaftar');window.location='index.php?page=mata_kuliah&aksi=create'</script>";
            exit();
        }

        //validasinya 
        if (strlen($kode_mk) > 11) {
            echo "Error: Input tidak boleh lebih dari 18 karakter.";
        }
        if (strlen($nama_mk) > 25) {
            echo "Error: Input tidak boleh lebih dari 18 karakter.";
        }
        if (strlen($sks) > 11) {
            echo "Error: Input tidak boleh lebih dari 18 karakter.";
        }
        if (strlen($dosen_nip) > 18) {
            echo "Error: Input tidak boleh lebih dari 18 karakter.";
        }
        if (strlen($semester) > 11) {
            echo "Error: Input tidak boleh lebih dari 18 karakter.";
        }


        $query = mysqli_query($db, "INSERT INTO mata_kuliah (kode_mk, nama_mk, sks, dosen_nip, semester) VALUES ('$kode_mk', '$nama_mk', '$sks', '$dosen_nip', '$semester')"); 
        
        if ($query){
            echo "<script>alert('Data berhasil disimpan');window.location='index.php?page=mata_kuliah'</script>";
        } else{
            echo "<script>alert('Data gagal disimpan!!!');window.location='index.php?page=mata_kuliah&aksi=create'</script>";
        }
    }
}
if(isset($_GET['proses']) == 'edit') {
    if (isset($_POST['edit'])) {
        $kode_mk = $_POST['kode_mk'];
        $nama_mk = $_POST['nama_mk'];
        $sks = $_POST['sks'];
        $dosen_nip = $_POST['dosen_nip'];
        $semester = $_POST['semester'];

        //validasinya 
        if (strlen($kode_mk) > 11) {
            echo "Error: Input tidak boleh lebih dari 18 karakter.";
        }
        if (strlen($nama_mk) > 25) {
            echo "Error: Input tidak boleh lebih dari 18 karakter.";
        }
        if (strlen($sks) > 11) {
            echo "Error: Input tidak boleh lebih dari 18 karakter.";
        }
        if (strlen($dosen_nip) > 18) {
            echo "Error: Input tidak boleh lebih dari 18 karakter.";
        }
        if (strlen($semester) > 11) {
            echo "Error: Input tidak boleh lebih dari 18 karakter.";
        }

        $query = mysqli_query($db, "UPDATE mata_kuliah SET kode_mk = '$kode_mk', nama_mk = '$nama_mk', sks = '$sks', dosen_nip ='$dosen_nip', semester = '$semester' where kode_mk= '$kode_mk'");
        
        

        if ($query){
            echo "<script>alert('Data berhasil diedit');window.location='index.php?page=mata_kuliah'</script>";
        } else{
            echo "<script>alert('Data gagal diedit!!!');window.location='index.php?page=mata_kuliah&aksi=create'</script>";
        }
    }
}
if(isset($_GET['proses']) == 'hapus') {
    $kode_mk = $_GET['kode_mk'];
    $query = mysqli_query($db, "DELETE FROM mata_kuliah WHERE kode_mk=$kode_mk");
    if ($query){
        echo "<script>alert('Data berhasil dihapus');window.location='index.php?page=mata_kuliah'</script>";
    } else{
        echo "<script>alert('Data gagal dihapus');window.location='index.php?page=mata_kuliah'</script>";
    }
}

?>