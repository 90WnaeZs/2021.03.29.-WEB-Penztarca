<?php
require "DB_Class.php";
session_start();

$db=new DB();
$db->Connection("penztarca");

$tomb;
$tomb = $db->selectUpload($_SESSION["userID"]);
?>

<!DOCTYPE html>
<html lang="HU">
<head>
<title>Pénztárca</title>
<link rel="stylesheet" href="pénztárca.css"/>
</head>

<body>
<ul id="menu">
<li><a href="regiszt.php">Regisztrálás</a></li>
<li><a href="">Rögzítés</a></li>
<li><a href="kimut.php">Kimutatások</a></li>
<li><a href="index.php">Kilépés</a></li>
</ul>
<div class="main_div">
<form action="" method="post">
            <!-- Jogcímek php-ból feltölteni -->
            <div class="form-group">
                <label for="jogcim">Jogcímek</label>
                <select name="jogcim" class="form-control" id="jogcim">
                    <option selected>Válasszon jogcímet</option>
                    <?php
                    foreach ($tomb as $key) {
                        echo "<option value=$key[ID_jogcim]>$key[jogcim]</option>";
                    }
                    ?>
                </select>
            </div>


            <button type="submit" name="kimu" id="kimu" class="button button-success">Kimutatás</button>

        </form>
</div>

</body>

</html>