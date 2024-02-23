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
    <?php 
        if($_GET){
            $song_name =$_GET['song'];
            $sql = "SELECT * FROM music WHERE name='{$song_name}'";
            $result = mysqli_query($connection, $sql);
            while ($row = $result->fetch_assoc()) {
                $song_name = $row["name"];
                $song_image = $row["image"]; 
                $song_video = $row["video"]; 
                $song_yt = $row["youtube"]; 
                $song_sp = $row["spotify"]; 
                $song_ap = $row["apple_music"]; 
                $song_artist = $row["artists"]; 
                $song_album = $row["album"]; 

                $path_incomplete = substr($song_image, 26);
                $path = "../../../..".$path_incomplete;
            }
        } 
    ?>
    <main>
        <section class="main__form" >
            <form action="" method="POST" class="form__fields" enctype="multipart/form-data">
                <label for="" class="field__name">
                    <span>Nombre de la cancion</span>
                    <input type="text" id="form_name" name="form_name" required autocomplete="off" value="<?php echo $song_name;  ?>"> 
                </label>
                <label for="" class="field__image">
                    <span>Imagen de la cancion</span>
                    <input type="file" id="form_image" name="form_image" required accept="image/*" >
                    <label for="form_image" style="background-image: url('<?php echo $path;  ?>');"></label>
                </label>
                <label for="" class="field__video">
                    <span>Video de YouTube</span>
                    <input type="url" id="form_video" name="form_video" required autocomplete="off" value="<?php echo $song_video;  ?>"> 
                </label>
                <label for="" class="field__yt">
                    <span>Enlace a YouTube</span>
                    <input type="url" id="form_yt" name="form_yt" required autocomplete="off" value="<?php echo $song_yt;  ?>"> 
                </label>
                <label for="" class="field__sp">
                    <span>Enlace a Spotify</span>
                    <input type="url" id="form_sp" name="form_sp" required autocomplete="off" value="<?php echo $song_sp;  ?>"> 
                </label>
                <label for="" class="field__ap">
                    <span>Enlace a Apple Music</span>
                    <input type="url" id="form_ap" name="form_ap" required autocomplete="off" value="<?php echo $song_ap;  ?>"> 
                </label>
                <label for="" class="field__artists">
                    <span>¿Hay colaboradores?</span>
                    <input type="text" id="form_artists" name="form_artists" placeholder="Si no hay dejelo vacio"  autocomplete="off" value="<?php echo $song_artist;  ?>"> 
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
                    <button id="form_button" name="form_button" type="submit">Actualizar</button>
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

                        $register_sql_list = "SELECT count(*) FROM music";
                        $register_sql = intval($register_sql_list)+1;

                        $path_file = "C:/xampp/htdocs/lander_rey/media/images/songs/".$name."/".$file;

                        $sql = "INSERT INTO music (id, name, image, video, youtube, spotify, apple_music, artists, album) VALUES ('{$register_sql}', '{$name}', '{$path_file}', '{$video}', '{$yt}', '{$sp}', '{$ap}', '{$artist}', '{$album}')";

                        mysqli_query($connection, $sql);

                        header("Location: http://localhost/lander_rey/panel/public/songs/");
                    }
                    else {

                        echo '<div><b>Ocurrió algún error al subir el fichero. No pudo guardarse.</b></div>';

                    }
                }
                else {
                    if (move_uploaded_file($temp, $path.$file)) {

                        if (file_exists("../../../media/images/songs/".$file."/")) {
                            foreach(glob("../../../media/images/songs/".$file . "/*") as $archivos_carpeta){             
                            if (is_dir($archivos_carpeta)){
                              rmDir_rf($archivos_carpeta);
                            } else {
                            unlink($archivos_carpeta);
                            }
                          }
                          rmdir("../../../media/images/songs/".$file);
                        } 

                        chmod($path.$file, 0777);

                        $path_file = "C:/xampp/htdocs/lander_rey/media/images/songs/".$name."/".$file;

                        if($_GET){
                            $action =$_GET['action'];
                            $album_name =$_GET['song'];

                            if($action == "modify"){
                                $sql = "UPDATE albums SET name='{$name}', image='{$path_file}', video='{$v}', youtube='{$yt}', spotify='{$sp}', apple_music='{$ap}', artists='{$artist}', album='{$album}',  WHERE name='$album_name'";

                                mysqli_query($connection, $sql);

                                header("Location: http://localhost/lander_rey/panel/public/albums/");
                            }

                        }
                    }
                }
            }
        }
    }  

?>