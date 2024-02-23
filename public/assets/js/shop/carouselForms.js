document.addEventListener("DOMContentLoaded", () => {

    const carouselContainer = document.querySelector(".carousel-container");
    const slides 		    = document.querySelectorAll(".carousel-slide");
    const nextButtons 	    = document.querySelectorAll(".btnNext");
    const prevButtons 	    = document.querySelectorAll(".btnPrev");
    const forms             = document.getElementsByClassName('step-form');
    
    let curSlide = 0;
    let datosRecopilados = {};

    updateProgressIndicator();

    for (let i = 0; i < forms.length; i++) {
        forms[i].addEventListener('submit', function (event) {
            event.preventDefault();

        // Recopilar datos del formulario actual
        var formData = new FormData(event.target);
        for (var [key, value] of formData.entries()) {
            datosRecopilados[key] = value;
        }
    })};

    // Event listener para los botones 'Anterior'
    prevButtons.forEach(button => {
        button.addEventListener("click", function () { moveLeft(); });
    });

    // Event listener para los botones 'Siguiente'
    nextButtons.forEach(button => {
        button.addEventListener("click", function () { submitForm(); });
    });

    // Función desplazamiento de las pantallas a la izquierda
    function moveLeft()
    {
        if (curSlide > 0)
        {
            --curSlide;
            updateProgressIndicator();
        }

        slides.forEach((slide, indx) => { slide.style.transform = `translateX(${-100 * curSlide}%)`; });

        smoothScroll("top");
    }

    // Función desplazamiento de las pantallas a la derecha
    function moveRight(step)
    {
        if (curSlide < (slides.length - 1))
        {
            if(step)
                curSlide = step - 1;
            else
                ++curSlide;

            updateProgressIndicator();
        }

        slides.forEach((slide, indx) => { slide.style.transform = `translateX(${-100 * curSlide}%)`; });

        smoothScroll("top");
    }

    function limpiarErrores()
    {
        document.querySelectorAll('.field-validation-msg').forEach(el => el.remove());
        document.querySelectorAll('.form-error').forEach(el => el.classList.remove("form-error"));
    }

    function submitForm() {
        const button = event.target;
        const form = button.closest(".step-form");
    
        if (form) {
            limpiarErrores();
            loading(true);
    
            // Recopilar datos solo del formulario actual
            const formData = new FormData(form);
    
            fetch(form.action, {
                method: form.method,
                body: formData,
            })
            .then(response => response.json())
            .then(data => {
    
                loading(false);
    
                if (data["success"] === true) {
                    if (data['redirect_url']) {
                        window.location.href = data['redirect_url'];
                    } else {
                        if(data["next-step"])
                            moveRight(data["next-step"]);
                    }
                } else {
                    function mostrarErrores(errors) {
                        limpiarErrores();
    
                        for (var campo in errors) {
                            if (errors.hasOwnProperty(campo)) {
                                var mensajes = errors[campo];
                                var input = document.querySelector('.step-form [name="' + campo + '"]');
                                if (input) {
                                    input.classList.add("form-error");
                                    mensajes.forEach(function (mensaje) {
                                        var p = document.createElement("p");
                                        p.className = "field-validation-msg";
                                        p.innerHTML = mensaje;
                                        input.parentNode.insertBefore(p, input.nextSibling);
                                    });
                                }
                            }
                        }
                    }
    
                    mostrarErrores(data.errors);
                }
            })
            .catch(error => {
                console.error("Error al enviar el formulario:", error);
            });
        }
    }

    // Obtén todos los elementos interactivos dentro del formulario actual
    const formElements = document.querySelectorAll('.step-form input, .step-form select, .step-form button');

    formElements.forEach(function (element, index) {
        // Agrega un evento de escucha al elemento
        element.addEventListener('keydown', function (event) {
            if(event.key === 'Tab') {
                event.preventDefault();

                // Calcula el índice del próximo elemento en el formulario
                const nextIndex = (index + 1) % formElements.length;

                // Establece el foco en el próximo elemento
                formElements[nextIndex].focus();
            }
        });
    });

    function updateProgressIndicator() {
        const progressIndicatorItems = document.querySelectorAll('.progress-indicator li');
        const progressIndicatorDivision = document.querySelectorAll('.progress-indicator div');
    
        progressIndicatorItems.forEach((item, index) => {
            if (index < curSlide)
            {
                item.classList.remove('current-step');
                item.classList.add('success');
            }
            else if (index === curSlide)
            {
                item.classList.remove('success');
                item.classList.add('current-step');
            }
            else
            {
                item.classList.remove('success', 'current-step');
            }
        });

        progressIndicatorDivision.forEach((item, index) => {
            if (index < curSlide)
            {
                item.classList.remove('current-step');
                item.classList.add('success');
            }
            else if (index === curSlide)
            {
                item.classList.remove('success');
                item.classList.add('current-step');
            }
            else
            {
                item.classList.remove('success', 'current-step');
            }
        });
    }
});