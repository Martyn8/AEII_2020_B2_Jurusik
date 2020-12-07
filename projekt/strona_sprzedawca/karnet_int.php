<?php
	session_start();
	REQUIRE_ONCE "funkcje.php";
	REQUIRE_ONCE "connect.php";
?>
<!DOCTYPE html>
<html lang="pl">
<head>
	<meta charset="UTF-8">
	<title>Karnety</title>
	<link rel="stylesheet" href="style.css">
	<script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
</head>
<body>

<div class="wrapper">
    <div class="sidebar">
        <h2>Klient lokalny</h2>
        <ul>
            <li><a href="index.php"><i class="fas fa-money-check-alt"></i>Sprzedaż biletów i karnetów</a></li>
            <li><a href="waznosc.php"><i class="fas fa-key"></i>Sprawdź ważność karnetu</a></li>
          </ul> 
          <h2 class="pls_down">Klient internetowy</h2>
        <ul> 
            <li><a href="zegarek.php"><i class="fas fa-stopwatch"></i>Wydanie zegarka</a></li>
            <li><a href="karnet_int.php"><i class="fas fa-hand-holding"></i>Wydanie karnetu</a></li>
        </ul> 
        <h2 class="pls_down">Rozliczenie</h2>
        <ul> 
        <li><a href="symulacja.php"><i class="fas fa-clock"></i>Symulacja czasu pobytu</a></li>
		<li><a href="rozliczenie.php"><i class="fas fa-hand-holding-usd"></i>Rozliczenie klienta</a></li>
        </ul> 
				<h2 class="pls_down">Wylogowanie</h2>
		<ul>
		<li><a href="wyloguj.php"><i class="fas fa-sign-out-alt"></i>Wyloguj</a></li>
		</ul>
    </div>
    <div class="main_content">
        <div class="header">Wydanie karnetu dla klienta internetowego na podstawie uzyskanego po zakupie kodu weryfikacyjnego.</div>  
        <div class="info">
          <div class="form">
          <form action="karnet_int.php" method="post"> <!-- Form-->
            <label for="ver_number"><h2>Kod weryfikacyjny:</h2></label><br>
            <div class="textbox">
            <input type="number" id="ver_number" name="kod_karnetu" placeholder="8-cyfrowy kod" ><br>
            </div>
            <input type="submit" class="button" value="Wydaj">
          </form> 
        </div>
		<p style="font-size: 23px;">
		<?php
			if(isset($_POST['kod_karnetu']) && strlen($_POST['kod_karnetu'])==8){
				$polaczenie = new mysqli($host, $db_user, $db_pass, $db_name);
	
				$kod_weryfikacyjny=$_POST['kod_karnetu'];
				
				$query = $polaczenie->query("SELECT data_aktywacji,cennik_id_cennika,id_karnetu,klient_id_klienta FROM karnet WHERE kod_weryfikacyjny_karnetu='$kod_weryfikacyjny';");
				$wiersz = $query->fetch_assoc(); // wszysktie bilety
				$id_klienta = $wiersz['klient_id_klienta'];
				$id_karnetu = $wiersz['id_karnetu'];
				$id_cennika = $wiersz['cennik_id_cennika'];
				$data_aktywacji_spr = $wiersz['data_aktywacji'];
				echo "<br />";
				
				$query = $polaczenie->query("SELECT czas FROM cennik WHERE id_cennika='$id_cennika';");
				$wiersz = $query->fetch_assoc(); // wszysktie bilety
				$czas=$wiersz['czas'];
				$liczba_dni=0;
				
				if($czas=="tygodniowy") $liczba_dni=7;
				else $liczba_dni=30;
					
				$query = $polaczenie->query("SELECT id_zegarka FROM zegarek WHERE klient_id_klienta IS NULL;");
				$id_zegarka_array = $query->fetch_all();
				$id_zegarka=$id_zegarka_array[0][0];
				// print_r($id_zegarka_array);
				
				
				
				echo "<br />";
				$czas_wejscia=date("Y-m-d H:i:s");
				$czas_aktywacji=date("Y-m-d");
				
				//$time = new DateTime("$czas_aktywacji");
				//$czas_aktywacji->add(new DateInterval('P' . $liczba_dni . 'D'));
				//$data_waznosci = $czas_aktywacji->format('Y-m-d');
				
				//increment 2 days
				if($czas=="tygodniowy"){
					$data_waznosci = strtotime($czas_aktywacji."+ 7 days");
					$data_waznosci=date("Y-m-d",$data_waznosci);
				}
				else{		
					$data_waznosci = strtotime($czas_aktywacji."+ 30 days");
					$data_waznosci=date("Y-m-d",$data_waznosci);
				}

						
				$query = $polaczenie->query("UPDATE zegarek SET klient_id_klienta='$id_klienta',bilet_id_biletu=NULL,karnet_id_karnetu='$id_karnetu',czas_wejscia='$czas_wejscia',czas_wyjscia=NULL WHERE id_zegarka='$id_zegarka';");
				if($query){
					if($data_aktywacji_spr==NULL){
						$query = $polaczenie->query("UPDATE karnet SET data_aktywacji='$czas_aktywacji', data_waznosci='$data_waznosci' WHERE kod_weryfikacyjny_karnetu='$kod_weryfikacyjny';");
					}
					echo "Zegarek ".$id_zegarka." został przydzielony."."<br>";
				}
				else{
					echo "Ten karnet jest w użyciu";
				}
				
				
				
				$polaczenie->close();
				
			}
			
		?>	</p>		
      </div>
    </div>
</div>

</body>
</html>