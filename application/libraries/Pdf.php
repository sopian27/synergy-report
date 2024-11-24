<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * CodeIgniter DomPDF Library
 *
 * Generate PDF's from HTML in CodeIgniter
 *
 * @packge        CodeIgniter
 * @subpackage        Libraries
 * @category        Libraries
 * @author        Ardianta Pargo
 * @license        MIT License
 * @link        https://github.com/ardianta/codeigniter-dompdf
 */
use Dompdf\Dompdf;
use Dompdf\Options;
class Pdf extends Dompdf{
    /**
     * PDF filename
     * @var String
     */
    public $filename;
    public $paper;
    public $orientation;
    
    public function __construct(){
        parent::__construct();
        $this->filename = "laporan.pdf";
        $this->paper = "F4";
        $this->orientation = "landscape";
    }
    /**
     * Get an instance of CodeIgniter
     *
     * @access    protected
     * @return    void
     */
    protected function ci()
    {
        return get_instance();
    }
    /**
     * Load a CodeIgniter view into domPDF
     *
     * @access    public
     * @param    string    $view The view to load
     * @param    array    $data The view data
     * @return    void
     */
    public function load_view($view, $data = array()){
        $html = $this->ci()->load->view($view, $data, TRUE);
        //$this->load_html($html);

        // Render the PDF
        $options = new Options();
        $options->set('isRemoteEnabled', TRUE);
        $options->set('enable-javascript', TRUE);
        $options->set('images', TRUE);
        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper($this->paper, $this->orientation);
        $this->render();
            // Output the generated PDF to Browser
               $this->stream($this->filename, array("Attachment" => false));
    }
}