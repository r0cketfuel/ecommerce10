document.addEventListener("DOMContentLoaded", load, false);

function load()
{
    scrollFunction();
    scrollToTopClickEvent();
    sidebarOpenClose();
    openModalclickListener();
	modalCloseEvent();

	let mainMenu = document.querySelectorAll(".main-menu-link");
	for(let i=0;i<mainMenu.length;i++)
		mainMenu[i].addEventListener('click', function() { mainMenuClick(i); return false });

	let subMenu = document.querySelectorAll(".submenu-link");
	for(let i=0;i<subMenu.length;i++)
		subMenu[i].addEventListener('click', function() { subMenuClick(i); return false });
}

//=========//
// ALERTAS //
//=========//
function createAlert(tipo, mensaje)
{
    const seccion   = document.querySelector(".main-container");
    const alerta    = document.createElement("div");

    alerta.classList.add("alert");
    alerta.classList.add(tipo);
    
    alerta.appendChild(document.createElement("div"));
    alerta.appendChild(document.createElement("div"));

    alerta.children[0].innerHTML = mensaje;
    alerta.children[1].innerHTML = "X";
    alerta.children[1].onclick = function() { this.parentElement.style.display="none"; };

    seccion.prepend(alerta);
    alerta.style.display = "flex";
}


//======================================//
// ACCORDION ARROW CLICK EVENT LISTENER //
//======================================//
function accordionArrowClickEvent()
{
    let arrows = document.querySelectorAll(".accordion .arrow");

    console.log(arrows);

    if(arrows)
        for(let i=0;i<arrows.length;++i)
            arrows[i].addEventListener('click', function() { accordionOpenClose(i); return false });
}

//=========================================//
// ALERT CLOSE BUTTON CLICK EVENT LISTENER //
//=========================================//
function alertCloseClickEvent()
{
    let button = document.getElementsByClassName("alert");
    if(button)
        for(let i=0;i<button.length;++i)
            button[i].addEventListener('click', function() { alertClose(i); return false });
}

//===========================================//
// SCROLL TO TOP BUTTON CLICK EVENT LISTENER //
//===========================================//
function scrollToTopClickEvent()
{
    let button = document.getElementById("backToTop");
    if(button)
        button.addEventListener('click', function() { smootScroll('top'); return false });
}

//=================================//
// SCROLL TO TOP BUTTON VISIBILITY //
//=================================//
function scrollFunction()
{
	window.onscroll = function()
	{
        let button = document.getElementById("backToTop");
        if(button)
            if(document.body.scrollTop > 20 || document.documentElement.scrollTop > 20)
            {
                button.style.display = "block";
                button.classList.add("show");
            }
            else
            {
                button.classList.remove("show");
            }
	};
}

//=================//
// SCROLL FUNCTION //
//=================//
function smootScroll(id)
{
    let element = document.getElementById(id);
    if(element)
        element.scrollIntoView({block: "start", behavior: "smooth"});
}

//=============================//
// SIDEBAR OPEN/CLOSE FUNCTION //
//=============================//
function sidebarOpenClose()
{
	let navLinks      = document.querySelector(".nav-links");
	let menuOpenBtn   = document.getElementsByClassName('font-awesome-icon-bars')[0];
	let menuCloseBtn  = document.getElementsByClassName("font-awesome-icon-close")[0];

	menuOpenBtn.onclick = function()
	{
		navLinks.style.left = "0";
	}
	
	menuCloseBtn.onclick = function()
	{
		navLinks.style.left = "-100%";
	}
}

//==========================//
// MAIN MENU CLICK FUNCTION //
//==========================//
function mainMenuClick(index)
{
	let navLinks = document.querySelectorAll(".main-menu");

	//CIERRA TODOS LOS MENUES ACTIVOS
	for(let i=0;i<navLinks.length;i++)
		if(i!=index)
			navLinks[i].classList.remove("active");

	navLinks[index].classList.toggle("active");
}

//========================//
// SUBMENU CLICK FUNCTION //
//========================//
function subMenuClick(index)
{
	let submenuLinks = document.querySelectorAll(".more");

	//CIERRA TODOS LOS SUBMENUES ACTIVOS
	for(let i=0;i<submenuLinks.length;i++)
		if(i!=index)
		submenuLinks[i].classList.remove("active");

	submenuLinks[index].classList.toggle("active");
}

//===============================//
// ACCORDION OPEN CLOSE FUNCTION //
//===============================//
function accordionOpenClose(index)
{
    let acc = document.getElementsByClassName("accordion-header");
    let i;
    
    for(i=0;i<acc.length;i++)
    {
        acc[i].addEventListener("click", function () {
            this.classList.toggle("accordion-active");
    
            let panel = this.nextElementSibling;
    
            if(panel.style.display === "block")
            {
                panel.style.display = "none";
            }
            else
            {
                panel.style.display = "block";
            }
        });
    }
}

//=======================//
// BUTTON EVENT LISTENER //
//=======================//
function openModalclickListener()
{
	var buttons = document.getElementsByClassName('openModal');

	if(buttons)
        for(let i=0;i<buttons.length;++i)
        {
            buttons[i].addEventListener('click', function () { openModal(buttons[i].dataset.modal); return false });
        }
}

//============//
// MODAL SHOW //
//============//
function openModal(modalId)
{
	let modal = document.getElementById("modal-" + modalId);
	modal.style.display = "block";

    let body = document.getElementsByTagName("body");
	body.style.overflow = "hidden";
}

//==================================//
// MODAL CLOSE CLICK EVENT LISTENER //
//==================================//
function modalCloseEvent()
{
	let modals	= [...document.getElementsByClassName("modal")];
	let spans 	= [...document.getElementsByClassName('modalClose')];

	for(let i=0;i<modals.length;++i)
	{
		let temp = modals[i].id.split('-');
		spans[i].addEventListener('click', function() { modalClose(temp[1]); return false });
	}
}

//=============//
// MODAL CLOSE //
//=============//
function modalClose(closeId)
{
	var modals = document.getElementById('modal-' + closeId);

	modals.style.display = "none";

    let body = document.getElementsByTagName("body");
    document.getElementById("top").style.overflowY = "scroll";
}