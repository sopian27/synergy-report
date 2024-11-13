<?php
defined('BASEPATH') or exit('No direct script access allowed');

class LembarPdsaController extends CI_Controller {

    public function __construct() 
    {
        parent::__construct();
        $this->load->model('lembarPdsa_model');
        $this->load->model('lembarPdsaSiklus_Model');
        $this->load->library('pdfgenerator');
    }


    public function pdf($unit,$idx) {

        $json = file_get_contents('php://input');
        $data = json_decode($json, true);
        $data['title'] = "Lembar Pdsa ".$unit;
        $test=$data['list']=$this->getHeaderData_get($unit,$idx);
        $data['unit']=$unit;
        $html = $this->load->view('lembar_pdsa', $data, true);
        $file_pdf = $data['title'];
        $this->pdfgenerator->generate($html, $file_pdf);
    }

    public function getHeaderData_get($unit,$id) {

        $lembarPdsa = array();
        $lembarPdsa =  $this->lembarPdsa_model->get($id);
        $lembarPdsa->SIKLUS = $this->lembarPdsaSiklus_Model->get($id);
        return $lembarPdsa;
    }
    
    
}