<?php defined('BASEPATH') or exit('No direct script access allowed');
require_once 'dompdf/autoload.inc.php';
use Dompdf\Dompdf;
use Dompdf\Options;

class Pdfgenerator
{
    public function generate($html, $filename, $stream = TRUE)
    {

        $options = new Options();
        $options->set('isRemoteEnabled', TRUE);
        $options->set('enable-javascript', TRUE);
        $options->set('images', TRUE);
    
        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('F4', 'landscape');
        $dompdf->render();
    
        if ($stream) {
            $dompdf->stream($filename . ".pdf", array("Attachment" => 0));
            exit();
        } else {
            return $dompdf->output();
        }
        
    }

    
}