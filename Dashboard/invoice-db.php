<?php
session_start();
$user_id = $_SESSION['user_id'];
include ("../connection.php");
define('FPDF_FONTPATH', '../fpdf/font');    
require_once('../fpdf/fpdf.php');

// Add headers to tell the browser it's a PDF and display inline
header('Content-Type: application/pdf');
header('Content-Disposition: inline; filename="filename.pdf"');

if(isset($_POST['appointmentDate'])&&isset($_POST['appointmentTime'])&&isset($_POST['service'])){


    $appointmentDate = $_POST['appointmentDate'];
    $appointmentTime = $_POST['appointmentTime'];
    $service = $_POST['service'];
    

    $sql = "SELECT * from appointment where appointment_date=? AND appointment_time = ? AND service = ?";
    $stmt  = $con->prepare($sql);
    $stmt->bind_param("sss",$appointmentDate,$appointmentTime,$service);
    $stmt->execute();
    $result = $stmt->get_result();

   

    if($result->num_rows>0){
        $row = $result->fetch_assoc();
        $appointmentID = $row['id'];
        $sql2 = "SELECT * FROM appointment JOIN user ON appointment.id=? AND user.id=?";
        $stmt2 = $con->prepare($sql2);
        $stmt2->bind_param("ii", $appointmentID, $user_id);
        $stmt2->execute();
        $result2 = $stmt2->get_result();
        if ($result2->num_rows > 0) {
            $row2 = $result2->fetch_assoc();
            $name = $row2['name'];
            $email = $row2['email'];
            $phone = $row2['phone'];
            $username = $row2['username'];
            $status = $row2['status'];
        }
        $sql3 = "SELECT service_price FROM services WHERE service_name=?";
        $stmt3 = $con->prepare($sql3);
        $stmt3->bind_param("s", $service);
        $stmt3->execute();
        $result3 = $stmt3->get_result();
        if ($result3->num_rows > 0) {
            $row3 = $result3->fetch_assoc(); 
            $service_price = $row3['service_price'];
        }

    }


$pdf = new FPDF('P','mm','A4');

$pdf->AddPage();

$pdf->SetFont('Arial','B',14);

$pdf->Cell(130	,5,'STYLE SPOT',0,0);
$pdf->Cell(59	,5,'INVOICE',0,1);

$pdf->SetFont('Arial','',12);

$pdf->Cell(130	,5,'Basundhara',0,0);
$pdf->Cell(59	,5,'',0,1);

$pdf->Cell(130	,5,'Kathmandu, Nepal, 44600',0,0);
$pdf->Cell(12	,5,'Date:',0,0);
$pdf->Cell(34	,5,''.$appointmentDate,0,1);

$pdf->Cell(130	,5,'Phone: 01-442222',0,0);
$pdf->Cell(22	,5,'Invoice ID:',0,0);
$pdf->Cell(34	,5,'#'.$appointmentID,0,1);

$pdf->Cell(130	,5,'Fax: 0555265',0,0);
$pdf->Cell(26	,5,'Customer ID:',0,0);
$pdf->Cell(34	,5,'#'.$user_id,0,1);

$pdf->Cell(189	,10,'',0,1);
$pdf->SetFont('','B');
$pdf->Cell(100	,5,'Bill to',0,1);

$pdf->Cell(10	,5,'',0,0);
$pdf->Cell(90	,5,'Name: '.$name,0,1);

$pdf->Cell(10	,5,'',0,0);
$pdf->Cell(90	,5,'Username: '.$username,0,1);

$pdf->Cell(10	,5,'',0,0);
$pdf->Cell(90	,5,'Email: '.$email,0,1);

$pdf->Cell(10	,5,'',0,0);
$pdf->Cell(90	,5,'Phone: '.$phone,0,1);

$pdf->Cell(10, 5, '', 0, 0);
if ($status == 'paid') {
    $pdf->SetTextColor(0, 128, 0); // Green color
} elseif ($status == 'unpaid') {
    $pdf->SetTextColor(255, 0, 0); // Red color
} else {
    $pdf->SetTextColor(0); // Default color
}
$pdf->Cell(90, 5, 'Status: ' . strtoupper($status), 0, 1);
$pdf->SetTextColor(0); // Reset text color to default


$pdf->Cell(189	,10,'',0,1);

$pdf->SetFont('Arial','B',12);

$pdf->Cell(130	,5,'Service Name',1,0);
// $pdf->Cell(25	,5,'Taxable',1,0);
$pdf->Cell(34	,5,'Amount',1,1);

$pdf->SetFont('Arial','',12);

$pdf->Cell(130	,5,''.$service,1,0);
// $pdf->Cell(25	,5,'-',1,0);
$pdf->Cell(34	,5,''.$service_price,1,1,'R');


$pdf->Cell(105	,5,'',0,0);
$pdf->Cell(25	,5,'Subtotal',0,0);
$pdf->Cell(8	,5,'Rs.',1,0);
$pdf->Cell(26	,5,''.$service_price,1,1,'R');

$pdf->Cell(105	,5,'',0,0);
$pdf->Cell(25	,5,'Discount',0,0);
$pdf->Cell(8	,5,'Rs.',1,0);
$pdf->Cell(26	,5,'0',1,1,'R');

$pdf->Cell(105	,5,'',0,0);
$pdf->Cell(25	,5,'Tax Rate',0,0);
$pdf->Cell(8	,5,'%',1,0);
$pdf->Cell(26	,5,'10%',1,1,'R');

$finalAmount = ($service_price + (10/100) * $service_price);
$pdf->Cell(100 ,5,'',0,0);
$pdf->SetFont('','B');
$pdf->Cell(30,5,'Total Amount',0,0);
$pdf->SetFont('','B');
$pdf->Cell(8 ,5,'Rs.',1,0);
$pdf->Cell(26 ,5,''.$finalAmount,1,1,'R');
$pdf->SetFont('');



$pdf->Output();
}
?>