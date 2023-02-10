<!DOCTYPE html>
<html lang="it">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Contenuti</title>
    <link rel="stylesheet" type="text/css" href="../css/content-page-style.css" />
</head>

<body>
    <header>
        <nav class="nav-di-giovava">
        </nav>
    </header>
    <main>
        <button class="tablink" onclick="openPage('Film', this, 'red')">Film</button>
        <button class="tablink" onclick="openPage('SerieTv', this, 'green')" id="defaultOpen">Serie Tv</button>
        <button class="tablink" onclick="openPage('Anime', this, 'blue')">Anime</button>

        <div id="Film" class="tabcontent">
            <?php foreach($templateParams["all-film"] as $film): ?>
                <div class="info-film">
                    <b class="titolo"><?php echo($film["nome"])?></b>
                    <img src="<?php echo(IMG_DIR.$film["immagine"])?>" alt="locandina di <?php echo($film["nome"])?>" class="locandina">
                    <p class="trama"><?php echo($film["trama"])?></p>
                    <p class="durata">Durata: <?php echo($film["durata"])?> minuti</p>
                </div>
            <?php endforeach; ?>
        </div>

        <div id="SerieTv" class="tabcontent">
            <?php foreach($templateParams["all-serietv"] as $serietv): ?>
                <p>CIAO</p>
                
            <?php endforeach; ?>
        </div>

        <div id="Anime" class="tabcontent">
            <?php foreach($templateParams["all-anime"] as $anime): ?>
                <p>CIAO</p>
            <?php endforeach; ?>
        </div>

    </main>
</body>
<script src="../js/nav-di-giovava.js" type="text/javascript"></script>
<script src="../js/content-page.js" type="text/javascript"></script>
<script src="https://kit.fontawesome.com/a076d05399.js"></script>

</html>