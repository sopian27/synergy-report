<?php defined('BASEPATH') or exit('No direct script access allowed');
require_once 'dompdf/autoload.inc.php';
use Dompdf\Dompdf;
use Dompdf\Options;

class Pdfgenerator
{
    public function generate($html, $filename='', $stream = TRUE, $orientation='')
    {

        $options = new Options();
        $options->set('isRemoteEnabled', TRUE);
        $options->set('enable-javascript', TRUE);
        $options->set('images', TRUE);
    
        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        
        // Set ukuran kertas 8.5 x 13 inch tanpa batas di bawah
        $customPaper = [0, 0, 612, 936]; // 8.5 * 72, 13 * 72
        $dompdf->setPaper($customPaper, $orientation);
        $dompdf->render();
    
        if ($stream) {
            $dompdf->stream($filename . ".pdf", array("Attachment" => 0));
            exit();
        } else {
            return $dompdf->output();
        }
        
    }

    public function generate2($html, $filename = '',  $paper = '', $orientation = '', $stream = TRUE)
    {
        $options = new Options();
        $options->set('isRemoteEnabled', TRUE);
        $options->set('enable-javascript', TRUE);
        $options->set('images', TRUE);
        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper($paper, $orientation);
        $dompdf->render();
        if ($stream) {
            $dompdf->stream($filename . ".pdf", array("Attachment" => 0));
            exit();
        } else {
            return $dompdf->output();
        }
    }

}