<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
require_once 'phpmailer/PHPMailerAutoload.php';

if (isset($_POST['inputFirstName']) 
    && isset($_POST['inputLastName']) 
    && isset($_POST['inputEmail']) 
    && isset($_POST['inputPhone']) 
    && isset($_POST['inputAddress']) 
    && isset($_POST['inputPackage']) 

    && isset($_POST['inputCourtAddress']) 
    && isset($_POST['inputCourtRoom']) 
    && isset($_POST['inputAccusedName']) 
    && isset($_POST['inputJudgeName']) 
    && isset($_POST['inputProceedingDate']) 
    && isset($_POST['inputAppealPurpose']) 
    && isset($_POST['inputAppealTo']) 
    && isset($_POST['inputAppealNumber']) 

    && isset($_POST['inputTranscriptDate']) 
    && isset($_POST['inputNumberCopies']) 

    && isset($_POST['inputProceedingType']) 
    && isset($_POST['inputWhatsTranscribed']) 
    && isset($_POST['inputProceedingTypeOther']) 
    && isset($_POST['inputWhatsTranscribedOther']) 

    && isset($_POST['inputOccupation'])
    && isset($_POST['inputOccupationOther'])
    && isset($_POST['inputOccupationCLDOther'])
    && isset($_POST['inputAdditional'])) {

    //check if any of the inputs are empty
    if (empty($_POST['inputFirstName']) || empty($_POST['inputLastName']) || empty($_POST['inputEmail']) || empty($_POST['inputPhone'])) {
        $data = array('success' => false, 'message' => 'Please fill out the form completely.');
        echo json_encode($data);
        exit;
    }

    $date_msg = implode(",<br>", $_POST['inputProceedingDate']);

    //create an instance of PHPMailer
    $mail = new PHPMailer();

    /*$mail->isSMTP();
    $mail->Host = 'vps.jeffmalc.com;vps.jeffmalc.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'info@transcriptservices.ca';                 // SMTP username
    $mail->Password = 'mayadog2k14';                           // SMTP password
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 465; */

    $mail->From = $_POST['inputEmail'];
    $mail->FromName = $_POST['inputFirstName'] ." " .  $_POST['inputLastName'];
    $mail->AddAddress('info@transcriptservices.ca'); //recipient 
    $mail->Subject = 'Transcript Order Submission';
    $mail->isHTML(true);
    $msgHTML = "<style>table td {border-bottom:1px solid #e1e1e1;}</style><table cellspacing='3'><tr><td width='35%' style='border-bottom:1px solid #e1e1e1;'><b>NAME:</b></td><td width='65%' style='border-bottom:1px solid #e1e1e1;'>" . $_POST['inputFirstName'] ." " .  $_POST['inputLastName'] 
    . "</td></tr><tr><td style='border-bottom:1px solid #e1e1e1;'><b>EMAIL:</b></td><td style='border-bottom:1px solid #e1e1e1;'>" . $_POST['inputEmail'] 
    . "</td></tr><tr><td style='border-bottom:1px solid #e1e1e1;'><b>PHONE:</b></td><td style='border-bottom:1px solid #e1e1e1;'>" . $_POST['inputPhone'] 
    . "</td></tr><tr><td style='border-bottom:1px solid #e1e1e1;'><b>ADDRESS:</b></td><td style='border-bottom:1px solid #e1e1e1;'>" . $_POST['inputAddress']
    . "</td></tr><tr><td style='border-bottom:1px solid #e1e1e1;'><b>OCCUPATION:</b></td><td style='border-bottom:1px solid #e1e1e1;'>" . $_POST['inputOccupation'] . "  " . $_POST['inputOccupationOther'] . "" . $_POST['inputOccupationCLDOther'] 
    . "</td></tr><tr><td style='border-bottom:1px solid #e1e1e1;'>&nbsp;</td><td style='border-bottom:1px solid #e1e1e1;'>"
    . "</td></tr><tr><td style='border-bottom:1px solid #e1e1e1;'><b>ORDER TYPE:</b></td><td style='border-bottom:1px solid #e1e1e1;'>" . $_POST['inputPackage'] 
    . "</td></tr><tr><td style='border-bottom:1px solid #e1e1e1;'>&nbsp;</td><td style='border-bottom:1px solid #e1e1e1;'>"
    . "</td></tr><tr><td style='border-bottom:1px solid #e1e1e1;'><b>REQUIRED TRANSCRIPT DATE:</b></td><td style='border-bottom:1px solid #e1e1e1;'>" . $_POST['inputTranscriptDate'] 
    . "</td></tr><tr><td style='border-bottom:1px solid #e1e1e1;'><b>NUMBER OF COPIES:</b></td><td style='border-bottom:1px solid #e1e1e1;'>" . $_POST['inputNumberCopies'] 
    . "</td></tr><tr><td style='border-bottom:1px solid #e1e1e1;'>&nbsp;</td><td style='border-bottom:1px solid #e1e1e1;'>"
    . "</td></tr><tr><td style='border-bottom:1px solid #e1e1e1;'><b>COURT ADDRESS:</b></td><td style='border-bottom:1px solid #e1e1e1;'>" . $_POST['inputCourtAddress'] 
    . "</td></tr><tr><td style='border-bottom:1px solid #e1e1e1;'><b>COURT ROOM NUMBER:</b></td><td style='border-bottom:1px solid #e1e1e1;'>" . $_POST['inputCourtRoom'] 
    . "</td></tr><tr><td style='border-bottom:1px solid #e1e1e1;'><b>NAME OF ACCUSED:</b></td><td style='border-bottom:1px solid #e1e1e1;'>" . $_POST['inputAccusedName'] 
    . "</td></tr><tr><td style='border-bottom:1px solid #e1e1e1;'><b>JUDGE OR JUSTICE NAME:</b></td><td style='border-bottom:1px solid #e1e1e1;'>" . $_POST['inputJudgeName'] 
    . "</td></tr><tr><td valign='top' style='border-bottom:1px solid #e1e1e1;'><b>PROCEEDING DATE:</b></td><td style='border-bottom:1px solid #e1e1e1;'>" . $date_msg
    . "</td></tr><tr><td style='border-bottom:1px solid #e1e1e1;'>&nbsp;</td><td style='border-bottom:1px solid #e1e1e1;'>"
    . "</td></tr><tr><td style='border-bottom:1px solid #e1e1e1;'><b>APPEAL PURPOSE:</b></td><td style='border-bottom:1px solid #e1e1e1;'>" . $_POST['inputAppealPurpose'] 
    . "</td></tr><tr><td style='border-bottom:1px solid #e1e1e1;'><b>APPEAL TO:</b></td><td style='border-bottom:1px solid #e1e1e1;'>" . $_POST['inputAppealTo'] 
    . "</td></tr><tr><td style='border-bottom:1px solid #e1e1e1;'><b>APPEAL NUMBER:</b></td><td style='border-bottom:1px solid #e1e1e1;'>" . $_POST['inputAppealNumber'] 
    . "</td></tr><tr><td style='border-bottom:1px solid #e1e1e1;'>&nbsp;</td><td style='border-bottom:1px solid #e1e1e1;'>"  
    . "</td></tr><tr><td style='border-bottom:1px solid #e1e1e1;'><b>PROCEEDING TYPE:</b></td><td style='border-bottom:1px solid #e1e1e1;'>" . $_POST['inputProceedingType'] . " " . $_POST['inputProceedingTypeOther'] 
    . "</td></tr><tr><td style='border-bottom:1px solid #e1e1e1;'><b>WHAT TO BE TRANSCRIBED:</b></td><td style='border-bottom:1px solid #e1e1e1;'>" . $_POST['inputWhatsTranscribed'] . "  " . $_POST['inputWhatsTranscribedOther']
    . "</td></tr><tr><td style='border-bottom:1px solid #e1e1e1;'>&nbsp;</td><td style='border-bottom:1px solid #e1e1e1;'>"  
    . "</td></tr><tr><td valign='top'><b>ADDITIONAL INFORMATION:</b></td><td>" . stripslashes($_POST['inputAdditional']) . "</td></tr></table>";
    $msg = " NAME: " . $_POST['inputFirstName'] ." " .  $_POST['inputLastName'] 
    . "\r\n EMAIL: " . $_POST['inputEmail'] 
    . "\r\n PHONE: " . $_POST['inputPhone'] 
    . "\r\n ADDRESS: " . $_POST['inputAddress'] 
    . "\r\n\r\n ORDER TYPE: " . $_POST['inputPackage'] 
    . "\r\n\r\n REQUIRED TRANSCRIPT DATE: " . $_POST['inputTranscriptDate'] 
    . "\r\n NUMBER OF COPIES: " . $_POST['inputNumberCopies'] 
    . "\r\n\r\n COURT ADDRESS: " . $_POST['inputCourtAddress'] 
    . "\r\n COURT ROOM NUMBER: " . $_POST['inputCourtRoom'] 
    . "\r\n NAME OF ACCUSED: " . $_POST['inputAccusedName'] 
    . "\r\n JUDGE OR JUSTICE OF THE PEACE: " . $_POST['inputJudgeName'] 
    . "\r\n PROCEEDING DATE: " . $date_msg 
    . "\r\n APPEAL PURPOSE: " . $_POST['inputAppealPurpose'] . "   //   APPEAL TO: " . $_POST['inputAppealTo'] . "   //   APPEAL NUMBER: " . $_POST['inputAppealNumber']    
    . "\r\n\r\n PROCEEDING TYPE: " . $_POST['inputProceedingType'] . " " . $_POST['inputProceedingTypeOther'] 
    . "\r\n WHAT TO BE TRANSCRIBED: " . $_POST['inputWhatsTranscribed'] . "  " . $_POST['inputWhatsTranscribedOther']
    . "\r\n OCCUPATION: " . $_POST['inputOccupation'] . "  " . $_POST['inputOccupationOther'] . "" . $_POST['inputOccupationCLDOther']
    . "\r\n\r\n ADDITIONAL INFORMATION: " . stripslashes($_POST['inputAdditional']);
    $mail->Body = $msgHTML;
    $mail->AltBody = $msg;

    $mail->Send(); 
    $mail->ClearAddresses();

    $msgClientHTML = "<table width='100%' height='70'><tr><td valign='middle'><img src='http://transcriptservices.ca/assets/images/logo2.png' alt='logo'></td><td valign='middle' align='right'><div style='text-align:right;font-size:12px;color:#4f5962;height:30px;'><a href='https://ca.linkedin.com/pub/shannon-tara-couto/b7/596/a06' style='color:#4f5962;text-decoration:none;'><img src='http://transcriptservices.ca/assets/images/email/linkedin-logo.jpg' alt='LinkedIn Icon' style='width:20px;height:20px;vertical-align:middle'> <span>Find us on LinkedIn</span></a> &nbsp;|&nbsp; <a href='https://www.facebook.com/pages/Transcript-Services/908504082525460?ref=hl' style='color:#4f5962;text-decoration:none;'><img src='http://transcriptservices.ca/assets/images/email/facebook-logo.jpg' alt='Facbook Icon' style='width:20px;height:20px;vertical-align:middle'> <span>Follow us on Facebook</span></a></div></td></tr></table>"
    . "<h1 style='font-size:40px; color:#4f5962;'>Transcript Order Confirmation</h1><h3 style='font-size:22px; color:#4f5962;'>We will begin to process your order. Please notify us within 24 hours of any changes with your order.</h3><br><hr style='border-bottom:1px solid #dddddd; border-top: none;'>"
    . "<style>table td {border-bottom:1px solid #e1e1e1; color:#4f5962;}</style><table cellspacing='3'><tr><td width='35%'><b>ORDER TYPE:</b></td><td width='65%'>" . $_POST['inputPackage'] 
    . "</td></tr><tr><td>&nbsp;</td><td>"
    . "</td></tr><tr><td><b>REQUIRED TRANSCRIPT DATE:</b></td><td>" . $_POST['inputTranscriptDate'] 
    . "</td></tr><tr><td><b>NUMBER OF COPIES:</b></td><td>" . $_POST['inputNumberCopies'] 
    . "</td></tr><tr><td>&nbsp;</td><td>"
    . "</td></tr><tr><td><b>COURT ADDRESS:</b></td><td>" . $_POST['inputCourtAddress'] 
    . "</td></tr><tr><td><b>COURT ROOM NUMBER:</b></td><td>" . $_POST['inputCourtRoom'] 
    . "</td></tr><tr><td><b>NAME OF ACCUSED:</b></td><td>" . $_POST['inputAccusedName'] 
    . "</td></tr><tr><td><b>JUDGE OR JUSTICE NAME:</b></td><td>" . $_POST['inputJudgeName'] 
    . "</td></tr><tr><td valign='top'><b>PROCEEDING DATE:</b></td><td>" . $date_msg
    . "</td></tr><tr><td>&nbsp;</td><td>"
    . "</td></tr><tr><td><b>APPEAL PURPOSE:</b></td><td>" . $_POST['inputAppealPurpose'] 
    . "</td></tr><tr><td><b>APPEAL TO:</b></td><td>" . $_POST['inputAppealTo'] 
    . "</td></tr><tr><td><b>APPEAL NUMBER:</b></td><td>" . $_POST['inputAppealNumber'] 
    . "</td></tr><tr><td>&nbsp;</td><td>"  
    . "</td></tr><tr><td><b>PROCEEDING TYPE:</b></td><td>" . $_POST['inputProceedingType'] . " " . $_POST['inputProceedingTypeOther'] 
    . "</td></tr><tr><td><b>WHAT TO BE TRANSCRIBED:</b></td><td>" . $_POST['inputWhatsTranscribed'] . "  " . $_POST['inputWhatsTranscribedOther']
    . "</td></tr><tr><td><b>OCCUPATION:</b></td><td>" . $_POST['inputOccupation'] . "  " . $_POST['inputOccupationOther'] . "" . $_POST['inputOccupationCLDOther']
    . "</td></tr><tr><td>&nbsp;</td><td>"  
    . "</td></tr><tr><td valign='top'><b>ADDITIONAL INFORMATION:</b></td><td>" . stripslashes($_POST['inputAdditional']) . "</td></tr></table>";
    $msgClient = "TRANSCRIPT ORDER CONFIRMATION\r\nWe will begin to process your order. Please contact us within 24 hours to notify us of any changes with your order."
    . "\r\n\r\n ORDER TYPE: " . $_POST['inputPackage'] 
    . "\r\n\r\n REQUIRED TRANSCRIPT DATE: " . $_POST['inputTranscriptDate'] 
    . "\r\n NUMBER OF COPIES: " . $_POST['inputNumberCopies'] 
    . "\r\n\r\n COURT ADDRESS: " . $_POST['inputCourtAddress'] 
    . "\r\n COURT ROOM NUMBER: " . $_POST['inputCourtRoom'] 
    . "\r\n NAME OF ACCUSED: " . $_POST['inputAccusedName'] 
    . "\r\n JUDGE OR JUSTICE OF THE PEACE: " . $_POST['inputJudgeName'] 
    . "\r\n PROCEEDING DATE: " . $date_msg 
    . "\r\n APPEAL PURPOSE: " . $_POST['inputAppealPurpose'] . "   //   APPEAL TO: " . $_POST['inputAppealTo'] . "   //   APPEAL NUMBER: " . $_POST['inputAppealNumber']    
    . "\r\n\r\n PROCEEDING TYPE: " . $_POST['inputProceedingType'] . " " . $_POST['inputProceedingTypeOther'] 
    . "\r\n WHAT TO BE TRANSCRIBED: " . $_POST['inputWhatsTranscribed'] . "  " . $_POST['inputWhatsTranscribedOther']
    . "\r\n OCCUPATION: " . $_POST['inputOccupation'] . "  " . $_POST['inputOccupationOther'] . "" . $_POST['inputOccupationCLDOther']
    . "\r\n\r\n ADDITIONAL INFORMATION: " . stripslashes($_POST['inputAdditional']);
    $mail->Subject = 'Transcript Order Confirmation - Transcript Services';
    $mail->From = 'info@transcriptservices.ca';
    $mail->FromName = "Transcript Services";
    $mail->AddAddress($_POST['inputEmail']); 
    $mail->Body = $msgClientHTML;
    $mail->AltBody = $msgClient;

    if (isset($_POST['ref'])) {
        $mail->Body .= "\r\n\r\nRef: " . $_POST['ref'];
    }

    if(!$mail->send()) {
        $data = array('success' => false, 'message' => 'Message could not be sent. Mailer Error: ' . $mail->ErrorInfo);
        echo json_encode($data);
        exit;
    }

    $data = array('success' => true, 'message' => 'Thanks! We have received your message. You will receive an email confirmation shortly.');
    echo json_encode($data);

} else {

    $data = array('success' => false, 'message' => 'Please fill out the form completely.');
    echo json_encode($data);

}