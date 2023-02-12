function openPage(pageName, elmnt, color) {
    // Hide all elements with class="tabcontent" by default */
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }

    // Remove the background color of all tablinks/buttons
    tablinks = document.getElementsByClassName("tablink");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].style.backgroundColor = "";
    }

    // Show the specific tab content
    document.getElementById(pageName).style.display = "block";
    window.history.pushState({}, document.URL, "?" + pageName );

    // Add the specific color to the button used to open the tab content
    elmnt.style.backgroundColor = color;
}


function filmAction(idfilm, action) {
    const xmlhttp = new XMLHttpRequest();
    xmlhttp.open("GET", "../utils/content-interactions.php?idfilm=" + idfilm + "&action=" + action);
    xmlhttp.send();
    location.reload();
}

function serieTvAction(idserietv, action) {
    const xmlhttp = new XMLHttpRequest();
    xmlhttp.open("GET", "../utils/content-interactions.php?idserietv=" + idserietv + "&action=" + action);
    xmlhttp.send();
    location.reload();
}

function animeAction(idanime, action) {
    const xmlhttp = new XMLHttpRequest();
    xmlhttp.open("GET", "../utils/content-interactions.php?idanime=" + idanime + "&action=" + action);
    xmlhttp.send();
    location.reload();
}

if(document.URL.includes("?film")) {
    document.getElementById("0").click();
}
    
if(document.URL.includes("?serietv")) {
    document.getElementById("1").click();
}
if(document.URL.includes("?anime")) {
    document.getElementById("2").click();
}
