<?php
require_once('db.php');
 
if( isset($_GET['del']) )
{
$id = $_GET['del'];
$sql= "DELETE FROM cennik WHERE id_cennika='$id'";
$res = $polaczenie->query($sql) or die("Failed".mysqli_error($polaczenie));

$newid = $id-1;
$sql= "ALTER TABLE cennik AUTO_INCREMENT = $newid";
$res = $polaczenie->query($sql) or die("Failed".mysqli_error($polaczenie));

echo "<meta http-equiv='refresh' content='0;url=edit_price_list.php'>";
}
?>