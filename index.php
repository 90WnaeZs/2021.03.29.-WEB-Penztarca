<?php

require "DB_Class.php";

session_start();
$db=new DB();

$db->Connection("penztarca");


if(isset($_POST["submit"]) && isset($_POST["username"]) && isset($_POST["password"]))
{
    $user=$_POST["username"];
    $pw=$_POST["password"];

    $db->Beléptetés($user,$pw);

    if(isset($_SESSION["userID"]) && strlen($user)>=1 && strlen($pw)>=1)
    {
        header("Location: kimut.php");
    }
    else
    {
        echo "<script type='text/javascript'>alert('Hibás felhasználónév jelszó páros!')</script>";
    }

}
?>

<!DOCTYPE html>
<html>

<head>
<title>Pénztárca</title>
<link rel="stylesheet" href="pénztárca.css">
</head>

<body>
<div class="main_div">
<form id="login_form" action="" method="POST">
<label for="username">Felhasználónév</label>
<br>
<input type="text" id="username" name="username" placeholder="Írja be a felhasználónevét!" required minLength=1/>
<br><br>
<label for="password">Jelszó</label>
<br>
<input type="password" id="password" name="password" placeholder="Írja be a jelszavát!" required minLength=1/>
<br><br>
<input type="submit" id="submit" name="submit" value="Bejelentkezés"/>
</div>
</form>

</body>

</html>