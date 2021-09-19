<?php
require_once('dbConnect.php');

$uname = $_POST['username'];
$id = $_POST['id'];
//$uname = 'itsme.badriram';
//$id = 10;
$sql = "SELECT * FROM patientreport WHERE uname ='".$uname."' AND patient_id = $id";

$result = $conn->query($sql);
$row = $result->fetch_assoc();
  
    require('fpdf/fpdf.php');
    $pdf = new FPDF('P','mm','A4');
    
    $pdf->AddPage();
    $pdf->Rect(5, 5, 200, 287, 'D'); 
    $pdf->SetTitle('FPDF tutorial');
    $pdf->SetFont("Times",'B',14);
    $name = $row['name'];
    $reportname = $name.'\'s Symptoms Report' ;
    $pdf->Cell(180,10,$reportname,0,0,'C',0);
    $pdf->Ln();
    $pdf->Ln();
    
    $pdf->SetFont("Times",'B',12);
    $pdf->Text(10,30,'Patient Name'); 
    $pdf->Text(10,40,'Gender');
    $pdf->Text(10,50,'Age');
    $pdf->Text(10,60,'Symptoms List:');
    $pdf->Text(10,70,'Fever');
    $pdf->Text(10,80,'Tiredness');
    $pdf->Text(10,90,'Drycough');
    $pdf->Text(10,100,'Aches and Pains');
    $pdf->Text(10,110,'Nasal Congestion');
    $pdf->Text(10,120,'Running Nose');
    $pdf->Text(10,130,'Sore Throat');
    $pdf->Text(10,140,'Diarrhoea');
    $pdf->Text(10,150,'Period of Illness');
    $pdf->Text(10,160,'Current Medication');
    $pdf->Text(10,180,'Past/Current Condition');
    $pdf->Text(10,200,'Location');

    $pdf->Text(58,30,":");
    $pdf->Text(58,40,":");
    $pdf->Text(58,50,":");

    $pdf->Text(58,70,":");
    $pdf->Text(58,80,":");
    $pdf->Text(58,90,":");
    $pdf->Text(58,100,":");
    $pdf->Text(58,110,":");
    $pdf->Text(58,120,":");
    $pdf->Text(58,130,":");
    $pdf->Text(58,140,":");
    $pdf->Text(58,150,":");
    $pdf->Text(58,160,":");
    $pdf->Text(58,180,":");
    $pdf->Text(58,200,":");


    $pdf->Text(60,30,$row['name']);
    $pdf->Text(60,40,$row['gender']);
    $pdf->Text(60,50,$row['age']);
    $pdf->Text(60,70,$row['fever']);
    $pdf->Text(60,80,$row['tiredness']);
    $pdf->Text(60,90,$row['drycough']);
    $pdf->Text(60,100,$row['ache']);
    $pdf->Text(60,110,$row['nasal_congestion']);
    $pdf->Text(60,120,$row['running_nose']);
    $pdf->Text(60,130,$row['sorethroat']);
    $pdf->Text(60,140,$row['diarrhoea']);
    $pdf->Text(60,150,$row['period']);
    $pdf->Text(60,160,$row['medication']);
    $pdf->Text(60,180,$row['past_condition']);
    $pdf->Text(60,200,$row['location']);

   
    
    $filename = $name.'_'.$id.'.pdf';

    $pdf->Output('F','patient_report/'.$filename);
  

?>
