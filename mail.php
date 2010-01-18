<?php
require ($_SERVER["DOCUMENT_ROOT"]."/common/header.php");

echo "<h1>Contact Us</h1>";

// get form variables
$EmailFrom = "www@respectalumni.com";
$EmailTo = "Travis Roberts <adrock451@yahoo.com>";
$Name = Trim(stripslashes($_POST['Name'])); 
$Email = Trim(stripslashes($_POST['Email'])); 
$Telephone = Trim(stripslashes($_POST['Phone']));
$Comments = Trim(stripslashes($_POST['Comments']));
$Subject = "Contact form mail from www.respectalumni.com";

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
$Body .= "Message:  ";
$Body .= $Comments;
$Body .= "\n";

// send mail
$sent = mail($EmailTo, $Subject, $Body, "From: <$EmailFrom>");

//check to ensure that mail was sent successfully
if($sent)
	echo "<p>Thank you for sending your comments to us at RespectAlumni.com.  If necessary, a representative will contact you regarding your email.</p>";
else
	echo "<p>I'm very sorry, but there was an error sending your email.  Please go back and try again.</p>";


require ($_SERVER["DOCUMENT_ROOT"]."/common/footer.php");
?>