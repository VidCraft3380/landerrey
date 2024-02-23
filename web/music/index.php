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
    $page_url= "../components/";
    $page_title = "";
    $page_style = $page_url."static/styles/sheets/music/";

    include("../components/views/blocs/head/index.php");
?>
<body>
    <?php 
        include("../components/views/blocs/header/index.php");
    ?>
    <main>
        <h1>MIS CANCIONES</h1>
        <section class="main__music">
            <?php 
                $search_music = "SELECT * FROM music Order By id Desc";

                $music_result = mysqli_query($connection, $search_music);

                while ($row = $music_result->fetch_assoc()) {

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
        </section>
    </main>
    <?php 
        include("../components/views/blocs/footer/index.php");
    ?>
    <?php 
        include("../components/static/js/script.php");
    ?>
</body>
</html>