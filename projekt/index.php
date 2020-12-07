<?php
    session_start();
?>
<!-- strona logowania -->
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style_login_manager.css?v=<?php echo time(); ?>">
</head>

<body>

<form action="zaloguj.php" method="post"> 
<div class="login_box">
        <h1>Zaloguj się</h1>
        <!-- <h3>Konto zarządcy</h3> -->
        <div class="input_box">
            <input class="email" type="text" placeholder="Nazwa użytkownika" name="login" value="">
        </div>
        <div class="input_box">
            <input class="password" type="password" placeholder="Hasło" name="haslo" value="">
        </div>
        <input class="login_button" onclick="login()" type="submit" name="" value="Zaloguj">

        <div class="błąd">
    <?php
    if(isset($_SESSION['blad']))    echo $_SESSION['blad'];
?>
    </div>
    </div>
</form>
</body>
</html>