document.addEventListener("DOMContentLoaded", () => {

    let acc = document.getElementsByClassName("accordion-header");

    for(let i=0;i<acc.length;i++)
        acc[i].addEventListener("click", function () { this.classList.toggle("accordion-active"); });

});