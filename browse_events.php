
<html>
<body style="background-color:LightSeaGreen">
<form method="get" action="home_visitor.php" align="center">
<input type="submit" value="Πίσω">
</form>

<! display the possible search options - all forms submit to this page>

<h1 align = middle  size = '30'>Τα παρακάτω events έχουν καταχωρηθεί! </h1>
<hr>
<p align="center"> Αναζήτηση events με βάση μια λέξη-κλειδι: </p>

<form align = "center" method="post" action="<?php $_PHP_SELF ?>">
<input name = "filter" type="text" id="filter">
</form>
<hr>
<p align="center"> Ή αναζήτηση events με βάση την κατηγορία: </p>

<form align = "center" method="post" action="<?php $_PHP_SELF ?>">
<input name = "cat" type="text" id="cat">
</form>
<hr>

<p align="center"> Ή αναζήτηση events με βάση την ημερομηνία/ώρα (έτος-μήνας-ημέρα ): </p>

<form align = "center" method="post" action="<?php $_PHP_SELF ?>">
<table align="center">
<tr><td><pre>Ημερομηνία/ώρα Έναρξης :</pre> </td><td><input name = "startd" type="text" id="startd"></td></tr>
<tr><td><pre>Ημερομηνία/ώρα Λήξης :</pre> </td><td><input name = "endd" type="text" id="endd"></td></tr>
<tr><td><input name = "sub" type="submit" value='Αναζήτηση events' id="sub"></td></tr>
</table>
</form>
<hr>
<?php

$host="localhost";
$username="root";
$password="1234";
$db_name="db";
$table_name="events";

$conn = @mysql_connect("$host", "$username", "$password")or die("cannot connect");	//mysql connect
mysql_set_charset('utf8',$conn);	//connection encoding
echo "<meta charset='UTF-8'>";		//HTML encoding
mysql_select_db("$db_name")or die("cannot select DB");	//epilegei tin db
//Sumfwna me tin upobli8eisa timi mesw tis POST sximatizei to katallilo query alliws epilegei otidhpote
if(isset($_POST['filter'])){
	$filter =$_POST['filter'];	
	$query=	"SELECT * FROM $table_name WHERE (name LIKE '%$filter%' OR description LIKE '%$filter%' OR owner LIKE '%$filter%') ORDER BY startdate";
}
elseif(isset($_POST['cat'])){
	$cat =$_POST['cat'];	
	$query=	"SELECT * FROM $table_name WHERE (category LIKE '%$cat%' ) ORDER BY startdate";
}
elseif(isset($_POST['sub']) and isset($_POST['startd']) and isset($_POST['endd'])){
	$startd=$_POST['startd'];
	$endd=$_POST['endd'];
	$query="SELECT * FROM $table_name WHERE (startdate BETWEEN '$startd' AND '$endd') ORDER BY startdate";
}
else{
$query="SELECT * FROM $table_name ORDER BY startdate";

}
$result=mysql_query($query);

//echo twn query results entos tou HTML table
echo "<table border='5' width='800' align='center' bgcolor='#C0C0C0'>"; // arxi enos table tag se HTML
echo"<tr>";
echo"<td>" . "start date and time" . "</td><td>" . "name" . "</td><td>". "owner" . "</td><td>". "category" . "</td><td>". "picture"."</td>"; 
echo"</tr> <br>" ;
while($row = mysql_fetch_array($result)){   //Creates a loop to loop through results
echo "<tr>";
echo "<td>" . $row['startdate'] . "</td><td>" . $row['name'] . "</td><td>". $row['owner'] . "</td><td>". $row['category'] ."</td><td>"."<img width = 150 height = 150 src=" . $row['photo'] .">". "</td>"."</td>
<td>"."<form method='get' action='more_info.php' ><input type='submit' name ='submit' value='More..'><input type='hidden' name='name1' value='". $row['name'] ."' id='name1'></form>"."</td>"; 
//the above line contains an embedded html form within our table , on click it redirects to more_info.php with the events name as a known (hidden ) value  to display more information  
echo"</tr> <br>" ;
}

echo "</table>"; //kleisimo tou table se HTML

mysql_close($conn); //kleisimo tou database connection

?>

</body>
</html>