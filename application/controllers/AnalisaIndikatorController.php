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
        $data = json_decode($json, true); // Decode JSON data to PHP array
        $data['title'] = "Analisa Indikator ".$unit;
        $data['list']=$this->getHeaderData_get($unit,$id);
        $data['unit']=$unit;
        $html = $this->load->view('analisa_indikator', $data, true);
        $file_pdf = $data['title'];
        $this->pdfgenerator->generate($html, $file_pdf);
    }

    public function getHeaderData_get($unit,$id) {
        
        $process_type = $unit;
        $dynamicData = array();
        $where = array(
            "id" => $id
        );
        $dynamicData=$this->sikat_analisa_indikator_model->get_where($where);
        return $dynamicData;
    }
}
