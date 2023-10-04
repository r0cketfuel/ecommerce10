<div id='modal_agregar_categoria' class='modal modal-primary' style="display: none">
    <div class='modal-content'>
        <div class='modal-header'>
            <h1>Agregar categoría</h1><span class='modalClose' onclick="this.parentElement.parentElement.parentElement.style.display='none';">X</span>
        </div>
        <div class='modal-body'>

            <label>
                Nombre
                <input type='text' required id='modal_nombre_categoria' placeholder='Nombre'>
            </label>

            <label>
                Descripción
                <input type='text' required id='modal_descripcion_categoria' placeholder='Descripcion'>
            </label>
            
            <button id='boton_agregar_categoria_modal' class='btn-primary'><span><i class='fa-solid fa-plus'></i></span>Agregar</button>

        </div>
    </div>
</div>