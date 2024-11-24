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
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 20px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }

    th,
    td {
        border: 1px solid #000;
        padding: 8px;
        text-align: left;
        vertical-align: top;
    }

    .section-title {
        font-weight: bold;
        text-align: center;
        font-size: 1.2em;
        padding: 15px;
        background-color: #f9f9f9;
        border: 1px solid #000;
    }
    </style>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-md-6">
                <h2>Lembar Kerja Perbaikan Mutu dengan Metode PDSA</h2>
                <h6><?=strtoupper(preg_replace('/([a-z])([A-Z])/', '$1 $2', $unit));?></h6>
                <h6>RSU SAWAH BESAR</h6>
            </div>
        </div>
        <table>
            <tr>
                <th>Judul Proyek Perbaikan:</th>
                <td><?=$list->JUDUL_PROYEK?></td>
            </tr>
            <tr>
                <th>Ketua Tim:</th>
                <td><?=$list->KETUA_TIM?></td>
            </tr>
            <tr>
                <th>Anggota Tim:</th>
                <th>Jabatan : </th>
            </tr>
            <tr>
                <td><?=$list->ANGGOTA_1?></td>
                <td><?=$list->JABATAN_1?></td>
            </tr>
            <tr>
                <td><?=$list->ANGGOTA_2?></td>
                <td><?=$list->JABATAN_2?></td>
            </tr>
            <tr>
                <td><?=$list->ANGGOTA_3?></td>
                <td><?=$list->JABATAN_3?></td>
            </tr>
            <tr>
                <th>Benefit / Keuntungan Perbaikan untuk:</th>
                <td><?=$list->BENEFIT?></td>
            </tr>
            <tr>
                <th>Masalah / Peluang:</th>
                <td><?=$list->MASALAH?></td>
            </tr>
        </table>

        <table>
            <tr>
                <th>Langkah 1. Tujuan (Apa yang ingin dicapai):</th>
            </tr>
            <tr>
                <td><?=$list->TUJUAN?></td>
            </tr>
            <tr>
                <th>Langkah 2. Bagaimana kita mengukur jika perbaikan menghasilkan perubahan? (Pilih salah satu)</th>
            </tr>
            <tr>
                <td><?=$list->UKURAN?></td>
            </tr>
            <tr>
                <th>Langkah 3 . Perbaikan apa yang akan dilakukan untuk menghasilkan perbaikan?:</th>
            </tr>
            <tr>
                <td><?=$list->PERBAIKAN?></td>
            </tr>
        </table>
        <table>
            <tr>
                <td>Periode Waktu Proyek Perbaikan: <?=$list->PERIODE_WAKTU?></td>
                <td>Anggaran: <?=$list->ANGGARAN?></td>
            </tr>
            <tr>
                <td>Tanggal Mulai Proyek: <?=$list->TANGGAL_MULAI?></td>
                <td>Tanggal Selesai Proyek: <?=$list->TANGGAL_SELESAI?></td>
            </tr>
        </table>
        <?php 
            $i=1;
            if (isset($list->SIKLUS) && is_array($list->SIKLUS)): ?>
        <?php foreach ($list->SIKLUS as $siklus): ?>
        <div class="section-title">Siklus: <?=$i?></div>

        <table>
            <tr>
                <th>PLAN <br />Saya berencana:</th>
            </tr>
            <tr>
                <td><?=$siklus->RENCANA?></td>
            </tr>
            <tr>
                <th>Tanggal Mulai Siklus:</th>
            </tr>
            <tr>
                <td><?=$siklus->TANGGAL_MULAI?></td>
            </tr>
            <tr>
                <th>Tanggal Selesai Siklus:</th>
            </tr>
            <tr>
                <td><?=$siklus->TANGGAL_SELESAI?></td>
            </tr>
            <tr>
                <th>Saya berharap :</th>
            </tr>
            <tr>
                <td><?=$siklus->BERHARAP?></td>
            </tr>
            <tr>
                <th>Tindakan:</th>
            </tr>
            <tr>
                <td><?=$siklus->TINDAKAN?></td>
            </tr>
            <tr>
                <th>DO:</th>
            </tr>
            <tr>
                <td>...</td>
            </tr>
            <tr>
                <th>Apa yang diamati?</th>
            </tr>
            <tr>
                <td><?=$siklus->DIAMATI?></td>
            </tr>
            <tr>
                <th>STUDY:</th>
            </tr>
            <tr>
                <td><?=$siklus->PELAJARI?></td>
            </tr>
            <tr>
                <th>Apa yang dipelajari ? Apakah sesuai dengan tujuan?</th>
            </tr>
            <tr>
                <td>...</td>
            </tr>
            <tr>
                <th>ACT</th>
            </tr>
            <tr>
                <td><?=$siklus->TINDAKAN_SELANJUTNYA?></td>
            </tr>
            <tr>
                <th>Dokumentasi</th>
            </tr>
            <tr>
                <?php
                        $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';

                        // Mendapatkan host (domain atau IP)
                        $host = $_SERVER['HTTP_HOST'];

                        // Mendapatkan port (jika ada)
                        $port = $_SERVER['SERVER_PORT'];
                        $portPart = ($port && $port != 80 && $port != 443) ? ":$port" : "";

                        // Menggabungkan menjadi URL
                        $baseUrl = $protocol . '://' . $host . $portPart.'/synergy-server';
                ?>
                <td><img src="<?= $baseUrl.$siklus->FILE_PATH ?>" alt="Uploaded Image <?= $baseUrl.$siklus->FILE_PATH ?>" width="300" height="300" /></td>
            </tr>
        </table>

        <?php $i++;
              endforeach; ?>
        <?php endif; ?>
    </div>
</body>

</html>