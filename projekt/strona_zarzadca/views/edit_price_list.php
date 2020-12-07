<?php
    session_start();
    require_once('db.php');  
   
if(isset($_POST['typ']) || isset($_POST['rodzaj']) || isset($_POST['czas']) || isset($_POST['cena']))
{  
  $typ = $_POST['typ'];  
  $rodzaj = $_POST['rodzaj']; 
  $czas = $_POST['czas']; 
  $cena = $_POST['cena']; 
   
  if($polaczenie->query("INSERT INTO cennik VALUES('','$typ','$rodzaj','$czas','$cena')"))  
echo "<meta http-equiv='refresh' content='0;url=edit_price_list.php'>";  
  else  
echo "Błąd";  
}  
   
$sql = "select * from cennik";
$res = $polaczenie->query($sql);
    
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Cennik</title>
        <link rel="stylesheet" href="/projekt/strona_zarzadca/assets/style_general.css?v=<?php echo time(); ?>">
        <link rel="stylesheet" href="/projekt/strona_zarzadca/assets/style_price_list.css?v=<?php echo time(); ?>">

    
    </head>

    <body>
        <div class="sidenav">
        <ul>
                <li><H3 class="list_title">Raporty</H3></li>
                <!-- <li><a href="management_report.php">Raport zarządczy</a></li>   -->
                <li><a href="operational_report.php">Raport operacynjy</a></li> 
                <li><H3 class="list_title">Cennik</H3></li>
                <li><a href="price_list.php">Wyświetl cennik</a></li>  
                <li><a href="edit_price_list.php">Edytuj cennik</a></li> 
                <li><a class="logout_btn" href="\projekt\strona_sprzedawca\wyloguj.php"><h3>Wyloguj się</h3></a></li>  
            </ul>
        </div>

        <div class="page_title"><h2>Edytuj cennik</h2></div>
        
        <div class="main">
        

            <div class="cennik_add">
                <form action="" method="POST">  

                <table class="cennik_add_form">
                <th style="margin-bottom: 20px">Dodaj rekord do bazy</th><th>Wpisz dane</th>
                <tr><td>Typ:</td><td><input type="text" name="typ"/></td></tr>
                <tr><td>Rodzaj:</td><td><input type="text" name="rodzaj"/></td></tr>
                <tr><td>Czas:</td><td><input type="text" name="czas"/></td></tr>
                <tr><td>Cena:</td><td><input type="text" name="cena"/></td></tr>

                </table>
                
                <input class="enter_price_list"  type="submit" value=" Potwierdź " style="    margin: 30px;
    width: 200px;
    height: 75px; border-radius: 50px;"/>  
                </form> 
                </div>

                <div>
            </div>

            <table class="price_list">
                <tr>
                    <th>Lp.</th>
                    <th>Typ</th>
                    <th>Rodzaj</th>
                    <th>Czas</th>
                    <th>Cena</th>
                    <th>Edycja</th>
                </tr>

<?php  

$jednostka = '';

if ($res->num_rows > 0){
    while ($row = $res->fetch_assoc()){
        if(in_array('Bilet', $row)){
            $czas=$row["czas"];
            switch ($czas){
            case 1:
                $jednostka = "godzina";
            break;
                case 3:
                    $jednostka = 'godziny';
                break;
                    case 5:
                        $jednostka = 'godzin';
                    break;
                        case 12:
                            $jednostka = 'godzin';
                        break;
                    default: echo "nie ma jednostki :(";
                    break;
            }

        }elseif(/* in_array('Kara', $row) &&  */in_array('Przedłużenie pobytu', $row)){
            $jednostka = "minuta";
        }
        elseif(/* in_array('Kara', $row) &&  */in_array('Atrakcja', $row)){
            $jednostka = "---";
          }
          elseif(/* in_array('Kara', $row) &&  */in_array('Zgubienie opaski', $row)){
            $jednostka = "---";
          }
        echo "<tr><td>".$row["id_cennika"]."</td>
        <td>".$row["typ"]."</td>
        <td>".$row["rodzaj"]."</td>
        <td>".$row["czas"]." ".$jednostka."</td>
                                    <td>".$row["cena"].' zł'."</td>
        <td>
        <button style='margin-right: 20px;'><a href='edit.php?edit=$row[id_cennika]'>Edytuj</a></button>   
        <button><a href='delete.php?del=$row[id_cennika]'>Usuń</a></button>   
        </td></tr>";
        $jednostka = '';
    }
    echo "</table>";
}
?> 
<button></button>   
</table>
        </div>
    </body>
</html>

