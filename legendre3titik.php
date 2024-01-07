<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gauss Legendre 3 Point Calculation</title>
    <link rel="stylesheet" href="./style/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>

    <?php require_once 'include/navbar.php';  ?>

    <div class="container">
        
        <h1>Perhitungan Menggunakan Metode Gaus Legendre 3 Titik</h1>
    
        <form>
            <p>Masukkan nilai dibawah ini</p>
            <div class="conten">
                <img src="img/integral.png" style="width:90px ;" alt="">
    
                <div class="conten2">
                    <input type="text" id="upperBound" value="" placeholder="batas atas"><br>
                    <input type="text" id="userFunction" value="" placeholder="fungsi"><br>
                    <input type="text" id="lowerBound" value="" placeholder="batas bawah"><br>
                </div>
            </div>
        </form>
    
        <button onclick="gaussLegendre3Points()">Hitung</button>
        <p id="result"></p>
    </div>


   <script>
        function gaussLegendre3Points() {
            const lowerBound = parseFloat(document.getElementById('lowerBound').value);
            const upperBound = parseFloat(document.getElementById('upperBound').value);
            const x1 = -Math.sqrt(3 / 5);
            const x2 = 0;
            const x3 = Math.sqrt(3 / 5);
            const w1 = 5 / 9;
            const w2 = 8 / 9;
            const w3 = 5 / 9;
            const userFunction = document.getElementById('userFunction').value;
            const cleanedFunction = userFunction.replace(/\^/g,'**').replace(/(\d)x/g, "$1*x");
            const f = new Function('x', `return ${cleanedFunction};`);
            const result = (upperBound - lowerBound) / 2 * (w1 * f((upperBound - lowerBound) / 2 * x1 + (upperBound + lowerBound) / 2) + w2 * f((upperBound - lowerBound) / 2 * x2 + (upperBound + lowerBound) / 2) + w3 * f((upperBound - lowerBound) / 2 * x3 + (upperBound + lowerBound) / 2));
            document.getElementById('result').innerHTML = `Hasil perhitungan:${result}`;
        }
    </script> 

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>