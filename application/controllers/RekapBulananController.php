<?php
defined('BASEPATH') or exit('No direct script access allowed');

class RekapBulananController extends CI_Controller {

    public function __construct() 
    {
        parent::__construct();
        $this->load->model('sikat_profile_indikator_model');
        $this->load->library('pdfgenerator');
    }


    public function pdf($unit,$subUnit) {

        $json = file_get_contents('php://input');
        $data = json_decode($json, true); // Decode JSON data to PHP array
        $data['title'] = "Rekap Bulanan Form C ".$unit.$subUnit;
        $data['list']=$this->getHeaderData_get($unit);
        $data['unit']=$unit;
        $html = $this->load->view('form_c', $data, true);
        $file_pdf = $data['title'];
        $this->pdfgenerator->generate($html, $file_pdf,true,"landscape");
    }

    public function getHeaderData_get($unit) {
        
        $process_type = $unit;
        $dynamicData = array();
        $where = array(
            "process_type" =>  $process_type
        );
        $dynamicData=$this->sikat_profile_indikator_model->get_where($where);
        return $dynamicData;
    }
}
