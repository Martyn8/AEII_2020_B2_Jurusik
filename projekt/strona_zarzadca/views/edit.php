<?php  
include_once('db.php');  
error_reporting(0);
   
if( isset($_GET['edit']) )  
{  
$id = $_GET['edit'];  

$sql = "SELECT * FROM cennik WHERE id_cennika='$id'";
$res = $polaczenie->query($sql);

// $res= mysql_query("SELECT * FROM cennik WHERE id_cennika='$id'");  
// $row= mysql_fetch_array($res);  
$row = $res->fetch_array();
}  
   
if( isset($_POST['newtyp']) || isset($_POST['newrodzaj'])  || isset($_POST['newczas'])  || isset($_POST['newcena']) )  
{  
$newtyp = $_POST['newtyp'];  
$newrodzaj = $_POST['newrodzaj'];  
$newczas = $_POST['newczas'];  
$newcena = $_POST['newcena']; 

$id   = $_POST['id'];  
$sql     = "UPDATE cennik SET typ='$newtyp', rodzaj='$newrodzaj', czas='$newczas', cena='$newcena'   WHERE id_cennika='$id'";  
// $res  = mysql_query($sql)   
$res = $polaczenie->query($sql)
                                     or die("Could not update".mysqli_error($polaczenie));  
echo "<meta http-equiv='refresh' content='0;url=edit_price_list.php'>";  
}  
   
?>  

<html>
<head>
<link rel="stylesheet" href="/projekt/strona_zarzadca/assets/style_price_list.css?v=<?php echo time(); ?>">

</head>
<body>
<div class="main">
<div class="cennik_add2">

    <form class="edycja" action="edit.php" method="POST">  
             Typ: <input type="text" name="newtyp" value="<?php echo $row[1]; ?>"><br />  
            Rodzaj: <input type="text" name="newrodzaj" value="<?php echo $row[2]; ?>"><br />  
            Czas: <input type="text" name="newczas" value="<?php echo $row[3]; ?>"><br />  
            Cena: <input type="text" name="newcena" value="<?php echo $row[4]; ?>"><br />  

            <input type="hidden" name="id" value="<?php echo $row[0]; ?>">  
            <input type="submit" value=" Potwierdź "style="    margin: 30px;
    width: 200px;
    height: 75px; border-radius: 50px;"/>   
            
                
<!--         <table style="margin-left: 30px"  class="cennik_add_form">
            <tr><td>Typ: </td><td><input type="text" name="newtyp" value="<?php echo $row[1]; ?>"> </td></tr>
            <tr><td>Rodzaj: </td><td><input type="text" name="newrodzaj" value="<?php echo $row[2]; ?>"> </td></tr>
            <tr><td>Czas: </td><td><input type="text" name="newczas" value="<?php echo $row[3]; ?>"> </td></tr>
            <tr><td>Cena: </td><td><input type="text" name="newcena" value="<?php echo $row[4]; ?>"> </td></tr>
        </table>
        <input class="enter_price_list" type="submit" value=" Update " style="    margin: 30px;
    width: 200px;
    height: 75px; border-radius: 50px;"  />   -->
    </form> 

</div>

</div>    


</body>
</html>


