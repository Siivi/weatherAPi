<?php 
    $fileName = './cache.json';
    $cacheTime = 5;
    $url ='http://api.openweathermap.org/data/2.5/weather?appid=KEYd&q=Tallinn,ee&units=metric';
    $currentTime = time();

    if (file_exists($fileName) && (time() - filemtime($fileName) < $cacheTime)){
        //echo time() - filemtime($fileName);
        $file = fopen($fileName, 'r');
        $response = file_get_contents($fileName);
        fclose($file);
        
       // $json = json_decode($response);

        //echo "lugesin cache failist";

    } else {
       
        $response = file_get_contents($url);
        $file = fopen($fileName, 'w');
        fwrite($file, $response);
        fclose($file);

       

        //echo "lugesin apist";
    }

     $json = json_decode($response);
    //die();

    

    //echo $response;

   // var_dump($response);


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Estonian weather</title>
</head>
<body>
    <div class="container">
        <div class="name"><h1><?php echo $json->name;?> weather</h1>
            <div class="time">
                <div><?php echo date("l g:i a", $currentTime); ?></div>
                <div><?php echo date("j F, Y", $currentTime); ?></div>
                <div><?php echo ucwords($json->weather[0]->description); ?></div>
                <img src="http://openweathermap.org/img/wn/<?php echo $json->weather[0]->icon;?>@2x.png">
            </div>
            <div class="weather">
                <div>Temp <?php echo $json->main->temp;?> °С</div>
                <div>Feels like<?php echo $json->main->feels_like;?> °С</div>
                <div>Wind:<?php echo $json->wind->speed;?> km/h</div>
                <div>Humidity:<?php echo $json->main->humidity;?> %</div>
            </div>
        </div>
    </div>    
<!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>