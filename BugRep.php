<!--Name: Deepti Rajput
   UIN: 660136229
   Chapter 8 Assignment -->


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Update Bug report</title>
</head>
<body>

<form method="POST" action="BugRep.php">
<p>Product Name:<input type="text" name="Product_name" /></p>
<p>Version:<input type="text" name="Version" /></p>
<p>Type of hardware:<input type="text" name="Hardware" /></p>
<p>Operating system:<input type="text" name="Operatingsystem" /></p>
<p>Frequency of occurence:<input type="text" name="Frequency" /></p>
<p>Proposed Solution:<input type="text" name="Solution"/></p>

<p><input type="submit" name="submit"value="Click here to Update" /></p>
</form>
<a href="BugReport.html"><b>Go Back </b> </a>
<?php 
if(isset($_POST['submit']))
{

if(empty($_POST['Product_name'])||empty($_POST['Version'])||empty($_POST['Hardware'])||empty($_POST['Operatingsystem'])
||empty($_POST['Frequency'])||empty($_POST['Solution']))
{
echo"<br>Please fill complete details.\n";	
}
else
{
$DBConnect = @mysql_connect("10.203.98.147", "drajp2","Password123");

if ($DBConnect === FALSE)
echo "<p>Unable to connect to the database server.</p>". "<p>Error code " . mysql_errno(). ": " . mysql_error() . "</p>";
else 
{
$DBName = "Report";
if (!@mysql_select_db($DBName, $DBConnect)) 
{
$SQLstring = "CREATE DATABASE $DBName";
$QueryResult = @mysql_query($SQLstring,$DBConnect);
if ($QueryResult === FALSE)
echo "<p>Unable to execute the query.</p>". "<p>Error code " . mysql_errno($DBConnect). ": " . mysql_error($DBConnect). "</p>";
else
echo "<p>You are the first visitor!</p>";
}
mysql_select_db($DBName, $DBConnect);
$TableName = "BugReport";
$SQLstring = "TRUNCATE TABLE $TableName";
$QueryResult = @mysql_query($SQLstring, $DBConnect);

if ($QueryResult === FALSE)
echo "<p>Unable to create the table.</p>". "<p>Error code " . mysql_errno($DBConnect). ": " . mysql_error($DBConnect) ."</p>";
$Product_name = stripslashes($_POST['Product_name']);
$Version=stripslashes($_POST['Version']);
$Hardware=stripslashes($_POST['Hardware']);
$Operatingsystem=stripslashes($_POST['Operatingsystem']);
$Frequency=stripslashes($_POST['Frequency']);
$Solution=stripslashes($_POST['Solution']);

}

$SQLstring = "INSERT INTO $TableName VALUES('$Product_name','$Version','$Hardware','$Operatingsystem','$Frequency','$Solution')";
$QueryResult = @mysql_query($SQLstring, $DBConnect);
if ($QueryResult === FALSE)
echo "<p>Unable to execute the query.</p>". "<p>Error code " . mysql_errno($DBConnect). ": " . mysql_error($DBConnect) . "</p>";
else
echo "<h1>Updated Bug report is</h1>";
	
	$TableName = "BugReport";
$SQLstring = "SELECT * FROM $TableName";
$QueryResult = @mysql_query($SQLstring,$DBConnect);
echo "<table width='100%' border='1'>";
echo "<tr><th>Product_name</th><th>Version</th><th>Hardware</th><th>Operatingsystem</th><th>Frequency</th><th>Solution</th></tr>";
while (($Row = mysql_fetch_assoc($QueryResult)) !== FALSE)
	{
echo "<tr><td>{$Row['Product_name']}</td>";
echo "<td>{$Row['Version']}</td>";
echo "<td>{$Row['Hardware']}</td>";
echo "<td>{$Row['Operatingsystem']}</td>";
echo "<td>{$Row['Frequency']}</td>";
echo "<td>{$Row['Solution']}</td></tr>";
	
}


mysql_close($DBConnect);
}
}
?>
</body>
</html>