<!--Name: Deepti Rajput
   UIN: 660136229
   Chapter 8 Assignment -->

<!DOCTYPE html>
<head>
<title>Enter Interview Details</title>
</head>
<body>
<h1><font color='blue'>Interview Details</font></h1>
<?php
$ShowForm=FALSE;
$fields = array('interviewer', 'position', 'interview_date', 'candidate', 
               'communication', 'appearance', 'computer_skills', 
               'business_knowledge', 'comments');
$interview=array();
foreach ($fields as $field)
     $interview[$field]="";
if (isset($_POST['submit'])) {
     foreach ($fields as $field) {
          if ((!isset($_POST[$field])) || (strlen(trim(($_POST[$field])))==0)) {
               echo "<p>'$field' is a required field.</p>\n";
               $ShowForm=TRUE;
          }
          else if (($field=='interview_date') &&
                   (preg_match('/^\d{4}-\d{1,2}-\d{1,2}$/',$_POST[$field])==0)) {
               echo "<p>'$field' must be in the form <em>yyyy</em>-<em>mm</em>-<em>dd</em>.</p>\n";
               $ShowForm=TRUE;
          }
          else {
               $interview[$field]=stripslashes(trim($_POST[$field]));
          }
     }
     if ($ShowForm===FALSE) {
          $DBConnect = @mysql_connect("10.203.98.147", "drajp2", "Password123");
          if ($DBConnect === FALSE)
               echo "<p>Unable to connect to the database server.</p>\n"
                  . "<p>Error code " . mysql_errno()
                  . ": " . mysql_error() . "</p>\n";
          else {
               $DBName ="human_resources";
               if (!@mysql_select_db($DBName, $DBConnect))
                    echo "<p>Unable to connect to the $DBName database!</p>";
               else {
                    $TableName = "interviews";
                    $fieldstr="";
                    $valuestr="";
                    $connector="";
                    foreach ($fields as $field) {
                         $fieldstr .= $connector . $field;
                         $valuestr .= $connector . "'" . $interview[$field] . "'";
                         $connector=", ";
                    }
                    $SQLString = "INSERT INTO $TableName (" . $fieldstr .
                         ") VALUES ($valuestr)";
                    $QueryResult = @mysql_query($SQLString, $DBConnect);
                    if ($QueryResult === FALSE)
                         echo "<p>There was an error saving the record.<br />\n" .
                              "The error was " . 
                              htmlentities(mysql_error($DBConnect)) .
                              ".<br />\nThe query was '" . 
                              htmlentities($SQLString) .
                              "'</p>\n";
                    else {
                         echo "<p>The interview information was saved.</p>\n";
                    }
               }
          }
     }
}
else {
     $ShowForm=TRUE;
}
if ($ShowForm===TRUE) {
?>
<form action='InterviewDetails.php' method='POST'>
<table>
<tr><td align='right'>Interviewers Name</td><td align='left'>
     <input type='text' size='30' name='interviewer' value='<?php echo $interview['interviewer']; ?>' />
     </td></tr>
<tr><td align='right'>Position</td><td align='left'>
     <input type='text' size='80' name='position' value='<?php echo $interview['position']; ?>' />
     </td></tr>
<tr><td align='right'>Date of Interview</td><td align='left'>
     <input type='text' size='20' name='interview_date' value='<?php echo $interview['interview_date']; ?>' />
     <small>(must be in the form <em>yyyy</em>-<em>mm</em>-<em>dd</em>)</small></td></tr>
<tr><td align='right'>Candidates Name</td><td align='left'>
     <input type='text' size='30' name='candidate' value='<?php echo $interview['candidate']; ?>' />
     </td></tr>
<tr><td align='right'>Communication Abilities</td><td align='left'>
     <textarea cols='80' rows='6' name='communication'><?php echo $interview['communication']; ?></textarea>
     </td></tr>
<tr><td align='right'>Professional Appearance</td><td align='left'>
     <textarea cols='80' rows='6' name='appearance'><?php echo $interview['appearance']; ?></textarea>
     </td></tr>
<tr><td align='right'>Computer Skills</td><td align='left'>
     <textarea cols='80' rows='6' name='computer_skills'><?php echo $interview['computer_skills']; ?></textarea>
     </td></tr>
<tr><td align='right'>Business Knowledge</td><td align='left'>
     <textarea cols='80' rows='6' name='business_knowledge'><?php echo $interview['business_knowledge']; ?></textarea>
     </td></tr>
<tr><td align='right'>Interviewers Comments</td><td align='left'>
     <textarea cols='80' rows='6' name='comments'><?php echo $interview['comments']; ?></textarea>
     </td></tr>
<tr><td align='center' colspan='2'>
     <input type='reset' name='reset' value='Clear Form' /> &nbsp;
     <input type='submit' name='submit' value='Submit' />
     </td></tr>
</table>
<?php
}
?>
<a href="ListofInterview.php">View List of Interviews</a>
</body>
</html>
