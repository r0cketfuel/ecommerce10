document.addEventListener('DOMContentLoaded', function () {
    var alerts = document.querySelectorAll('.alert');
    var offset = 20; // Espacio entre alertas

    alerts.forEach(function (alert, index) {
        var previousAlertHeight = 0;

        // Calcula la posición superior para cada alerta
        for (var i = 0; i < index; i++) {
            previousAlertHeight += alerts[i].offsetHeight + offset;
        }

        // Establece la posición superior
        alert.style.top = (40 + previousAlertHeight) + 'px';
    });
});