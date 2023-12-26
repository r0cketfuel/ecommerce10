document.addEventListener("DOMContentLoaded", function() {
    const slides 		= document.querySelectorAll(".carousel-slide");
    const nextButtons 	= document.querySelectorAll(".btnNext");
    const prevButtons 	= document.querySelectorAll(".btnPrev");
    
    let curSlide 		= 0;
    const maxSlide 		= slides.length - 1;

    nextButtons.forEach(button => {
        button.addEventListener("click", function () {
            if (curSlide < maxSlide) ++curSlide;

            slides.forEach((slide, indx) => {
                slide.style.transform = `translateX(${-100 * curSlide}%)`;
            });
            smoothScroll("top");
        });
    });

    prevButtons.forEach(button => {
        button.addEventListener("click", function () {
            if (curSlide > 0) --curSlide;   

            slides.forEach((slide, indx) => {
                slide.style.transform = `translateX(${-100 * curSlide}%)`;
            });
            smoothScroll("top");
        });
    });

    function smoothScroll(id) {
        const element = document.getElementById(id);
        if(element)
            element.scrollIntoView({ block: "start", behavior: "smooth" });
    }

    const errorFields = document.querySelectorAll(".form-error");

    errorFields.forEach(errorField => {
        errorField.addEventListener("input", function () {
            errorField.classList.remove("form-error");
            const errorMessage = errorField.closest(".panel").querySelector(".field-validation-msg");
            if (errorMessage) {
                errorMessage.remove();
            }
        });
    });

    if (errorFields.length > 0) {
        const elementLabel = errorFields[0].closest(".panel");
        setTimeout(function() { 
            smoothScroll(elementLabel);
        }, 1000);
        errorFields[0].focus();
    }
});