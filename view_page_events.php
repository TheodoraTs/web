<!View the events of a given page as admin>
<html>
<body style="background-color:LightSeaGreen">
<form method="get" action="view_pages.php" align="center">
<input type="submit" value="Πίσω">
</form>


<?php

session_start();
if (!(isset($_SESSION['login']) && $_SESSION['login'] != '0')) {		//elegxei an o user ekane login epituxws mesw mias metablitis session 
header ("Location: login_admin.php");	//an oxi kanei redirect stin login selida 
}

$myname=$_GET["name1"];	//i krufh timh tis form ,mesw tis get

$host="localhost";
$username="root";
$password="1234";
$db_name="db";
$table_name="events";


$conn = @mysql_connect("$host", "$username", "$password")or die("cannot connect");	//mysql connect
mysql_set_charset('utf8',$conn);	//kwdikas sundesis 
mysql_select_db("$db_name")or die("cannot select DB");	//epilegei tin db
//sxhmatizei to query - Epilegei ola ta events pou sxetizontai me tin sugkekrimeni selida.
$query="SELECT * FROM $table_name WHERE pagename='$myname'";
$result=mysql_query($query);
//emfanizei ta events data mesa se ena HTML table 
echo "<table border='5' width='100%' align='center' bgcolor='#D8BFD8'>"; // dimiourgia enos table tag se HTML

while($row = mysql_fetch_array($result)){   //dimiourgei mia loop to loop through results - events

echo "<meta charset='UTF-8'>";	//HTML kwdikopoihsh

echo "<tr>";
echo "<td>" . $row['startdate'] . "</td><td>" . $row['name'] . "</td><td>". $row['owner'] . "</td>" ."<td>". "<img width = 100 height = 100 src=" . $row['photo'] .">". "</td>";
echo "</tr>";
echo "<tr>";
echo "<td>" . $row['description'] . "</td>" ;  
echo"</tr> <br>" ;
}

echo "</table>"; //kleisimo tou HTML table

mysql_close($conn); // kleisimo sundesis me ti basi dedomenwn

?>
</body>
</html>