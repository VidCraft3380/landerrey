<?php 

    include_once("C:/xampp/htdocs/lander_rey/panel/components/inc/config/db/index.php");
    include("C:/xampp/htdocs/lander_rey/panel/components/inc/tools/CRUD/index.php");

    if($_GET){
        $action =$_GET['action'];
        $album =$_GET['album'];

        if($action == "delete"){
            $sql = "DELETE FROM albums WHERE name='{$album}'";
            mysqli_query($connection, $sql);
            if (file_exists("../../../media/images/albums/".$album."/")) {
                foreach(glob("../../../media/images/albums/".$album . "/*") as $archivos_carpeta){             
                if (is_dir($archivos_carpeta)){
                  rmDir_rf($archivos_carpeta);
                } else {
                unlink($archivos_carpeta);
                }
              }
              rmdir("../../../media/images/albums/".$album);
            } 
        }
    }

?>
<!DOCTYPE html>
<html lang="es">
<?php 
    $style_url= "../../";
    $style = "albums";
    include_once("C:/xampp/htdocs/lander_rey/panel/components/views/blocs/head/index.php");

?>
<body>
    <?php 

        include_once("C:/xampp/htdocs/lander_rey/panel/components/views/blocs/header/index.php");

    ?>
    <main>
        <section class="main__albums">
            <ul class="albums__list">
            <?php 

                $sql = "SELECT * FROM albums";

                $result = mysqli_query($connection, $sql);

                while ($row = $result->fetch_assoc()) {

                    $name = $row["name"];
                    $image = $row["image"];

                    $path_incomplete = substr($image, 26);
                    $path = "../../..".$path_incomplete;

                    $delete = [
                        'action' => 'delete',
                        'album' => $row["name"],
                    ];
                    $modify = [
                        'action' => 'modify',
                        'album' => $row["name"],
                    ];

                    $url =  http_build_query($delete);
                    $url_modify =  http_build_query($modify);

                    echo "<li class='list__item'><figure class='item__image'><img src='{$path}'></figure><div class='item__name'><span>{$name}</span></div><div class='item__buttons'><div class='buttons__modify'><a href='http://localhost/lander_rey/panel/public/albums/modify/index.php?{$url_modify}'>Modificar</a></div><div class='buttons__delete'><a href='index.php?{$url}'>Eliminar</a></div></div></li>";
                }

            ?>
            </ul>
            <div class="albums__buttom">
                <div class="button__add">
                    <a href="http://localhost/lander_rey/panel/public/albums/create/">Añadir</a>
                </div>
            </div>
        </section>
    </main>
</body>
</html>