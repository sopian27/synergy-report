<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AnalisaIndikatorController extends CI_Controller {

    public function __construct() 
    {
        parent::__construct();
        $this->load->model('sikat_analisa_indikator_model');
        $this->load->library('pdfgenerator');
    }


    public function pdf($unit,$id) {

        $json = file_get_contents('php://input');
        $data = json_decode($json, true);
        $data['title'] = "Analisa Indikator ".$unit;
        $data['list']=$this->getHeaderData_get($unit,$id);
        $data['unit']=$unit;
        $data['charts']=$this->buildChart($data);
        $html = $this->load->view('analisa_indikator', $data, true);
        $file_pdf = $data['title'];
        $this->pdfgenerator->generate($html, $file_pdf,true,"potrait");
    }

    
    public function pdfUnit($unit,$tahun) {

        $json = file_get_contents('php://input');
        $data = json_decode($json, true);
        $data['title'] = "Analisa Indikator ".$unit;
        $data['list']=$this->getHeaderData_get($unit,null,$tahun);
        $data['unit']=$unit;
        $data['charts']=$this->buildChartDownload($data);
        $html = $this->load->view('analisa_indikator', $data, true);
        $file_pdf = $data['title'];
        $this->pdfgenerator->generate($html, $file_pdf,true,"potrait");
    }

    
    public function chart($unit) {
        $json = file_get_contents('php://input');
        $data = json_decode($json, true);
        //echo json_encode($this->buildChart($data));
        echo json_encode(['listChart' => $this->buildChart($data)]);
    }



    public function convertToQuickChartFormat($data) {
        // Array untuk menyimpan label x
        $labels = [];
        // Array untuk menyimpan datasets
        $datasets = [];
        // Iterasi untuk mendapatkan label dan dataset
        foreach ($data['lines'] as $line) {
            // Hitung total nilai data untuk ditampilkan di legend
            
            $dataset = [
                'label' => $line['name'] ." ( ". implode(', ', array_map(function($x, $y) {
                                            return "$x : $y";  // Format "x : y"
                                        }, array_column($line['data'], 'x'), array_column($line['data'], 'y'))) ." ) ",

               // 'label' => implode(', ', array_column($line['data'], 'x')) . ' (' . number_format($total, 2) . ')',
                'data' => [],
                'fill' => false, // Garis tidak diisi
                //'borderColor' => $line['color'], // Warna garis
                //'backgroundColor' => $line['color'], // Warna titik data
                //'pointStyle' => $line['pointStyle'], // Gaya titik data
                //'borderWidth' => 2
            ];
    
            foreach ($line['data'] as $point) {
                // Tambahkan label hanya jika belum ada dalam array
                if (!in_array($point['x'], $labels)) {
                    $labels[] = $point['x'];
                }
                $dataset['data'][] = $point['y'];
            }
    
            $datasets[] = $dataset;

        }
    
        // Struktur akhir yang sesuai dengan format QuickChart
        $chartConfig = [
            'width' => 3898,  // Lebar untuk F4 Landscape (300 DPI)
            'height' => 2540,  // Tinggi untuk F4 Landscape (300 DPI)
            'type' => 'line',
            'data' => [
                'labels' => $labels,
                'datasets' => $datasets
            ],
            'options' => [
                'responsive' => true,
                'scales' => [
                    'xAxes' => [
                        [
                            'scaleLabel' => [
                                'display' => true,
                                'labelString' => 'Bulan',
                                'fontSize' => 10 // Ukuran font untuk label sumbu x
                            ],
                            'ticks' => [
                                'fontSize' => 10 // Ukuran font untuk nilai sumbu x
                            ]
                        ]
                    ],
                    'yAxes' => [
                        [
                            'ticks' => [
                                'beginAtZero' => true,
                                'stepSize' => 10, // Interval nilai pada sumbu y
                                //'max' => 120,   // Nilai maksimum sumbu y
                                'fontSize' => 10 // Ukuran font untuk nilai sumbu y
                            ],
                            'scaleLabel' => [
                                'display' => true,
                                'labelString' => $data['options']['yTitle'] ?? 'Persen (%)',
                                'fontSize' => 10 // Ukuran font untuk label sumbu y
                            ]
                        ]
                    ]
                ],
                'legend' => [
                    'display' => true,
                    'position' => 'bottom',
                    'labels' => [
                        'fontSize' => 8 // Ukuran font untuk legend
                    ]
                ],
                'tooltips' => [
                    'enabled' => true,
                    'mode' => 'index',
                    'intersect' => false,
                    'bodyFontSize' => 10, // Ukuran font untuk isi tooltip
                    'titleFontSize' => 10 // Ukuran font untuk judul tooltip
                ]
            ]
        ];
        
    
        return $chartConfig;
    }

    public function getHeaderData_get($unit,$id,$tahun) {

        $dynamicData = array();
        $dynamicData=$this->sikat_analisa_indikator_model->getByQuery($unit,$id,$tahun);
        return $dynamicData;
    }

    public function buildChart($data) {

        $listChart ="";

        foreach ($data['dataList'] as $index => $item) {
            $chartData = $this->convertToQuickChartFormat($item['chart']);

            $chartConfig = json_encode($chartData);
            $chartUrl = "https://quickchart.io/chart?w=350&h=280&c=" . urlencode($chartConfig);
    
            $listChart = $chartUrl;
        }
      
        return $listChart;
    }

    public function buildChartDownload($data) {

        $listChart =[];

        foreach ($data['dataList'] as $index => $item) {
            $chartData = $this->convertToQuickChartFormat($item['chart']);

            $chartConfig = json_encode($chartData);
            $chartUrl = "https://quickchart.io/chart?w=350&h=280&c=" . urlencode($chartConfig);
    
            //$listChart = $chartUrl;
            $listChart[$item['kriteria']] = $chartUrl;

        }
      
        return $listChart;
    }
    
    
}