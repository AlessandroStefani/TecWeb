<!DOCTYPE html>
<html lang="it" dir="ltr">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title><?php echo $templateParams["titolo"] ?></title>
        <link rel="stylesheet" type="text/css" href="../css/series_page.css" />
        <script src="https://kit.fontawesome.com/a076d05399.js"></script>
        <meta charset="UTF-8"/>
    </head>
    <body>
        <nav>      
            <div class="nav_bar">
                <img src="../img/site_logo.PNG" alt="logo">
                <a href="#"><i class="fas fa-qrcode"></i> Home</a>
                <a href="#"><i class="fas fa-user"></i>Profilo</a>
                <a href="#"><i class="fas fa-search"></i>Esplora</a> <!--<i class="fas fa-tv">-->
            </div>
        </nav>

        <aside class="right_aside">
            <div class="notification_check">
                <input type="checkbox" id="notif">
                <label for="notif">Ricevi Notifiche</label>
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
            <?php foreach($templateParams["postSerie"] as $post): ?>
                <article class="main_article">
                    <header>
                        <div class="profile_info">
                            <img src="<?php echo IMG_DIR.$templateParams["serieInfo"]["foto"]?>" alt="Profile_Picture" >
                            <p class="user_name"> <?php echo $templateParams["serieInfo"]["username"]?> </p>
                            <p class="timestamp"> <?php echo $templateParams["serieInfo"]["data"]?> </p>
                        </div>
                    </header>
                    <section class="comment">
                        <div>
                            <img src="<?php echo IMG_DIR.$templateParams["serieInfo"]["immagine"]?>" alt="Comment_Picture">
                        </div>
                        <p>
                            <?php echo $templateParams["serieInfo"]["testo"]?>
                        </p>    
                    </section>
                </article>   
            <?php endforeach ?>

            <article class="main_article">
                <header>
                    <div class="profile_info">
                        <img src="../img/ProfilePic.png" alt="Profile_Picture" >
                        <p class="user_name"> Profile Name </p>
                        <p class="timestamp"> 12:00 </p>
                    </div>
                </header>
                <section class="comment">
                    <p>
                        Lorem ipsum dolor sit, amet consectetur adipisicing elit. Ut tenetur quos nostrum, nisi doloribus maiores eum delectus dolorum corrupti facilis qui iste ea minima, vero libero quia accusantium numquam placeat!
                    </p>    
                </section>
            </article>   

            <article class="main_article">
                <header>
                    <div class="profile_info">
                        <img src="../img/fotoprofilo1.PNG" alt="Profile_Picture" >
                        <p class="user_name"> Profile Name </p>
                        <p class="timestamp"> 12:00 </p>
                    </div>
                </header>
                <section class="comment">
                    <div>
                        <img src="../img/PogAinsley.jpg" alt="Comment_Picture">
                    </div>
                </section>
            </article>    

            <article class="main_article">
                <header>
                    <div class="profile_info">
                        <img src="../img/fotoprofilo2.PNG" alt="Profile_Picture" >
                        <p class="user_name"> Profile Name </p>
                        <p class="timestamp"> 12:00 </p>
                    </div>
                </header>
                <section class="comment">
                    <div>
                        <img src="../img/PogAinsley.jpg" alt="Comment_Picture">
                    </div>
                    <p>
                        Lorem ipsum dolor sit, amet consectetur adipisicing elit. Ut tenetur quos nostrum, nisi doloribus maiores eum delectus dolorum corrupti facilis qui iste ea minima, vero libero quia accusantium numquam placeat!
                    </p>
                </section>
            </article>    

            <article class="main_article">
                <header>
                    <div class="profile_info">
                        <img src="../img/fotoprofilo3.PNG" alt="Profile_Picture" >
                        <p class="user_name"> Profile Name </p>
                        <p class="timestamp"> 12:00 </p>
                    </div>
                </header>
                <section class="comment">
                    <p>
                        Lorem ipsum dolor sit, amet consectetur adipisicing elit. Ut tenetur quos nostrum, nisi doloribus maiores eum delectus dolorum corrupti facilis qui iste ea minima, vero libero quia accusantium numquam placeat!
                    </p>
                </section>
            </article>    

        </main>

        <footer>
            <div class="text_bar">
                <i class="fas fa-plus"></i>                
                <div class="input_container">
                    <input type="text" id="text_b">
                </div>
                <div class="button_textbox">
                    <button><i class="fas fa-arrow-right"></i></button>
                </div>
            </div>
        </footer>

    </body>
</html>