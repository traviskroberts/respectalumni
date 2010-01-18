<?php
require ($_SERVER["DOCUMENT_ROOT"]."/common/header.php");
?>

<h1>Request School Colors</h1>

<p>If you would like a printing of "Respect Alumni" shirts in the colors of your school, please use the form below to make a request.</p>

<form method="post" action="send_request.php">
	
	<p>Name:<br />
	<input type="text" name="Name" size="20" /></p>
	
	<p>Email:<br />
	<input type="text" name="Email" size="20" /></p>
	
	<p>Phone Number:<br />
	<input type="text" name="Phone" size="20" /></p>
	
	<p>School:<br />
	<input type="text" name="School" size="20" /></p>
	
	<p>Desired Shirt Color:<br />
	<input type="text" name="Shirt" size="20" /></p>
	
	<p>Desired Text Color:<br />
	<input type="text" name="Text" size="20" /></p>
	
	<p>Additional Comments:<br />
	<textarea name="Comments" rows="6" cols="40"></textarea></p>
	
	<p><input type="submit" value="Send Mail" /></p>
</form>

<?php
require ($_SERVER["DOCUMENT_ROOT"]."/common/footer.php");
?>