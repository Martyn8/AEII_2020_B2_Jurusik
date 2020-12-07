<?php
 
    session_start();
     
    function fetch_data()  
    {  
        $output = ''; 
       require_once "connect.php";
    
       $polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);
        
       if ($polaczenie->connect_errno!=0)
       {
           echo "Error: ".$polaczenie->connect_errno;
       }
       else
       {
           $sql = "SELECT COUNT(id_klienta) as ile FROM klient;";
           $result = $polaczenie->query($sql);
           
           if ($result->num_rows > 0){
               while ($row = $result->fetch_assoc()){
                   $roznica = $row['ile'] -60000;
                   $output .= "<tr><td>".'Frekwencja'."</td>
                   <td>".'60000'."</td>
                   <td>".$row['ile']."</td>
                   <td>".$roznica."</td></tr>";
               }
           }
   
           $sql = "select sum(kwota) as suma from platnosc";
           $result = $polaczenie->query($sql);
   
           if ($result->num_rows > 0){
               while ($row = $result->fetch_assoc()){
                   $roznica = $row['suma'] -1500000;
                   $output .= "<tr><td>".'Przychód'."</td>
               <td>".'1500000 zł'."</td>
               <td>".$row["suma"].' zł '."</td>
               <td>".$roznica.' zł '."</td></tr>";
               }
       }
   
           $sql = "select max(id_karnetu) as suma from karnet";
           $result = $polaczenie->query($sql);
   
           if ($result->num_rows > 0){
               while ($row = $result->fetch_assoc()){
                   $roznica = $row['suma'] -1000;
                   $output .= "<tr><td>".'Ilość karnetów'."</td>
               <td>".'1000'."</td>
               <td>".$row["suma"]."</td>
               <td>".$roznica."</td></tr>";
               }
       }
   
           $sql = "select max(id_biletu) as suma from bilet";
           $result = $polaczenie->query($sql);
   
           if ($result->num_rows > 0){
               while ($row = $result->fetch_assoc()){
                   $roznica = $row['suma'] -59000;
                   $output .= "<tr><td>".'Ilość biletów'."</td>
               <td>".'59000'."</td>
               <td>".$row["suma"]."</td>
               <td>".$roznica."</td></tr>";
               }
       }

       $sql = "select avg(czas) as suma from bilet";
       $result = $polaczenie->query($sql);

       if ($result->num_rows > 0){
           while ($row = $result->fetch_assoc()){
               $roznica = $row['suma'] -5;
               $output .= "<tr><td>".'Średni czas spędzany na basenie'."</td>
           <td>".'5 h'."</td>
           <td>".$row["suma"]."</td>
           <td>".$roznica.' h '."</td></tr>";
           }
   }
         return $output;  
    }
   }  
    if(isset($_POST["generate_pdf"]))  
    {  
         require_once('tcpdf\TCPDF-main\tcpdf.php');  
         $obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);  
         $obj_pdf->SetCreator(PDF_CREATOR);  
         $obj_pdf->SetTitle("Generate HTML Table Data To PDF From MySQL Database Using TCPDF In PHP");  
         $obj_pdf->SetHeaderData('', '', PDF_HEADER_TITLE, PDF_HEADER_STRING);  
         $obj_pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));  
         $obj_pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));  
         $obj_pdf->SetDefaultMonospacedFont('dejavusans');  
         $obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);  
         $obj_pdf->SetMargins(PDF_MARGIN_LEFT, '10', PDF_MARGIN_RIGHT);  
         $obj_pdf->setPrintHeader(false);  
         $obj_pdf->setPrintFooter(false);  
         $obj_pdf->SetAutoPageBreak(TRUE, 10);  
         $obj_pdf->SetFont('dejavusans', '', 11);  
         $obj_pdf->AddPage();  
         $content = '';  
         $content .= '  
         <h4 align="center">Raport operacyjny</h4><br /> 
         <table border="1" cellspacing="0" cellpadding="3">  
              <tr>  
                   <th width="25%"></th>  
                   <th width="30%">Planowe</th>  
                   <th width="15%">Wykonane</th>  
                   <th width="30%">Odchylenie od planu</th>  
              </tr>  
         ';  
         $content .= fetch_data();  
         $content .= '</table>';  
         $obj_pdf->writeHTML($content);  
         $content = utf8_encode($content);
         $obj_pdf->Output('file.pdf', 'I');  
    }  
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Raport operacyjny</title>
        <link rel="stylesheet" href="/projekt/strona_zarzadca/assets/style_general.css?v=<?php echo time(); ?>">
        <link rel="stylesheet" href="/projekt/strona_zarzadca/assets/style_operation_report.css">
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

        <div class="page_title"><h2>Raport operacyjny</h2></div>

        <div class="main">
        <form class="generuj_raport" method="post" style="align-self: center"> 
            <input class="button" onclick="" type="submit" name="generate_pdf" value="Wygeneruj raport operacyjny">
            </form>  

            <table class="operational_report">
                <tr>
                    <th></th>
                    <th>Planowe:</th>
                    <th>Wykonane:</th>
                    <th>Odchylenie od planu:</th>
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
                            $sql = "SELECT COUNT(id_klienta) as ile FROM klient;";
                            $result = $polaczenie->query($sql);
                            
                            if ($result->num_rows > 0){
                                while ($row = $result->fetch_assoc()){
                                    $roznica = $row['ile'] -60000;
                                    echo "<tr><td>".'Frekwencja'."</td>
                                    <td>".'60000'."</td>
                                    <td>".$row['ile']."</td>
                                    <td>".$roznica."</td></tr>";
                                }
                            }

/* 
                            $sql = "select sum(kwota) as suma from platnosc";
                            $sql2 = "select sum(kwota_dopłaty) as dopłata from doplata";
                            $result = $polaczenie->query($sql);
                            $result2 = $polaczenie->query($sql2);
                            echo $result2;
                            $result = $result->fetch_assoc();
                            $result2 = $result2->fetch_assoc();
                            $przychód =  $result +  $result2;
                            if ($result->num_rows > 0){
                                while ($row = $result->fetch_assoc()){
                                    $roznica = $przychód -1500000;
                                echo "<tr><td>".'Przychód'."</td>
                                <td>".'1500000 zł'."</td>
                                <td>".$przychód.' zł '."</td>
                                <td>".$roznica.' zł '."</td></tr>";
                                } */


                            $sql = "select sum(kwota) as suma from platnosc";
                            $result = $polaczenie->query($sql);

                            if ($result->num_rows > 0){
                                while ($row = $result->fetch_assoc()){
                                    $roznica = $row['suma'] -1500000;
                                echo "<tr><td>".'Przychód'."</td>
                                <td>".'1500000 zł'."</td>
                                <td>".$row["suma"].' zł '."</td>
                                <td>".$roznica.' zł '."</td></tr>";
                                }
                        }

                            $sql = "select max(id_karnetu) as suma from karnet";
                            $result = $polaczenie->query($sql);

                            if ($result->num_rows > 0){
                                while ($row = $result->fetch_assoc()){
                                    $roznica = $row['suma'] -1000;
                                echo "<tr><td>".'Ilość karnetów'."</td>
                                <td>".'1000'."</td>
                                <td>".$row["suma"]."</td>
                                <td>".$roznica."</td></tr>";
                                }
                        }

                            $sql = "select max(id_biletu) as suma from bilet";
                            $result = $polaczenie->query($sql);

                            if ($result->num_rows > 0){
                                while ($row = $result->fetch_assoc()){
                                    $roznica = $row['suma'] -59000;
                                echo "<tr><td>".'Ilość biletów'."</td>
                                <td>".'59000'."</td>
                                <td>".$row["suma"]."</td>
                                <td>".$roznica."</td></tr>";
                                }
                        }

                        $sql = "select avg(czas) as suma from bilet";
                        $result = $polaczenie->query($sql);

                        if ($result->num_rows > 0){
                            while ($row = $result->fetch_assoc()){
                                $roznica = $row['suma'] -5;
                            echo "<tr><td>".'Średni czas spędzany na basenie'."</td>
                            <td>".'5 h'."</td>
                            <td>".$row["suma"]."</td>
                            <td>".$roznica.' h '."</td></tr>";
                            }
                    }

                            echo "</table>";
                        }
                        $polaczenie->close();
                ?>

            </table>


        </div>

    </body>
</html>

