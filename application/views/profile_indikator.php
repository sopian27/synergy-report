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
        <div class="row">
            <div class="col-xs-12 col-md-6">
                <h2>Profile Indikator</h2>
                <h6><?=strtoupper(preg_replace('/([a-z])([A-Z])/', '$1 $2', $unit));?></h6>
                <h6>RSU SAWAH BESAR</h6>
            </div>
            <div class="col-xs-12 col-md-6" style="margin-left:600px;">
                <p><b>PIC data :</b><?=$direkturName?></p>
            </div>
        </div>
        <table class="table table-striped table-bordered">
            <?php  foreach($list as $obj => $value){ ?>
            <tr>
                <th>Nomor Urut</th>
                <td><?= $value->ORDERS ?></td>
            </tr>
            <tr>
                <th>Judul Indikator</th>
                <td><?=$value->JUDUL_INDIKATOR?></td>
            </tr>
            <tr>
                <th>Dasar Pemikiran</th>
                <td>
                    <?=$value->DASAR_PEMIKIRAN?>
                </td>
            </tr>
            <tr>
                <th>Dimensi Mutu</th>
                <td>
                    <?php 
                        if ($value->IS_EFEKTIF == '1') echo "1. Efektif<br>";
                        if ($value->IS_AMAN == '1') echo "2. Keselamatan<br>";
                        if ($value->IS_BERPASIEN == '1') echo "3. Berorientasi pada pasien / pengguna layanan<br>";
                        if ($value->IS_TEPAT_WAKTU == '1') echo "4. Tepat waktu<br>";
                        if ($value->IS_EFISIEN == '1') echo "5. Efisien<br>";
                        if ($value->IS_ADIL == '1') echo "6. Adil<br>";
                        if ($value->IS_INTEGRASI == '1') echo "7. Terintegrasi<br>";
                    ?>
                </td>
            </tr>
            <tr>
                <th>Tujuan</th>
                <td> <?=$value->TUJUAN?></td>
            </tr>
            <tr>
                <th>Definisi Operasional</th>
                <td><?=$value->DEFINISI_PEMIKIRAN?></td>
            </tr>
            <tr>
                <th>Jenis Indikator</th>
                <td><?=$value->TIPE_INDIKATOR?></td>
            </tr>
            <tr>
                <th>Satuan Pengukuran</th>
                <td><?=$value->UKURAN_INDIKATOR?></td>
            </tr>
            <tr>
                <th>Numerator (pembilang)</th>
                <td><?=$value->NUMERATOR?></td>
            </tr>
            <tr>
                <th>Denominator (penyebut)</th>
                <td><?=$value->DENUMERATOR?></td>
            </tr>
            <tr>
                <th>Target Pencapaian</th>
                <td><?=$value->TARGET_PENCAPAIAN?></td>
            </tr>
            <tr>
                <th>Formula</th>
                <td><?=$value->FORMULA?></td>
            </tr>
            <tr>
                <th>Metode Pengumpulan Data</th>
                <td><?=$value->METODE_PENGUMPULAN?></td>
            </tr>
            <tr>
                <th>Sumber Data</th>
                <td><?=$value->SUMBER_DATA?></td>
            </tr>
            <tr>
                <th>Instrumen Pengumpulan Data</th>
                <td>
                    <?php 
                    echo $value->INSTRUMEN_PENGAMBILAN; 
                    if ($value->INSTRUMEN_PENGAMBILAN=="Lainnya") {
                        echo " : " . $value->ISI_INSTRUMEN;
                    }
                    ?>
                </td>
            </tr>
            <tr>
                <th>Besar Sampel</th>
                <td><?=$value->BESAR_SAMPEL?></td>
            </tr>
            <tr>
                <th>Cara Pengambilan Sampel</th>
                <td><?=$value->POPULASI_SAMPEL?></td>
            </tr>
            <tr>
                <th>Periode Pengumpulan Data</th>
                <td><?=$value->PERIODE_PELAPORAN?></td>
            </tr>
            <tr>
                <th>Periode Penyajian Data</th>
                <td>Run Chart</td>
            </tr>
            <tr>
                <th>Pengguna Data</th>
                <td>Unit di Synergy</td>
            </tr>
            <tr>
                <th>Pola Analisis dan Pelaporan</th>
                <td>
                    Triwulan
                </td>
            </tr>
            <tr>
                <th>Penanggung Jawab</th>
                <td><?=$value->PENANGGUNG_JAWAB?></td>
            </tr>
            <tr>
                <th>Kode Indikator</th>
                <td>
                    <?php 
                   $kodeIndikator="";
                        if ($value->isINM == '1') $kodeIndikator.="INM<br> ";
                        if ($value->isIMPRs == '1') $kodeIndikator.="IMPrs<br> ";
                        if ($value->isIMPUnit == '1') $kodeIndikator.="IMPUnit<br> ";

                        echo $kodeIndikator;
                    ?>
                </td>
            </tr>
            <?php } ?>
        </table>
    </div>
</body>

</html>