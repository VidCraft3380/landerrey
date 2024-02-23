<!DOCTYPE html>
<html lang="es">
<?php 
    $style_url= "../";
    $style = "home";
    include "../components/views/blocs/head/index.php";

?>
<body>
    <?php 

        include "../components/views/blocs/header/index.php";

    ?>
    <main>
        <section class="main__items">
            <h1 class="items__title">Crea, modifica y elimina</h1>
            <div>
                <div class="items__item items__album">
                    <a href="http://localhost/lander_rey/panel/public/albums/" class="item__link">
                        <figure class="link__image">
                            <img src="../components/static/assets/icons/disk/item.svg" alt="Icono de un disco musical" srcset="../components/static/assets/icons/disk/item.svg">
                        </figure>
                        <div class="link__title">
                            <span>Albums</span>
                        </div>
                    </a>
                </div>
                <div class="items__item items__songs">
                    <a href="http://localhost/lander_rey/panel/public/songs/" class="item__link">
                        <figure class="link__image">
                            <img src="../components/static/assets/icons/song/item.svg" alt="Icono de una nota musical" srcset="../components/static/assets/icons/song/item.svg">
                        </figure>
                        <div class="link__title">
                            <span>Canciones</span>
                        </div>
                    </a>
                </div>
                <div class="items__item items__news">
                    <a href="http://localhost/lander_rey/panel/public/news/" class="item__link">
                        <figure class="link__image">
                            <img src="../components/static/assets/icons/news/item.svg" alt="Icono de un periodico musical" srcset="../components/static/assets/icons/news/item.svg">
                        </figure>
                        <div class="link__title">
                            <span>Newsletter</span>
                        </div>
                    </a>
                </div>
            </div>
        </section>
    </main>
</body>
</html>