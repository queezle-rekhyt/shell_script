<?php
if($_POST["username"]||$_POST["password"]){
    session_start();
    $_SESSION["username"]=$_POST["username"];
    $_SESSION["password"]=$_POST["password"];
    echo $_SESSION["username"]."<br>";
    echo $_SESSION["password"];
    header("Location:./success.php");
}else{
	echo "false";
	header("Location:./test.php");
}
?>
