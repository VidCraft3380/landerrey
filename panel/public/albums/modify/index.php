<?php 

    include("C:/xampp/htdocs/lander_rey/panel/components/inc/tools/CRUD/index.php");

?>
<!DOCTYPE html>
<html lang="es">
<?php 
    $style_url= "../../../";
    $style = "create_album";
    include("C:/xampp/htdocs/lander_rey/panel/components/views/blocs/head/index.php");

?>
<body>
    <?php 

        include("C:/xampp/htdocs/lander_rey/panel/components/inc/config/db/index.php");

        include("C:/xampp/htdocs/lander_rey/panel/components/views/blocs/header/index.php");

    ?>
    <?php 
        if($_GET){
            $album_name =$_GET['album'];
            $sql = "SELECT * FROM albums WHERE name='{$album_name}'";
            $result = mysqli_query($connection, $sql);
            while ($row = $result->fetch_assoc()) {
                $name = $row["name"];
                $image = $row["image"]; 

                $path_incomplete = substr($image, 26);
                $path = "../../../..".$path_incomplete;
            }
        } 
    ?>
    <main>
        <section class="main__form" >
            <form action="" method="POST" class="form__fields" enctype="multipart/form-data">
                <label for="" class="field__name">
                    <span>Nombre del album</span>
                    <input type="text" id="form_name" name="form_name" required autocomplete="off" value="<?php echo $name;  ?>"> 
                </label>
                <label for="" class="field__image">
                    <span>Imagen del album</span>
                    <input type="file" id="form_image" name="form_image" required accept="image/*">
                    <label for="form_image" id="image" style="background-image: url('<?php echo $path;  ?>');"></label>
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

        if (isset($file) && $file != "" && $name != "") {

            $type = $_FILES['form_image']['type'];
            $size = $_FILES['form_image']['size'];
            $temp = $_FILES['form_image']['tmp_name'];

            if (!((strpos($type, "gif") || strpos($type, "jpeg") || strpos($type, "jpg") || strpos($type, "png")))) {
                echo '<div><b>Error. La extensión o el tamaño de los archivos no es correcta.<br/>';
            }
            else {

                $path = "../../../../media/images/albums/".$name."/";

                if (!file_exists($path)) {
                    mkdir($path, 0777, true);

                    if (move_uploaded_file($temp, $path.$file)) {

                        chmod($path.$file, 0777);

                        $path_file = "C:/xampp/htdocs/lander_rey/media/images/albums/".$name."/".$file;

                        $sql = "INSERT INTO albums (name, image) VALUES ('{$name}', '{$path_file}')";

                        mysqli_query($connection, $sql);

                        header("Location: http://localhost/lander_rey/panel/public/albums/");
                    }
                    else {

                        echo '<div><b>Ocurrió algún error al subir el fichero. No pudo guardarse.</b></div>';

                    }
                }
                else {

                    if (move_uploaded_file($temp, $path.$file)) {

                        if (file_exists("../../../media/images/albums/".$file."/")) {
                            foreach(glob("../../../media/images/albums/".$file . "/*") as $archivos_carpeta){             
                            if (is_dir($archivos_carpeta)){
                              rmDir_rf($archivos_carpeta);
                            } else {
                            unlink($archivos_carpeta);
                            }
                          }
                          rmdir("../../../media/images/albums/".$file);
                        } 

                        chmod($path.$file, 0777);

                        $path_file = "C:/xampp/htdocs/lander_rey/media/images/albums/".$name."/".$file;

                        if($_GET){
                            $action =$_GET['action'];
                            $album_name =$_GET['album'];

                            if($action == "modify"){
                                $sql = "UPDATE albums SET name='{$name}' , image='{$path_file}' WHERE name='$album_name'";

                                mysqli_query($connection, $sql);

                                header("Location: http://localhost/lander_rey/panel/public/albums/");
                            }

                        }
                        
                    }
                    else {

                        echo '<div><b>Ocurrió algún error al subir el fichero. No pudo guardarse.</b></div>';

                    }
                }
            }
        }
    }  

?>