<?php
session_start();	
if (!(isset($_SESSION['login']) && $_SESSION['login'] != '0')) {	//elegxei an o user ekane login epituxws mesw mias metablitis session
header ("Location: login_admin.php");	//an oxi kanei redirect sto login page
}
?>

<html>
<body align="center" style="background-color:LightSeaGreen">
<p>Επιτυχής Σύνδεση ! <br>
Καλωσήλθες <?php echo $_SESSION['username'];?> <br>
Επέλεξε μία από τις παρακάτω ενέρειες.
</p>
<br>
<hr size="5" noshade align>
<!proboli energeiwn tou diaxeiristi>
<form method="get" action="actions_admin.php" align="center">
<input type="submit" value="Διαχείριση των event pages!">
</form>

<br>
<hr size="5" noshade align>
<! h aposundesi>
<form method="get" action="logout.php" align="center">
<input type="submit" value="Αποσύνδεση">
</form>


</body>
</html>


