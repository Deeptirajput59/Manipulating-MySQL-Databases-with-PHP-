<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" 
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Show</title>
<!--Name: Deepti Rajput
   UIN: 660136229
   Chapter 9 Assignment -->

<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
</head>
<body>
<h1>Show ratings</h1>
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
		      $SQLString="SELECT * FROM $TableName ";
          $QueryResult = @mysql_query($SQLString, $DBConnect);
          if ($QueryResult === FALSE)
               echo "<p>There was an error when executing the query.<br />\n" .
                              "The error was " . 
                              htmlentities(mysql_error($DBConnect)) .
                              ".<br />\nThe query was '" . 
                              htmlentities($SQLString) .
                              "'</p>\n";
          else if (mysql_num_rows($QueryResult)==0) 
               echo "<p>There are no surveys to display.</p>\n";
               echo "<table border='1' cellspacing='0'>\n";
               echo "<tr><th>Flight Date</th>" .
                    "<th>Flight Time</th>" .
                    "<th>Flight Number</th>" .
                    "<th>Airline</th>" .
                    "<th>Starting City</th>" .
                    "<th>Ending City</th>" .
                    "<th>Friendliness of customer staff</th>" .
                    "<th>Space for luggage storage</th>" .
                    "<th>Comfort of seating</th>" .
                    "<th>Cleanliness of aircraft</th>" .
                    "<th>Noise level of aircraft</th></tr>\n";
					while (($Row = mysql_fetch_assoc($QueryResult)) !== FALSE) {
echo "<tr><td>{$Row['flight_date']}</td>";
echo "<td>{$Row['flight_time']}</td>";
echo "<td>{$Row['flight_number']}</td>";
echo "<td>{$Row['airline']}</td>";
echo "<td>{$Row['start_city']}</td>";
echo "<td>{$Row['end_city']}</td>";
echo "<td>{$Row['friendliness']}</td>";
echo "<td>{$Row['luggage_space']}</td>";
echo "<td>{$Row['seat_comfort']}</td>";
echo "<td>{$Row['cleanliness']}</td>";
echo "<td>{$Row['noise_level']}</td></tr>";

}
					
					
					
              while (($Row = mysql_fetch_assoc($QueryResult)) !== FALSE) {
                    $SpacePos=strpos($survey['flight_time']," ");
                    if ($SpacePos===FALSE)
                         $survey['Time']=substr($survey['flight_time'],0,strlen($survey['flight_time'])-2);
                    else
                         $survey['Time']=substr($survey['flight_time'],0,$SpacePos);
                    $survey['AMorPM']=strtoupper(substr($survey['flight_time'],strlen($survey['flight_time'])-2,2));
                    echo "<tr><td>" . $survey['flight_date'] . "</td>" .
                         "<td>" . $survey['Time'] . 
                              " " .$survey['AMorPM'] . 
                              "</td>" .
                         "<td>" . $survey['flight_number'] . "</td>" .
                         "<td>" . $survey['airline'] . "</td>" .
                         "<td>" . $survey['start_city'] . "</td>" .
                         "<td>" . $survey['end_city'] . "</td>" .
                         "<td>" . $ratings[$survey['friendliness']] . "</td>" .
                         "<td>" . $ratings[$survey['luggage_space']] . "</td>" .
                         "<td>" . $ratings[$survey['seat_comfort']] . "</td>" .
                         "<td>" . $ratings[$survey['cleanliness']] . "</td>" .
                         "<td>" . $ratings[$survey['noise_level']] . "</td>" .
                         "</tr>\n";
               }
               echo "</table>\n";
          }
     }

?>
<br />
<p><a href="AirlineSurvey.html">Home page</a></p>
</body>
</html>

