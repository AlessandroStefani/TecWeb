<!DOCTYPE html>
<html lang="it" dir="ltr">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title><?php echo $templateParams["serieInfo"]["nome"] ?></title>
        <link rel="stylesheet" type="text/css" href="../css/series_page.css" />
        <script src="https://kit.fontawesome.com/a076d05399.js"></script>
        <meta charset="UTF-8"/>
    </head>
    <body>
        <nav>
            <div class="nav_bar">
                <img src="../img/site_logo.PNG" alt="logo">
                <a href="../php/home-page.php"><i class="fas fa-qrcode"></i> Home</a>
                <a href="../php/profile-page.php"><i class="fas fa-user"></i>Profilo</a>
                <a href="../php/content-page.php"><i class="fas fa-search"></i>Esplora</a> <!--<i class="fas fa-tv">-->
            </div>
        </nav>

        <aside class="right_aside">
            <div class="notification_check">
                <form action="" method="POST">
                    <input type="checkbox" name="notif" id="notif" onchange="" <?php if($templateParams["notifiche"]){echo "checked";} ?>>
                    <label for="notif">Ricevi Notifiche</label>
                </form>
            </div>
        </aside>

        <div class="serie_info">
            <div class="serie_title">
                <h1> <?php echo $templateParams["serieInfo"]["nome"] ?> </h1>
            </div>
            <div class="image_container">
                <img id="center_image" src="<?php echo IMG_DIR.$templateParams["serieInfo"]["immagine"]?>" alt="immagine Serie">    
            </div>
            <div class="serie_description">
                <p> <?php echo $templateParams["serieInfo"]["trama"] ?> </p>
            </div>    
        </div>

        <main>
            <?php foreach($templateParams["posts"] as $post): ?>
                <article class="main_article">
                    <header>
                        <div class="profile_info">
                            <img src="<?php echo IMG_DIR.$post["foto profilo"]?>" alt="Profile_Picture" >
                            <p class="user_name"> <?php echo $post["username"]?> </p>
                            <p class="timestamp"> <?php echo $post["data"]?> </p>
                        </div>
                    </header>
                    <section class="comment">
                        <?php if(isset($post["immagine"])): ?>
                            <div>
                                <img src="<?php echo IMG_DIR.$post["immagine"]?>" alt="Comment_Picture">
                            </div>
                        <?php endif; ?>
                        <?php if(isset($post["testo"])): ?>
                            <p>
                                <?php echo $post["testo"]?>
                            </p>    
                        <?php endif; ?>
                    </section>
                </article>   
            <?php endforeach ?>
        </main>

        <footer>
            <div class="text_bar">
                <form action="../php/serie_page.php<?php echo "?tipo=".$templateParams["tipo"]."&id=".$templateParams["idTipo"]."&notifiche=".$templateParams["notifiche"]?>" method="POST" enctype="multipart/form-data">
                    <input type="file" name="fileToUpload" id="fileToUpload" style="display: none;">
                    <label for="fileToUpload"><i class="fas fa-plus"></i></label>
                    <div class="input_container">
                        <input type="text" name="postText" id="postText">
                    </div>
                    <input type="submit" value="Invia" name="submit">
                </form>
            </div>
        </footer>

    </body>
</html>