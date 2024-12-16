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
        font-family: Arial, sans-serif;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    th,
    td {
        border: 1px solid black;
        padding: 8px;
        text-align: left;
        vertical-align: top;
    }
    </style>
</head>

<body>
    <div class="container">
        <div class="row" style="display: flex; align-items: center;">
            <div class="col-xs-12 col-md-6">
                <h2>Analisa Indikator</h2>
                <h6>UNIT <?=strtoupper(preg_replace('/([a-z])([A-Z])/', '$1 $2', $unit));?></h6>
                <h6>RSUD SAWAH BESAR</h6>
            </div>
            <div class="col-xs-12 col-md-6" style="text-align: right;margin-top:60px">
                <p><b>PIC data :</b> <?=ucwords(strtolower(preg_replace('/([a-z])([A-Z])/', '$1 $2', $unit)))?></p>
            </div>
        </div>
        <table class="table table-striped table-bordered">
            <?php  foreach($list as $obj => $value){ ?>
            <tr>
                <th>INDIKATOR</th>
                <td><?=$value['JUDUL_INDIKATOR']?></td>
            </tr>
            <tr>
                <th>NUMERATOR</th>
                <td><?= nl2br(htmlspecialchars($value['NUMERATOR'])) ?></td>
            </tr>
            <tr>
                <th>DENUMERATOR</th>
                <td><?= nl2br(htmlspecialchars($value['DENUMERATOR'])) ?></td>
            </tr>
            <tr>
                <th>TARGET</th>
                <td><?=$value['TARGET_PENCAPAIAN']?></td>
            </tr>
            <tr>
                <th>TAHUN</th>
                <td><?=$value['tahun']?></td>
            </tr>
            <?php foreach ($charts as $index => $chartUrl): ?>
            <tr>
                <?php
                    if($index==$value['JUDUL_INDIKATOR']) {
                        echo "<th>GRAFIK</th>";
                ?> 
                <td>
                    <div>
                        <img src="<?= $chartUrl ?>" alt="Chart for <?= $index ?>" />
                    </div>
                </td>
                <?php
                    }else{
                        echo "<th></th>";
                        echo "<td></td>";
                    }
                ?> 
            </tr>
            <?php endforeach; ?>
            <tr>
                <th>ANALISA</th>
                <td><?= nl2br(htmlspecialchars($value['analisa'])) ?></td>
            </tr>
            <tr>
                <th>REKOMENDASI</th>
                <td><?= nl2br(htmlspecialchars($value['rekomendasi'])) ?></td>
            </tr>
            <?php } ?>
        </table>
    </div>
</body>
<script>
</script>

</html>