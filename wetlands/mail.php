<?php $name = $_POST['name'];
$email = $_POST['email'];
$number = $_POST['number'];
$message = $_POST['message'];
$formcontent="From: $name \nE-mail: $email \nNumber: $number \nMessage: $message";
$recipient1 = "c.severn1@nuigalway.ie";
$recipient2 = "s.lydon13@nuigalway.ie";
$recipient3 = "c.gaughan-smith1@nuigalway.ie";
$subject = "Contact Form";
$mailheader = "From: $email \r\n";
mail($recipient1, $subject, $formcontent, $mailheader) or die("Error!");
mail($recipient2, $subject, $formcontent, $mailheader) or die("Error!");
mail($recipient3, $subject, $formcontent, $mailheader) or die("Error!");
readfile('http://danu6.it.nuigalway.ie/Wetlands/contact.php');
?>