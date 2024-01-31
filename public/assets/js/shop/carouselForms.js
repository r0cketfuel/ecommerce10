document.addEventListener("DOMContentLoaded", () => {

    const carouselContainer = document.querySelector(".carousel-container");
    const slides 		    = document.querySelectorAll(".carousel-slide");
    const nextButtons 	    = document.querySelectorAll(".btnNext");
    const prevButtons 	    = document.querySelectorAll(".btnPrev");
    const forms             = document.getElementsByClassName('step-form');
    const loader            = document.getElementById("loader");
    
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
    function moveRight()
    {
        if (curSlide < (slides.length - 1))
        {
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

    function loading(status)
    {
        carouselContainer.style.transition  = "opacity 0.4s";

        if(status)
        {
            carouselContainer.style.opacity     = 0.4;
            loader.style.display                = "flex"
        }
        else
        {
            carouselContainer.style.opacity     = 1;
            loader.style.display                = "none"
        }
    }

    function submitForm()
    {
        const button    = event.target;
        const form      = button.closest(".step-form");

        if(form)
        {
            limpiarErrores();
            loading(true);

            // Recopilar datos de todos los formularios anteriores y el formulario actual
            const allForms = document.querySelectorAll(".step-form");
            const formData = new FormData();

            allForms.forEach((form, index) => {
                // Solo recopila datos del formulario actual y los formularios anteriores
                if(index <= curSlide) {
                    const formFields = new FormData(form);
                    formFields.forEach((value, key) => {
                        formData.append(key, value);
                    });
                }
            });

            fetch(form.action, {
                method: form.method,
                body:   formData,
            })
            .then(response => response.json())
            .then(data => {

                loading(false);

                if(data["success"] === true)
                {
                    if(data['redirect_url'])
                    {
                        window.location.href = data['redirect_url'];
                    }
                    else
                    {
                        moveRight();
                    }
                }
                else
                {
                    // Función para recorrer el JSON y agregar mensajes de error debajo de los inputs
                    function mostrarErrores(errors)
                    {
                        limpiarErrores();

                        // Recorre cada campo en los errores
                        for (var campo in errors) {
                            if (errors.hasOwnProperty(campo))
                            {
                                // Obtiene el mensaje de error para el campo actual
                                var mensajes = errors[campo];

                                // Agrega un mensaje de error debajo del input correspondiente

                                // Buscar el elemento dentro del formulario actual
                                var input = document.querySelector('.step-form [name="' + campo + '"]');

                                if(input)
                                {
                                    // Crea un elemento <p> con la clase 'field-validation-msg' y agrega el mensaje
                                    input.classList.add("form-error");
                                    mensajes.forEach(function (mensaje) {
                                    var p = document.createElement("p");
                                    p.className = "field-validation-msg";
                                    p.innerHTML = mensaje;

                                    // Inserta el mensaje de error debajo del input
                                    input.parentNode.insertBefore(p, input.nextSibling);
                                    });
                                }
                            }
                        }
                    }

                    // Llama a la función con el JSON de errores
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