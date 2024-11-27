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
        $this->pdfgenerator->generate($html, $file_pdf);
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
            $total = array_sum(array_column($line['data'], 'y'));
            $dataset = [
                'label' => $line['name'] . ' (' . number_format($total, 2) . ')', // Menambahkan total ke label legend
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
                                'labelString' => 'Bulan'
                            ]
                        ]
                    ],
                    'yAxes' => [
                        [
                            'ticks' => [
                                'beginAtZero' => true,
                                'stepSize' => 10, // Interval nilai pada sumbu y
                                //'max' => 120     // Nilai maksimum sumbu y
                            ],
                            'scaleLabel' => [
                                'display' => true,
                                'labelString' => $data['options']['yTitle'] ?? 'Persen (%)'
                            ]
                        ]
                    ]
                ],
                'legend' => [
                    'display' => true,
                    'position' => 'bottom'
                ],
                'tooltips' => [
                    'enabled' => true,
                    'mode' => 'index',
                    'intersect' => false
                ]
            ]
        ];
    
        return $chartConfig;
    }

    public function getHeaderData_get($unit,$id) {

        $dynamicData = array();
        $dynamicData=$this->sikat_analisa_indikator_model->getByQuery($unit,$id);
        return $dynamicData;
    }

    public function buildChart($data) {

        $listChart ="";

        foreach ($data['dataList'] as $index => $item) {
            $chartData = $this->convertToQuickChartFormat($item['chart']);

            $chartConfig = json_encode($chartData);
            $chartUrl = "https://quickchart.io/chart?w=500&h=300&c=" . urlencode($chartConfig);
    
            $listChart = $chartUrl;
        }
      
        return $listChart;
    }
    
    
}