<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" 
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>View Airline Surveys</title>
<!--Name: Deepti Rajput
   UIN: 660136229
   Chapter 9 Assignment -->

<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
</head>
<body>
<h1>Airline Surveys</h1>
<?php

$DBConnect = @mysql_connect("10.203.98.147", "drajp2","Password123");
if ($DBConnect === FALSE)
     echo "<p>Unable to connect to the database server.</p>\n"
        . "<p>Error code " . mysql_errno()
        . ": " . mysql_error() . "</p>\n";
else {
     $DBName ="surveys";
     $TableName = "airlines";
     if (!@mysql_select_db($DBName, $DBConnect))
          echo "<p>Unable to connect to the $DBName database!</p>";
     else {
		 mysql_select_db($DBName,$DBConnect);
		 if(empty($_POST['Flight_Date']) || empty($_POST['Flight_Time']) || empty($_POST['Flight_Number']) || empty($_POST['Airline']) || empty($_POST['Starting_City']) || empty($_POST['Ending_City']))     
         echo "<p>You must enter all fields. Click your browser's Back button to return to the Guest Book.</p>\n"; 
         else 
        {  
		 $Flight_Date=stripslashes($_POST['Flight_Date']);
		 $Flight_Time=stripslashes($_POST['Flight_Time']);
		 $Flight_Number=stripslashes($_POST['Flight_Number']);
		 $Airline=stripslashes($_POST['Airline']);
		 $Starting_City=stripslashes($_POST['Starting_City']);
		 $Ending_City=stripslashes($_POST['Ending_City']);
		 
		 $Friendliness=stripslashes($_POST['n']);
		 $Space=stripslashes($_POST['p']);
		 $Comfort=stripslashes($_POST['f']);
		 $Cleanliness=stripslashes($_POST['g']);
		 $Noise=stripslashes($_POST['e']);
          $SQLString="insert into $TableName values(null,'$Flight_Date'
		  ,'$Flight_Time','$Flight_Number','$Airline','$Starting_City','$Ending_City','$Friendliness',
		  '$Space','$Comfort','$Cleanliness','$Noise')";
          $QueryResult = @mysql_query($SQLString, $DBConnect);
          if ($QueryResult === FALSE)
               echo "<p>There was an error when executing the query.<br />\n" .
                              "The error was " . 
                              htmlentities(mysql_error($DBConnect)) .
                              ".<br />\nThe query was '" . 
                              htmlentities($SQLString) .
                              "'</p>\n";
          else 
               echo "Rating updated successfully";
         
               echo "To go to home page click below";       
			   }
	 }
     }

?>
<br />
<p><a href="AirlineSurvey.html">Home page</a></p>
</body>
</html>

