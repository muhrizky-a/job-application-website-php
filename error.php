</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Page Not Found</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/header-footer.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        .container {
            text-align: center;
        }

        h1 {
            font-size: 20vw;

        }
        h2 {
            font-size: 3vw;
        }

        footer {
            position: absolute;
            left: 0;
            bottom: 0;
        }
    </style>
</head>

<body>
    <?php
    // Load file yang berisi fungsi menampilkan navbar, dan tampilkan navbar
    include("web-component/header-footer.php");
    displayNavBar();
    ?>


    <div class="container">
        <h1>404</h1>
        <h2>Halaman Tidak Ditemukan</h2>
    </div>
    <?php
    displayFooter();
    ?>
</body>

</html>