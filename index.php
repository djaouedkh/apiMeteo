<?php 





        if (isset($_POST['submit'])) {
            
            $city = $_POST['city_name'];
            // 1 définir l'url qui contient notre api key
                $url = "https://api.openweathermap.org/data/2.5/weather?q=" . $city . "&lang=fr&units=metric&appid=f9f0ad6458ac6c6b758f4377ba092113";

            // 2 recuperer le contenu de cette url
                $raw = file_get_contents($url);
        
            // 3 comme le contenu est sous format json , en php pour récuperer des données sous format json faut le décoder
                $json = json_decode($raw);
        
            // 3.5 (optionnel) afficher le tout 
                // var_dump($json);
        
            // 4 recuperer l'info qui nous interesse dans le contenu qui est un ensemble d'objet et tableaux
                $name = $json->name;
                $weather = $json->weather[0]->main;
                $desc = $json->weather[0]->description;
                
                $temp = $json->main->temp;
                $feelsLike = $json->main->feels_like;
                
                $speed = $json->wind->speed;
                $deg = $json->wind->deg;
        }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container text-center py-5">

        <?php if (isset($_POST['submit'])){ ?>

            <h1>Météo du jour à <strong> <?php echo $name ?> </strong> </h1>

        <!-- -- afficher les icon meteo en fonction du temps -- -->
            <div class="row justify-content-center align-items-center">
                <?php 
                    switch ($weather) {
                        case 'Clear':
                        ?>
                            <div class="icon sunny">
                                <div class="sun">
                                    <div class="rays"></div>
                                </div>
                            </div>
                        <?php 
                        break;

                        case 'Drizzle':
                        ?>
                        <div class="icon sun-shower">
                            <div class="cloud"></div>
                            <div class="sun">
                                <div class="rays"></div>
                            </div>
                            <div class="rain"></div>
                        </div>
                        <?php 
                        break;

                        case 'Rain':
                        ?>
                        <div class="icon rainy">
                            <div class="cloud"></div>
                            <div class="rain"></div>
                        </div>
                        <?php 
                        break;

                        case 'Clouds':
                        ?>
                        <div class="icon cloudy">
                            <div class="cloud"></div>
                            <div class="cloud"></div>
                        </div>
                        <?php 
                        break;

                        case 'Thunderstorm':
                        ?>
                        <div class="icon thuder-storm">
                            <div class="cloud"></div>
                            <div class="lightning">
                                <div class="bolt"></div>
                                <div class="bolt"></div>
                            </div> 
                        </div>
                        <?php 
                        break;

                        case 'Snow':
                        ?>
                        <div class="icon flurries">
                            <div class="cloud"></div>
                            <div class="snow">
                                <div class="flake"></div>
                                <div class="flake"></div>
                            </div>
                        </div>
                        <?php
                        break; 
                    }
                    ?>

                    <div class="meteo_desc text-left">
                        <h2>
                            <?php echo $temp; ?> degré C <?php echo $speed; ?> Km/h <br>
                            <?php echo $desc; ?>
                        </h2>
                    </div>
                    
                
            </div>

        <?php } ?>

    </div>

    <form action='' method='post'>
        <input type='text' name='city_name' placeholder='Votre ville'>
        <input type='submit' name='submit' value='Valider'>
    </form>

</body>
</html>