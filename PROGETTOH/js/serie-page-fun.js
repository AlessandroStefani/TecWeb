function sos( notifiche ) {
    if(notifiche){
        //window.history.pushState({}, document.URL, "&ciao");
        console.log(document.URL.replace("notifiche=1", "notifiche=0" ));
    } else {
        window.history.pushState({}, document.URL, "&ciao=0");
        //console.log(document.URL.replace("notifiche=0", "notifiche=1" ));    
    }
    //location.reload();
}