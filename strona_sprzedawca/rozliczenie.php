<!DOCTYPE html>
<html lang="pl">
<head>
	<meta charset="UTF-8">
	<title>Rozliczenie</title>
	<link rel="stylesheet" href="style.css">
	<script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
</head>
<body>

<div class="wrapper">
    <div class="sidebar">
        <h2>Klient lokalny</h2>
        <ul>
            <li><a href="index.php"><i class="fas fa-money-check-alt"></i>Sprzedaż biletów i karnetów</a></li>
            <li><a href="karnet_lokal.php"><i class="fas fa-hand-holding"></i>Wydanie zegarka</a></li>
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
    </div>
    <div class="main_content">
        <div class="header">Rozliczenie klienta na podstawie numeru zegarka i danych zawartych w bazie o jego pobycie w placówce.</div>  
        <div class="info">
          <div class="form">
          <form action="#"> <!-- Form-->
            <label for="watch_number"><h2>Numer zegarka:</h2></label><br>
            <div class="textbox">
            <input type="number" id="watch_number" name="watch_number" placeholder="Numer zegarka" ><br>
            </div>
            <label for="visit_time"><h2>Czas pobytu w minutach:</h2></label><br>
            <div class="textbox">
            <input type="number" id="visit_time" name="visit_time" placeholder="Czas pobytu" ><br>
            </div>
            <input type="submit" class="button" value="Rozlicz">
          </form> 
        </div>
      </div>
    </div>
</div>

</body>
</html>