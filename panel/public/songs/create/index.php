<?php 

    include("C:/xampp/htdocs/lander_rey/panel/components/inc/tools/CRUD/index.php");

?>
<!DOCTYPE html>
<html lang="es">
<?php 
    $style_url= "../../../";
    $style = "create_songs";
    include("C:/xampp/htdocs/lander_rey/panel/components/views/blocs/head/index.php");

?>
<body>
    <?php 

        include("C:/xampp/htdocs/lander_rey/panel/components/inc/config/db/index.php");

        include("C:/xampp/htdocs/lander_rey/panel/components/views/blocs/header/index.php");

    ?>
    <main>
        <section class="main__form" >
            <form action="" method="POST" class="form__fields" enctype="multipart/form-data">
                <label for="" class="field__name">
                    <span>Nombre de la cancion</span>
                    <input type="text" id="form_name" name="form_name" required autocomplete="off"> 
                </label>
                <label for="" class="field__image">
                    <span>Imagen de la cancion</span>
                    <input type="file" id="form_image" name="form_image" required accept="image/*">
                    <label for="form_image"></label>
                </label>
                <label for="" class="field__video">
                    <span>Video de YouTube</span>
                    <input type="url" id="form_video" name="form_video" required autocomplete="off"> 
                </label>
                <label for="" class="field__yt">
                    <span>Enlace a YouTube</span>
                    <input type="url" id="form_yt" name="form_yt" required autocomplete="off"> 
                </label>
                <label for="" class="field__sp">
                    <span>Enlace a Spotify</span>
                    <input type="url" id="form_sp" name="form_sp" required autocomplete="off"> 
                </label>
                <label for="" class="field__ap">
                    <span>Enlace a Apple Music</span>
                    <input type="url" id="form_ap" name="form_ap" required autocomplete="off"> 
                </label>
                <label for="" class="field__artists">
                    <span>¿Hay colaboradores?</span>
                    <input type="text" id="form_artists" name="form_artists" placeholder="Si no hay dejelo vacio"  autocomplete="off"> 
                </label>
                <label for="" class="field__album">
                    <span>Album</span>
                    <select name="form__album" id="form__album" required>
                        <option value="NULL">Cancion individual</option>
                        <?php 

                            $sql = "SELECT * FROM albums";

                            $result = mysqli_query($connection, $sql);

                            while ($row = $result->fetch_assoc()) {

                                $album = $row["name"];

                                echo '<option value="'.$album.'">'.$album.'</option>';
                            }

                        ?>
                    </select>
                </label>
                <label for="" class="field__name">
                    <button id="form_button" name="form_button" type="submit">Añadir</button>
                </label>
            </form>
        </section>
    </main>
</body>
</html>
<?php 

    if(isset($_POST['form_name']) && isset($_POST['form_button'])) {

        $file_str = $_FILES['form_image']['name'];
        $file = str_replace(" ", "+", $file_str);

        $name_incomplete = $_POST['form_name'];
        $name = str_replace(" ", "+", $name_incomplete);
        $video = $_POST['form_video'];
        $yt = $_POST['form_yt'];
        $sp = $_POST['form_sp'];
        $ap = $_POST['form_ap'];
        $artist = $_POST['form_artists'];
        $album = $_POST['form__album'];

        if (isset($file) && $file != "" && $name != "") {

            $type = $_FILES['form_image']['type'];
            $size = $_FILES['form_image']['size'];
            $temp = $_FILES['form_image']['tmp_name'];

            if (!((strpos($type, "gif") || strpos($type, "jpeg") || strpos($type, "jpg") || strpos($type, "png")))) {
                echo '<div><b>Error. La extensión o el tamaño de los archivos no es correcta.<br/>';
            }
            else {

                $path = "../../../../media/images/songs/".$name."/";

                if (!file_exists($path)) {
                    mkdir($path, 0777, true);

                    if (move_uploaded_file($temp, $path.$file)) {

                        chmod($path.$file, 0777);

                        $path_file = "C:/xampp/htdocs/lander_rey/media/images/songs/".$name."/".$file;

                        $path_incomplete = substr($path_file, 26);
                        $path_image = "../../..".$path_incomplete;

                        $register_sql_list = "SELECT count(*) FROM music";
                        $register_sql = intval($register_sql_list)+1;

                        $sql = "INSERT INTO music (id, name, image, video, youtube, spotify, apple_music, artists, album) VALUES ('{$register_sql}', '{$name}', '{$name}', '{$path_file}', '{$video}', '{$yt}', '{$sp}', '{$ap}', '{$artist}', '{$album}')";

                        mysqli_query($connection, $sql);

                        //-$subject = "Nueva canción"; 

                        /*$mail_body = ' 
                        <html>
                            <head>
                                <title>Nueva canción</title>
                            </head>
                            <style>
                                figure {
                                    display: block;
                                    width: 200px;
                                    height: 200px;
                                    margin-bottom: 30px;
                                }
                                figure img {
                                    display: block;
                                    width: 200px;
                                    height: 200px;
                                }
                                .main__title {
                                    display: block;
                                    width: 600px;
                                    padding: 20px;
                                    background-color:#f1f1f1;
                                    font-size:28px;
                                    font-weight:bold;
                                    color:rgb(22,24,35);
                                }
                                .main__content {
                                    display: block;
                                    width: 600px;
                                    padding: 20px;
                                    background-color:#f8f8f8;
                                    color:rgba(22,24,35,0.75);
                                }
                                .main__content h2 {
                                    width: 100%;
                                    font-size:18px;
                                    margin-bottom: 20px;
                                    text-align: center;
                                }
                                .main__content iframe {
                                    margin: 0 auto;
                                    margin-bottom: 30px;
                                }
                                .main__content .content__social {
                                    display: flex;
                                    justify-content: space-around;
                                    width: 100%;
                                }
                                .main__content .content__social .social__button {
                                    display: inline-flex;
                                    justify-content: center;
                                    align-items: center;
                                    padding: 20px;
                                    background-color: #000;
                                }
                                .main__content .content__social .social__button a {
                                    display: inline;
                                    text-decoration: none;
                                    color: #fff;
                                    text-decoration: none;
                                }
                            </style>
                            <body>
                                <figure>
                                    <img src="http://localhost/lander_rey/media/images/logo/logo.png" alt="Logo Lander Rey" srcset="http://localhost/lander_rey/media/images/logo/logo.png">
                                </figure>
                                <section class="main__title">
                                    <h1>Lander Rey ha lanzado una nueva canción</h1>
                                </section>
                                <section class="main__content">
                                    <h2 class="content__title">Escucha la nueva canción de Lander Rey llamada '.$name.'</h2>  
                                    <iframe width="560" height="315" src="'.$video.'" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>                 
                                    <div class="content__social">
                                        <div class="social__button"><a href="'.$sp.'">Escuchar en Spotify</a></div>
                                        <div class="social__button"><a href="'.$ap.'">Escuchar en Apple Music</a></div>
                                    </div>
                                </section>
                            </body>
                        </html>
                        '; 
                        */

                        //-$headers  = 'MIME-Version: 1.0' . "\r\n";
                        //-$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
                        //-$headers .= 'From: Recordatorio <thekingled3380@gmail.com>' . "\r\n";

                        //-$search = "SELECT * FROM users";

                        //-$result_search = mysqli_query($connection, $search);
        
                        //-while ($row = $result_search->fetch_assoc()) {
        
                            //-$email = $row["email"];
                            //-mail($email, $subject, $mail_body, $headers); 
                            
                        //-}

                        header("Location: http://localhost/lander_rey/panel/public/songs/");

                    }
                    else {

                        echo '<div><b>Ocurrió algún error al subir el fichero. No pudo guardarse.</b></div>';

                    }
                }
                else {
                    echo '<div><b>Esta cancion ya existe</b></div>';
                }
            }
        }
    }  

?>