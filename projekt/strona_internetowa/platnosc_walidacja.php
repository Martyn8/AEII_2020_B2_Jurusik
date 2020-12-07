<?php
	session_start();
	REQUIRE_ONCE "funkcje.php";

		$_SESSION['ch_imie']=$_POST['imie'];  // Zmienne sesyjne które zawierają dane.
		$_SESSION['ch_nazwisko']=$_POST['nazwisko']; 
		$_SESSION['ch_email_1']=$_POST['email_1'];
		$_SESSION['ch_email_2']=$_POST['email_2'];
		$_SESSION['ch_telefon']=$_POST['telefon'];
		$_SESSION['ch_regulamin']=$_POST['regulamin'];
		$_SESSION['ch_methods']=$_POST['methods'];

		if(walidacja_danych_platnosci($_SESSION['ch_imie'],$_SESSION['ch_nazwisko'],$_SESSION['ch_email_1'],$_SESSION['ch_email_2'],$_SESSION['ch_telefon'],$_SESSION['ch_methods'],$_SESSION['ch_regulamin']))
		{	
			header('Location: platnosc.php');
		}
		else
		{
			header('Location: metoda_platnosci.php');
			exit();
		}