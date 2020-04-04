<?php		//here we perform the access check for admins

$host="localhost";		//to connect to the database
$username="root";
$password="1234";
$db_name="db";
$table_name="administrators";

// Connect to server and select database.
@mysql_connect("$host", "$username", "$password")or die("cannot connect");  //mysql connection
mysql_select_db("$db_name")or die("cannot select DB");		//select our db

// username and password sent from form (POST method)
$myusername=$_POST['ausername'];
$mypassword=$_POST['apassword'];

// To protect from MySQL injection attacks
$myusername = @mysql_real_escape_string($myusername);
$mypassword = @mysql_real_escape_string($mypassword);
//form the query - check if the given values match our admin database values
$query="SELECT * FROM $table_name WHERE username='$myusername' and password='$mypassword'";
$result=mysql_query($query);

// Mysql_num_row is counting table row
$count=mysql_num_rows($result);

// If result matched $myusername and $mypassword, table row must be 1 row

if($count==1){

// Register $myusername, $mypassword as SESSION variables along with a login value and redirect to file "login_success.php"

session_start();
$_SESSION['login'] = "1";
$_SESSION['username'] = "$myusername";
$_SESSION['password'] = "$mypassword";
header("location:login_success.php");


}

else {
session_start();	//remember that he didnt login
$_SESSION['login'] = "0";
header("location:failed.php");
}
?>