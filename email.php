<?php

if(isset($_POST['reciever']) && isset($_POST['subject']) && isset($_POST['email_body'])){

    $reciever = $_POST['reciever'];
    $subject = $_POST['subject'];
    $email_body = $_POST['email_body'];


    require_once "PHPMailer\\PHPMailer.php";
    require_once "PHPMailer\\Exception.php";
    require_once "PHPMailer\\SMTP.php";

    $mail = new PHPMailer\PHPMailer\PHPMailer();
    $mail->IsSMTP(); 

    $mail->SMTPDebug = 1; 
    $mail->SMTPAuth = true; 
    $mail->Host = "";
    $mail->Port = ***; 
    $mail->IsHTML(true);
    $mail->Username = "";
    $mail->Password = "";

    $mail->From = "";
    $mail->FromName = "";

    $mail->addAddress($reciever); //Recipient name is optional


    $mail->isHTML(true);

    $mail->Subject = $subject;
    $mail->Body = $email_body ;
    if($mail->send()){
        echo json_encode("Mail sent successfully");
    }else{
        echo "Process failed"." ".$mail->ErrorInfo;
    }

}else{
    echo "Incomplete Parameters";
}

?>


