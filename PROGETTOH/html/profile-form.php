<!DOCTYPE html>
<html lang="it">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" type="text/css" href="../css/profile-style.css" />
    <title>Profilo</title>
</head>
<body>
    <header>
        <nav class="nav-di-giovava" id="<?php if($_SESSION["notifica_follow"]){echo("true");} else {echo("false");}?>">
        </nav>
    </header>
    <main>
        <?php if((isset($_GET["idutente"]) && $_SESSION["idutente"] == $_GET["idutente"]) || (!isset($_GET["idutente"]))): ?>
        <aside class="logout-aside">
            <form action="" method="POST">
                <input type="submit" value="Logout" name ="logout">
            </form>
        </aside>
        <?php endif ?>

        <section class="profile_info">
            <img src="<?php echo IMG_DIR.$templateParams["UserInfo"]["foto profilo"]?>" alt="ImmagineProfilo">
            <div class="profile_name">
                <p> <?php echo $templateParams["UserInfo"]["username"]."#".$templateParams["UserInfo"]["idutente"]?> </p>
            </div>    
            <?php if( isset($_GET["idutente"]) && $_SESSION["idutente"] != $_GET["idutente"] && !in_array(["idutente" => $dbh->getUserInfobyID($_GET["idutente"])[0]["idutente"], "username" => $dbh->getUserInfobyID($_GET["idutente"])[0]["username"]], $dbh->getFollowedByID($_SESSION["idutente"]))): ?>
                <div class="follow-unfollow">
                    <form action="" method="POST">
                        <input type="submit" value="Followa il cretino" name = "follow">
                    </form>
                </div>    
            <?php elseif( isset($_GET["idutente"]) && $_SESSION["idutente"] != $_GET["idutente"]): ?>
                <div class="follow-unfollow">
                    <form action="" method="POST">
                        <input type="submit" value="UN-Followa il cretino" name = "unfollow">
                    </form>
                </div>    
            <?php endif ?>
        </section>

        <section class="series_info">
            <div class="user_followed">
                <div class="dropdown">
                    <button class="dropbtn"> Users Following </button>
                    <div class="dropup-content">
                    <?php if(isset($templateParams["Followers"])): ?>
                            <?php foreach($templateParams["Followers"] as $followers): ?>
                            <a href="../php/profile-page.php?<?php echo "idutente=".$followers["idutente"]?>"> <?php echo $followers["username"] ?> </a>
                            <?php endforeach ?>
                        <?php else: ?>
                            <a href="#"> U have no friends </a>
                        <?php endif ?>
                    </div>
                </div>
            </div>

            <div class="user_following">
                <div class="dropdown">
                    <button class="dropbtn"> Users Followed </button>
                    <div class="dropup-content">
                        <?php if(isset($templateParams["Followed"])): ?>
                            <?php foreach($templateParams["Followed"] as $followed): ?>
                            <a href="../php/profile-page.php?<?php echo "idutente=".$followed["idutente"]?>"> <?php echo $followed["username"] ?> </a>
                            <?php endforeach ?>
                        <?php else: ?>
                            <a href="#"> U have no friends </a>
                        <?php endif ?>
                    </div>
                </div>
            </div>
        </section>

        <div class="divisorio">
            <p> Posts </p>
        </div>

        <?php foreach($templateParams["postSerietv"] as $post): ?>
            <article class="user_post">
                <div class="date_post-serie_link">
                    <p> <?php echo $post["post"][0]["data"]  ?> </p>
                    <a href="<?php echo "../php/serie_page.php?tipo=".$post["tipo"]."&id=".$post["id"]."&notifiche=".$post["notifiche"] ?>"> <?php echo $post["nome"]?> </a>
                    <form action="../php/profile-page.php" method="POST">
                        <input type="hidden" name="idPost" value="<?php echo $post["post"][0]["idpost"] ?>">
                        <input type="submit" value="Delete" name="deleteOrder" >
                    </form>
                </div>
                <?php if(isset($post["post"][0]["immagine"])): ?>
                <div class="post_image">
                    <img src="<?php echo IMG_DIR.$post["post"][0]["immagine"]?>" alt="ImmaginePost">
                </div>
                <?php endif ?>
                <?php if(isset($post["post"][0]["testo"])): ?>
                <div class="text_post">
                    <p> <?php echo $post["post"][0]["testo"] ?> </p>
                </div>
                <?php endif ?>
            </article>
        <?php endforeach ?>

        <?php foreach($templateParams["postFilm"] as $post): ?>
            <article class="user_post">
                <div class="date_post-serie_link">
                    <p> <?php echo $post["post"][0]["data"]  ?> </p>
                    <a href="<?php echo "../php/serie_page.php?tipo=".$post["tipo"]."&id=".$post["id"]."&notifiche=".$post["notifiche"]?>"> <?php echo $post["nome"]?> </a>
                    <form action="../php/profile-page.php" method="POST">
                        <input type="hidden" name="idPost" value="<?php echo $post["post"][0]["idpost"] ?>">
                        <input type="submit" value="Delete" name="deleteOrder" >
                    </form>
                </div>
                <?php if(isset($post["post"][0]["immagine"])): ?>
                <div class="post_image">
                    <img src="<?php echo IMG_DIR.$post["post"][0]["immagine"]?>" alt="ImmaginePost">
                </div>
                <?php endif ?>
                <?php if(isset($post["post"][0]["testo"])): ?>
                <div class="text_post">
                    <p> <?php echo $post["post"][0]["testo"] ?> </p>
                </div>
                <?php endif ?>
            </article>
        <?php endforeach ?>

        <?php foreach($templateParams["postAnime"] as $post): ?>
            <article class="user_post">
                <div class="date_post-serie_link">
                    <p> <?php echo $post["post"][0]["data"]  ?> </p>
                    <a href="<?php echo "../php/serie_page.php?tipo=".$post["tipo"]."&id=".$post["id"]."&notifiche=".$post["notifiche"]?>"> <?php echo $post["nome"]?> </a>
                    <form action="../php/profile-page.php" method="POST">
                        <input type="hidden" name="idPost" value="<?php echo $post["post"][0]["idpost"] ?>">
                        <input type="submit" value="Delete" name="deleteOrder" >
                    </form>
                </div>
                <?php if(isset($post["post"][0]["immagine"])): ?>
                <div class="post_image">
                    <img src="<?php echo IMG_DIR.$post["post"][0]["immagine"]?>" alt="ImmaginePost">
                </div>
                <?php endif ?>
                <?php if(isset($post["post"][0]["testo"])): ?>
                <div class="text_post">
                    <p> <?php echo $post["post"][0]["testo"] ?> </p>
                </div>
                <?php endif ?>
            </article>
        <?php endforeach ?>

    </main>
</body>
<script src="../js/nav-di-giovava.js" type="text/javascript"></script>
<script src="https://kit.fontawesome.com/a076d05399.js"></script>
</html>