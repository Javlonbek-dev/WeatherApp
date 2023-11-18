<?php
$error = "";
if (array_key_exists('submit', $_POST)) {
    if (!isset($_POST['city']) || empty(trim($_POST['city']))) {
        $error = "Sorry, Your Input field is empty";
    }
    if ($_POST['city']) {
        $apiData = file_get_contents("https://api.openweathermap.org/data/2.5/weather?q=" .
            $_POST['city'] . "&appid=db9dcb6082a1eba19d758978b004c0cd");
        $weatherArry = json_decode($apiData, true);
        $tempSilse = $weatherArry['main']['temp'] - 273;
        $weather = "<b>" . $weatherArry['name'] . "," . $weatherArry['sys']['country'] . ":" . intval($tempSilse) . "&deg;C</b> <br>";
        $weather .= "<b> Weather Condition : </b>" . $weatherArry['weather']['0']['description'] . "</br>";
        $weather .= "<b> Atmosperic Pressure :</b>" . $weatherArry['main']['pressure'] . "hPa <br>";
        $weather .= "<b> Wind Speed : </b>" . $weatherArry['wind']['speed'] . "meter/sec";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Document</title>
</head>

<body>

    <div class="container">
        <h1>Search Global Weather</h1>
        <form action="" method="post">
            <input type="text" name="city" id="city" placeholder="City Name">
            <button type="submit" name="submit" class="btn btn-success">Submit</button>
            <div class="output">
                <?php
                if ($weather) {
                    echo '<div class="alert alert-success" role="alert">
    ' . $weather . '
  </div>';
                } else if ($error) {
                    echo '<div class="alert alert-danger" role="alert">
    ' . $error . '
  </div>';
                }
                ?>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>