const nav = document.querySelector('.nav-di-giovava');
const head = document.querySelector("head");

let ilNav;

if (document.querySelector("#true")) {
    ilNav = `
    <div class="nav_bar">
        <img src="../img/site_logo.PNG" alt="logo">
        <a href="../php/home-page.php"><i class="fas fa-qrcode"></i> Home</a>
        <a class="profilo" href="../php/profile-page.php" style="background-color:red;"><i class="fas fa-user"></i>Profilo</a>
        <a href="../php/content-page.php"><i class="fas fa-search"></i>Esplora</a>
    </div>
    `;
} else {
    ilNav = `
    <div class="nav_bar">
        <img src="../img/site_logo.PNG" alt="logo">
        <a href="../php/home-page.php"><i class="fas fa-qrcode"></i> Home</a>
        <a class="profilo" href="../php/profile-page.php"><i class="fas fa-user"></i>Profilo</a>
        <a href="../php/content-page.php"><i class="fas fa-search"></i>Esplora</a>
    </div>
    `;
}

let loStileDelNav = `
<link rel="stylesheet" type="text/css" href="../css/nav-di-giovava-style.css" />
`;

nav.innerHTML += ilNav;
head.innerHTML += loStileDelNav;
