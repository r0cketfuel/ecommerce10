@extends("admin.layout.master")

@section("title", "Nuevo artículo")

@section("css")
    <link rel="stylesheet"	href="{{config('constants.framework_css')}}modal.css">
    <link rel="stylesheet"	href="{{config('constants.framework_css')}}layout.css">
    <link rel="stylesheet"	href="{{config('constants.framework_css')}}panel.css">
    <link rel="stylesheet"	href="{{config('constants.framework_css')}}alert.css">
@endsection

@section("body")
    <div class="main-container">
        
        @if ($errors->any())
            <div class="alert danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
                <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
            </div>
        @endif

        <h1>Nuevo artículo</h1>

        @include('admin.articulos.modals.categoria')
        @include('admin.articulos.modals.subcategoria')

        <div class="grid grid-cols-12 grid-align-start gap3">
            <div class="col-span-6 col-span-900p-12">
                <div class="panel">
                    <div class="panel-title">Datos del producto</div>
                    <div class="panel-content">
                        <fieldset>
                            <legend>Categoría</legend>
                            <select form="form" id="categoria_id" name="categoria" value="{{ old('categoria') }}">
                                <option value="" disabled selected>Categoría</option>
                                @foreach ($categorias as $categoria)
                                    <option value="{{ $categoria['id'] }}">{{ $categoria['nombre'] }}</option>
                                @endforeach
                            </select>

                            <select form="form" id="subcategoria_id" name="subcategoria" disabled value="{{ old('subcategoria') }}">
                                <option value="" disabled selected>Subcategoría</option>
                            </select>
                            <div class="flex">
                                <button type="button" class="openModal" id="boton_agregar_categoria"><span><i class="fa-solid fa-plus"></i></span>Categoría</button>
                                <button type="button" class="openModal" id="boton_agregar_subcategoria"><span><i class="fa-solid fa-plus"></i></span>Subcategoría</button>
                            </div>
                        </fieldset>

                        <fieldset>
                            <legend>Datos principales</legend>
                            <div class="flex">
                                <label>
                                    Codigo
                                    <input form="form" type="text" name="codigo" class="{{ $errors->has('codigo') ? 'form-error' : '' }}" value="{{ old('codigo') }}" required>
                                </label>
                                @if ($errors->has('codigo'))
                                    <p class="field-validation-msg"><i class="fa-solid fa-triangle-exclamation"></i> {{ $errors->first('codigo') }}</p>
                                @endif
                            </div>
                            <div class="flex">
                                <label>
                                    Nombre
                                    <input form="form" type="text" name="nombre" class="{{ $errors->has('nombre') ? 'form-error' : '' }}" value="{{ old('nombre') }}" required>
                                </label>
                                @if ($errors->has('nombre'))
                                    <p class="field-validation-msg"><i class="fa-solid fa-triangle-exclamation"></i> {{ $errors->first('nombre') }}</p>
                                @endif
                            </div>
                            <div class="flex">
                                <label>
                                    Descripción
                                    <input form="form" type="text" name="descripcion" class="{{ $errors->has('descripcion') ? 'form-error' : '' }}" value="{{ old('descripcion') }}" required>
                                </label>
                                @if ($errors->has('descripcion'))
                                    <p class="field-validation-msg"><i class="fa-solid fa-triangle-exclamation"></i> {{ $errors->first('descripcion') }}</p>
                                @endif
                            </div>
                        </fieldset>

                        <fieldset>
                            <legend>Datos principales</legend>
                            <div class="flex">
                                <label>
                                    Precio
                                    <input form="form" type="text" name="precio" class="{{ $errors->has('precio') ? 'form-error' : '' }}" value="{{ old('precio') }}" required>
                                </label>
                                @if ($errors->has('precio'))
                                    <p class="field-validation-msg"><i class="fa-solid fa-triangle-exclamation"></i> {{ $errors->first('precio') }}</p>
                                @endif
                            </div>
                            <div class="flex">
                                <label>
                                    Moneda
                                    <select form="form" name="moneda" class="{{ $errors->has('moneda') ? 'form-error' : '' }}" required>
                                        <option value="" disabled selected>Seleccione...</option>
                                        <option value="1" {{ old('moneda') == 1 ? 'selected' : '' }}>Pesos</option>
                                        <option value="2" {{ old('moneda') == 2 ? 'selected' : '' }}>Dólares</option>
                                    </select>
                                </label>
                                @if ($errors->has('moneda'))
                                    <p class="field-validation-msg"><i class="fa-solid fa-triangle-exclamation"></i> {{ $errors->first('moneda') }}</p>
                                @endif
                            </div>
                            <p class="nota">El precio del dólar se actualiza todos los días a las: FALTA</p>
                        </fieldset>

                        <fieldset>
                            <legend>Atributos</legend>
                            <div id="clone" class="flex row">
                                <select name="talles[]">
                                    <option value="" disabled selected>Talles</option>
                                    @foreach ($talles as $talle)
                                        <option value="{{ $talle['id'] }}">{{ $talle['talle'] }}</option>
                                    @endforeach
                                </select>
                                <input form="form" type="number" name="stock[]" placeholder="Stock" min="1" required>
                                <input form="form" type="color"  name="color[]">
                                <button class="btn-danger" onclick="eliminarAtributo(this.parentNode);" style="width: 70px; display: block"><i class="fa-solid fa-trash-can"></i></button>
                            </div>
                            <button form="form" type="button" onclick="agregarAtributo();"><span><i class="fa-solid fa-plus"></i></span>Atributo</button>
                        </fieldset>

                        <script>
                            function agregarAtributo() {
                                const cloneDiv = document.querySelector("#clone");
                                let clone = cloneDiv.cloneNode(true);
                                clone.children[1].value = "";
                                clone.children[2].value = "";
                                clone.removeAttribute("id");
                                cloneDiv.after(clone);
                            }

                            function eliminarAtributo(element) {
                                if (element.id != "clone")
                                    element.remove();
                            }
                        </script>

                        <fieldset>
                            <legend>Presentación</legend>
                            <label>
                                Detalle del artículo
                                <textarea id="detalle" name="detalle" form="form">{{ old('detalle') }}</textarea>
                            </label>
                        </fieldset>

                        <button form="form" type="submit" class="btn-primary"><span><i class="fa-solid fa-plus"></i></span>Publicar artículo</button>
                    </div>
                </div>
            </div>

            <div class="col-span-6 col-span-900p-12">
                <div class="panel">
                    <div class="panel-title">Imágenes</div>
                    <div class="panel-content">
                        <legend>Imagen principal</legend>
                        <div class="cropme" id="landscape" style="width: 100%; height: 285px; border: 1px dashed #ddd; background: #f1f1f1;">
                            <a href="javascript:;" id="crop-image" class="d-inline-block mybtn1"><i class="icofont-upload-alt"></i> Upload Image Here</a>
                        </div>
                        <input type="hidden" id="feature_photo" name="photo" value="">
                    </div>
                </div>
            </div>
        </div>

        <form id="form" method="post" enctype="multipart/form-data" action="{{ route('articulos.store') }}">@csrf</form>
    </div>


    <script>
        document.addEventListener("DOMContentLoaded", load, false);

        const modalAgregarCategoria         = document.getElementById("modal_agregar_categoria");
        const modalAgregarSubcategoria      = document.getElementById("modal_agregar_subcategoria");

        const botonAgregarCategoriaModal    = document.getElementById("boton_agregar_categoria_modal")
        const botonAgregarSubcategoriaModal = document.getElementById("boton_agregar_subcategoria_modal")

        const selectCategorias              = document.getElementById("categoria_id");
        const selectSubcategorias           = document.getElementById("subcategoria_id");
        
        const botonAgregarCategoria         = document.getElementById("boton_agregar_categoria");
        const botonAgregarSubcategoria      = document.getElementById("boton_agregar_subcategoria");
        
        function load()
        {
            botonAgregarCategoria.addEventListener("click",         modalAgregarCategoriaShow,      false);
            botonAgregarSubcategoria.addEventListener("click",      modalAgregarSubcategoriaShow,   false);

            botonAgregarCategoriaModal.addEventListener("click",    agregarCategoriaClick,          false);
            botonAgregarSubcategoriaModal.addEventListener("click", agregarSubcategoriaClick,       false);

            selectCategorias.addEventListener("change",             categoriasChangeEvent,          false);
        }

        function modalAgregarCategoriaShow()
        {
            modalAgregarCategoria.style.display = "block";
        }

        function modalAgregarSubcategoriaShow()
        {
            modalAgregarSubcategoria.style.display = "block";
        }

        async function listadoCategorias()
        {
            const url = "/api/categorias";

            const response  = await fetch(url, {
                method: "GET",
                headers: {
                    "Content-Type": "application/json",
                },
            });

            return response;
        }

        async function listadoSubcategorias()
        {
            const url = "/api/subcategorias";

            const response  = await fetch(url, {
                method: "GET",
                headers: {
                    "Content-Type": "application/json",
                },
            });

            return response;
        }

        async function agregarCategoriaClick()
        {
            try {
                const inputName         = document.getElementById("modal_nombre_categoria");
                const inputDescripcion  = document.getElementById("modal_descripcion_categoria");
                const buttonLabel       = botonAgregarCategoria.innerHTML;

                botonAgregarCategoria.disabled = true;

                const url = "/api/categorias";
                const parametros = {
                    nombre:         inputName.value,
                    descripcion:    inputDescripcion.value,
                };

                const response = await fetch(url, {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                },
                body: JSON.stringify(parametros),
                });

                if(response.status === 201)
                {
                    const nuevaCategoria = await response.json();
                    nuevaCategoriaId = nuevaCategoria.id;

                    // Reset boton agregar
                    botonAgregarCategoria.disabled = false;

                    // Reset controles
                    inputName.value = "";
                    inputDescripcion.value = "";

                    // Reset select categorías
                    selectCategorias.disabled = true;
                    selectCategorias.innerHTML = '<option value="" selected>Categoría</option>';

                    // Reset select subcategorías
                    selectSubcategorias.disabled = true;
                    selectSubcategorias.innerHTML = '<option value="" selected>Subcategoría</option>';

                    // Recarga categorías
                    const responseCategorias    = await listadoCategorias();
                    const categorias            = await responseCategorias.json();
                    
                    categorias.forEach((categoria) => {
                        const isSelected = categoria.id === nuevaCategoriaId;
                        addOption(selectCategorias, categoria.id, categoria.nombre, false, isSelected);
                    });

                    // Habilita select categorías y cierra el modal
                    selectCategorias.disabled = false;

                    modalAgregarCategoria.style.display = 'none';
                }
            }
            catch (error)
            {
                console.error("Error al agregar categoría:", error);
            }
        }

        function agregarSubcategoriaClick()
        {
            //Controles del modal
            let modalSelectCategoria    = document.getElementById("modal_categoria");
            let inputName               = document.getElementById("modal_nombre_subcategoria");
            let inputDescripcion        = document.getElementById("modal_descripcion_subcategoria");
            let buttonLabel 	        = botonAgregarSubcategoria.innerHTML;

            modalAgregarSubcategoria.style.display  = "block";
            botonAgregarSubcategoria.disabled       = true;

            let xhttp 	= new XMLHttpRequest()
            let url 	= "/admin/ajax/agregaSubcategoria";
            
            let parametros = {};
            parametros["idCategoria"]   = modalSelectCategoria.value;
            parametros["nombre"]        = inputName.value;
            parametros["descripcion"]   = inputDescripcion.value;

            xhttp.onreadystatechange = function()
            {
                if(this.readyState == 4 && this.status == 200)
                {             
                    //Reset boton agregar
                    botonAgregarSubcategoria.innerHTML = buttonLabel;
                    botonAgregarSubcategoria.disabled = false;

                    //Reset controles
                    modalSelectCategoria.value  = "";
                    inputName.value             = "";
                    inputDescripcion.value      = "";

                    //Reset select subcategorías
                    selectSubcategorias.disabled        = true;
                    selectSubcategorias.options.length  = 0;
                    addOption(selectSubcategorias,"","Subcategoría",true,true);
                    
                    //Recarga subcategorías
                    const array = JSON.parse(this.responseText);
                    for(let i=0;i<array.length;++i)
                        addOption(selectSubcategorias, array[i]["nombre"], array[i]["descripcion"], false, false);

                    selectSubcategorias.disabled = false;
                    modalClose(2);

                    createAlert("success","Subcategoría creada exitosamente");
                }
            }

            xhttp.open("POST", url, true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send("parametros=" + JSON.stringify(parametros));
        }

        function addOption(selectElement,value,text,disabled,selected)
        {
            let option      = document.createElement("option");
            option.value    = value;
            option.text     = text;
            option.disabled = disabled;
            option.selected = selected;

            selectElement.add(option);
        }

        function categoriasChangeEvent()
        {
            let parametros  = {};
            let xhttp 	    = new XMLHttpRequest()
            let url 	    = "/api/subcategorias/" + selectCategorias.value;
            
            //Reset select subcategorías
            selectSubcategorias.disabled        = true;
            selectSubcategorias.options.length  = 0;
            addOption(selectSubcategorias,"","Subcategoría",true,true);

            xhttp.onreadystatechange = function()
            {
                if(this.readyState == 4 && this.status == 200)
                {             
                    const array = JSON.parse(this.responseText);
                    if(array.length>0)
                    {
                        for(let i=0;i<array.length;++i)
                            addOption(selectSubcategorias, array[i]["id"], array[i]["nombre"], false, false);

                        selectSubcategorias.disabled = false;
                    }
                }
            }

            xhttp.open("GET", url, true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send("parametros=" + JSON.stringify(parametros));
        }

    </script>

@endsection
