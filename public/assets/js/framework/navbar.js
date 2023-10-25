document.addEventListener("DOMContentLoaded", () => {
    const menuOpenBtn = document.getElementById("responsive-nav");
    if (menuOpenBtn) {
        menuOpenBtn.addEventListener("click", sidebarOpenClose);
    }

    const mainMenuLinks = document.querySelectorAll(".main-menu-link");
    mainMenuLinks.forEach(link => {
        link.addEventListener("click", mainMenuClick);
    });

    const subMenuLinks = document.querySelectorAll(".submenu-link");
    subMenuLinks.forEach(link => {
        link.addEventListener("click", subMenuClick);
    });
    
});


//======================//
// Sidebar Open / Close //
//======================//
function sidebarOpenClose() {
    let navLinks = document.querySelector(".nav-links");
    navLinks.style.left = navLinks.style.left === "0" ? "-100%" : "0";

    let menuOpenBtn     = document.getElementsByClassName("font-awesome-icon-bars")[0];
    let menuCloseBtn    = document.getElementsByClassName("font-awesome-icon-close")[0];

    menuOpenBtn.onclick = function () {
        navLinks.style.left = "0";
    }

    menuCloseBtn.onclick = function () {
        navLinks.style.left = "-100%";
    }
}

function mainMenuClick()
{
    return;
}

function subMenuClick()
{
    return;
}