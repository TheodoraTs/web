
<html>
<body style="background-color:LightSeaGreen">
<form method="get" action="view_events.php" align="center">
<input type="submit" value="Πίσω">
</form>

<?php
$myname=$_GET["name1"];	//h krufh timh ths formas ,mesw tis get


$host="localhost";
$username="root";
$password="1234";
$db_name="db";
$table_name="events";

$conn = @mysql_connect("$host", "$username", "$password")or die("cannot connect");	//mysql connect
mysql_set_charset('utf8',$conn);	//connection encoding
mysql_select_db("$db_name")or die("cannot select DB");	//epilegei tin db
//form query-select the event from db
$query="SELECT * FROM $table_name WHERE name='$myname'";
$result=mysql_query($query);
//emfanisi olwn twn pliroforiwn twn events entos enos HTML table
echo "<table border='5' width='100%' align='center' bgcolor='#C0C0C0'>"; // arxi enos table tag se HTML

while($row = mysql_fetch_array($result)){   //dimiourgia mias  loop to loop through results
echo "<meta charset='UTF-8'>";	//HTML encoding
$la=$row['latitude'];
$lo=$row['longitude'];
echo "<tr>";
echo "<td>" . $row['startdate'] . "</td><td>" . $row['name'] . "</td><td>". $row['owner'] . "</td>" ."<td>". "<img width = 100 height = 100 src=" . $row['photo'] .">". "</td>";
echo "</tr>";
echo "<tr>";
echo "<td>" . $row['description'] . "</td>"."<td colspan=3 ><div id='map-canvas'></div></td>" ;  	// orizei ena tmhma mesa sto table gia na emfanizei to xarth mesa se auto.
echo"</tr> <br>" ;
}

echo "</table>"; //kleisimo tou HTML table

mysql_close($conn); // kleisimo tou database connection

?>

<style>
      #map-canvas {
        width: 500px;
        height: 400px;
      }
    </style>
    <script src="https://maps.googleapis.com/maps/api/js"></script>
    <script>
      function initialize() {
		var longitude =<?php echo $lo ?>; 	//lambanei tis antistoixes times apo tis php metablites
		var latitude=<?php echo $la ?>; 
		 
        var mapCanvas = document.getElementById('map-canvas');
        var mapOptions = {	//map options
          center: new google.maps.LatLng(latitude, longitude),
          zoom: 15,
          mapTypeId: google.maps.MapTypeId.ROADMAP
        }
        var map = new google.maps.Map(mapCanvas, mapOptions)	//orismos tou marker 
		var marker = new google.maps.Marker({
		  position: new google.maps.LatLng(latitude, longitude),
		  map: map,
		  
			});
      }
      google.maps.event.addDomListener(window, 'load', initialize);	//fortwnei & arxikopoiei ton xarth

    </script>

</body>
    
</html>