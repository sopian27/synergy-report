<?php defined('BASEPATH') or exit('No direct script access allowed');
require_once 'dompdf/autoload.inc.php';
use Dompdf\Dompdf;
use Dompdf\Options;

class Pdfgenerator
{
    public function generate($html, $filename = '', $stream = TRUE)
    {
        $options = new Options();
        $options->set('isRemoteEnabled', TRUE);
        //$options->set('isHtml5ParserEnabled', true);
        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape'); // A4 size in landscape orientation
        //$dompdf->setPaper([0, 0, 2000, 8000]); // Custom width and height in points
        $dompdf->render();
        if ($stream) {
            $dompdf->stream($filename . ".pdf", array("Attachment" => 0));
            exit();
        } else {
            return $dompdf->output();
        }
    }
}