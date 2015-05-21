<?php
require 'PHPMailerAutoload.php';
$mail = new PHPMailer;

$send = false;
$name=addslashes(strip_tags($_POST["ecentric_contact_name"]));
$location=addslashes(strip_tags($_POST["ecentric_contact_location"]));
$salary=addslashes(strip_tags($_POST["ecentric_contact_salary"]));
$comments=addslashes(strip_tags($_POST["ecentric_contact_comments"]));
$title=addslashes(strip_tags($_POST["title"]));


	$htmlmessage = <<<MESSAGE
    <html>
    	<head>
     		<title>Request from :: EcentricHR</title>
    	</head>
	    <body>
	      <style>body {font: 12px/1.2em Verdana}</style>
	      <strong>Job title: </strong>$title<br />
	      <strong>Name: </strong>$name<br />
	      <strong>Location: </strong>$location<br />
	      <strong>Salary: </strong>$salary<br />
	      <p><strong>Comments: </strong>$comments</p>
	    </body>
    </html>
MESSAGE;

$mail->FromName = ucfirst($name);
$mail->addAddress('careers@ecentrichr.com', ucfirst($name));     // Add a recipient77

if(!empty($_FILES['ecentric_contact_resume']['name'])){
	$tmpname = $_FILES['ecentric_contact_resume']['tmp_name'];
	$filename = $_FILES['ecentric_contact_resume']['name'];
	$mail->addAttachment($tmpname, $filename);    		  // Optional name
}

$mail->isHTML(true);                                  // Set email format to HTML
$mail->Subject = 'Request from :: EcentricHR Contact Form';
$mail->Body    = $htmlmessage;
$mail->send();
$send = true;

echo json_encode($send);
?>