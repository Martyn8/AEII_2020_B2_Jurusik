<?php
	session_start();
?>
<?php
    $option = isset($_POST['hiddenPrice']) ? $_POST['hiddenPrice'] : false;
    if (!$option)
    {
        header("Location: seller.php");
        exit; 
    }
    
    $string = $_POST['hiddenList'];
    $array = explode(";", $string);
    $newArray = array();
    for ($i = 1; $i < sizeof($array); $i++)
    {
        $element = explode(" ", $array[$i]);
        $element[2] = trim($element[2], 'h');
        for($j=0;$j<3;$j++){
            $newArray[$i-1] =[$element[0],$element[1],$element[2]];
        }
    }

    $_SESSION['klient_zakupy']=$newArray;
    $_SESSION['suma_platnosci']=$_POST['hiddenPrice'];
    header("Location: metoda_platnosci.php");
?>