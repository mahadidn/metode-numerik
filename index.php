<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Metode Perhitungan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>

    <?php  require './include/navbar.php';  ?>

    <div class="container bg-success p-5">
        <h1 class="p-4 bg-white text-center">Kelompok Metode Numerik</h1>
        <div class="container bg-white p-3">
            Nama Kelompok
            <ol>
                <li>M.Syafiq Haiqal (2101020033)</li>
                <li>Azel Fahrezi (2101020034)</li>
                <li>Abdul Katsir (2101020044)</li>
                <li>Mahadi Dwi Nugraha (2101020065)</li>
                <li>Daniel Edwardo Manurung (2101020089)</li>
                <li>Zacky Santoso (2101020123)</li>
            </ol>
        </div>
    </div>
    <div class="container mt-4">
        <h3>Aplikasi Perhitungan Integrasi Numerik</h3>
        <ol>
            <li class="mb-3" ><a href="./romberg.php" style="text-decoration: none; color: black;">Integrasi Romberg</a></li>
            <li class="mb-3" ><a href="./legendre2titik.php" style="text-decoration: none; color: black;">Gauss-Legendre 2 titik</a></li>
            <li class="mb-3" ><a href="./legendre3titik.php" style="text-decoration: none; color: black;">Gauss-Legendre 3 titik</a></li>
        </ol>
    </div>

    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>