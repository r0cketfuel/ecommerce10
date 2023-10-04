<div id='modal-categoria-add' class='modal'>
    <div class='modal-content'>
        <div class='modal-header'>
            <h1>Agregar categoría</h1><span class='modalClose' id='modalClose-categoria-add'>X</span>
        </div>
        <div class='modal-body'>

            <input type='text' required id='modal_nombre_categoria'         placeholder='Nombre'>
            <input type='text' required id='modal_descripcion_categoria'    placeholder='Descripcion'>
            <br>
            <button id='modal_button_agregar_categoria' class='btn-primary'><span><i class='fa-solid fa-plus'></i></span>Agregar</button>

            <select required id='modal_categoria'>
                <option value='' disabled selected>Categoría</option>

                @foreach ($categorias as $categoria)
                    <option value="{{ $categoria['id'] }}">{{ $categoria['nombre'] }}</option>
                @endforeach
            </select>

        </div>
    </div>
</div>