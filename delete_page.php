<html>
<body style="background-color:LightSeaGreen">

<form method="get" action="actions_admin.php" align="center">
<input type="submit" value="Πίσω">
</form>

<p align="center">Παρακαλώ πληκτρολογήστε το ID του page που θέλετε να διαγράψετε παρακάτω :</p>
<br>
<hr>

<?php		//start running php code

session_start();
if (!(isset($_SESSION['login']) && $_SESSION['login'] != '0')) {		//check if the user logged in successfully via a session variable
header ("Location: login_admin.php");	//if not redirect to the login page
}

if(isset($_POST['Delete']))		//If a page table id was submitted via self PHP form , we run the following code
{

$host = "localhost";
$username = "root";
$password = "1234";
$db_name = "db";
$table_name="pageurls";
$table_name2="events";

$conn = @mysql_connect("$host", "$username", "$password")or die("cannot connect");	//mysql connect

$pageid = $_POST['anid'];	//Get the tableid we want to delete via the POST form

mysql_select_db("$db_name")or die("cannot select DB");	//select our db
//form a query to get the pagename(id) in order to delete the page's events aswell
$query="SELECT name FROM $table_name WHERE ID = '$pageid' ";
$result=mysql_query($query);
while($row = mysql_fetch_array($result)){ 
$deletedpage= $row['name'];

}

if(! $result )
{
  die('Could not fetch data: ' . mysql_error());
}
//The first query deletes the page , the secont deletes the events associated with it
$query1="DELETE FROM $table_name WHERE ID = '$pageid' " ;
$query2="DELETE FROM $table_name2 WHERE pagename = '$deletedpage' " ;

$result1=mysql_query($query1);
$result2=mysql_query($query2);

if(! $result1 )
{
  die('Could not delete page..: ' . mysql_error());
}
if(! $result2 )
{
  die('Could not delete page events..: ' . mysql_error());
}

echo "το page και τα events του διαγράφηκαν επιτυχώς !\n";
mysql_close($conn); //close the connection
}
else		//if nothing was submitted stop running php and display the html form below
{
?>

<form method="post" action="<?php $_PHP_SELF ?>">		 <! this form submits to this page the user's input>
<table width="500" align="center"  bgcolor="#C0C0C0" >

<tr>
<td><pre>Page ID :</pre></td>
<td><input name="anid" type="text" id="anid"></td>
</tr>


<tr>
<td>&nbsp;</td>
<td><input name="Delete" type="submit" value="Διαγραφή"></td>
<td>&nbsp;</td>

</tr>
</table>
</form>

<?php		// the submission check is done within php so this is necessary
}
?>
</body>
</html>

