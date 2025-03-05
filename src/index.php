<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Sistem Informasi Akademik</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    </head>
        <style>
        .custom-link:hover {
            color: white !important; /* Warna berubah jadi putih saat hover */
            text-decoration: none !important; /* Tetap tanpa garis bawah */
        }
    </style>
 
  <body>
    <nav class="navbar bg-dark navbar-expand-lg border-bottom border-body" data-bs-theme="dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Kelompok3</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                <a class="nav-link" aria-current="page" href="index.php">Home</a>
                </li>

                <li class="nav-item">
                <a class="nav-link" href="index.php?page=mahasiswa">Mahasiswa</a>
                </li>

                <li class="nav-item">
                <a class="nav-link" href="index.php?page=prodi">Prodi</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="index.php?page=dosen">Dosen</a>
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
            if($page == "dosen") include 'dosen.php';
        ?>
    </div>
    <footer class = "bg-dark">
    <div class="container">
        <div class="row align-items-center">
            <div class = "col-lg-3 py-5">
                <img src="TI.png" class="img-fluid rounded-2" width="80">
                <p class = "text-white py-2">Jurusan teknologi informasi</p>
            </div>
            <div class = "col-lg-3 py-5 text-white">
                <p>
                    <ul>
                        <li>
                            <a href=# class="custom-link text-secondary text-decoration-none">Lorem ipsum dolor sit</a>
                        </li>
                        <li>
                            <a href=# class="custom-link text-secondary text-decoration-none">Lorem ipsum dolor sit amet</a>
                        </li>
                        <li>
                            <a href=# class="custom-link text-secondary text-decoration-none">Lorem ipsum dolor sit</a>
                        </li>
                        <li>
                            <a href=# class="custom-link text-secondary text-decoration-none">Lorem ipsum dolor sit amet</a>
                        </li>
                    </ul>
                </p>
            </div>
            <div class = "col-lg-3 py-5">
            </div>
            <div class = "col-lg-3 py-5">
                <i class="bi bi-instagram text-white"></i>
                <i class="bi bi-facebook text-white"></i>
                <i class="bi bi-tiktok text-white"></i>
            </div>
        </div>
    </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
    <script>
        new DataTable('#prodi');
        new DataTable('#mahasiswa');
        new DataTable('#dosen');
    </script>
  </body>
</html>