
<html>
<body style="background-color:LightSeaGreen ">
<form method="get" action="actions_admin.php" align="center">
<input type="submit" value="Πίσω">
</form>

<?php
session_start();
if (!(isset($_SESSION['login']) && $_SESSION['login'] != '0')) {		//elegxei an o user ekane login epituxws mesw mias metablitis session
header ("Location: login_admin.php");	//an oxi kanei redirect stin login selida 
}

$host="localhost";
$username="root";
$password="1234";
$db_name="db";
$table_name="pageurls";

$conn = @mysql_connect("$host", "$username", "$password")or die("cannot connect");    //connect to mysql
mysql_set_charset('utf8',$conn);		//kwdikas gia to connection 
mysql_select_db("$db_name")or die("cannot select DB");		//epilegei tin db
//form query - select all pages
$query="SELECT * FROM $table_name ";
$result=mysql_query($query);
//HTML mazi me PHP kwdikas me echo's.Dimiourgia enos table kai emfanisi twn query results
echo "<table border='10' width='100%' align='center' bgcolor='#C0C0C0'>"; // dimiourgia tou table tag se HTML

while($row = mysql_fetch_array($result)){   //Dimiourgei mia loop to loop through results
echo "<meta charset='UTF-8'>";	//HTML kwdikas
echo "<tr>";
echo "<td>" . $row['ID'] . "</td><td>" . $row['name'] . "</td><td>". $row['URL'] . "</td>" ."<td>". "<img width = 100 height = 100 src=" . $row['image'] .">". "</td>".
"<td>"."<form method='get' action='view_page_events.php' ><input type='submit' name ='submit' value='Page events'><input type='hidden' name='name1' value='". $row['name'] ."' id='name1'></form>"."</td>";  
//i parapanw grammi periexei mia enswmatwmeni HTML form mesa sto table,click sto button gia na kanei redirect sto view_page_events.php me to onoma selides ws gnwsth (krufh) timh gia na emfanisei ta events      
echo"</tr> <br>" ;
}

echo "</table>"; //kleisimo tou HTML table

mysql_close($conn); //kleisimo tou connection me tin basi dedomenwn

?>
</body>
</html>