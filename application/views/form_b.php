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
                <h2>Form B</h2>
                <h4>LAPORAN BULANAN UNIT</h4>
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
                    <th style="width: 150px;">Nama Indikator</th>
                    <th>Numerator</th>
                    <th>Denumrator</th>
                    <th>Hasil</th>
                    <th>Target</th>
                    <th>Analisa</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                  $iterator=1;
                  $monthlyIterator=0;
                  foreach($list as $obj => $value){
                    $total=0;
                    if($value->STATUS_ACC =='1'){
                ?>
                <tr>
                    <td><?= $iterator?></td>
                    <td><?=$value->JUDUL_INDIKATOR?></td>
                    <td><?=$m[$monthlyIterator]['numerator']?></td>
                    <td><?=$m[$monthlyIterator]['denumerator']?></td>
                    <td><?=$m[$monthlyIterator]['hasil_text']?></td>
                    <td><?=$value->TARGET_PENCAPAIAN?></td>
                    <td><?= isset($m[$monthlyIterator]['analisa']) ? $m[$monthlyIterator]['analisa'] : '' ?></td>
                    
                </tr>
                <?php 
                    $iterator++;
                    $monthlyIterator++;
                    }
                } 
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>