<!DOCTYPE html>
<html lang="en">
<head>
    <title><?= $title; ?>/</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style>
    body {
        transform: scale(0.8);
        /* Adjust the scale as needed */
        transform-origin: top left;
    }
    </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-md-6">
                <h2>Form A</h2>
                <h4>SENSUS HARIAN</h4>
                <h5>PEMANTAUAN INDIKATOR MUTU PELAYANAN</h5>
                <h6>Instalasi Rawat Jalan</h6>
                <h6>RSU SAWAH BESAR</h6>
            </div>
            <div class="col-xs-12 col-md-6" style="margin-left:600px;">
                <p><b>Bulan :</b><?= $monthSelectedName ?></p>
                <p><b>PIC data :</b><?=$direkturName?></p>
                <p><b>Tanggal dilaporkan :</b> <?= $todayDate ?></p>
            </div>
        </div>
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th style="width: 150px;">Besaran / Variabel</th>
                    <?php for ($i = 1; $i <= 31; $i++) : ?>
                    <th><?= $i ?></th>
                    <?php endfor; ?>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                  $iterator=1;
                  $dailyIterator=0;
                  foreach($list as $obj){
                    $total=0;
                ?>
                <tr>
                    <td><?= $iterator?></td>
                    <td><?=$obj['JUDUL']?></td>                    
                    <?php foreach ($d[$dailyIterator] as $value) { ?>
                    <td><?php 
                              $daily = $value == null || "" ? "0" : $value;
                              $total+=$daily;
                              echo $daily;
                          ?>
                    </td>
                    <?php } ?>
                    <td><?=$total?></td>
                </tr>
                <?php 
                  $iterator++;
                  $dailyIterator++;
                 } 
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>