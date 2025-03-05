<?php
include 'koneksi.php';

// Menghitung jumlah data
$dosen = mysqli_fetch_array(mysqli_query($db, "SELECT COUNT(*) as total FROM dosen"))['total'];
$mahasiswa = mysqli_fetch_array(mysqli_query($db, "SELECT COUNT(*) as total FROM mahasiswa"))['total'];
$prodi = mysqli_fetch_array(mysqli_query($db, "SELECT COUNT(*) as total FROM prodi"))['total'];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistem Informasi Akademik</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.css" />
</head>

<body>
    <div class="container">
        <div class="row gx-3 gy-2 align-items-center py-5">
            <div class = "col-lg-4 px-5">
                <div class="bg-secondary p-4 d-flex align-items-center justify-content-between rounded-2">
                    <img src="mahasiswa.png" class="img-fluid rounded-2" width="80">
                    <p class="text-white m-0 fs-4">mahasiswa <br><?php echo $mahasiswa; ?> Data</p>
                </div>
            </div>
            <div class = "col-lg-4 px-5">
                <div class="bg-secondary p-4 d-flex align-items-center justify-content-between rounded-2">
                    <img src="prodi.png" alt="Dosen" class="img-fluid rounded-2" width="80">
                    <p class="text-white m-0 fs-4">prodi <br><?php echo $prodi; ?> Data</p>
                </div>
            </div>
            <div class = "col-lg-4 px-5">
                <div class="bg-secondary p-4 d-flex align-items-center justify-content-between rounded-2">
                    <img src="dosen.png" alt="Dosen" class="img-fluid rounded-2" width="80">
                    <p class="text-white m-0 fs-4">dosen <br><?php echo $dosen; ?> Data</p>
                </div>
            </div>
        </div>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Explicabo voluptatibus quibusdam voluptates aspernatur fugit perferendis nisi sit. Sapiente at minus eum totam, perspiciatis, reprehenderit odit sunt aliquid ducimus nobis atque ipsum quod necessitatibus culpa? Amet tempora rem aliquid. Nisi praesentium dolorum, atque dignissimos ducimus vel vero sequi perferendis odit maiores cupiditate esse, voluptas animi magnam quos molestiae saepe odio! Doloribus dolore id quae vitae eligendi, optio laboriosam dicta repellendus sed, possimus exercitationem! Esse perferendis minima rerum magni tenetur molestias optio odit, ducimus temporibus inventore reiciendis ad modi. Totam iste commodi illo eligendi dolorem, quod repellat exercitationem sit excepturi aperiam. Quis.</p>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempore at soluta aspernatur eos totam dolorum recusandae dolore nemo unde rerum. Error eaque fuga, corporis perspiciatis natus eveniet provident. Quod, rerum quasi. Repudiandae doloribus saepe assumenda itaque voluptatibus temporibus facere dolore architecto quod adipisci animi dolor neque, aut, vero, cumque possimus?</p>
    </div>
</body>
</html>
