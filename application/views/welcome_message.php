<!DOCTYPE html>
<html lang="en">

<head>
    <title><?= $title; ?>/</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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

                <h6>RSU SAWAH BESAR</h6>
            </div>
            <div class="col-xs-12 col-md-6" style="margin-left:600px;">
            </div>
        </div>
        <table class="table table-striped table-bordered">
            <tr>
                <th>INDIKATOR</th>
                <td>test</td>
            </tr>
            <tr>
                <th>NUMERATOR</th>
                <td>test</td>
            </tr>
            <tr>
                <th>GRAFIK</th>
                <td>
                    <canvas id="myChart"></canvas>
                    <!-- Tag img untuk menampilkan grafik dalam bentuk gambar -->
                    <img id="chartImage" src="<?=$chart?>" alt="Chart Image" style="display: block; width: 100%; height: auto;">
                </td>
            </tr>
        </table>
    </div>
</body>
<script>
// Inisialisasi Chart.js
var ctx = document.getElementById('myChart').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
        datasets: [{
            label: '# of Votes',
            data: [12, 19, 3, 5, 2, 3],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});

// Konversi grafik menjadi gambar
var canvas = document.getElementById('myChart');
var chartImage = canvas.toDataURL('image/png'); // Converts the chart to a base64 image

// Add the image as an <img> tag in the HTML content
document.getElementById('chartImage').src = chartImage;
</script>

</html>