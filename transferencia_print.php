<?php
include_once './tcpdf/tcpdf.php';
include_once 'clases/conexion.php';
// Extend the TCPDF class to create custom Header and Footer
class MYPDF extends TCPDF {

    // Page footer
    public function Footer() {
        // Position at 15 mm from bottom
        $this->SetY(-15);
        // Set font
        $this->SetFont('helvetica', 'I', 8);
        // Page number
        $this->Cell(0,0, 'Pag. '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, 
                false, 'R', 0, '', 0, false, 'T', 'M');
    }
}
// create new PDF document // CODIFICACION POR DEFECTO ES UTF-8
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Alex Sandoval');
$pdf->SetTitle('REPORTE DE TRANSFERENCIA');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');
$pdf->setPrintHeader(false);
// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

//set margins POR DEFECTO
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
//$pdf->SetMargins(8,10, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

//set auto page breaks SALTO AUTOMATICO Y MARGEN INFERIOR
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);


// ---------------------------------------------------------

// TIPO DE LETRA
$pdf->SetFont('times', 'B', 14);

// AGREGAR PAGINA
$pdf->AddPage('P', 'LEGAL');
$pdf->Cell(0, 0, "TRANSFERENCIA", 0, 1, 'C');
//SALTO DE LINEA
$pdf->Ln();
if (!empty(isset($_REQUEST['opcion']))) {
    switch ($_REQUEST['opcion']) {
        case 1://fecha            
            $cabeceras = consultas::get_datos("select * from v_trans_cabecera "
                            . "where trans_fecha::date between '" . $_REQUEST['vdesde'] . "' and '" . $_REQUEST['vhasta'] . "'");
            break;
        case 2: //proveedor
            $cabeceras = consultas::get_datos("select * from v_trans_cabecera where suc_orig in (". $_REQUEST['vorig_trans'].")");
            break;
        case 3: //articulo
            $cabeceras = consultas::get_datos("select * from v_trans_cabecera where suc_dest in (". $_REQUEST['vdest_trans'].")");
            break;
        case 4: //empleado
            $cabeceras = consultas::get_datos("select * from v_compra where emp_cod in(" . $_REQUEST['vempleado'] . ")");
            break;
    }
} else {
    $cabeceras = consultas::get_datos("select * from v_trans_cabecera where trans_cod= " . $_REQUEST['vtrans_cod']);
}
$pdf->SetFont('times', '', 11);

if (!empty($cabeceras)) {
    foreach ($cabeceras as $cabecera) {
        $pdf->Cell(130, 2, "ORIGEN: " . $cabecera['suc_orig'], 0, '', 'L');
        $pdf->Cell(80, 2, "FECHA: " . $cabecera['trans_fecha'], 0, '', 'L');
        $pdf->Ln();   
        $pdf->Cell(130, 2, "DESTINO: " . $cabecera['suc_dest'], 0, '', 'L');
        $pdf->Cell(80, 2, "ESTADO: " . $cabecera['trans_estado'], 0, '', 'L');
        $pdf->Ln();
        //$pdf->Cell(130, 2, "SUCURSAL: " . $cabecera['suc_descri'], 0, '', 'L');
        //$pdf->Cell(80, 2, "PEDIDO N??: " . $cabecera['com_cod'], 0, '', 'L');
        $pdf->Ln();
        $pdf->Cell(0, 5, "", 0, '', 'L');
        $pdf->Ln();
//COLOR DE TABLA
        $pdf->SetFillColor(255, 255, 255);
        $pdf->SetTextColor(0);
        $pdf->SetDrawColor(0, 0, 0);
        $pdf->SetLineWidth(0.5);

        $pdf->SetFont('', 'B', 12);
        // Header        
        $pdf->SetFillColor(180, 180, 180);
        //consulta detalle pedido
        $detalles = consultas::get_datos("select * from v_detalle_trans where trans_cod=" . $cabecera['trans_cod']);
        if (!empty($detalles)) {
            $pdf->Cell(15, 5, 'COD.', 1, 0, 'C',1);
            $pdf->Cell(45, 5, 'DEP. ORIGEN', 1, 0, 'C', 1);
            $pdf->Cell(45, 5, 'DEP. DESTINO', 1, 0, 'C', 1);
            $pdf->Cell(75, 5, 'ARTICULO', 1, 0, 'C', 1);
            $pdf->Cell(20, 5, 'CANT.', 1, 0, 'C', 1);
            
            $pdf->Ln();
            $pdf->SetFont('', '');
            $pdf->SetFillColor(255, 255, 255);

            foreach ($detalles as $det) {
                $pdf->Cell(15, 5, $det['trans_cod'], 1, 0, 'C', 1);
                $pdf->Cell(45, 5, $det['dep_descri'], 1, 0, 'C', 1);
                $pdf->Cell(45, 5, $det['desti'], 1, 0, 'C', 1);
                $pdf->Cell(75, 5, $det['art_descri'] . " " . $det['mar_descri'], 1, 0, 'L', 1);
                $pdf->Cell(20, 5, $det['trns_cant'], 1, 0, 'C', 1);
                
                $pdf->Ln();
            }
       
        } else {
            $pdf->Cell(165, 2, "La transferencia no posee detalles", 0, '', 'L', 1);
            $pdf->Ln();
            $pdf->Ln();
            $pdf->SetFont('times', '', 11);
        }
        $pdf->Ln();
            $pdf->Ln();
        $pdf->Cell(130, 2, "FIRMA SALIDA ", '', 'L');
        $pdf->Cell(80, 2, "RECEPCION ", '', 'L');
        $pdf->Ln();
            $pdf->Ln();
        $pdf->Cell(130, 2, "_______________ ", '', 'L');
        $pdf->Cell(80, 2, "_______________ ", '', 'L');
    }
} else {
    $pdf->SetFillColor(255, 255, 255);
    $pdf->SetTextColor(0);
    $pdf->SetDrawColor(0, 0, 0);
    $pdf->SetLineWidth(0.2);
    $pdf->Cell(165, 2, "No se encontraron registros", 0, '', 'L', 1);
}

//SALIDA AL NAVEGADOR
$pdf->Output('reporte_marca.pdf', 'I');
?>