<!DOCTYPE html>
<html>
<html lang="en">
 <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
 </head>
<body style="background-color:LightSeaGreen">

<h1 align="center">Welcome!</h1>

<div class="container">
<p class="text-center">Επιλέξτε αν είστε διαχειριστής ή επισκέπτης. </p>

</div>

<!basic redirection form for admin/visitor>
<div class="container">
<form method="get" action="login_admin.php" align="center">
<input type="submit" value="Διαχειριστής">
</form>

<center><img  src="admin.jpg"  width="150" height="150" ></center>
</div>
<hr>
<div class="container">
<form method="get" action="home_visitor.php" align="center">
<input type="submit" value="Επισκέπτης">
</form>
<center><img src="visitor.jpg"  width="150" height="150" ></center>
</div>

</body>
</html>