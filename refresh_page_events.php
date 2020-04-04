
<html>
<body style="background-color:lightblue">
<form method="get" action="view_pages.php" align="center">
<input type="submit" value="Back">
</form>


<?php

$myname=$_GET["name1"];

$host="localhost";
$username="root";
$password="1234";
$db_name="db";
$table_name="events";


$conn = @mysql_connect("$host", "$username", "$password")or die("cannot connect");
mysql_set_charset('utf8',$conn);
mysql_select_db("$db_name")or die("cannot select DB");

$query="DELETE * FROM $table_name WHERE pagename='$myname'";
$result=mysql_query($query);

if(! $result )
{
  die('Could not update page data: ' . mysql_error());
}





mysql_close($conn); //Make sure to close out the database connection

?>
</body>
</html>