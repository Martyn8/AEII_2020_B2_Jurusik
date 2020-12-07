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
        <div class="header">Wydanie zegarków dla biletów oraz przedstawienie kodów weryfikacyjnych karnetów.</div>  
        <div class="info">
		<p style="font-size: 23px;">
		<?php
			session_start();
			REQUIRE_ONCE "funkcje.php";
			REQUIRE_ONCE "connect.php";

		$wybor_platnosci = $_SESSION['paymentMethod'];
		$klientArray = array();
		$klientArray = $_SESSION['klient_zakupy'];
		$suma_platnosci = $_SESSION['suma_platnosci'];
		mysqli_report(MYSQLI_REPORT_STRICT);

		try{
			$polaczenie = new mysqli($host, $db_user, $db_pass, $db_name);

			if($polaczenie->connect_errno != 0){
				throw new Exception(mysqli_connect_errno());
			}
			else{
				$id_klienta=kupowanie_lokalne($polaczenie,$suma_platnosci,$wybor_platnosci);

				for($i=0;$i<sizeof($klientArray);$i++){	
					if($klientArray[$i][0]=='Bilet'){
						dodawanie_biletu_lokalne($polaczenie,$id_klienta, $klientArray[$i][0],$klientArray[$i][1],$klientArray[$i][2]);
					}
					elseif($klientArray[$i][0]=='Karnet'){
						$kod_weryfikacyjny_karnetu = mt_rand(10000000,99999999);
						dodawanie_karnetu_lokalne($polaczenie,$id_klienta, $klientArray[$i][0],$klientArray[$i][1],$klientArray[$i][2],$kod_weryfikacyjny_karnetu);
						echo "Kod weryfikacyjny dla: ".$klientArray[$i][0]." ".$klientArray[$i][1]." ".$klientArray[$i][2]." -> ".$kod_weryfikacyjny_karnetu."<br>";
					}			
				}
				$query = $polaczenie->query("SELECT id_biletu FROM bilet WHERE klient_id_klienta=$id_klienta;");
				$id_biletu_array = $query->fetch_all();
				$id_biletu = @$wiersz['id_biletu'];
				echo "<br />";
				$query = $polaczenie->query("SELECT id_zegarka FROM zegarek WHERE klient_id_klienta IS NULL;");
				$id_zegarka_array = $query->fetch_all();
			
				echo "<br />";
				$czas_wejscia=date("Y-m-d H:i:s");
				for($i=0; $i<sizeof($id_biletu_array); $i++){	
				  $id_biletu=$id_biletu_array[$i][0];
				  $id_zegarka=@$id_zegarka_array[$i][0];
				  
				  if($id_zegarka){
					$query = $polaczenie->query("UPDATE zegarek SET klient_id_klienta='$id_klienta',bilet_id_biletu='$id_biletu',karnet_id_karnetu=NULL,czas_wejscia='$czas_wejscia',czas_wyjscia=NULL WHERE id_zegarka='$id_zegarka';");
					echo "Zegarek ".$id_zegarka." został przydzielony."."<br>";
				  }
				  else{
					echo "Nie ma wolnego zegarka. <br>";
					exit();
				  }
				}


				$polaczenie->close();
			}
		}

		catch(Exception $err)
		{
			echo "Informacja o błędzie: ".$err;
		} ?></p>
	</div>
     </div>
    </div>
</div>

</body>
</html>
