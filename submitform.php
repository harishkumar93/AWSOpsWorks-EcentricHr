<?php
require 'PHPMailerAutoload.php';
$mail = new PHPMailer;
$send = false;

if (count($_POST)>0) {
  $name=addslashes(strip_tags($_POST["name"]));
  $email=addslashes(strip_tags($_POST["email"]));
  $comments=addslashes(strip_tags($_POST["comments"]));
  
  $object 		= "Request from :: EcentricHR :: ".ucfirst($name)." posted a comment";
  $htmlmessage 	= <<<MESSAGE
  <html>
  	<head>
   		<title>Request from :: EcentricHR</title>
  	</head>
    <body>
      <style>body {font: 12px/1.2em Verdana}</style>
      <strong>Name: </strong>$name<br />
      <strong>Email: </strong>$email<br />
      <p><strong>Comments: </strong>$comments</p>
    </body>
  </html>
MESSAGE;

  $mail->From = $email;
  $mail->FromName = ucfirst($name);
  $mail->addAddress('info@ecentrichr.com');
  $mail->isHTML(true);
  $mail->Subject = 'Request from :: EcentricHR Contact Form';
  $mail->Body    = $htmlmessage;
  $mail->send();
  $send = true;
}
echo json_encode($send);
?>