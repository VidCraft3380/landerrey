<?php 
    $server = "185.166.188.206";
    $database = "u989003691_lander_rey";
    $username = "u989003691_admin";
    $password = "zDDaH!*>5";

    $connection = mysqli_connect($server, $username, $password, $database);

    if (!$connection) {
        die("Connection failed: " . mysqli_connect_error());
    }
?>
<!DOCTYPE html>
<html lang="es">
<?php 
    $page_url= "components/";
    $page_title = "";
    $page_style = $page_url."static/styles/sheets/home/";

    include("components/views/blocs/head/index.php");
?>
<body>
    <?php 
        include("components/views/blocs/header/index.php");
    ?>
    <main>
        <section class= "main__welcome" data-aos="fade-up">
            <div class= "welcome__logo">
                <img class= "logo__shadow" src="components/static/assets/logo/white.png" alt="Sombra del logo de Lander Rey" srcset="components/static/assets/logo/white.png">
                <img class= "logo__item" src="components/static/assets/logo/logo.png" alt="Logo de Lander Rey" srcset="components/static/assets/logo/logo.png">
            </div>
        </section>
        <section class= "main__last-video">
            <h1>MI ULTIMA CANCIÓN</h1>
            <div class= "last-video__item" data-aos="fade-down">
                <?php 
                    $sql = "SELECT * From music Order By id Desc";

                    $result = mysqli_query($connection, $sql);

                    $i = 0;

                    while ($row = $result->fetch_assoc()) {

                        $video = $row["video"];

                        $i++;

                        echo '<iframe src="'.$video.'" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';

                        if($i == 1){
                            break;
                        }
    
                    }
                ?>
            </div>
        </section>
        <section class="main__music">
            <?php 
                $search_music = "SELECT * FROM music Order By id Desc";

                $music_result = mysqli_query($connection, $search_music);

                $x = 0;

                while ($row = $music_result->fetch_assoc()) {

                    $x++;

                    if($x == 4){
                        break;
                    }

                    $name = $row["name"];
                    $image = $row["image"];
                    $youtube = $row["youtube"];
                    $spotify = $row["spotify"];
                    $ap = $row["apple_music"];
                    $artists = "Lander Rey ".$row["artists"];
                    $album = $row["album"];

                    $path_incomplete = substr($image, 26);
                    $path = "".$path_incomplete;

                    echo '<div class="music__item" data-aos="fade-right"  data-aos-duration="3200" style="background-image: url('.$path.');"><div class="item__header"><span class="header__title">'.$name.'</span><span class="header__artist">'.$artists.'</span><span class="header__album"></span></div><div class="item__social"><ul class="social__media"><li class="media__item yt"><a href="'.$youtube.'"></a></li><li class="media__item sp"><a href="'.$spotify.'"></a></li><li class="media__item ap"><a href="'.$ap.'"></a></li></ul></div></div>';

                }
            ?>
            <div class="music__more">
                <div class="more__button">
                    <a href="">Más</a>
                </div>
            </div>
        </section>
        <section class="main__bio" id="bio" data-aos="zoom-in"  data-aos-duration="3200">
            <div class="bio__item">
                <figure class="item__image">
                    <img src="content/images/bio/image.png" alt="Imagen de Lander Rey." srcset="content/images/bio/image.png">
                </figure>
                <div class="item__text">
                    <div class="text__quote"></div>
                    <div class="text__paragraph">
                        <p>Lander Rey nació en San Cristobal, República Dominicana. Artista y compositor de sus canciones, con influencias rítmicas de R&B, Reggaetón, Dancehall y Pop, comenzó su viaje por la música en un dúo a los 16 años en el pueblo que nació, el cual tuvo que dejar, mudándose a otra ciudad, Santo Domingo.</p>
                        <p>El interés por la música siempre ha estado presente en cada aspecto de la vida de Lander Rey, su inspiración viene de muchas influencias, como experiencia personales, artistas, de amistades o de ideas en el estudio. Entre los artistas latinos que lo inspiran están Don Omar, Farruko y Arcángel. Cómo también despertó interés por artistas anglosajones y sus colores musicales, como Chris Brown, Trey Songs y Neyo.</p>
                    </div>
                </div>
            </div>
        </section>
        <section class="main__thanks" data-aos="flip-right">
            <h3 class="thanks__title">Gracias a</h3>
            <figure class= "thanks__disco">
                <img src="components/static/assets/logo/producer.png" alt="Imagen del logo dels sello discografico FINO MUSIC" srcset="components/static/assets/logo/producer.png">
            </figure>
        </section>
    </main>
    <?php 
        include("components/views/blocs/footer/index.php");
    ?>
    <?php 
        include("components/static/js/script.php");
    ?>
</body>
</html>