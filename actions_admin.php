<?php
session_start();		//check if the user logged in successfully via a session variable
if (!(isset($_SESSION['login']) && $_SESSION['login'] != '0')) {
header ("Location: login_admin.php");  //if not redirect to the login page
}
?>
<! dislay all possible actions >
<html>
<body align="center" style="background-color:LightSeaGreen">

<form method="get" action="view_pages.php" align="center" valign="top" height="500">
<input type="submit" value="Προβολή των facebook event pages">
</form>

<br>
<hr>

<form method="get" action="add_page.php" align="center">
<input type="submit" value="Προσθήκη ενός facebook event page">
</form>

<br>
<hr>

<form method="get" action="delete_page.php" align="center">
<input type="submit" value="Διαγραφή ενός facebook event page">
</form>

<br>
<hr>

<form method="get" action="logout.php" align="center">
<input type="submit" value="Αποσύνδεση">
</form>


</body>
</html>
