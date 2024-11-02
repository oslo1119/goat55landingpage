<?php



use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;



/**
 *We have to require the path to the PHPMailer class 
 */

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';


require 'config.php';


/**
 * The function uses the PHPMailer object to send an email 
 * to the address we specify.
 * @param  [string] $email, [Where our email goes]
 * @param  [string] $subject, [The email's subject]
 * @param  [string] $message, [The message]
 * @return [string]          [Error message, or success]
 */

function sendMail($email, $subject, $message)
{

    
    $mail = new PHPMailer();

    $mail->isSMTP();

    $mail->SMTPAuth = true;

    $mail->Host = MAILHOST;

    $mail->Username = USERNAME;

    $mail->Password = PASSWORD;

    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;

    $mail->Port = 587;

    $mail->setFrom(SEND_FROM, SEND_FROM_NAME);

    $mail->addAddress($email);

    $mail->addReplyTo(REPLY_TO, REPLY_TO_NAME);

    $mail->IsHTML(true);

    $mail->Subject = $subject;

    $mail->Body = $message;


    $mail->AltBody = $message;

    
    if (!$mail->send()) {
        return "Email not send. Please try again";
    } else {
        return "success";
    }
}