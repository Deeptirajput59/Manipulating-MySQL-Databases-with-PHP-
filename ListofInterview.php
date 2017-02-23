<!--Name: Deepti Rajput
   UIN: 660136229
   Chapter 8 Assignment -->

<!DOCTYPE html>
<head>
<title>View List of Interviews</title>
</head>
<body>
<h1><font color='blue'>List of Interviews</font></h1>
<?php
$DBConnect = @mysql_connect("10.203.98.147", "drajp2", "Password123");
if ($DBConnect === FALSE)
     echo "<p>Unable to connect to the database server.</p>\n"
        . "<p>Error code " . mysql_errno()
        . ": " . mysql_error() . "</p>\n";
else {
     $DBName ="human_resources";
     $TableName = "interviews";
     if (!@mysql_select_db($DBName, $DBConnect))
          echo "<p>Unable to connect to the $DBName database!</p>";
     else {
          $SQLString="SELECT * FROM $TableName ORDER BY InterviewID";
          $QueryResult = @mysql_query($SQLString, $DBConnect);
          if ($QueryResult === FALSE)
               echo "<p>There was an error when executing the query.<br />\n" .
                              "The error was " . 
                              htmlentities(mysql_error($DBConnect)) .
                              ".<br />\nThe query was '" . 
                              htmlentities($SQLString) .
                              "'</p>\n";
          else if (mysql_num_rows($QueryResult)==0) 
               echo "<p>There are no interviews to display.</p>\n";
          else {
               echo "<table border='1' cellspacing='0'>\n";
               echo "<tr><th>ID</th>" . 
                    "<th>Interviewers Name</th>" . 
                    "<th>Position</th>" . 
                    "<th>Date of Interview</th>" . 
                    "<th>Candidates Name</th>" . 
                    "<th>Communication Abilities</th>" . 
                    "<th>Professional Appearance</th>" . 
                    "<th>Computer Skills</th>" . 
                    "<th>Business Knowledge</th>" . 
                    "<th>Interviewers Comments</th></tr>\n";
               while ($interview=mysql_fetch_assoc($QueryResult)) {
               echo "<tr><td>" . $interview['InterviewID'] . "</td>" . 
                    "<td>" . $interview['interviewer'] . "</td>" . 
                    "<td>" . $interview['position'] . "</td>" . 
                    "<td>" . $interview['interview_date'] . "</td>" . 
                    "<td>" . $interview['candidate'] . "</td>" . 
                    "<td>" . $interview['communication'] . "</td>" . 
                    "<td>" . $interview['appearance'] . "</td>" . 
                    "<td>" . $interview['computer_skills'] . "</td>" . 
                    "<td>" . $interview['business_knowledge'] . "</td>" . 
                    "<td>" . $interview['comments'] . "</td>" . 
                    "</tr>\n";
               }
               echo "</table>\n";
          }
     }
}
?>
<a href="InterviewDetails.php">Enter data for a new interview</a>
</body>
</html>
