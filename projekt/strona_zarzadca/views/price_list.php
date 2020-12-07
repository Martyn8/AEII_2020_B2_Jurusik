<?php
 
    session_start();
     

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Cennik</title>
        <link rel="stylesheet" href="/projekt/strona_zarzadca/assets/style_price_list.css?v=<?php echo time(); ?>">
        <link rel="stylesheet" href="/projekt/strona_zarzadca/assets/style_general.css?v=<?php echo time(); ?>">

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

        <div class="page_title"><h2>Cennik</h2></div>

        <div class="main">
            <table class="price_list">
                <tr>
                    <th>Lp.</th>
                    <th>Typ</th>
                    <th>Rodzaj</th>
                    <th>Czas</th>
                    <!-- <th>Jednostka</th> -->
                    <th>Cena</th>
                </tr>
                
                <?php
                        require_once "connect.php";
 
                        $polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);
                         
                        if ($polaczenie->connect_errno!=0)
                        {
                            echo "Error: ".$polaczenie->connect_errno;
                        }
                        else
                        {
                            $sql = "select * from cennik";
                            $result = $polaczenie->query($sql);
                            $jednostka = '';
                            $bilet = "bilet";
                            $kara = "kara";
                            if ($result->num_rows > 0){
                                while ($row = $result->fetch_assoc()){
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
                                    <td>".$row["cena"].' zł'."</td></tr>";
                                    $jednostka = '';
                                }
                                echo "</table>";
                            }
                        }
                        $polaczenie->close();
                ?>
                
            </table>

        </div>

    </body>
</html>