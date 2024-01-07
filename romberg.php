<?php

/**
 * @Copyright Kelompok 1 Metode Numerik
 */

class MetodeRomberg {

    // h = jarak pias
    public array $h = [];
    
    // n = iterasi
    public ?float $n = null; 
    
    // x
    public array $x = [];
    
    // tentukan batas atas (b) dan batas bawah (a)
    public float $b;
    public float $a;
    
    // hitung fungsi
    public function cariNilai(){

        $b = $this->b;
        $a = $this->a;
        $n = $this->n;
        $h = $this->h;

        if ($n == null && $h[0] == null){
            die;
        }
        
        if ($n == null){
            $n = ($b - $a)/$h[0];
            return $n;
        }else if ($h[0] == null){
            $h[0] = ($b - $a)/$n;
            return $h[0];
        }
        
    }
    
}

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Metode Romberg</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="./style/style.css">
</head>
  <style>
    body {
        background-color: lightgray;
    }

    /* hp */
    @media only screen and (max-width: 767px){

        
        .container-right {
            width: 50%;
            float: left;
        }
        .container-left {
            width: 48%;
            float: right;
        }

    }


    /* tablet */
    @media only screen and (min-width: 768px) and (max-width: 1023px){

        .container-right {
            width: 50%;
            float: left;
            /* margin-bottom: 800%; */
        }
        .container-left {
            width: 48%;
            float: right;
            /* margin-top: 150%; */
        }

    }


    /* laptop */
    @media only screen and (min-width: 1024px){

        .container-right {
            width: 50%;
            float: left;
            /* margin-top: 20%; */
        }
        .container-left {
            width: 49%;
            float: right;
            /* margin-top: 150%; */
        }
    }


  </style>
  <body>

        <?php require_once 'include/navbar.php';  ?>
      
      <h1 class="text-center mt-4 mb-5">Perhitungan menggunakan romberg</h1>

<div class="container">

    <form method="post" action="romberg.php">

        <form>
            <h4 class="d-inline">Contoh Penulisan Fungsi (tidak menggunakan spasi) = </h4>
             <input type="text" class="mb-4 text-center p-2 rounded" value="(4x-x^3)exp(x^2)" disabled>
            <div class="conten">
                <img src="img/integral.png" style="width:90px ;" alt="">
                
                <div class="conten2">
                    <input type="text" name="batasAtas" id="upperBound" placeholder="batas atas" value="<?= $_POST['batasAtas'] ?? '' ?>"><br>
                    <input type="text" name="fungsi" id="userFunction" placeholder="fungsi" value="<?= $_POST['fungsi'] ?? '' ?>"><br>
                    <input type="text" name="batasBawah" id="upperBound" placeholder="batas bawah" value="<?= $_POST['batasBawah'] ?? '' ?>"><br>
                </div>
            </div>
            <div class="mb-3 container">
                <label for="iterasi">Masukkan Iterasi (n)</label>
                <input type="number" name="n" class="form-control" value="<?= $_POST['n'] ?? '' ?>">
            </div>
            <div class="mb-3 container">
                <label for="iterasi">Atau Jarak (h)</label>
                <input type="text" name="h" class="form-control" value="<?= $_POST['h'] ?? '' ?>">
            </div>
            <div class="d-flex justify-content-center">
                <button class="btn btn-outline-primary mb-4" type="submit">Cari</button>
            </div>
        </form>
    
    <?php

        if(!isset($_POST['batasAtas']) && !isset($_POST['batasBawah'])){
            die();
        }

        $romberg = new MetodeRomberg(); 
        
        // n
        $romberg->n = (float)$_POST['n'];
        
        // batas atas
        $romberg->b = (float)$_POST['batasAtas'];

        // batas bawah
        $romberg->a = (float)$_POST['batasBawah'];

        // h
        $romberg->h[0] = (float)$_POST['h'];

        $fungsi = $_POST['fungsi'];

        // menangkap ^ dan mengubahnya menjadi pow
        $mathExpression = preg_replace('/(\w+)\^(\d+)/', 'pow($1, $2)', $fungsi);

        // menangkap tidak ada perkalian, dan mengubahnya menjadi perkalian
        $mathExpression = preg_replace('/(\d+)([a-zA-Z])/', '$1 * $2', $mathExpression);
        $pattern = '/(\))(\w|\()/';
        $replacement = '$1 * $2';
        $mathExpression = preg_replace($pattern, $replacement, $mathExpression);

        $mathExpression2 = $mathExpression;

        // menangkap x mengubah menjadi $x[$i]
        $pattern = '/\b(x)\b/';
        $replacement = '$x[$i]';
        $mathExpression = preg_replace($pattern, $replacement, $mathExpression);
        
        $replacement2 = '$x[0]';
        $mathExpression2 = preg_replace($pattern, $replacement2, $mathExpression2);

        // x
        $x = [];
        
        // fungsi x
        $fx = [];
        ?>

    <?php
    

        // h (jika belum di set)
        if ($romberg->h[0] == null){
            $romberg->h[0] = $romberg->cariNilai();
        }else if ($romberg->n == null){
            $romberg->n = $romberg->cariNilai();
        }

        
        $x[0] = $romberg->a;
        $x[1] = $romberg->b / $romberg->n;
        $k = [];
        // $k[0] = (4*$x[0] - pow($x[0], 3)) * exp($x[0] * $x[0]);
        $k[0] = eval("return $mathExpression2;");
        ?>

        
    <div class="container bg-white p-3 rounded text-center mb-3">
        <h4>Hasil Untuk <?= $fungsi ?></h4>
    </div>
    <p><b>Batas atas = <?= $_POST['batasAtas'] ?></b></p>
    <p><b>Batas bawah = <?= $_POST['batasBawah'] ?></b></p>
    <p><b>n (iterasi) = <?= $romberg->n ?></b></p>
    <p><b>h (jarak) = <?= $romberg->h[0] ?></b></p>

    <div class="container-right table-responsive">
        

        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <h2>Tabel fungsi</h2>
                <th scope="col">r</th>
                <th scope="col">xr</th>
                <th scope="col">f(xr)</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row"><?= 0 ?></th>
                    <td><?= $x[0] ?></td> 
                    <td><?= $k[0] ?></td>
                </tr> 
                <?php for ($i = 1; $i <= $romberg->n; $i++){ 
                    
                    $x[$i] = $x[$i - 1] + $romberg->h[0];  
                    
                    // fungsi
                    // $f = (4*$x[$i] - pow($x[$i], 3)) * exp($x[$i] * $x[$i]);
                    $f = eval("return $mathExpression;");
                    
                    $fx[$i - 1] = $f;
                ?>
                <tr>
                    <th scope="row"><?= $i ?></th>
                    <td><?= $x[$i] ?></td> 
                    <td><?= $fx[$i-1] ?></td>
                </tr>   
                <?php } ?>
            </tbody>
      
        </table>
    </div>
    <!-- bikin metode romberg -->
    <?php 

        $h = [];
        $b = $romberg->b;
        $a = $romberg->a;
        $n = $romberg->n;
        $A = [];     
        $r = [];
        $r[$n] = $n;
        $fr = [];
        array_unshift($fx, 0);
        $m = [];
        $k;
        
        // inisialisasi fungsi pertama
        // $m[0] = (4*$x[0] - pow($x[0], 3)) * exp($x[0] * $x[0]);
        $m[0] = eval("return $mathExpression2;");

        // cari nilai k (untuk iterasi rombergnya)
        for($i = 0; $i <= $n; $i++){
            if($result = pow(2, $i) > $n){
                $k = $i;
                break;
            }
        }
        
        // hitung nilai h(i) = b - a / n^i, i = 1, 2, 3,...
        for ($i = 1; $i <= $k; $i++){
            $h[0] = ($b - $a) / 2;
            $h[$i] = ($b - $a) / pow(2, $i);
            // echo $h[$i] . "||";
        }

        // cari nilai iterasi fungsinya, (fr)
        $o = 0;
        $r = [];
        $r[0] = $n;
        
        // bikin dulu iterasi fungsi yg digunakan
        $hasil;
        $j = 2;
        $fx[-1] = 0;
        $b = [];
        $b[0] = $m[0];
        $c = 0;
        // iterasi semuanya
        for ($l = 1; $l < $k; $l++){
            
            // iterasi buat dapatin r fungsinya
            for ($i = 1; $i <= $n; $i++){
                $r[$i] = $r[$i - 1] - $r[0]/$j;


                
                $b[$r[$i - 1]] = $fx[$r[$i - 1]];

                if ($r[$i] < 0){    
                    break;
                } 
            }

            // iterasi untuk menjumlahkan nilai fungsinya
            for ($i = 0; $i < $n; $i++){
    
                if (!isset($b[$i])){
                    continue;
                }else {
                    $c = $c + (2 * $b[$i]);
                }
            }
            
            // hitung A0 - An
            // echo $h[0] . " * (" . $m[0] . " + " . $b[$n] . ") ||";
            // echo $h[$l + 1] . " * (" . $m[0] . " + " . $c . " + " . $b[$n] . "<br>";
            $A[0] = $h[0] * ($m[0] + $b[$n]);
            $A[$l] = $h[$l + 1] * ($m[0] + $c + $b[$n]);
            $j = $j * 2;    
            $c = 0;
        }
        
    
    ?>
    <div class="container-left table-responsive">
        <table class="table table-striped table-hover">
            <h2>Tabel Romberg</h2>
            <thead>
                <tr>
                <th scope="col">r</th>
            <?php for($i = 1; $i <= $k * 2; $i++){ ?>
                <?php if($i % 2 == 0){ ?>
                <th scope="col">O(h^<?= $i ?>)</th>
                <?php } ?>
            <?php }?>
                
                </tr>
            </thead>
            <tbody>
                
            <?php for($i = 0; $i < $k; $i++){ 
                
                // $B = [];

                if(!isset($B[-1])){  
                    $A[-1] = 0;
                    $B[-1] = 0; 
                    $C[-1] = 0; 
                    $D[-1] = 0; 
                    $E[-1] = 0; 
                    $F[-1] = 0; 
                    $G[-1] = 0; 
                    $H[-1] = 0; 
                    $I[-1] = 0; 
                    $J[-1] = 0;
                    $K[-1] = 0;
                    $L[-1] = 0;
                }

                $B[$i] = $A[$i] + (($A[$i] - $A[$i - 1])/(pow(2, 2) - 1));
                $C[$i] = $B[$i] + (($B[$i] - $B[$i - 1])/(pow(2, 4) - 1));
                $D[$i] = $C[$i] + (($C[$i] - $C[$i - 1])/(pow(2, 6) - 1));
                $E[$i] = $D[$i] + (($D[$i] - $D[$i - 1])/(pow(2, 8) - 1));
                $F[$i] = $E[$i] + (($E[$i] - $E[$i - 1])/(pow(2, 10) - 1));
                $G[$i] = $F[$i] + (($F[$i] - $F[$i - 1])/(pow(2, 12) - 1));
                $H[$i] = $G[$i] + (($G[$i] - $G[$i - 1])/(pow(2, 14) - 1));
                $I[$i] = $H[$i] + (($H[$i] - $H[$i - 1])/(pow(2, 16) - 1));
                $J[$i] = $I[$i] + (($I[$i] - $I[$i - 1])/(pow(2, 18) - 1));
                $K[$i] = $J[$i] + (($J[$i] - $J[$i - 1])/(pow(2, 20) - 1));
                $L[$i] = $K[$i] + (($K[$i] - $K[$i - 1])/(pow(2, 22) - 1));
            
            ?>
                <tr>
                    <td scope="row"><?= $i ?></td>
                    
                    <?php for($j = 0; $j < $k; $j++){?>

                        <?php if($j == 0){ ?>
                            <td scope="row"><?= $A[$i] ?></td>
                            <?php $hasil = $A[$i]; ?>
                        <?php } ?>
                        <?php if($j == 1){ $B[0] = 0;?>
                            <td scope="row"><?= $B[$i] ?></td>
                            <?php $hasil = $B[$i]; ?>
                        <?php } ?>
                        <?php if($j == 2){ $C[0] = 0; $C[1] = 0;?>
                            <td scope="row"><?= $C[$i] ?></td>
                            <?php $hasil = $C[$i]; ?>
                        <?php } ?>
                        <?php if($j == 3){ $D[0] = 0; $D[1] = 0; $D[2] = 0 ?>
                            <td scope="row"><?= $D[$i] ?></td>
                            <?php $hasil = $D[$i]; ?>
                        <?php } ?>
                        <?php if($j == 4){ $E[0] = 0; $E[1] = 0; $E[2] = 0; $E[3] = 0; ?>
                            <td scope="row"><?= $E[$i] ?></td>
                            <?php $hasil = $E[$i]; ?>
                        <?php } ?>
                        <?php if($j == 5){ $F[0] = 0; $F[1] = 0; $F[2] = 0; $F[3] = 0; $F[4] = 0;?>
                            <td scope="row"><?= $F[$i] ?></td>
                            <?php $hasil = $F[$i]; ?>
                        <?php } ?>
                        <?php if($j == 6){ $G[0] = 0; $G[1] = 0; $G[2] = 0; $G[3] = 0; $G[4] = 0; $G[5] = 0?>
                            <td scope="row"><?= $G[$i] ?></td>
                            <?php $hasil = $G[$i]; ?>
                        <?php } ?>
                        <?php if($j == 7){ $H[0] = 0; $H[1] = 0; $H[2] = 0; $H[3] = 0; $H[4] = 0; $H[5] = 0; $H[6] = 0?>
                            <td scope="row"><?= $H[$i] ?></td>
                            <?php $hasil = $H[$i]; ?>
                        <?php } ?>
                        <?php if($j == 8){ $I[0] = 0; $I[1] = 0; $I[2] = 0; $I[3] = 0; $I[4] = 0; $I[5] = 0; $I[6] = 0; $I[7] = 0?>
                            <td scope="row"><?= $I[$i] ?></td>
                            <?php $hasil = $I[$i]; ?>
                        <?php } ?>
                        <?php if($j == 9){ $J[0] = 0; $J[1] = 0; $J[2] = 0; $J[3] = 0; $J[4] = 0; $J[5] = 0; $J[6] = 0; $J[7] = 0; $J[8] = 0?>
                            <td scope="row"><?= $J[$i] ?></td>
                            <?php $hasil = $J[$i]; ?>
                        <?php } ?>
                        <?php if($j == 10){ $K[0] = 0; $K[1] = 0; $K[2] = 0; $K[3] = 0; $K[4] = 0; $K[5] = 0; $K[6] = 0; $K[7] = 0; $K[8] = 0; $K[9] = 0?>
                            <td scope="row"><?= $K[$i] ?></td>
                            <?php $hasil = $K[$i]; ?>
                        <?php } ?>
                        <?php if($j == 11){ $L[0] = 0; $L[1] = 0; $L[2] = 0; $L[3] = 0; $L[4] = 0; $L[5] = 0; $L[6] = 0; $L[7] = 0; $L[8] = 0; $L[9] = 0; $L[10] = 0?>
                            <td scope="row"><?= $L[$i] ?></td>
                            <?php $hasil = $L[$i]; ?>
                        <?php } ?>
                    
                    <?php } ?>    
                    </tr> 
            <?php } ?>
            </tbody>
        </table>
        <h2>Hasil Akhir = <?= $hasil ?></h2>
            
    </div>
</div>

<div class="container-fluid footer bg-black d-flex text-light p-5 justify-content-center">
        <h2 class="footer-font">&copy;2023 Kelompok Metode Numerik</h2>
</div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    

</body>
</html>