<?php
    session_start();
    if(!isset($_SESSION['login'])){
        header("location: login.php");
        exit();
    }
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistem Informasi Akademik</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.css" />
  </head>
 
  <body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Siakad</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                </li>

                <li class="nav-item">
                <a class="nav-link" href="index.php?page=mahasiswa">Mahasiswa</a>
                </li>

                <?php if($_SESSION['level'] != 'user' ) : ?>
                <li class="nav-item">
                <a class="nav-link" href="index.php?page=user">User</a>
                </li>
                <?php endif ?>

                <li class="nav-item">
                <a class="nav-link" href="index.php?page=prodi">Prodi</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="index.php?page=dosen">Dosen</a>
                </li>

                <?php if($_SESSION['level'] != 'user') : ?>
                    <?php if($_SESSION['level'] != 'stuff') : ?>
                        <li class="nav-item">
                        <a class="nav-link" href="index.php?page=mata_kuliah">Mata kuliah</a>
                        </li>
                    <?php endif ?>
                <?php endif ?>

                <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <?=$_SESSION['nama']?>
                </a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                </ul>
                </li>
            </ul>
            <form class="d-flex" role="search">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
            </div>
        </div>
    </nav>
    <div class="container my-4">
        <?php
            $page = isset($_GET['page'])  ? $_GET['page'] : 'home';
            if($page == "home") include 'home.php';
            if($page == "mahasiswa") include 'mahasiswa.php';
            if($page == "prodi") include 'prodi.php';
            if($page == "user") include 'user.php';
            if($page == "dosen") include 'dosen.php';
            if($page == "mata_kuliah") include 'mata_kuliah.php';
        ?>
    </div>
    <div class="text-center bg-dark text-light py-2">
        Sistem Informasi Akademik &copy; TRPL 2D Teknologi Informasi 2024
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
    <script>
        new DataTable('#prodi');
        new DataTable('#mahasiswa');
        new DataTable('#mata_kuliah');
    </script>
  </body>
</html>