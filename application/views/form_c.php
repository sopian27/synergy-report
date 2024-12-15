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
                <h2>Form C</h2>
                <h4>REKAPITULASI PENCAPAIAN INDIKATOR MUTU RSUD SAWAH BESAR</h4>
                <h6>UNIT <?=strtoupper(preg_replace('/([a-z])([A-Z])/', '$1 $2', $unit));?></h6>
                <h6>RSUD SAWAH BESAR</h6>
            </div>
        </div>
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th style="width: 150px;">Nama Indikator</th>
                    <th>Kode Indikator</th>
                    <th>Standard</th>
                    <th colspan="12" style="text-align: center; vertical-align: middle;">Pencapaian Per Bulan</th>
                    <th>Keterangan</th>
                </tr>
                <tr>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th>Januari</th>
                    <th>Februari</th>
                    <th>Maret</th>
                    <th>April</th>
                    <th>Mei</th>
                    <th>Juni</th>
                    <th>Juli</th>
                    <th>Agustus</th>
                    <th>September</th>
                    <th>Oktober</th>
                    <th>November</th>
                    <th>Desember</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    $iterator=0;
                    $j=1;
                    foreach ($list as $obj => $value) {
                        if ($value->STATUS_ACC == '1') {
                ?>
                <tr>
                    <td><?= $j ?></td>
                    <td><?= $value->JUDUL_INDIKATOR ?></td>
                <tr>
                    <th>Kode Indikator</th>
                    <td>
                        <?php 
                   $kodeIndikator="";
                        if ($value->isINM == '1') $kodeIndikator.="INM, ";
                        if ($value->isIMPRs == '1') $kodeIndikator.="IMPrs, ";
                        if ($value->isIMPUnit == '1') $kodeIndikator.="IMPUnit ";

                        echo $kodeIndikator;
                    ?>
                    </td>
                </tr>
                <td><?= $value->TARGET_PENCAPAIAN ?></td>
                <?php 
                                for ($yIterator = 0; $yIterator < count($y); $yIterator++) { ?>
                <td>
                    <?php 
                                if (!empty($y[$yIterator]['m']) && isset($y[$yIterator]['m'][$iterator]['hasil_text'])) {
                                    echo $y[$yIterator]['m'][$iterator]['hasil_text']; // Output only one value per cell
                                }
                                ?>
                </td>
                <?php 
                        } 
                    ?>
                <td><?= '0' ?></td>
                </tr>
                <?php 
                        $iterator++;
                        $j++;
                        }
                    } 
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>