<?php

class DB
{
        protected $db_host;
        protected $db_user;
        protected $db_pwd;
        protected $db_con;

        function __construct()
        {
            $this->db_host="localhost";
            $this->db_user="root";
            $this->db_pwd="";
        }

        function __destruct()
        {

        }

        function Connection($dbname)
        {
            try
            {
                $this->db_con=new PDO("mysql:host=$this->db_host;dbname=$dbname",$this->db_user, $this->db_pwd);
            }
            catch(PDOException $e)
            {   
                //die("<h1>Kapcsolódási hiba!</h1><p>$e</p>");
            }
        }

        function Beléptetés($user,$pwd)
        { 
            $tomb[]=null;
            $res=$this->db_con->prepare("select ID_user from users where Nev= :pNev and Jelszo= :pPwd");
            $res->bindparam('pNev', $user);
            $res->bindparam('pPwd', $pwd);
            $res->execute();

            while($row=$res->fetch())
            {
                $tomb=$row;
            }

            $_SESSION["userID"]=$tomb[0];

        }

        function Regisztráció($user,$pw)
        {
            $succes=false;
            $van=false;

            $reg_sel=$this->db_con->prepare("SELECT * FROM users WHERE Nev= :pNev");
            $reg_sel->bindparam('pNev', $user);
            $row_sel=$reg_sel->execute();
            $row_sel=$reg_sel->fetch();

            if($row_sel>0)
            {
                echo "<script type='text/javascript'>alert('Van már ilyen nevű felhasználó!')</script>";
                $van=true;
            }
            else
            {
                $van=false;
            }

            if($van==false)
            {
                $reg=$this->db_con->prepare("INSERT INTO users(Nev,Jelszo) values(?,?)");

                $reg->bindparam(1,$user);
                $reg->bindparam(2,$pw);
                $reg->execute();

                if($reg)
                {
                    echo "<script type='text/javascript'>alert('Sikeres regisztráció!')</script>";
                    header("Location: regiszt.php");
                }
                else if($reg==false)
                {
                    echo "<script type='text/javascript'>alert('A regisztráció nem sikerült!')</script>";
                    header("Location: regiszt.php");
                }
            }
        }

        function selectUpload($uid)
        {
            $tomb;
            $res = $this->db_con->prepare("SELECT DISTINCT `penzek`.`ID_jogcim`,`jogcimek`.`jogcim` FROM `penzek` LEFT JOIN `jogcimek` ON `penzek`.`ID_jogcim` = `jogcimek`.`ID_jogcim` WHERE (`penzek`.`ID_user`= :uid) ORDER BY `jogcimek`.`jogcim` ASC ;");
            $res->bindParam(':uid', $uid);
            $res->execute();
            while ($row = $res->fetch()) {
                $tomb[] = $row;
            }
            return $tomb;
        }

	// Lekérdezés a kimutatáshoz
        function showData($uid, $jc)
        {
            $tomb;
            $res = $this->db_con->prepare("SELECT `penzek`.`datum`,`jogcimek`.`jogcim`, `penzek`.`kiadas`FROM `penzek` LEFT JOIN `jogcimek` ON `penzek`.`ID_jogcim` = `jogcimek`.`ID_jogcim`WHERE (`penzek`.`ID_user` = :Iduser) AND ( `jogcimek`.`ID_jogcim`= :jcim);");
            $res->bindParam(':Iduser', $uid);
            $res->bindParam(':jcim', $jc);
            $res->execute();
            while ($row = $res->fetch()) {
                $tomb[] = $row;
            }
            return $tomb;
        }
 }
    




?>