<?php
require("tool/connect.php");
if(isset($_GET["id"])){
    $id = $_GET["id"];
}
$sql = "SELECT  * FROM userdata WHERE `userID`  = $id;";
$result = mysqli_query($connection,$sql);
$rows = mysqli_fetch_all($result,MYSQLI_ASSOC);
echo "{\"hours\":{$rows[0]['hours']},\"minutes\":{$rows[0]['minutes']},\"id\":{$rows[0]['userID']}}";
?>