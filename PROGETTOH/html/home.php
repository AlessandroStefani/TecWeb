<!DOCTYPE html>
<html lang="it">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Home</title>
    <link rel="stylesheet" type="text/css" href="../css/home-style.css" />
</head>

<body>
    <header>
        <nav class="nav-di-giovava">
            <h1>qui ci va il nav di giovava</h1>
        </nav>
    </header>
    <main>
        <section class="watchtime">
            <p>qui ci va il tempo totale</p>
            <p>e qui il numero di episodi e film visti</p>
        </section>

        <div class="scroller" id="film">
            <h2>Film</h2>
            <section class="img-container">

                <?php foreach($templateParams["info-film-seguiti"] as $infofilm): ?>
                <a href="#">
                    <img src="<?php echo IMG_DIR.$infofilm["immagine"]?>" alt="immagine-link <?php echo $infofilm["nome"]?>">
                    <p class="content-title"><?php echo $infofilm["nome"]?></p>                     
                    <span class="notification-badge">5</span>
                </a>
                <?php endforeach ?>
                
                <a href="../html/content-page.html">
                    <img id="add-content">
                    <p class="content-title">Aggiungi Film</p>
                </a>
            </section>
        </div>

        <div class="scroller" id="serieTv">
            <h2>Serie Tv</h2>
            <section class="img-container">

                <?php foreach($templateParams["info-serietv-seguite"] as $infoserietv): ?>
                <a href="#">
                    <img src="<?php echo IMG_DIR.$infoserietv["immagine"]?>" alt="immagine-link <?php echo $infoserietv["nome"]?>">
                    <p class="content-title"><?php echo $infoserietv["nome"]?></p>                     
                    <span class="notification-badge">5</span>
                </a>
                <?php endforeach ?>

                <a href="../html/content-page.html">
                    <img id="add-content">
                    <p class="content-title">Aggiungi SerieTv</p>
                </a>
            </section>
        </div>

        <div class="scroller" id="anime">
            <h2>Anime</h2>
            <section class="img-container">

                <?php foreach($templateParams["info-anime-seguiti"] as $infoanime): ?>
                <a href="#">
                    <img src="<?php echo IMG_DIR.$infoanime["immagine"]?>" alt="immagine-link <?php echo $infoanime["nome"]?>">
                    <p class="content-title"><?php echo $infoanime["nome"]?></p>                     
                    <span class="notification-badge">5</span>
                </a>
                <?php endforeach ?>

                <a href="../html/content-page.html">
                    <img id="add-content">
                    <p class="content-title">Aggiungi Anime</p>
                </a>
            </section>
        </div>
    </main>
</body>
<script src="../js/home.js" type="text/javascript"></script>
</html>