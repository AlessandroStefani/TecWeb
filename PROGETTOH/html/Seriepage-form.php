<!DOCTYPE html>
<html lang="it" dir="ltr">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title><?php echo $templateParams["serieInfo"]["nome"] ?></title>
        <link rel="stylesheet" type="text/css" href="../css/series_page.css" />
        <link rel="stylesheet" type="text/css" href="../css/nav-di-giovava-style.css" />
        <script src="https://kit.fontawesome.com/a076d05399.js"></script>
        <meta charset="UTF-8"/>
    </head>
    <body>     
        <header>
            <nav class="nav-di-giovava" id="<?php if($_SESSION["notifica_follow"]){echo("true");} else {echo("false");}?>">
            </nav>
        </header>

        <aside class="right_aside">
            <div class="notification_check">
                <form action="" method="POST">
                    <input type="submit" name="notif" id="notif" <?php if($templateParams["notifiche"]){echo "checked";} ?>>
                    <label for="notif"><?php echo ($templateParams["notifiche"] ? ("Notifiche: ON") : "Notifiche: OFF") ?></label>
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
                            <a class="profile_link" href="../php/profile-page.php<?php if($post["idutente"] != $_SESSION["idutente"])echo("?idutente=".$post["idutente"]) ?>"><img class="Profile_Picture" src="<?php echo IMG_DIR.$post["foto profilo"]?>" alt="Profile_Picture"></a>
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
<script src="../js/nav-di-giovava.js" type="text/javascript"></script>
</html>