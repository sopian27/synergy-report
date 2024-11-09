<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		//$this->load->view('welcome_message');
		$this->load->library('pdfgenerator');
        $data['title'] = "Data Random";
        $file_pdf = $data['title'];
        $paper = 'A4';
		//$html = $this->load->view('analisa_indikator', $data, true);
        $orientation = "landscape";
		$chartConfig = [
			'type' => 'bar',
			'data' => [
				'labels' => ['2012', '2013', '2014', '2015', '2016'],
				'datasets' => [
					[
						'label' => 'Users',
						'data' => [120, 60, 50, 180, 120],
						'borderColor' => 'rgba(255, 99, 132, 1)',
						'backgroundColor' => 'rgba(255, 99, 132, 0.2)',
						'borderWidth' => 1
					]
				]
			]
		];
		
		// Encode the config to JSON and create the QuickChart URL
		$chartUrl = 'https://quickchart.io/chart?w=500&h=300&c=' . urlencode(json_encode($chartConfig));

		// Misalnya $chart adalah array yang berisi URL gambar
		$chart = ['imageUrl' => $chartUrl];
		// Pastikan Anda mengambil string URL gambar dari array
		$chartUrl = $chart['imageUrl'];
				
		// Output the image
		//echo '<img src="' . $chartUrl . '" alt="Chart" />';
		$data['chart']=$chartUrl;
        $html = $this->load->view('welcome_message',$data,true);
        //$this->pdfgenerator->generate($html, $file_pdf, $paper, $orientation);
		//echo $html;
		//exit();
	
		$this->pdfgenerator->generate($html, $file_pdf);

		
	}

	public function pdf(){
		echo "test";
	}
}
