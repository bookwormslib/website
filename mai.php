<?php

function Send_Mail($to,$nameto,$subject,$body)
{

// Modify the path in the require statement below to refer to the 
// location of your Composer autoload.php file.
require 'phpmailer/class.phpmailer.php';

// Instantiate a new PHPMailer 
$mail = new PHPMailer;

// Tell PHPMailer to use SMTP
$mail->isSMTP();

// Replace sender@example.com with your "From" address. 
// This address must be verified with Amazon SES.
$mail->setFrom('info@bookwormslibrary.com', 'Bookworms');

// Replace recipient@example.com with a "To" address. If your account 
// is still in the sandbox, this address must be verified.
// Also note that you can include several addAddress() lines to send
// email to multiple recipients.
$mail->addAddress($to,$nameto);

// Replace smtp_username with your Amazon SES SMTP user name.
$mail->Username = getenv('SES_USER');

// Replace smtp_password with your Amazon SES SMTP password.
$mail->Password = getenv('SES_PASS');
    
// Specify a configuration set. If you do not want to use a configuration
// set, comment or remove the next line.
$mail->addCustomHeader('X-SES-CONFIGURATION-SET', 'ConfigSet');
 
// If you're using Amazon SES in a region other than US West (Oregon), 
// replace email-smtp.us-west-2.amazonaws.com with the Amazon SES SMTP  
// endpoint in the appropriate region.
$mail->Host = getenv('SES_HOST');

// The subject line of the email
$mail->Subject = $subject;

// The HTML-formatted body of the email
$mail->Body = $body;

// Tells PHPMailer to use SMTP authentication
$mail->SMTPAuth = true;

// Enable TLS encryption over port 587
$mail->SMTPSecure = 'tls';
$mail->Port = 587;

// Tells PHPMailer to send HTML-formatted email
$mail->isHTML(true);

if(!$mail->send()) {
    echo "Email not sent. " , $mail->ErrorInfo , PHP_EOL;
	return false;
} else {
    echo "Email sent!" , PHP_EOL;
    return true;
}

}
?>
