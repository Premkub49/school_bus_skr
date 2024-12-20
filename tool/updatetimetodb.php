<?php
require("connect.php");
$hours = $_POST["hours"];
$minutes = $_POST["minutes"];
$id = $_POST["id"];
$sql = "UPDATE `userdata` SET `hours` = $hours ,`minutes` = $minutes WHERE `userID` = \"$id\";";
if(mysqli_query($connection,$sql)){
     echo "yes";
}
?>