<?php

/*
 * Establish a MySQL connection and select the specified database.
 * Returns a MySQL link identifier on success, exits with an
 * error message on failure.
*/
function db_connect($databaseName) {
  /* Establish a connection with mySQL */
  $link = mysql_connect("localhost", "adrock_travis", "travis")
    or die("ERROR: Could not Connect." . mysql_error());

  /* Select database to use */
  mysql_select_db($databaseName)
    or die("ERROR: Could not select database '$databaseName'.");

  return $link;
}

/*-----------------------------------------------------------------------------------------------
/////////////////////////////////////////////////////////////////////////////////////////////////
-----------------------------------------------------------------------------------------------*/

function showAll($table) {
	$query = "SELECT * FROM ".$table." ";
	echo "\n";
	echo $query;	
	$result = mysql_query($query);
	$num_rows = mysql_num_rows($result);
	print "<table width=\"600\" border=\"1\" rules=\"all\">\n";
	while ($get_info = mysql_fetch_row($result)){
		print "<tr>\n";
		foreach ($get_info as $field)
			print "\t<td>$field</td>\n";
		print "</tr>\n";
	}
	print "</table>\n";
	mysql_free_result($result);
 }

/*-----------------------------------------------------------------------------------------------
/////////////////////////////////////////////////////////////////////////////////////////////////
-----------------------------------------------------------------------------------------------*/
 
function populateCompany(){
    $query = "SELECT name FROM company";
    $result = mysql_query($query) or die("Query show_all contacts failed!");
    while($row = mysql_fetch_object($result)){
      echo "<option value=\"" . $row->name . "\">" . $row->name . "</option>\n";
    }
    mysql_free_result($result);
 }

/*-----------------------------------------------------------------------------------------------
/////////////////////////////////////////////////////////////////////////////////////////////////
-----------------------------------------------------------------------------------------------*/

function getOtherCompanies($company_name) {
	$query = "SELECT name FROM company";
   $result = mysql_query($query) or die("Query show_all contacts failed!");
   while($row = mysql_fetch_object($result)){
	  if($row->name == $company_name)
     	 echo "<option value=\"" . $row->name . "\" selected=\"selected\">" . $row->name . "</option>\n";
	  else
	    echo "<option value=\"" . $row->name . "\">" . $row->name . "</option>";
   }
   mysql_free_result($result);
}

/*-----------------------------------------------------------------------------------------------
/////////////////////////////////////////////////////////////////////////////////////////////////
-----------------------------------------------------------------------------------------------*/

function getCompanyID($company_name) {
	//first, get company id by looking up company name in company table
	$query = "SELECT company_id FROM company WHERE name LIKE '%$company_name%'";
	$result = mysql_query($query) or die("Query to look up company id failed.");
	$row = mysql_fetch_object($result);
	$company_id = $row->company_id;
	mysql_free_result($result);
	return $company_id;
}

/*-----------------------------------------------------------------------------------------------
/////////////////////////////////////////////////////////////////////////////////////////////////
-----------------------------------------------------------------------------------------------*/
 
function schedule_meeting($company_name, $date, $start_time, $end_time, $client) {
	//get company id
	$company_id = getCompanyID($company_name);
	
	//insert values into meeting table
	$query = "INSERT INTO meeting VALUES('', '$company_id', '$date', '$start_time', '$end_time', '$client')";
	mysql_query($query) or die("Query to insert values into meeting table failed.");
	
	$query = "SELECT MAX(meeting_id) AS meeting_id FROM meeting";
	$result = mysql_query($query) or die("Query to get meeting id failed.");
	$row = mysql_fetch_object($result);
	$meeting_id = $row->meeting_id;
	mysql_free_result($result);
	
	//return meeting_id so values can be inserted into event table
	return $meeting_id;	
}

/*-----------------------------------------------------------------------------------------------
/////////////////////////////////////////////////////////////////////////////////////////////////
-----------------------------------------------------------------------------------------------*/

function getEmployees($company_name) {
	//get company id
	$company_id = getCompanyID($company_name);
	
	//now get all of the employees who work for that company
	$query = "SELECT * FROM employee WHERE company_id LIKE '$company_id'";
	$result = mysql_query($query) or die("Query to select employees failed.");
	while($row = mysql_fetch_object($result)){
		echo "<input type=\"checkbox\" name=\"employees[]\" value=\"$row->employee_id\">" . $row->fname . " " . $row->lname . "<br />\n";
	}
	echo "<input type=\"hidden\" name=\"employees\" value=\"" . $temp . "\" />";
	mysql_free_result($result);
}

/*-----------------------------------------------------------------------------------------------
/////////////////////////////////////////////////////////////////////////////////////////////////
-----------------------------------------------------------------------------------------------*/

function insertCompany($company_name, $logo_loc) {
	$query = "INSERT INTO company VALUES('', '$company_name', '$logo_loc')";
	mysql_query($query) or die("Query to insert a new company failed.");
	return true;
}

/*-----------------------------------------------------------------------------------------------
/////////////////////////////////////////////////////////////////////////////////////////////////
-----------------------------------------------------------------------------------------------*/

function insertEmployee($company_name, $fname, $lname, $email) {
	//get company id
	$company_id = getCompanyID($company_name);
	
	//check if employee already exists
	if(checkForEmp($company_id, $fname, $lname, $email)) {
		//now, add new employee for that company
		$query = "INSERT INTO employee VALUES('', '$company_id', '$fname', '$lname', '$email')";
		mysql_query($query) or die("Query to insert a new employee failed.");
		return true;
	}
	else return false;
}

/*-----------------------------------------------------------------------------------------------
/////////////////////////////////////////////////////////////////////////////////////////////////
-----------------------------------------------------------------------------------------------*/

function checkForEmp($company_id, $fname, $lname, $email) {
	//check for employee by company and name
	$query = "SELECT * FROM employee WHERE company_id LIKE '$company_id' AND fname LIKE '$fname' AND lname LIKE '$lname'";
	$result1 = mysql_query($query);
	//check for employee by company and email
	$query = "SELECT * FROM employee WHERE company_id LIKE '$company_id' AND email LIKE '$email'";
	$result2 = mysql_query($query);
	if(mysql_fetch_object($result1)){
		echo "Employee data already exists for that name and company.\n";
		return false;
	}
	else if(mysql_fetch_object($result2)){
		echo "Employee data already exists for that email address.\n";
		return false;
	}
	else return true;
}

/*-----------------------------------------------------------------------------------------------
/////////////////////////////////////////////////////////////////////////////////////////////////
-----------------------------------------------------------------------------------------------*/

function showEmployees($company_name) {
	//get the company's id number
	$company_id = getCompanyID($company_name);
	
	//search for employees using company id
	$query = "SELECT * FROM employee WHERE company_id LIKE '$company_id' ";
	$result = mysql_query($query) or die("Query to select employees failed.");
	
	//print out employee info
	while($row = mysql_fetch_object($result)){
		echo "<tr>\n";
		echo "<td>" . $row->employee_id . "</td>\n";
		echo "<td>" . $row->fname . " " . $row->lname . "</td>\n";
		echo "<td> <a href=\"mailto:" . $row->email . "\">" . $row->email . "</a></td>\n";
		echo "<td><a href=\"edit.php?employee_id=" . $row->employee_id . "\">edit</a> |\n";
		echo "<a href=\"delete.php?employee_id=" . $row->employee_id . "\">delete</a></td>\n";
		echo "</tr>\n";
	}
	
	//free the result set
	mysql_free_result($result);
}

/*-----------------------------------------------------------------------------------------------
/////////////////////////////////////////////////////////////////////////////////////////////////
-----------------------------------------------------------------------------------------------*/

function showCompany($company_name) {
	//get the details about the company
	$query = "SELECT * FROM company WHERE name LIKE '$company_name' ";
	$result = mysql_query($query) or die("Query to select employees failed.");
	
	//print out company info
	while($row = mysql_fetch_object($result)){
		echo "<tr>\n";
		echo "<td>" . $row->company_id . "</td>\n";
		echo "<td>" . $row->name . "</td>\n";
		echo "<td> <img src=\"" . $row->logo_loc . "\" alt=\"company logo\" /></td>\n";
		echo "<td><a href=\"edit.php?company_id=" . $row->company_id . "\">edit</a> |\n";
		echo "<a href=\"delete.php?company_id=" . $row->company_id . "\">delete</a></td>\n";
		echo "</tr>\n";
	}
	
	//free the result set
	mysql_free_result($result);
}

/*-----------------------------------------------------------------------------------------------
/////////////////////////////////////////////////////////////////////////////////////////////////
-----------------------------------------------------------------------------------------------*/

function getFirstName($employee_id) {
	$query = "SELECT * FROM employee WHERE employee_id LIKE '$employee_id'";
	$result = mysql_query($query) or die("Query to select employees failed.");
	
	//print out company info
	$row = mysql_fetch_object($result);
	return $row->fname;
	
	//free the result set
	mysql_free_result($result);
}

/*-----------------------------------------------------------------------------------------------
/////////////////////////////////////////////////////////////////////////////////////////////////
-----------------------------------------------------------------------------------------------*/

function getLastName($employee_id) {
	$query = "SELECT * FROM employee WHERE employee_id LIKE '$employee_id'";
	$result = mysql_query($query) or die("Query to select employees failed.");
	
	//print out company info
	$row = mysql_fetch_object($result);
	return $row->lname;
	
	//free the result set
	mysql_free_result($result);
}

/*-----------------------------------------------------------------------------------------------
/////////////////////////////////////////////////////////////////////////////////////////////////
-----------------------------------------------------------------------------------------------*/

function getEmail($employee_id) {
	$query = "SELECT * FROM employee WHERE employee_id LIKE '$employee_id'";
	$result = mysql_query($query) or die("Query to select employees failed.");
	
	//print out company info
	$row = mysql_fetch_object($result);
	return $row->email;
	
	//free the result set
	mysql_free_result($result);
}

/*-----------------------------------------------------------------------------------------------
/////////////////////////////////////////////////////////////////////////////////////////////////
-----------------------------------------------------------------------------------------------*/

function getCompany($employee_id) {
	//first, get the employees company id
	$query = "SELECT * FROM employee WHERE employee_id LIKE '$employee_id'";
	$result = mysql_query($query) or die("Query to select employees company id failed.");
	
	//get the company id
	$row = mysql_fetch_object($result);
	$company_id = $row->company_id;
	
	//free the result set
	mysql_free_result($result);
	//------------------------
	//now get the company name using the id
	$query = "SELECT * FROM company WHERE company_id = '$company_id'";
	$result = mysql_query($query) or die("Query to select company name failed.");
	
	//return the company name
	$row = mysql_fetch_object($result);
	return $row->name;
	
	//free the result set
	mysql_free_result($result);
}

/*-----------------------------------------------------------------------------------------------
/////////////////////////////////////////////////////////////////////////////////////////////////
-----------------------------------------------------------------------------------------------*/

function getCompanyName($company_id) {
	$query = "SELECT * FROM company WHERE company_id LIKE '$company_id'";
	
	$result = mysql_query($query) or die("Query to select company name failed.");
	
	//print out company info
	$row = mysql_fetch_object($result);
	return $row->name;
	
	//free the result set
	mysql_free_result($result);
}

/*-----------------------------------------------------------------------------------------------
/////////////////////////////////////////////////////////////////////////////////////////////////
-----------------------------------------------------------------------------------------------*/

function getLogo($company_id) {
	$query = "SELECT * FROM company WHERE company_id LIKE '$company_id'";
	
	$result = mysql_query($query) or die("Query to select company name failed.");
	
	//print out company info
	$row = mysql_fetch_object($result);
	return $row->logo_loc;
	
	//free the result set
	mysql_free_result($result);
}

/*-----------------------------------------------------------------------------------------------
/////////////////////////////////////////////////////////////////////////////////////////////////
-----------------------------------------------------------------------------------------------*/

function editEmployee($employee_id, $fname, $lname, $email) {
	$query = "UPDATE employee SET fname = '$fname', 
				lname = '$lname', 
				email = '$email' 
				WHERE employee_id = '$employee_id'";
	mysql_query($query) or die("Query to update employee failed.");
}

/*-----------------------------------------------------------------------------------------------
/////////////////////////////////////////////////////////////////////////////////////////////////
-----------------------------------------------------------------------------------------------*/

function editCompany($comp_id, $company_name, $logo_loc) {
	$query = "UPDATE company SET name = '$company_name',
				logo_loc = '$logo_loc'
				WHERE company_id = '$comp_id'";
	mysql_query($query) or die("Query to update company failed.");
	return true;
}

/*-----------------------------------------------------------------------------------------------
/////////////////////////////////////////////////////////////////////////////////////////////////
-----------------------------------------------------------------------------------------------*/

function deleteEmp($employee_id) {
	return true;
}

/*-----------------------------------------------------------------------------------------------
/////////////////////////////////////////////////////////////////////////////////////////////////
-----------------------------------------------------------------------------------------------*/

function deleteCo($company_id) {
	return true;
}

?>
