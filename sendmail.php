<?php
  function send_mail($email,$subject,$message)
  {      
    require_once('PHPmailer/class.phpmailer.php');
    require 'PHPmailer/PHPMailerAutoload.php'; 
    $mail = new PHPMailer();
    $mail->IsSMTP(); 
    $mail->SMTPDebug  = 0;                     
    $mail->SMTPAuth   = true;                  
    $mail->SMTPSecure = "tls";                 
    $mail->Host       = "smtp.gmail.com";      
    $mail->Port       = 587;             
    $mail->AddAddress($email,'');
    $mail->Username="farjiparam@gmail.com";  
    $mail->Password="@rp311616";            
    $mail->SetFrom('farjiparam@gmail.com','');
    $mail->AddReplyTo("farjiparam@gmail.com","");
    $mail->Subject    = $subject;  
    $mail->Body = "hello this is my message"; 
    $mail->MsgHTML($message);
    $bool = $mail->Send();

    if(!$bool) {
     echo 'Message could not be sent.';
     echo 'Mailer Error: ' . $mail->ErrorInfo;
     exit;
   }
  } 

?>