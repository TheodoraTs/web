
<html>
<body style="background-color:LightSeaGreen">
<form method="get" action="home_visitor.php" align="center">
<input type="submit" value="Πίσω">
</form>
<br>
<br>
<br>
<h1 align = middle  size = '30'>Τα παρακάτω events έχουν καταχωρηθεί! </h1>
<hr>
<?php

$host="localhost";
$username="root";
$password="1234";
$db_name="db";
$table_name="events";

$conn = @mysql_connect("$host", "$username", "$password")or die("cannot connect");	//mysql connect
mysql_set_charset('utf8',$conn);	//connection encoding
mysql_select_db("$db_name")or die("cannot select DB");	//epilegei tin db
// sximatizei to query-epilegei ola ta events
$query="SELECT * FROM $table_name order by startdate";
$result=mysql_query($query);

//display all events within a table
echo "<table border='5' width='100%' align='center' bgcolor='#C0C0C0'>"; // arxi enos table tag se HTML
echo"<tr>";		//top row
echo"<td>" . "start date and time" . "</td><td>" . "name" . "</td><td>". "owner" . "</td><td>". "category" . "</td><td>". "picture"."</td>"; 
echo"</tr> <br>" ;

while($row = mysql_fetch_array($result)){   //Creates a loop to loop through results
echo "<meta charset='UTF-8'>";	//HTML encoding definition
echo "<tr>";
echo "<td>" . $row['startdate'] . "</td><td>" . $row['name'] . "</td><td>". $row['owner'] . "</td><td>". $row['category'] ."</td><td>"."<img width = 100 height = 100 src=" . $row['photo'] .">". "</td>"."</td>
<td>"."<form method='get' action='more_info.php' ><input type='submit' name ='submit' value='More..'><input type='hidden' name='name1' value='". $row['name'] ."' id='name1'></form>"."</td>"; 
//the above line contains an embedded html form within our table , on click it redirects to more_info.php with the events name as a known (hidden ) value  to display more information  
echo"</tr> <br>" ;
}

echo "</table>"; //Close the table in HTML

mysql_close($conn); //Make sure to close out the database connection

?>
</body>
</html>