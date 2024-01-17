<?php

namespace App\Controllers;

use App\Models\SiswaModel;
use App\Models\HasilModel;
use Dompdf\Dompdf;
use Dompdf\Options;

class Pdf extends BaseController
{
    public function generatePdf()
    {
        // Load the view that contains your HTML table
        $html = view('hasil'); // Replace 'pdf_view' with the actual view name

        // Setup dompdf
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isPhpEnabled', true);

        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);

        // Set paper size and orientation (e.g., 'A4' or 'letter')
        $dompdf->setPaper('A4', 'portrait');

        // Render the PDF (choose to save it, send it to the browser, or output it)
        $dompdf->render();

        // Output the PDF to the browser
        $dompdf->stream('table.pdf', ['Attachment' => false]);
    }
}
