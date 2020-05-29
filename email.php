<?php

if(isset($_POST['reciever']) && isset($_POST['subject']) && isset($_POST['email_body'])){

    $reciever = $_POST['reciever'];
    $subject = $_POST['subject'];
    $email_body = $_POST['email_body'];


    require_once "PHPMailer\\PHPMailer.php";
    require_once "PHPMailer\\Exception.php";
    require_once "PHPMailer\\SMTP.php";

    //PHPMailer Object
    $mail = new PHPMailer\PHPMailer\PHPMailer();
    $mail->IsSMTP(); // enable SMTP

    $mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
    $mail->SMTPAuth = true; // authentication enabled
    // $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
    $mail->Host = "smtp.hostinger.in";
    $mail->Port = 587; // or 587
    $mail->IsHTML(true);
    $mail->Username = "mindalert@gyaansolution.com";
    $mail->Password = "imsayantan2";

    //From email address and name
    $mail->From = "mindalert@gyaansolution.com";
    $mail->FromName = "Sayantan Chatterjee";

    //To address and name
    // $mail->addAddress("recepient1@example.com", "Recepient Name");
    $mail->addAddress($reciever); //Recipient name is optional

    // //Address to which recipient will reply
    // $mail->addReplyTo("reply@yourdomain.com", "Reply");

    // //CC and BCC
    // $mail->addCC("cc@example.com");
    // $mail->addBCC("bcc@example.com");

    //Send HTML or Plain Text email
    $mail->isHTML(true);

    $mail->Subject = $subject;
    $mail->Body = $email_body ;
    // $mail->AltBody = "This is the plain text version of the email content";



    if($mail->send()){
        echo json_encode("Mail sent successfully");
    }else{
        echo "Process failed"." ".$mail->ErrorInfo;
    }

}else{
    echo "Incomplete Parameters";
}

?>


