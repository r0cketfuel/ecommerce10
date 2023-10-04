<div id='modal_agregar_subcategoria' class='modal modal-primary' style="display: none">
    <div class='modal-content'>
        <div class='modal-header'>
            <h1>Agregar subcategoría</h1><span class='modalClose' onclick="this.parentElement.parentElement.parentElement.style.display='none';">X</span>
        </div>
        <div class='modal-body'>

            <label>
                Categoría
                <select required id='modal_categoria'>
                    <option value='' disabled selected>Categoría</option>
                        @foreach ($categorias as $categoria)
                            <option value="{{ $categoria['id'] }}">{{ $categoria['nombre'] }}</option>
                        @endforeach
                </select>
            </label>

            <label>
                Nombre
                <input type='text' required id='modal_nombre_subcategoria' placeholder='Nombre'>
            </label>

            <label>
                Descripción
                <input type='text' required id='modal_descripcion_subcategoria' placeholder='Descripcion'>
            </label>

            <button id='boton_agregar_subcategoria_modal' class='btn-primary'><span><i class='fa-solid fa-plus'></i></span>Agregar</button>

        </div>
    </div>
</div>