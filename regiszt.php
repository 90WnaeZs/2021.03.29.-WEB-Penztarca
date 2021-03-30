<?php

require "DB_Class.php";

session_start();

$db=new DB();
$db->Connection("penztarca");

if(isset($_POST["reg_sub"]) && isset($_POST["reg_user"]) && isset($_POST["reg_pw"]) && isset($_POST["reg_pw2"]))
{
    $user=$_POST["reg_user"];
    $pw=$_POST["reg_pw"];
    $pw2=$_POST["reg_pw2"];

    if($pw==$pw2)
    {
        $db->Regisztráció($user,$pw);
    }
    else
    {
        echo "<script type='text/javascript'>alert('A két jelszó nem egyezik meg!')</script>";
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

<ul id="menu">
<li><a href="regiszt.php">Regisztrálás</a></li>
<li><a href="">Rögzítés</a></li>
<li><a href="kimut.php">Kimutatások</a></li>
<li><a href="index.php">Kilépés</a></li>
</ul>

<div class="main_div">

<br>
<form id="regiszt_form" action="" method="POST">
<label for="reg_user">Felhasználónév:</label><br>
<input type="text" id="reg_user" name="reg_user" placeholder="Írjon be egy felhasználónevet!" minLength="3" required/><br>
<label for="reg_pw">Jelszó:</label><br>
<input type="password" id="reg_pw" name="reg_pw" placeholder="Írja be a jelszavát!" minLength="6" required/><br>
<label for="reg_pw2">Jelszó megint:</label><br>
<input type="password" id="reg_pw2" name="reg_pw2" placeholder="Írja be ismét a jelszavát" required/><br><br><br>
<input type="submit" id="reg_sub" name="reg_sub" value="Regisztráció"/>
</form>

</div>

</body>

</html>