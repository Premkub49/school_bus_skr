<?php
require("connect.php");
$id = $_POST['id'];
$sql = "SELECT * FROM userdata WHERE `userID` LIKE '{$id}';";
$result = mysqli_query($connection,$sql);
if($result){
$rows = mysqli_fetch_all($result,MYSQLI_ASSOC);
echo "{\"lat\":{$rows[0]['lat']},\"lng\":{$rows[0]['lng']}}";
}
?>