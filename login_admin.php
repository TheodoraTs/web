<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">	<!Html encoding>
</head>
<body style="background-color:LightSeaGreen">

<p style="text-align:center">Παρακαλώ πληκτρολογήστε το όνομα και τον κωδικό παρακάτω.
</p>
<br>
<hr>


<form  method="post" action="check_admin.php">   <!always use post with login forms - security - we submit our data to a php file for evaluation>

<table width="600" align="center"  bgcolor="#C0C0C0">	<!Html table entos tis form>

<tr>
<td colspan="10"><strong>Σύνδεση Διαχειριστή </strong></td>
</tr>

<tr>
<td><pre>Όνομα :</pre></td>
<td><input name="ausername" type="text" id="ausername" ></td>
</tr>

<tr>
<td><pre>Κωδικός :</pre></td>
<td><input name="apassword" type="password" id="apassword" ></td>
</tr>

<tr>
<td>&nbsp;</td>
<td><input type="submit" name="Submit" value="Σύνδεση"></td>
</tr>

</table>

</form>
<br>
<hr>


<form method="get" action="home.php" align="center"> <!form pou kanei redirection stin arxiki selida>
<input type="submit" value="Αρχική Σελίδα">
</form>

</body>
</html>