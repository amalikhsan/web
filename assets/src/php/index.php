<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SocialQuotes</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap');

        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            font-family: 'Ubuntu', sans-serif !important;
        }


        .vhs-100 {
            min-height: 100vh !important;
        }

        footer {
            margin-top: auto;
        }

        /* 
        #map {
            height: 100vh;
        } */
    </style>
    <script>
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>
    <link rel="stylesheet" href="assets/public/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
    <link rel="apple-touch-icon" sizes="180x180" href="assets/public/icon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/public/icon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/public/icon/favicon-16x16.png">
    <link rel="manifest" href="assets/public/icon/site.webmanifest">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.8.0/dist/leaflet.css" integrity="sha512-hoalWLoI8r4UszCkZ5kL8vayOGVae1oxXe/2A4AO6J9+580uKHDO3JdHb7NzwwzK5xr/Fs0W40kiNHxM9vyTtQ==" crossorigin="" />
</head>

<body class="bg-light">
    <nav class="navbar navbar-expand-lg bg-white shadow-lg sticky-top">
        <div class="container-lg">
            <a class="navbar-brand fw-bold text-primary fs-3" href="#">S<span class="d-none d-lg-inline-block">ocial</span>Q<span class="d-none d-lg-inline-block">uotes</span></a>
            <?php
            if (isset($_SESSION["login"])) {
            ?>
                <form action="" method="get" class="d-flex mx-lg-auto">
                    <input type="text" name="key" class="form-control me-2 py-0" placeholder="Search account" autocomplete="off">
                    <button type="submit" class="btn btn-sm btn-primary d-flex" name="page" value="profile"><i class="bi bi-search"></i><span class="ms-2 d-none d-lg-inline-block">Search</span></button>
                </form>
                <a class=" btn btn-sm btn-primary me-lg-2" href="?page=home"><i class="bi bi-house"></i><span class="ms-2 d-none d-lg-inline-block">Home</span></a>
                <a class="btn btn-sm btn-primary me-lg-2" href="?key=<?= $_SESSION["login"] ?>&page=profile"><i class="bi bi-person"></i><span class="ms-2 d-none d-lg-inline-block">Profile</span></a>
                <a class="btn btn-sm btn-primary" href="?page=logout" onclick="return confirm('Apakah anda yakin ingin logout');if(confirm)return true;else return false;"><i class="bi bi-box-arrow-right"></i><span class="ms-2 d-none d-lg-inline-block">Logout</span></a>
            <?php
            } else {
            ?>
                <a class="btn btn-sm btn-primary ms-auto me-lg-2" href="?page=login">Login</a>
                <a class="btn btn-sm btn-primary" href="?page=register">Register</a>
            <?php
            }
            ?>
        </div>
    </nav>

    <main class="bg-primary vhs-100">
        <?php
        $page = @$_GET["page"];
        switch ($page) {
            case 'login':
                require_once 'assets/src/php/layouts/login.php';
                break;

            case 'home':
                require_once 'assets/src/php/layouts/home.php';
                break;

            case 'register':
                require_once 'assets/src/php/layouts/register.php';
                break;

            case 'logout':
                require_once 'assets/src/php/layouts/logout.php';
                break;

            case 'edit':
                require_once 'assets/src/php/layouts/edit.php';
                break;

            case 'profile':
                require_once 'assets/src/php/layouts/profile.php';
                break;

            case 'editprofile':
                require_once 'assets/src/php/layouts/editprofile.php';
                break;

            default:
                require_once 'assets/src/php/layouts/login.php';
                break;
        }
        ?>
    </main>
    <!-- <div id="map"></div> -->
    <footer class="text-center bg-light shadow-lg border-top py-3">
        <p class="mb-0 text-primary">Copyright &copy; <?= date("Y") ?> By <a href="#" class="fw-bold">SocialQuotes</a>.</p>
    </footer>
    <script src="assets/public/js/bootstrap.js"></script>
    <!-- <script src="https://unpkg.com/leaflet@1.8.0/dist/leaflet.js" integrity="sha512-BB3hKbKWOc9Ez/TAwyWxNXeoV9c1v6FIeYiBieIWkpLjauysF18NzgR1MBNBXf8/KABdlkX68nAhlwcDFLGPCQ==" crossorigin=""></script>
    <script>
        var map = L.map('map').setView([-2.963624, 464.718547], 13);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        L.marker([-2.963624, 464.718547]).addTo(map)
            .bindPopup('A pretty CSS3 popup.<br> Easily customizable.')
            .openPopup();
    </script> -->
</body>

</html>