<?php
defined('BASEPATH') or exit('No direct script access allowed');

class FormAController extends CI_Controller {

    public function __construct() 
    {
        parent::__construct();
        $this->load->model('sikat_profile_indikator_model');
        $this->load->library('pdfgenerator');
    }


    public function pdf($unit) {

        $json = file_get_contents('php://input');
        $data = json_decode($json, true); // Decode JSON data to PHP array
        $data['title'] = "Report Form A ".$unit;
        $data['list']=$this->getHeaderDataFormA_get($unit);
        $html = $this->load->view('form_a', $data, true);
        $file_pdf = $data['title'];
        $this->pdfgenerator->generate($html, $file_pdf,true,"landscape");
    }


    public function getHeaderDataFormA_get($unit) {
        
        $process_type = $unit;
        $dynamicData = array();
        $where = array(
            "process_type" =>  $process_type,
            "status_acc"   => '1'
        );
        $dynamicData=$this->sikat_profile_indikator_model->get_where($where);

        $combinedNumerator = [];
        $combinedDeNumerator = [];
        $iterator = 1;
        foreach ($dynamicData as $item) {

            if (!empty($item->NUMERATOR) && !empty($item->DENUMERATOR)) {
                $combinedNumerator[$item->ID] = [
                    'ID'        => $item->ID,
                    'JUDUL' => $item->NUMERATOR,
                    'LEVEL' => $iterator
                ];

                $combinedDeNumerator[$item->ID] = [
                    'ID'        => $item->ID,
                    'JUDUL' => $item->DENUMERATOR,
                    'LEVEL' => $iterator
                ];
            }

            $iterator++;
        }

        $finalCombined = array_merge($combinedNumerator, $combinedDeNumerator);
        // Mengurutkan $finalCombined berdasarkan 'LEVEL'
        usort($finalCombined, function ($a, $b) {
            return $a['LEVEL'] <=> $b['LEVEL']; // Menggunakan spaceship operator untuk pengurutan
        });

       return $finalCombined;
    }
}
