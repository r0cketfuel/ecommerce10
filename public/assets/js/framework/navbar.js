document.addEventListener("DOMContentLoaded", () => {

    const menuOpenBtn = document.getElementById("responsive-nav");
    if (menuOpenBtn)
        menuOpenBtn.addEventListener("click", function () { sidebarOpenClose(); return false });

    const mainMenu = document.querySelectorAll(".main-menu-link");
    for (let i = 0; i < mainMenu.length; i++)
        mainMenu[i].addEventListener("click", function () { mainMenuClick(i); return false });

    const subMenu = document.querySelectorAll(".submenu-link");
    for (let i = 0; i < subMenu.length; i++)
        subMenu[i].addEventListener("click", function () { subMenuClick(i); return false });

});

//======================//
// Sidebar Open / Close //
//======================//
function sidebarOpenClose() {
    let navLinks = document.querySelector(".nav-links");
    let menuOpenBtn = document.getElementsByClassName("font-awesome-icon-bars")[0];
    let menuCloseBtn = document.getElementsByClassName("font-awesome-icon-close")[0];

    menuOpenBtn.onclick = function () {
        navLinks.style.left = "0";
    }

    menuCloseBtn.onclick = function () {
        navLinks.style.left = "-100%";
    }
}