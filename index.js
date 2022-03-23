let link = document.getElementById("linkHome")

window.location.pathname === "/Formation_cours2/Blog/index.php" ? link.classList.add("active") : link.classList.remove("active")

if ( window.history.replaceState ) {
    window.history.replaceState( null, null, window.location.href );
}