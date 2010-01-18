<?php
require ($_SERVER["DOCUMENT_ROOT"]."/common/header.php");

echo "<h1>Request School Colors</h1>";

// get form variables
$EmailFrom = "www@respectalumni.com";
$EmailTo = "Travis Roberts <adrock451@yahoo.com>";
$Name = Trim(stripslashes($_POST['Name'])); 
$Email = Trim(stripslashes($_POST['Email'])); 
$Telephone = Trim(stripslashes($_POST['Phone']));
$School = Trim(stripslashes($_POST['School']));
$Shirt = Trim(stripslashes($_POST['Shirt']));
$Text = Trim(stripslashes($_POST['Text']));
$Comments = Trim(stripslashes($_POST['Comments']));
$Subject = "School color request from www.respectalumni.com";

// prepare email body text
$Body = "";
$Body .= "Name: ";
$Body .= $Name;
$Body .= "\n";
$Body .= "Email: ";
$Body .= $Email;
$Body .= "\n";
$Body .= "Telephone: ";
$Body .= $Telephone;
$Body .= "\n";
$Body .= "School: ";
$Body .= $School;
$Body .= "\n";
$Body .= "Shirt Color: ";
$Body .= $Shirt;
$Body .= "\n";
$Body .= "Text Color: ";
$Body .= $Text;
$Body .= "\n";
$Body .= "Comments:  ";
$Body .= $Comments;
$Body .= "\n";

// send mail
$sent = mail($EmailTo, $Subject, $Body, "From: <$EmailFrom>");

//check to ensure mail was sent successfully
if($sent)
	echo "<p>Thank you for sending your request for a shirt.  Based on the number of requests we get, we will try our best to make a shirt available for your school.</p>";
else
	echo "<p>I'm very sorry, but there was an error sending your email.  Please go back and try again.</p>";


require ($_SERVER["DOCUMENT_ROOT"]."/common/footer.php");
?>