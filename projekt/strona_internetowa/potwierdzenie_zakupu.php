<?php
	session_start();
	REQUIRE_ONCE "funkcje.php";


	if((!isset($_SESSION['ch_imie']))||(!isset($_SESSION['ch_nazwisko']))||(!isset($_SESSION['ch_email_1']))||(!isset($_SESSION['ch_email_2']))||(!isset($_SESSION['ch_telefon'])))
	{
		header('Location: metoda_platnosci.php'); // Dla przypadku gdyby ktoś wszedł na strone wpisując po url, wtedy wyśle do metoda_platnosci.php
		exit();
	}
	else
	{	
$_SESSION['ch_pl_imie']=$_POST['pl_imie'];  // Zmienne sesyjne które zawierają dane.
$_SESSION['ch_pl_master']=$_POST['pl_master']; 
$_SESSION['ch_pl_trzy_cyfry']=$_POST['pl_trzy_cyfry'];
$_SESSION['ch_pl_data']=$_POST['pl_data'];
$klientArray = array();
$klientArray = $_SESSION['klient_zakupy'];
$suma_platnosci = $_SESSION['suma_platnosci'];

if(walidacja_danych_karty($_SESSION['ch_pl_imie'],$_SESSION['ch_pl_master'],$_SESSION['ch_pl_trzy_cyfry'],$_SESSION['ch_pl_data']))
{
	
	$kod_weryfikacyjny = mt_rand(100000,999999);
	$rodzaj_platnosci = wybor_banku($_SESSION['ch_methods']);
	REQUIRE_ONCE "connect.php";
	mysqli_report(MYSQLI_REPORT_STRICT);
	
	try{
		$polaczenie = new mysqli($host, $db_user, $db_pass, $db_name);

		if($polaczenie->connect_errno != 0){
			throw new Exception(mysqli_connect_errno());
		}
		else{
			echo "Pomyślnie dokonano zakupu"."<br>";
			kupowanie($polaczenie,$_SESSION['ch_imie'],$_SESSION['ch_nazwisko'],$_SESSION['ch_email_1'],$_SESSION['ch_telefon'],$kod_weryfikacyjny,$suma_platnosci, $rodzaj_platnosci);
			echo"Twój kod weryfikacyjny to: ".$kod_weryfikacyjny."<br>";
			for($i=0;$i<sizeof($klientArray);$i++){	
				if($klientArray[$i][0]=='Bilet'){
					dodawanie_biletu($polaczenie, $klientArray[$i][0],$klientArray[$i][1],$klientArray[$i][2],$kod_weryfikacyjny);
				}
				elseif($klientArray[$i][0]=='Karnet'){
					$kod_weryfikacyjny_karnetu = mt_rand(10000000,99999999);
					dodawanie_karnetu($polaczenie, $klientArray[$i][0],$klientArray[$i][1],$klientArray[$i][2],$kod_weryfikacyjny,$kod_weryfikacyjny_karnetu);
					echo "Kod weryfikacyjny dla: ".$klientArray[$i][0]." ".$klientArray[$i][1]." ".$klientArray[$i][2]." -> ".$kod_weryfikacyjny_karnetu."<br>";
				}
				else{
					
				}
				
			}
			$polaczenie->close();
		}
	}
	catch(Exception $err)
	{
		echo "Informacja o błędzie: ".$err;
	}
	
	unset($_SESSION['ch_imie']);
	unset($_SESSION['ch_nazwisko']);
	unset($_SESSION['ch_email_1']);
	unset($_SESSION['ch_email_2']);
	unset($_SESSION['ch_telefon']);
	unset($_SESSION['ch_regulamin']);
	unset($_SESSION['ch_methods']);
	unset($_SESSION['ch_pl_imie']);  // Zmienne sesyjne które zawierają dane.
	unset($_SESSION['ch_pl_master']); 
	unset($_SESSION['ch_pl_trzy_cyfry']);
	unset($_SESSION['ch_pl_data']);
	}
	else
	{
	header('Location: platnosc.php'); // Dla przypadku gdyby ktoś wszedł na strone wpisując po url, wtedy wyśle do platnosc.php
	exit();
}
	}
