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
                <h2>Analisa Indikator</h2>
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
                    <th>INDIKATOR</th>
                    <td>Judul singkat yang spesifik mengenai indikator apa yang akan diukur.</td>
                </tr>
                <tr>
                    <th>NUMERATOR</th>
                    <td>Jumlah hasil kritis laboratorium yang dilaporkan &lt; 30 menit</td>
                </tr>
                <tr>
                    <th>DENOMINATOR</th>
                    <td>Jumlah hasil kritis laboratorium yang survey</td>
                </tr>
                <tr>
                    <th>TARGET</th>
                    <td>100%</td>
                </tr>
                <tr>
                    <th>GRAFIK</th>
                    <td>
                        <div class="graph">
                           
                        </div>
                    </td>
                </tr>
                <tr>
                    <th>ANALISA</th>
                    <td>Pertanyaan dan Jawaban: Apa alasan / penyebab di balik trend pada grafik di atas?</td>
                </tr>
                <tr>
                    <th>REKOMENDASI</th>
                    <td>Pertanyaan dan Jawaban: Apa perbaikan yang dapat dilakukan untuk memperbaiki trend di atas?</td>
                </tr>
            <?php } ?>
        </table>
    </div>
</body>

</html>