<html>
<head>
<meta charset="UTF-8">	<!Html encoding>
</head>
<body style="background-color:LightSeaGreen ">
<form method="get" action="actions_admin.php" align="center">
<input type="submit" value="Πίσω">
</form>
<p align="center">Παρακαλώ πληκτρολογήστε το όνομα του page και το URL του παρακάτω :</p>
<br>
<hr>

<?php	//arxi tou php kwdika

session_start();
if (!(isset($_SESSION['login']) && $_SESSION['login'] != '0')) {		//elegxei an o user ekane login epituxws mesw mias metablitis session
header ("Location: login_admin.php");	//an oxi kanei redirect stin login selida
}

if(isset($_POST['Add']))	//An kapoio page upobli8ike mesw self PHP form , sunexizoume me ton akolou8o kwdika
{
	
$host = "localhost";
$username = "root";
$password = "1234";
$db_name = "db";
$table_name="pageurls";
$table_name2="events";


$pagename = $_POST['apagename'];	//Get the name/URL	8eloume na kanoume pros8hkh mesw tis POST form 
$pageURL=$_POST['aURL'];
$token='CAAXBp6SRcpgBAFHTSqVu9rnlgzM9Og4WotMqKf8zWG1UIujs1wZCXk562euf5FMvDZBZANtjL9urQORcOVBV7ZBWIHucXWBGcZCZB4ZC4cjQBwF1jsinlG7JisXlhhJrEMxtnczKauRSkp4barkq24KaQ2GssrN0vXmbHUTXcIcW7GA9ovG04QMQ6S3ZB7DpDUU5qpZAnIHwewxnhNT2nZAR5a8ep4iZCISTl0ZD' ;

//orismos sunartisis pou elegxei an uparxei to fb url 

function url_exists($pageURL){
	     if ((strpos($pageURL,  "https")) === false){ $pageURL =  "https://" . $pageURL;} //pos8etei https an leipei
		 
		 
		 
	      if (is_array(@get_headers($pageURL)) && ((strpos($pageURL,  "facebook")) !== false))	//an to header request itan epituxes kai to page itan kapoio fb page
	          return true;
	     else
		 {return true;}
	}



If(url_exists("$pageURL")) { //an to dedomeno URL uparxei
	
$pageName= substr($pageURL, strrpos($pageURL, "/") + 1);  //pairnoume to onoma/id tou page,pou einai to substring meta tin teleutaia ka8eto
//$pagename=str_replace("?fref=ts","",$pagename);

// To protect from MySQL injection attacks
$pageName= @mysql_real_escape_string($pageName);
$requesturl= "https://graph.facebook.com/v2.4/" . $pageName ."?fields=events,category,picture,location,picture&access_token=".$token ;		//sximatizei to request sto API

$curl = curl_init();

// Set some options 
curl_setopt_array($curl, array(
    CURLOPT_RETURNTRANSFER => 1,
    CURLOPT_URL => $requesturl ,
	CURLOPT_SSL_VERIFYPEER => 0
));
// stelnei to request & apo8ikeuei tin apantisi sto $resp
$resp = curl_exec($curl);

// Close curl_close
//request($curl);
//apokwdikopoiei to JSON object , gia epeksergasia
$resp=(json_decode($resp, true));

//apo8ikeuei tis JSON metablites pou xreiazomaste
$image=$resp['picture']['data']['url'];
$category= $resp['category'];
$city=$resp['location']['city'];
$longitude=$resp['location']['longitude'];
$latitude=$resp['location']['latitude'];
// gia prostasia apo MySQL attacks
$category=@mysql_real_escape_string($category);
$city=@mysql_real_escape_string($city);


$cnt=0;

foreach ($resp ['events']['data'] as $value )	//gia ka8e event pou epistrefetai
{

	$list [$cnt] = $resp['events']['data'][$cnt]['id'];		//apo8ikeuei to id tou mesa ston pinaka
	
	$cnt=$cnt+1;	
}


$conn = @mysql_connect("$host", "$username", "$password")or die("cannot connect");	//connect to mysql
mysql_set_charset('utf8_general_ci');		//set connection encoding
mysql_select_db("$db_name")or die("cannot select DB");		//epilegei to table apo tin db

$query="INSERT INTO $table_name (URL, name , image) VALUES ('$pageURL', '$pageName','$image')" ;		//sximatizei to query - apo8ikeuei to page
$result=mysql_query($query);

if(! $result )
{
  die('Could not update page data: ' . mysql_error());
}
echo "page added successfully !<br>";
mysql_close($conn);


foreach ($list as $eventid)		//loop over events
{	
	
	$eventrequest= "https://graph.facebook.com/v2.4/" . $eventid ."?fields=description,category,name,owner,start_time,picture,privacy&access_token=".$token ;	//form the request to the API 
	$curl1 = curl_init();

// Set some options
curl_setopt_array($curl1, array(
    CURLOPT_RETURNTRANSFER => 1,
    CURLOPT_URL => $eventrequest ,
	CURLOPT_SSL_VERIFYPEER => 0
));
// Send the request & save response to $resp1
$resp1 = curl_exec($curl1);

// Close request
curl_close($curl1);

$resp1=(json_decode((string)$resp1, true));
//save to variables what we need from the JSON object
	$eventname=$resp1['name'];
	$description=$resp1['description'];
	$owner=$resp1['owner']['name'];
	$startdate=$resp1['start_time'];	
	$photo=$resp1['picture']['data']['url'];

	// To protect from MySQL injection attacks	
	$eventname=@mysql_real_escape_string($eventname);
	$description=@mysql_real_escape_string($description);
	$owner=@mysql_real_escape_string($owner);
	
	
	$conn = @mysql_connect("$host", "$username", "$password")or die("cannot connect"); //connect to mysql
	mysql_set_charset('utf8',$conn);
	
	mysql_select_db("$db_name")or die("cannot select DB");
	//sximatizei to query -apo8ikeuei ta event data gia auto to event
	$query="INSERT INTO $table_name2 (id, name, description , startdate ,owner ,city ,category ,photo ,longitude, latitude, pagename ) VALUES ('$eventid', '$eventname', '$description' , '$startdate' ,'$owner' , '$owner','$category','$photo','$longitude','$latitude','$pageName' )" ;
	
	$result1=mysql_query($query);
		if(! $result1 )
		{
		  die('Could not insert event: ' . mysql_error());
		}
		echo "page event saved ! <br>";
	mysql_close($conn); //close connection
	
} 




}Else{	//if URL doesnt exist
Echo"Άκυρο page URL ή κανένα Facebook page!";
}

}
else	//an tipota den exei upobli8ei stamataei to treximo tis php kai emfanizei tin parakatw html forma
{
?>

<form method="post" action="<?php $_PHP_SELF ?>">	 <! auth h form ypoballei stin selida tin eisodo tou xrhsth >
<table width="500" align="center"  bgcolor="#C0C0C0" >	<!mesw enos table>

<tr>
<td><pre>Όνομα Page :</pre></td>
<td><input name="apagename" type="text" id="apagename" size= "50"></td>
</tr>

<tr>
<td><pre>URL :</pre></td>
<td><input name="aURL" type="text" id="aURL" size= "50"></td>
</tr>

<tr>
<td>&nbsp;</td>
<td><input name="Add" type="submit"  value="Προσθήκη"></td>
<td>&nbsp;</td>

</tr>
</table>
</form>


<?php // o elegxos upobolis ginetai mesw tis php otan auto einai aparaitito
}
?>


</body>
</html>

