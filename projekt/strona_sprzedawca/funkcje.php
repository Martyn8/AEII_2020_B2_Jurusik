<?php
	
function validate_email($email) {  //Walidacja czy email jest poprawny
    return (preg_match("/(@.*@)|(\.\.)|(@\.)|(\.@)|(^\.)/", $email) || !preg_match("/^.+\@(\[?)[a-zA-Z0-9\-\.]+\.([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/", $email)) ? false : true;
}

function validate_name_surname($imie) { //Walidacja czy imie czy nazwisko jest poprawne
    return (preg_match('/(*UTF8)^[A-ZĄĘÓŁŚŻŹĆŃ]{1}+[a-ząęółśżźćń]+$/i', $imie)) ? false : true;
}

function czytaj_kwote_doplaty_z_pliku(){
    $myfile = fopen("doplata.txt", "r") or die("Unable to open file!");
    $dane = fread($myfile,filesize("doplata.txt"));
    fclose($myfile);

    return $dane;
}

function czy_spoznienie_na_wyjsciu_z_basenu($wyjscie, $wejscie, $ile_godzin_na_bilecie){ //Funkcja do liczenia czy ycześtnik się spóźnił czy nie.
    $datetime1 = strtotime($wyjscie);
    $datetime2 = strtotime($wejscie);
	echo "Na bilecie był czas ".$ile_godzin_na_bilecie." h<br>";
	$secs = $datetime2 - $datetime1;
	// echo -$secs."<br>";
	// echo ($ile_godzin_na_bilecie*3600)."<br>";
	// echo (-$secs-($ile_godzin_na_bilecie*3600))."<br>";
	$ile_spoznienia = ceil((-$secs-($ile_godzin_na_bilecie*3600))/60);
	// echo -($ile_godzin_na_bilecie + $secs/3600)% 60;
    if($secs<$ile_godzin_na_bilecie*-3600){
		echo "Spoznienie o ".$ile_spoznienia." minuty<br>";
		// echo -($ile_godzin_na_bilecie - $secs*3600) % 60;
		return $ile_spoznienia;
    }
    else{
		echo "Brak spoznienia<br>";
		return 0;
    }
}

function walidacja_danych_platnosci($imie,$nazwisko,$email_1,$email_2,$telefon,$methods,$regulamin){
	//Funkcja do walidacji danych, jeśli jest nie prawidłowa to zmienna sesyjna zostanie usunięta.
	$all_ok=true;
	if(validate_name_surname($imie))
	{	
		$all_ok=false;
		$_SESSION['err_imie']='<br /><span style="color:red"><b>Imię nie może być puste, zawierać cyfr lub znaków specjalnych.</b></span>';
		unset($_SESSION['ch_imie']);
	}
	if(validate_name_surname($nazwisko))
	{
		$all_ok=false;
		$_SESSION['err_nazwisko']='<br /><span style="color:red"><b>Nazwisko nie może być puste, zawierać cyfr lub znaków specjalnych.</b></span>';
		unset($_SESSION['ch_nazwisko']);
	}
	if(!validate_email($email_1))
	{
		$all_ok=false;
		$_SESSION['err_email_1']='<br /><span style="color:red"><b>Zły adres email.</b></span>';
		unset($_SESSION['ch_email_1']);
	}
	if($email_1!=$email_2)
	{
		$all_ok=false;
		$_SESSION['err_email_2']='<br /><span style="color:red"><b>Email się nie zgadzania.</b></span>';
		unset($_SESSION['ch_email_2']);
	}
	if(!is_numeric($telefon)|| strlen($telefon)!=9)
	{
		$all_ok=false;
		$_SESSION['err_telefon']='<br /><span style="color:red"><b>Nie prawidłowy numer telefonu.</b></span>';
		unset($_SESSION['ch_telefon']);
	}
	if(!isset($methods))
	{
		$all_ok=false;
		$_SESSION['err_methods']='<br /><span style="color:red"><b>Nie wybrano metody płatności.</b></span>';
		unset($_SESSION['ch_methods']);
	}
	if(!isset($regulamin))
	{
		$all_ok=false;
		$_SESSION['err_regulamin']='<br /><span style="color:red"><b>Nie zaakpcetowano regulaminu.</b></span>';
		unset($_SESSION['ch_regulamin']);
	}
	return $all_ok;
}
		
function sesja_wypisz($x){ // Funkcja do wypisywani prawidłowych danych bądź komunikatów o błedzie
	if(isset($_SESSION[$x]))
	{
		echo $_SESSION[$x];
		unset($_SESSION[$x]);
	}
}	

function walidacja_danych_karty($imie,$nr_karty,$trzy_cyfry,$data_waznosci){
	
	$all_ok=true;
	if(validate_name_surname($imie))
	{	
		$all_ok=false;
		$_SESSION['err_pl_imie']='<br /><span style="color:red"><b>Imię nie może być puste, zawierać cyfr lub znaków specjalnych.</b></span>';
		unset($_SESSION['ch_pl_imie']);
	}
	if(!is_numeric($nr_karty)|| strlen($nr_karty)!=16)
	{
		$all_ok=false;
		$_SESSION['err_pl_master']='<br /><span style="color:red"><b>Nie prawidłowy numer karty.</b></span>';
		unset($_SESSION['ch_pl_master']);
	}
	if(!is_numeric($trzy_cyfry)|| strlen($trzy_cyfry)!=3)
	{
		$all_ok=false;
		$_SESSION['err_pl_trzy_cyfry']='<br /><span style="color:red"><b>Nie prawidłowy numer bezpieczeństwa.</b></span>';
		unset($_SESSION['ch_pl_trzy_cyfryr']);
	}
	if(@!is_numeric($data_waznosci[0]) || !is_numeric($data_waznosci[1]) || !is_numeric($data_waznosci[3]) || !is_numeric($data_waznosci[4]) || $data_waznosci[2]!='/' || strlen($data_waznosci)!=5)
	{
		$all_ok=false;
		$_SESSION['err_pl_data']='<br /><span style="color:red"><b>Nie prawidłowa data.</b></span>';
		unset($_SESSION['ch_pl_data']);
	}
	return $all_ok;
}
function wybor_banku($typ_banku){
        $banki=array('paypal','ing','visa','blik','bitcash','mastercard');
        return $banki[($typ_banku-1)];
};
function kupowanie($polaczenie, $imie, $nazwisko, $email, $telefon, $kod_weryfikacyjny, $kwota_suma, $rodzaj_platnosci){
	$polaczenie->query("INSERT INTO klient VALUES(NULL, '$imie', '$nazwisko', '$email', '$telefon', '$kod_weryfikacyjny');");
    $query = $polaczenie->query("SELECT id_klienta FROM klient WHERE kod_weryfikacyjny = '$kod_weryfikacyjny';");
    $wiersz = $query->fetch_assoc();
    $id_klienta = $wiersz['id_klienta'];
	
	$polaczenie->query("INSERT INTO platnosc VALUES(NULL, '$kwota_suma', '$rodzaj_platnosci', '$id_klienta');");
}

function kupowanie_lokalne($polaczenie,$suma_platnosci,$wybor_platnosci){
	$polaczenie->query("INSERT INTO klient VALUES(NULL, NULL, NULL, NULL, NULL, NULL);");
	$query = $polaczenie->query("SELECT MAX(id_klienta) FROM klient");
	$wiersz = $query->fetch_assoc();
	$id_klienta = $wiersz['MAX(id_klienta)'];
	$polaczenie->query("INSERT INTO platnosc VALUES(NULL, '$suma_platnosci', '$wybor_platnosci', '$id_klienta');");
	return $id_klienta;
}

function dodawanie_biletu($polaczenie, $typ_biletu,$rodzaj_biletu,$czas_biletu,$kod_weryfikacyjny){
	$query = $polaczenie->query("SELECT id_klienta FROM klient WHERE kod_weryfikacyjny = '$kod_weryfikacyjny';");
    $wiersz = $query->fetch_assoc();
	$id_klienta = $wiersz['id_klienta'];

	$query1 = $polaczenie->query("SELECT id_platnosci FROM platnosc WHERE klient_id_klienta = $id_klienta;");
    $wiersz1 = $query1->fetch_assoc();
    $id_platnosci = $wiersz1['id_platnosci'];
	
	$query2 = $polaczenie->query("SELECT id_cennika FROM cennik WHERE typ='$typ_biletu' AND rodzaj='$rodzaj_biletu' AND czas='$czas_biletu';");
    $wiersz2 = $query2->fetch_assoc();
    $id_cennika = $wiersz2['id_cennika'];

	$polaczenie->query("INSERT INTO bilet VALUES(NULL,'$typ_biletu','$rodzaj_biletu','$czas_biletu','$id_klienta','$id_platnosci','$id_cennika')");
}


function dodawanie_biletu_lokalne($polaczenie,$id_klienta, $typ_biletu,$rodzaj_biletu,$czas_biletu){
	$query1 = $polaczenie->query("SELECT id_platnosci FROM platnosc WHERE klient_id_klienta = $id_klienta;");
    $wiersz1 = $query1->fetch_assoc();
    $id_platnosci = $wiersz1['id_platnosci'];
	
	$query2 = $polaczenie->query("SELECT id_cennika FROM cennik WHERE typ='$typ_biletu' AND rodzaj='$rodzaj_biletu' AND czas='$czas_biletu';");
    $wiersz2 = $query2->fetch_assoc();
    $id_cennika = $wiersz2['id_cennika'];
	
	$polaczenie->query("INSERT INTO bilet VALUES(NULL,'$typ_biletu','$rodzaj_biletu','$czas_biletu','$id_klienta','$id_platnosci','$id_cennika')");
}

function dodawanie_karnetu($polaczenie, $typ_karnetu,$rodzaj_karnetu,$czas_karnetu,$kod_weryfikacyjny,$kod_weryfikacyjny_karnetu){
	$query = $polaczenie->query("SELECT id_klienta FROM klient WHERE kod_weryfikacyjny = '$kod_weryfikacyjny';");
    $wiersz = $query->fetch_assoc();
	$id_klienta = $wiersz['id_klienta'];

	$query1 = $polaczenie->query("SELECT id_platnosci FROM platnosc WHERE klient_id_klienta = $id_klienta;");
    $wiersz1 = $query1->fetch_assoc();
    $id_platnosci = $wiersz1['id_platnosci'];
	
	$query2 = $polaczenie->query("SELECT id_cennika FROM cennik WHERE typ='$typ_karnetu' AND rodzaj='$rodzaj_karnetu' AND czas='$czas_karnetu';");
	
    $wiersz2 = $query2->fetch_assoc();
    $id_cennika = $wiersz2['id_cennika'];

	

	$polaczenie->query("INSERT INTO karnet VALUES(NULL,'$typ_karnetu','$rodzaj_karnetu','$czas_karnetu',NULL,NULL,'$id_klienta','$id_platnosci','$id_cennika', '$kod_weryfikacyjny_karnetu')");
}
function dodawanie_karnetu_lokalne($polaczenie,$id_klienta, $typ_karnetu,$rodzaj_karnetu,$czas_karnetu,$kod_weryfikacyjny_karnetu){
	$query1 = $polaczenie->query("SELECT id_platnosci FROM platnosc WHERE klient_id_klienta = $id_klienta;");
    $wiersz1 = $query1->fetch_assoc();
    $id_platnosci = $wiersz1['id_platnosci'];
	
	$query2 = $polaczenie->query("SELECT id_cennika FROM cennik WHERE typ='$typ_karnetu' AND rodzaj='$rodzaj_karnetu' AND czas='$czas_karnetu';");
	
    $wiersz2 = $query2->fetch_assoc();
    $id_cennika = $wiersz2['id_cennika'];

	$polaczenie->query("INSERT INTO karnet VALUES(NULL,'$typ_karnetu','$rodzaj_karnetu','$czas_karnetu',NULL,NULL,'$id_klienta','$id_platnosci','$id_cennika', '$kod_weryfikacyjny_karnetu')");
}

function dodaj_czas_do_biletu($wejscie, $ile_minut)
{
	$time = new DateTime("$wejscie");
	$time->add(new DateInterval('PT' . $ile_minut . 'M'));
	$stamp = $time->format('Y-m-d H:i:s');
	return $stamp;
}