<!DOCTYPE html>
<html lang="it">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Home</title>
    <link rel="stylesheet" type="text/css" href="../css/home-style.css" />
</head>

<body>
    <header>
        <nav class="nav-di-giovava" id="<?php if($_SESSION["notifica_follow"]){echo("true");} else {echo("false");}?>">
        </nav>
    </header>
    <main>
        <section class="watchtime">
            <p><?php echo($templateParams["tempo-totale"]) ?> minuti</p>
            <p><?php echo($templateParams["episodi-totali"]) ?> episodi</p>
        </section>

        <div class="scroller" id="film">
            <h2>Film</h2>
            <section class="img-container">

                <?php foreach($templateParams["info-film-seguiti"] as $infofilm): ?>
                <a href="../php/serie_page.php?tipo=film&id=<?php echo($infofilm["idfilm"])?>&notifiche=<?php echo($infofilm["notifiche"])?>">
                    <img src="<?php echo IMG_DIR.$infofilm["immagine"]?>" alt="immagine-link <?php echo $infofilm["nome"]?>">
                    <p class="content-title"><?php echo $infofilm["nome"]?></p>
                    <?php if($infofilm["notifiche"]): ?>             
                        <span class="notification-badge"> <?php echo($infofilm["numero-notifiche"]) ?> </span>
                    <?php endif; ?>
                </a>
                <?php endforeach ?>
                
                <a href="../php/content-page.php?film">
                    <img id="add-content">
                    <p class="content-title">Aggiungi Film</p>
                </a>
            </section>
        </div>

        <div class="scroller" id="serieTv">
            <h2>Serie Tv</h2>
            <section class="img-container">

                <?php foreach($templateParams["info-serietv-seguite"] as $infoserietv): ?>
                <a href="../php/serie_page.php?tipo=serietv&id=<?php echo($infoserietv["idserietv"])?>&notifiche=<?php echo($infoserietv["notifiche"])?>">
                    <img src="<?php echo IMG_DIR.$infoserietv["immagine"]?>" alt="immagine-link <?php echo $infoserietv["nome"]?>">
                    <p class="content-title"><?php echo $infoserietv["nome"]?></p>                     
                    <?php if($infoserietv["notifiche"]): ?>             
                        <span class="notification-badge"> <?php echo($infoserietv["numero-notifiche"]) ?> </span>
                    <?php endif; ?>
                </a>
                <?php endforeach ?>

                <a href="../php/content-page.php?serietv">
                    <img id="add-content">
                    <p class="content-title">Aggiungi SerieTv</p>
                </a>
            </section>
        </div>

        <div class="scroller" id="anime">
            <h2>Anime</h2>
            <section class="img-container">

                <?php foreach($templateParams["info-anime-seguiti"] as $infoanime): ?>
                <a href="../php/serie_page.php?tipo=anime&id=<?php echo($infoanime["idanime"])?>&notifiche=<?php echo($infoanime["notifiche"])?>">
                    <img src="<?php echo IMG_DIR.$infoanime["immagine"]?>" alt="immagine-link <?php echo $infoanime["nome"]?>">
                    <p class="content-title"><?php echo $infoanime["nome"]?></p>                     
                    <?php if($infoanime["notifiche"]): ?>             
                        <span class="notification-badge"> <?php echo($infoanime["numero-notifiche"]) ?> </span>
                    <?php endif; ?>
                </a>
                <?php endforeach ?>

                <a href="../php/content-page.php?anime">
                    <img id="add-content">
                    <p class="content-title">Aggiungi Anime</p>
                </a>
            </section>
        </div>
    </main>
</body>
<script src="https://kit.fontawesome.com/a076d05399.js"></script>
<script src="../js/home.js" type="text/javascript"></script>
<script src="../js/nav-di-giovava.js" type="text/javascript"></script>
</html>