<?php
 
 $from = "Sandra Sender <sender@example.com>";
 $to = "Ramona Recipient <vishnu.vijayaraghavan@gmail.com>";
 $subject = "Hi!";
 $body = "Hi,\n\nHow are you?";
 
 $host = "216.51.232.139";
 $username = "info@bookwormslib.com";
 $password = "fourvees";
 phpinfo();
 $headers = array ('From' => $from,
   'To' => $to,
   'Subject' => $subject);
 $smtp = Mail::factory('smtp',
   array ('host' => $host,
     'auth' => true,
     'username' => $username,
     'password' => $password));
 
 $mail = $smtp->send($to, $headers, $body);
 
 if (PEAR::isError($mail)) {
   echo("<p>" . $mail->getMessage() . "</p>");
  } else {
   echo("<p>Message successfully sent!</p>");
  }
 ?>