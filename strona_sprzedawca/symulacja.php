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
        <div class="header">Symulacje pobytu klienta - zegarka w placówce.</div>  
        <div class="info">
          <div class="form">
          <form action="#"> <!-- Form-->
            <label for="watch_number"><h2>Numer zegarka:</h2></label><br>
            <div class="textbox">
            <input type="number" id="watch_number" name="watch_number" placeholder="Numer zegarka" ><br>
            </div>

            <label for="entry_time"><h2>Czas wejścia:</h2></label><br>
            <div class="textbox">
            <input type="time" id="entry_time" name="entry_time" placeholder="Czas wejścia" ><br>
            </div>

            <label for="exit_time"><h2>Czas wyjścia:</h2></label><br>
            <div class="textbox">
            <input type="time" id="exit_time" name="exit_time" placeholder="Czas wyjścia" ><br>
            </div>
            <h2>Korzystanie z atrakcji:</h2><br>
            <input type="checkbox" name="atrkacja1" style="margin-left: 15px;"><a>Atrakcja 1</a><br>
            <input type="checkbox" name="atrkacja2" style="margin-left: 15px;"><a>Atrakcja 2</a><br>
            <input type="checkbox" name="atrkacja3" style="margin-left: 15px;"><a>Atrakcja 3</a><br>
            <input type="checkbox" name="atrkacja4" style="margin-left: 15px;"><a>Atrakcja 4</a><br>

            <input type="submit" class="button" value="Symuluj">
          </form> 
        </div>
      </div>
    </div>
</div>

</body>
</html>