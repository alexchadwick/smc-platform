<?php
/*
 * PHPMailer
 * */
require 'PHPMailerAutoload.php';

$mail = new PHPMailer;

$errors = [];

$mail->isSMTP();                                      // Set mailer to use SMTP
//TODO
$mail->Host = 'smtp1.example.com;smtp2.example.com';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'user@example.com';                 // SMTP username
$mail->Password = 'secret';                           // SMTP password
$mail->SMTPSecure = 'tls'; // Enable encryption, 'ssl' also accepted
$mail->Port = 587; //SMTP port


//TODO
$mail->From = 'from@example.com';
$mail->FromName = 'Jobs Website';
$mail->addAddress('joe@example.net', 'HR');     // Add a recipient
//$mail->addAddress('ellen@example.com');               // Name is optional
//$mail->addReplyTo('info@example.com', 'Information');
//$mail->addCC('cc@example.com');
//$mail->addBCC('bcc@example.com');

$mail->WordWrap = 50;                                 // Set word wrap to 50 characters

//ATTACHMENT
if(isset($_FILES['resume'])) {
    //Get attachment temp file
    $file_tmp  = $_FILES['resume']['tmp_name'];
    $file_name = $_FILES['resume']['name'];
    $file_size = $_FILES['resume']['size'];
    $file_type = $_FILES['resume']['type'];
    $fileExtParts = explode('.',$file_name);
    $file_ext=strtolower(end($fileExtParts));

    $allowedExts= ["jpeg","jpg","png","pdf"];

    if(in_array($file_ext,$allowedExts) === false){
        $errors[]="extension not allowed, please choose a PDF, JPEG or PNG file.";
    }

    if($file_size > (2097152 * 2)) {
        $errors[]='File size must be exactly 4 MB';
    }



    $mail->AddAttachment($file_tmp, $file_name);          // Add attachment, but do not save it
    //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
}


$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = 'Here is the subject';
$mail->Body    = 'This is the HTML message body <b>in bold!</b>';
$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

if(empty($errors)==true) {
    if(!$mail->send()) {
        echo 'Message could not be sent.';
        echo 'Mailer Error: ' . $mail->ErrorInfo;
    } else {
        echo 'Message has been sent';
    }
} else {
    //Write errors to screen
    print_r($errors);
}