<?php
require ($_SERVER["DOCUMENT_ROOT"]."/common/header.php");
?>

<h1>Contact Us</h1>

<form method="post" action="mail.php">
	
	<p>Name:<br />
	<input type="text" name="Name" size="20" /></p>
	
	<p>Email:<br />
	<input type="text" name="Email" size="20" /></p>
	
	<p>Phone Number:<br />
	<input type="text" name="Phone" size="20" /></p>
	
	<p>Comments:<br />
	<textarea name="Comments" rows="6" cols="40"></textarea></p>
	
	<p><input type="submit" value="Send Mail" /></p>
</form>

<?php
require ($_SERVER["DOCUMENT_ROOT"]."/common/footer.php");
?>